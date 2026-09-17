    /* ===================================================
    PRESENSI LEAFLET MAP & GEOLOCATION LOGIC
    =================================================== */
    document.addEventListener("DOMContentLoaded", function () {
        // 1. Inisialisasi Jam Digital Realtime
        updateClock();
        setInterval(updateClock, 1000);

        // 2. Lokasi Sekolah (Set Manual - Contoh: Kota Palu, Sulawesi Tengah)
        // SMAN 1 Palu sebagai titik acuan lokasi sekolah
        const sekolahLat = parseFloat(document.getElementById("latitude").value);
        const sekolahLng = parseFloat(document.getElementById("longitude").value);

        // Inisialisasi Leaflet Map dengan pusat di Kota Palu
        const map = L.map('map').setView([sekolahLat, sekolahLng], 15);

        // Pilihan TileLayer: CartoDB Positron (Tampilan Bersih & Modern)
        L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> &copy; <a href="https://carto.com/">CARTO</a>'
        }).addTo(map);

        // Icon Custom untuk Sekolah (Warna Hijau)
        const schoolIcon = L.icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        // Icon Custom untuk User (Warna Emas/Oranye)
        const userIcon = L.icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-gold.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        // Marker 1: Titik Lokasi Sekolah
        const schoolMarker = L.marker([sekolahLat, sekolahLng], { icon: schoolIcon }).addTo(map);
        schoolMarker.bindPopup("<b>Lokasi Sekolah (Palu)</b><br>Titik Presensi Utama.").openPopup();

        // Radius Lingkaran Area Presensi (contoh 100 Meter)
        L.circle([sekolahLat, sekolahLng], {
            color: '#047857',
            fillColor: '#10b981',
            fillOpacity: 0.15,
            radius: parseInt(document.getElementById("radius").value)
        }).addTo(map);

        // 3. Request Izin Akses Geolocation Browser
        if (navigator.geolocation) {
            navigator.geolocation.watchPosition(
                function (position) {
                    const userLat = position.coords.latitude;
                    const userLng = position.coords.longitude;

                    // Update UI Koordinat
                    document.getElementById('user-lat').innerText = userLat.toFixed(6);
                    document.getElementById('user-lng').innerText = userLng.toFixed(6);

                    // Marker 2: Titik Lokasi User
                    if (window.userMarker) {
                        window.userMarker.setLatLng([userLat, userLng]);
                    } else {
                        window.userMarker = L.marker([userLat, userLng], { icon: userIcon }).addTo(map);
                        window.userMarker.bindPopup("<b>Posisi Anda Sekarang</b>").openPopup();
                    }

                    // Hitung Jarak User ke Sekolah (Haversine Formula)
                    const distance = calculateDistance(sekolahLat, sekolahLng, userLat, userLng);
                    const statusElement = document.getElementById('location-status');
                    const button = document.getElementById("absen");

                    if (distance <= 500) {
                        statusElement.className = "location-status status-ok";
                        statusElement.innerHTML = `<i class="fa-solid fa-circle-check"></i> Anda berada dalam radius presensi (${Math.round(distance)} meter dari sekolah).`;
                    } else {
                        statusElement.className = "location-status status-warn";
                        statusElement.innerHTML = `<i class="fa-solid fa-triangle-exclamation"></i> Anda di luar radius presensi (${Math.round(distance)} meter dari sekolah).`;
                        button.setAttribute("disabled","");
                    }

                    // Fit Bounds agar kedua marker terlihat di peta
                    const group = L.featureGroup([schoolMarker, window.userMarker]);
                    map.fitBounds(group.getBounds().pad(0.2));
                },
                function (error) {
                    console.warn("Akses lokasi ditolak/error: " + error.message);
                    document.getElementById('location-status').className = "location-status status-warn";
                    document.getElementById('location-status').innerHTML = `<i class="fa-solid fa-location-crosshairs"></i> Izinkan akses lokasi browser untuk dapat melakukan absen.`;
                },
                {
                    enableHighAccuracy: true,
                    maximumAge: 0,
                    timeout: 10000
                }
            );
        } else {
            alert("Browser Anda tidak mendukung Geolocation.");
        }
    });

    // Fungsi Update Jam Digital
    function updateClock() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');

        document.getElementById('live-time').innerText = `${hours}:${minutes}:${seconds} WITA`;

        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('live-date').innerText = now.toLocaleDateString('id-ID', options);
    }

    // Fungsi Hitung Jarak (Hasil dalam Meter)
    function calculateDistance(lat1, lon1, lat2, lon2) {
        const R = 6371e3; // Radius bumi dalam meter
        const φ1 = lat1 * Math.PI / 180;
        const φ2 = lat2 * Math.PI / 180;
        const Δφ = (lat2 - lat1) * Math.PI / 180;
        const Δλ = (lon2 - lon1) * Math.PI / 180;

        const a = Math.sin(Δφ / 2) * Math.sin(Δφ / 2) +
                Math.cos(φ1) * Math.cos(φ2) *
                Math.sin(Δλ / 2) * Math.sin(Δλ / 2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

        return R * c; 
    }