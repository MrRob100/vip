<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7/leaflet.css" />
    <script src="http://cdn.leafletjs.com/leaflet-0.7/leaflet.js"></script>
    <script src="https://d3js.org/d3.v3.min.js" type="text/javascript"></script>

    <script src="{{ asset('public/js/app.js') }}" defer></script>


    <style>
        html,
        body {
            height: 100%;
            width: 100%;
        }

        body {
            margin: 0;
        }

        #map, #app, .container {
            width: 100%;
            height: 100%;
        }

    </style>

</head>

<body>
    <div id="app">
        <map-page>
        </map-page>
    </div>
</body>
</html>