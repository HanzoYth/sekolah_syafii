// Service Worker — Sekolah Islam Al-Qur'an Imam Syafi'i Web App (PWA)
const CACHE_NAME = 'sekolah-syafii-pwa-v1';

self.addEventListener('install', function (event) {
    self.skipWaiting();
});

self.addEventListener('activate', function (event) {
    event.waitUntil(self.clients.claim());
});

// Network-first strategy agar data akademik SIAKAD selalu mutakhir
self.addEventListener('fetch', function (event) {
    if (event.request.method !== 'GET') return;
    event.respondWith(
        fetch(event.request).catch(function () {
            return caches.match(event.request);
        })
    );
});

