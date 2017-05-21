var CACHE_NAME = 'ShowYourCar';
var urlsToCache = [
	'/',
	/*'manifest.json'*/
    ,
	'/index.php',
	'/dashboard.php',
    '/assets/data/header.php',
    '/assets/data/header2.php',
	'/assets/css/reset.css',
	'/assets/css/style.css',
    '/assets/css/jquery.mobile-1.4.5.min.css',
	'/assets/js/jquery-1.11.3.js',
	'/assets/js/script.js',
    '/assets/js/jquery.mobile-1.4.5.min.js',
	'/assets/css/images/'
];

self.addEventListener('install', function (event) {
    //The installation will only succeed if all urlsToCache can be resolved.
    event.waitUntil(
        caches.open(CACHE_NAME)
        .then(function (cache) {
            console.log('Opened cache');
            return cache.addAll(urlsToCache);
        }, function () {
            console.log('Failed to load cache')
        }).then(function () {
            console.log('Caching succeeded');
        }, function () {
            console.log('Failed to cache')
        })
    );
    self.skipWaiting();
});


self.addEventListener('activate', function (event) {
    event.waitUntil(
        console.log('Activating SW')
    )
});


self.addEventListener('fetch', function (event) {
    console.log('Fetching...');
    event.respondWith(fetch(event.request)
        .catch(function (error) {
            return caches.open(CACHE_NAME)
                .then(function (cache) {
                    return cache.match(event.request); //TODO catch undefined
                })
        })
        .then(function (data) {
            if (data === undefined) {
                data = caches.open(CACHE_NAME)
                    .then(function (cache) {
                        return cache.match('index.php');
                    });
            }
            return data;
        })
    )
});
