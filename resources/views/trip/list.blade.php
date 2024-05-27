<x-app-layout>
    <x-slot name="title">ダーツの結果</x-slot>

    <!-- Google Maps API の読み込み -->
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_key') }}&libraries=places" defer></script>

    <div id="map" style="height: 600px; width:1200px;"></div>
    
    <div id="place-result"></div>
    <div>
        {{ $parameter->spot_category->en_name }}
    </div>
    <!-- Google Maps JavaScript -->
    <script>
        let map;
        let marker;
        let radius = 0;
        const orangePin = "http://maps.google.com/mapfiles/ms/icons/orange-dot.png";
        const redPin = "http://maps.google.com/mapfiles/ms/icons/red-dot.png";
        const infoWindow = new google.maps.InfoWindow();

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: {{ $parameter->departure_latitude }}, lng: {{ $parameter->departure_longitude }} }, // 出発地を中心に設定
                zoom: 13
            });

            // 出発地のマーカーを設定
            placeMarker({{ $parameter->departure_latitude }}, {{ $parameter->departure_longitude }}, orangePin);
            
            // 円描画
            const transportation = "{{ $parameter->transportation }}";
            const tripTime = {{ $parameter->trip_time }};
            if (transportation === "徒歩") {
                radius = 80 * tripTime; // 徒歩の場合の半径
            } else if (transportation === "自転車") {
                radius = 250 * tripTime; // 自転車の場合の半径
            } else if (transportation === "車") {
                radius = 1000 * tripTime; // 車の場合の半径
            }

            drawCircle({{ $parameter->departure_latitude }}, {{ $parameter->departure_longitude }}, radius);

            // ダーツの条件
            const request = {
                location: { lat: {{ $parameter->departure_latitude }}, lng: {{ $parameter->departure_longitude }} },
                radius: radius,
                type: ['{{ $parameter->spot_category->en_name }}'],
             }
            // 円の中にダーツ
            const service = new google.maps.places.PlacesService(map);
            service.nearbySearch(request, callback);
        }

        // ピン刺し
        function placeMarker(lat, lng, iconUrl) {
            return new google.maps.Marker({
                position: { lat: lat, lng: lng },
                map: map,
                icon: {
                    url: iconUrl
                }
            });
        }

        // ダーツ先
        function placeMarkerWithInfo(lat, lng, iconUrl, place) {
            const dartsMarker = placeMarker(lat, lng, iconUrl);

            google.maps.event.addListener(dartsMarker, 'click', function() {
                const content = `
                    <div>
                        <strong><a href="https://www.google.com/search?q=${encodeURIComponent(place.name)}" target="_blank">${place.name}</a></strong>
                        <p>${place.vicinity}</p>
                    </div>`;
                infoWindow.setContent(content);
                infoWindow.open(map, dartsMarker);
            });
        }

        // 円描画
        function drawCircle(lat, lng, r) {
            const cityCircle = new google.maps.Circle({
                strokeColor: "#F15A22",
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: "#FAB27B",
                fillOpacity: 0.2,
                map: map,
                center: { lat: lat, lng: lng },
                radius: r,
            });
        }
        
        function callback(results, status) {
            if (status == google.maps.places.PlacesServiceStatus.OK) {
                for (var i = 0; i < results.length; i++) {
                    placeMarkerWithInfo(results[i].geometry.location.lat(), results[i].geometry.location.lng(), redPin, results[i]);
                }
            } else {
                document.getElementById('place-result').innerHTML = "該当する施設が見つかりませんでした。";
            }
            console.log("aaa");
        }
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHmS-cMWkslPonyCsDSuV8hyc5U6p55ps&libraries=places&callback=initMap">
    </script>
</x-app-layout>
