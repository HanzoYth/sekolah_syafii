document.addEventListener("DOMContentLoaded", function () {
    // 1. Ambil Elemen DOM
    var latInput = document.getElementById('latitude');
    var lngInput = document.getElementById('longitude');
    var radiusInput = document.getElementById('radius');
    var namaLokasiInput = document.getElementById('nama_lokasi');
    var dataList = document.getElementById('lokasi_list');

    // Nilai koordinat default/fallback (Palu / -0.8917, 119.8707)
    var defaultLat = parseFloat(latInput ? latInput.value : -0.8917) || -0.8917;
    var defaultLng = parseFloat(lngInput ? lngInput.value : 119.8707) || 119.8707;
    var defaultRadius = parseInt(radiusInput ? radiusInput.value : 100) || 100;

    // 2. Inisialisasi Peta Leaflet
    var map = L.map('map-setting').setView([defaultLat, defaultLng], 16);

    // Tile Layer OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    }).addTo(map);

    // Marker (bisa di-drag)
    var marker = L.marker([defaultLat, defaultLng], { draggable: true }).addTo(map);

    // Circle / Area Radius
    var circle = L.circle([defaultLat, defaultLng], {
        color: '#214E32',
        fillColor: '#CFA138',
        fillOpacity: 0.25,
        radius: defaultRadius
    }).addTo(map);

    // 3. Fungsi Helper Update Posisi (Peta, Marker, Circle, & Input)
    function updatePosition(lat, lng) {
        if (latInput) latInput.value = lat.toFixed(6);
        if (lngInput) lngInput.value = lng.toFixed(6);

        var newLatLng = new L.LatLng(lat, lng);
        marker.setLatLng(newLatLng);
        circle.setLatLng(newLatLng);
        map.panTo(newLatLng);
    }

    // 4. Event Drag Marker
    marker.on('dragend', function () {
        var pos = marker.getLatLng();
        updatePosition(pos.lat, pos.lng);
    });

    // 5. Event Klik di Peta
    map.on('click', function (e) {
        updatePosition(e.latlng.lat, e.latlng.lng);
    });

    // 6. Event Ubah Radius
    if (radiusInput) {
        radiusInput.addEventListener('input', function (e) {
            var newRadius = parseInt(e.target.value) || 0;
            circle.setRadius(newRadius);
        });
    }

    // 7. Autocomplete Pencarian Lokasi Akurat (Terkunci Indonesia & Area Terdekat)
    var searchTimeout;
    var searchResults = []; // Untuk menyimpan hasil fetch sementara

    if (namaLokasiInput && dataList) {
        namaLokasiInput.addEventListener('input', function (e) {
            var query = e.target.value.trim();

            // A. Cek jika pengguna memilih salah satu saran dari dropdown datalist
            var selectedOption = searchResults.find(function (item) {
                return item.display_name === query;
            });

            if (selectedOption) {
                var newLat = parseFloat(selectedOption.lat);
                var newLng = parseFloat(selectedOption.lon);
                
                // Perbarui posisi titik di peta
                updatePosition(newLat, newLng);
                map.setView([newLat, newLng], 17);
                return;
            }

            // B. Ambil saran lokasi via Nominatim API jika pengguna mengetik (> 2 karakter)
            clearTimeout(searchTimeout);
            if (query.length < 3) {
                dataList.innerHTML = '';
                return;
            }

            // Debounce delay 500ms agar server API tidak dibombardir request
            searchTimeout = setTimeout(function () {
                // Ambil batas area (viewbox) dari tampilan peta saat ini untuk membobot pencarian terdekat
                var bounds = map.getBounds();
                var viewbox = [
                    bounds.getWest(), // lon min
                    bounds.getNorth(), // lat max
                    bounds.getEast(),  // lon max
                    bounds.getSouth()  // lat min
                ].join(',');

                // countrycodes=id -> Kunci khusus negara Indonesia
                // viewbox -> Utamakan hasil di sekitar koordinat peta yang sedang aktif
                var url = 'https://nominatim.openstreetmap.org/search?format=json' +
                          '&addressdetails=1' +
                          '&limit=8' +
                          '&countrycodes=id' +
                          '&viewbox=' + viewbox +
                          '&q=' + encodeURIComponent(query);

                fetch(url)
                    .then(function (response) {
                        return response.json();
                    })
                    .then(function (data) {
                        dataList.innerHTML = ''; // Reset opsi lama
                        searchResults = data;    // Simpan hasil pencarian baru

                        // Tampilkan pilihan rekomendasi ke dalam datalist
                        data.forEach(function (item) {
                            var option = document.createElement('option');
                            option.value = item.display_name; // Menampilkan nama tempat + kota lengkap
                            dataList.appendChild(option);
                        });
                    })
                    .catch(function (error) {
                        console.error('Gagal mengambil saran lokasi:', error);
                    });
            }, 500);
        });
    }

    // 8. Logika Modal Konfirmasi & Copy Jam Kerja
    var btnCopySenin = document.getElementById('btn-copy-senin');
    if (btnCopySenin) {
        btnCopySenin.addEventListener('click', function () {
            var jamMasukSenin = document.getElementById('jam_masuk_senin').value;
            var jamKeluarSenin = document.getElementById('jam_keluar_senin').value;

            var hariList = ['selasa', 'rabu', 'kamis', 'jumat', 'sabtu'];
            hariList.forEach(function (hari) {
                var elMasuk = document.getElementById('jam_masuk_' + hari);
                var elKeluar = document.getElementById('jam_keluar_' + hari);

                if (elMasuk) elMasuk.value = jamMasukSenin;
                if (elKeluar) elKeluar.value = jamKeluarSenin;
            });
        });
    }

    var btnTriggerModal = document.getElementById('btn-trigger-modal');
    var modalKonfirmasi = document.getElementById('modal-konfirmasi');
    var btnCancelModal = document.getElementById('btn-cancel-modal');

    if (btnTriggerModal && modalKonfirmasi) {
        btnTriggerModal.addEventListener('click', function () {
            modalKonfirmasi.style.display = 'flex';
        });
    }

    if (btnCancelModal && modalKonfirmasi) {
        btnCancelModal.addEventListener('click', function () {
            modalKonfirmasi.style.display = 'none';
        });
    }

    // Fix render peta terpotong / abu-abu di modal/layout tersembunyi
    setTimeout(function () {
        map.invalidateSize();
    }, 300);
});