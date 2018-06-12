/**
 * Created by BK on 30.05.18.
 */
function initMap() {

    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 4
    });
    var url = $('#map').data('gpx-file');

    $.ajax({
        type: "GET",
        url: url,
        dataType: "xml",
        success: function (xml) {
            var points = [];
            var bounds = new google.maps.LatLngBounds();
            $(xml).find("trkpt").each(function () {
                var lat = $(this).attr("lat");
                var lon = $(this).attr("lon");
                var p = new google.maps.LatLng(lat, lon);
                points.push(p);
                bounds.extend(p);
            });

            var poly = new google.maps.Polyline({
                // use your own style here
                path: points,
                strokeColor: "#FF00AA",
                strokeOpacity: .7,
                strokeWeight: 4
            });

            poly.setMap(map);

            // fit bounds to track
            map.fitBounds(bounds);
        }
    });
}

window.initMap = initMap;