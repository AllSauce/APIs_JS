const apiKey = "AAPK19437b5f16dd406c8cc517fcda4e9522knv4OpcC0ofIyHNxLBI1Jm6YeBfnFIwYKo5AN1XCHhnxHgJAHKdyNSN7lrznBqDp";
    const basemapEnum = "ArcGIS:LightGray";

    const pMap = L.map("pMap", {
      minZoom: 2
    }).setView([59.75356929265679, 18.073459091832664], 7);

    L.esri.Vector.vectorBasemapLayer(basemapEnum, {
      apiKey: apiKey
    }).addTo(pMap);

    var icon = L.icon({
        iconUrl: 'img/plane-icon.png',
        iconSize: [27, 31],
        iconAnchor: [13.5, 17.5],
        popupAnchor: [0, -11]
      });

  var markers = L.esri
  .featureLayer({
     url: "https://services2.arcgis.com/jUpNdisbWqRpMo35/ArcGIS/rest/services/Airports28062017/FeatureServer/0",
     where:"iata_code IS NOT NULL",
     pointToLayer: function (geojson, latlng) {
   return L.marker(latlng, {
     icon: icon
   });
 }
}).addTo(pMap);

 markers.bindPopup(function (layer) {
 return L.Util.template('<p><strong><a href=\' comments.php?airfield={iata_code} \'>{name}</a></strong> located in {iso_country}</p>', layer.feature.properties);
 });
