document.addEventListener("DOMContentLoaded", function () {

    const locationBtn = document.getElementById("openLocation");
    if (!locationBtn) return;

    locationBtn.addEventListener("click", function (e) {
        e.preventDefault();

        // Office location (fixed)
        const destinationLat = 19.099023;
        const destinationLng = 72.888816;

        if (!navigator.geolocation) {
            window.open("https://maps.app.goo.gl/iZJa3o9ozooxKni99", "_blank");
            return;
        }

        navigator.geolocation.getCurrentPosition(
            function (position) {
                const userLat = position.coords.latitude;
                const userLng = position.coords.longitude;

                const mapsUrl =
                    `https://www.google.com/maps/dir/?api=1&origin=${userLat},${userLng}&destination=${destinationLat},${destinationLng}`;

                window.open(mapsUrl, "_blank");
            },
            function () {
                window.open("https://maps.app.goo.gl/iZJa3o9ozooxKni99", "_blank");
            },
            {
                enableHighAccuracy: true,
                timeout: 10000
            }
        );
    });

});
