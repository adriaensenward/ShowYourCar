<script>
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker
            .register('/sw.js')
            .then(function(registration) {
                console.log("Service Worker Registered. Scope: " + registration.scope);
            });
    }

</script>
</body>

</html>
