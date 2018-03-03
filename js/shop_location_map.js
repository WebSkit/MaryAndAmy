function initMap() {
    // Change this depending on the name of your PHP or XML file
    var url = 'http://localhost/MaryAndAmy/DAO/shopLocation.php';
    downloadUrl(url, function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName('marker');
        Array.prototype.forEach.call(markers, function(markerElem) {
            var id = markerElem.getAttribute('id');
            var shopName = markerElem.getAttribute('name');
            var addressLine1 = markerElem.getAttribute('addressLine1');
            var addressLine2 = markerElem.getAttribute('addressLine2');
            var postcode = markerElem.getAttribute('postcode');
            var point = new google.maps.LatLng(
                parseFloat(markerElem.getAttribute('lat')),
                parseFloat(markerElem.getAttribute('lng'))
            );

            var map = new google.maps.Map(document.getElementById('map'), {
                center: point,
                zoom: 15
            });
            var infoWindow = new google.maps.InfoWindow;

            var address = addressLine1 + " " + addressLine2 + " " + postcode;
            var infowincontent = document.createElement('div');
            var strong = document.createElement('strong');
            strong.textContent = shopName
            infowincontent.appendChild(strong);
            infowincontent.appendChild(document.createElement('br'));

            var text = document.createElement('text');
            text.textContent = address
            infowincontent.appendChild(text);
            var marker = new google.maps.Marker({
                map: map,
                position: point,
                label: shopName.charAt(0)
            });
            marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
            });
        });
    });
}

function downloadUrl(url, callback) {
    var request = window.ActiveXObject ?
        new ActiveXObject('Microsoft.XMLHTTP') :
        new XMLHttpRequest;

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
        }
    };

    request.open('GET', url, true);
    request.send(null);
}

function doNothing() {}
