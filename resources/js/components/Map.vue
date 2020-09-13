<template>
    <div class="container">
        <div id="map">
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                map: {},
                myLat: "",
                myLong: "",
                myCity: ""
            };
        },

        mounted() {

            this.getMine();
            this.getPoints();
        },

        methods: {

            getMine: function() {
                var that = this;
                var request = new XMLHttpRequest();
                var path = "lookup";
                request.open('GET', path, true);
                request.send();
                request.onload = function() {
                    var mine = JSON.parse(request.response);

                    that.myLat = mine.latitude;
                    that.myLong = mine.longitude;
                    that.myCity = mine.city;

                }
            },

            getPoints: function() {

                var that = this;
                var request = new XMLHttpRequest();
                var path = "points";
                request.open('GET', path, true);
                request.send();
                request.onload = function() {
                    var points = JSON.parse(request.response);

                    //add to that points
                    that.buildMap(points);

                }

            },

            buildMap: function(points) {

                //create map object and set default positions and zoom level
                this.map = L.map('map').setView([20, 0], 2);
                L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(this.map);

                // var Icon = this.getIcon();

                for (var i = 0; i < points.length; i++) {

                    L.marker([points[i]['latitude'], points[i]['longitude']], {
                        icon: this.getIcon(false)
                    }).bindPopup(points[i]['city']).addTo(this.map);
                }

                //own
                L.marker([this.myLat, this.myLong], {
                    icon: this.getIcon(true)
                }).bindPopup(this.myCity).addTo(this.map);

            },

            getIcon: function(own) {

                var Icon = L.icon({
                    // iconUrl: 'http://myinspirationinformation.com/wp-content/uploads/2015/12/logoAndName.png',
                    // shadowUrl: 'http://leafletjs.com/docs/images/leaf-shadow.png',


                    iconUrl: own ? "icons/marker-red.png" : "icons/marker-blue.png",

                    iconSize: [20, 20], // size of the icon
                    shadowSize:   [50, 64], // size of the shadow
                    iconAnchor: [10, 20], // point of the icon which will correspond to marker's location
                    shadowAnchor: [4, 62],  // the same for the shadow
                    popupAnchor: [0, -10] // point from which the popup should open relative to the iconAnchor
                });

                return Icon;
            }
        }
    }

</script>


