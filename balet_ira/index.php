<?php include('header.php'); ?>

<div class="welcome">
    <h1>Dobrodošli u plesni studio Balet</h1>
    <p>Naš studio nudi profesionalne časove baleta za sve uzraste i nivoe.</p>
    <p>Uživajte u našim modernim prostorijama i učite od najboljih trenera.</p>
    <p>Pridružite se našem baletnom studiju i započnite svoje plesno putovanje već danas!</p>
    <p>Nalazimo se na dvije lokacije. U Zagrebu i Splitu!</p>

    <img src="images/image.png" alt="Balet Studio">
</div>

<div id="maps-container">
    <h2>Split</h2>
    <div id="map-split" style="height: 400px;"></div>
    <h2>Zagreb</h2>
    <div id="map-zagreb" style="height: 400px; margin-top: 20px;"></div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAMywWj_xP_wg6WPmPCKvzVJ89EOHPejCM"></script>
<script>
    function initMap() {
        var split = {lat: 43.508133, lng: 16.440193}; // Lokacija Splita
        var zagreb = {lat: 45.815399, lng: 15.966568}; // Lokacija Zagreba

        var mapSplit = new google.maps.Map(document.getElementById('map-split'), {
            zoom: 12,
            center: split
        });

        var mapZagreb = new google.maps.Map(document.getElementById('map-zagreb'), {
            zoom: 12,
            center: zagreb
        });

        var markerSplit = new google.maps.Marker({
            position: split,
            map: mapSplit
        });

        var markerZagreb = new google.maps.Marker({
            position: zagreb,
            map: mapZagreb
        });
    }

    window.onload = initMap;
</script>



<?php include('footer.php'); ?>
