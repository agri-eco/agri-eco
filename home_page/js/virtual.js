var mapnik = L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
		tileSize: 512,
		zoomOffset: -1,
		attribution:
			'&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
	}),
	asd = L.tileLayer(
		"https://tiles.stadiamaps.com/tiles/alidade_smooth_dark/{z}/{x}/{y}{r}.png",
		{
			tileSize: 512,
			zoomOffset: -1,
			attribution:
				'&copy; <a href="https://stadiamaps.com/">Stadia Maps</a>, &copy; <a href="https://openmaptiles.org/">OpenMapTiles</a> &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors',
		}
	)
    satellite = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', 
    { tileSize: 512, 
    zoomOffset: -1, 
    attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'});

    // Map initialization
    var map = L.map('map', {
        center: [14.201063005457934, 120.8829413175803],
        zoom: 19,
        layers: [asd, satellite,mapnik]
    });
    


// Adding Marker
var entrance = L.marker([14.201063005457934, 120.8829413175803])
		.addTo(map)
		.bindPopup("CvSU Agri-Eco Park Entrance")
		.openPopup(),
	infocenter = L.marker([14.200835484095448, 120.88309956791305])
		.addTo(map)
		.bindPopup("Info Center"),
	carabao = L.marker([14.201002, 120.883342])
        .addTo(map)
        .bindPopup("Carabao"),
	hagdan = L.marker([14.201078, 120.883463])
		.addTo(map)
		.bindPopup("Hagdan ng Karunungan"),
	beeprogram = L.marker([14.200708, 120.884056])
		.addTo(map)
		.bindPopup("Bee Program"),
	plantgarden = L.marker([14.198701, 120.885394])
		.addTo(map)
		.bindPopup("Plant Garden"),
	mainbuilding = L.marker([14.198658, 120.885986])
		.addTo(map)
		.bindPopup("Agri-Eco Park Main Building"),
	fashionfruit = L.marker([14.198049, 120.885941])
		.addTo(map)
		.bindPopup("Fashion Fruit Trail"),
	sprintfield = L.marker([14.19862, 120.88218])
		.addTo(map)
		.bindPopup("Sprint Field Center"),
	coffeecenter = L.marker([14.19744, 120.88373])
		.addTo(map)
		.bindPopup("Coffee Center");

const circle = L.circle([14.198707094878296, 120.88233826911802], {
	radius: 20,
	color: "green",
	fillColor: "red",
	fillOpacity: 0.2,
})
	.addTo(map)
	.bindPopup("Sprint Field");

    var points = L.layerGroup([entrance, infocenter, carabao, hagdan, beeprogram, plantgarden, mainbuilding, fashionfruit, sprintfield, coffeecenter]);



var baseMaps = {
    "<span style= 'color: black'> Smooth Dark </span>": asd,
    "<span style= 'color: green'> Satellite </span>": satellite,
    "<span style='color: gray'>Grayscale</span>": mapnik
};

var overlayMaps = {
    "Tour Location": points
};

var layerControl = L.control.layers(baseMaps, overlayMaps).addTo(map);






// Map layer
// var OpenStreetMap = L.tileLayer(
// 	"https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
// 	{
// 		attribution:
// 			'&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
// 		maxZoom: 21,
// 		tileSize: 512,
// 		zoomOffset: -1,
// 	}
// ).addTo(map);



// Base Layer
// var OpenStreetMap = L.tileLayer(
// 		"https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
// 		{
// 			attribution:
// 				'&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
// 			maxZoom: 21,
// 			tileSize: 512,
// 			zoomOffset: -1,
// 		}
// 	),
// 	streets = L.tileLayer(
// 		"https://server.arcgisonline.com/ArcGIS/rest/services/Specialty/DeLorme_World_Base_Map/MapServer/tile/{z}/{y}/{x}",
// 		{
// 			attribution: "Tiles &copy; Esri &mdash; Copyright: &copy;2012 DeLorme",
// 			minZoom: 1,
// 			maxZoom: 11,
// 		}
// 	);

// var layerControl = L.control.layers(baseMaps, overlayMaps).addTo(map);
// layerControl.addBaseLayer(satellite, "Satellite");
// layerControl.addOverlay(parks, "Parks");
// Add popup message
// let template = `
// <h3>Empire State Building</h3>
// <div style="text-align:center">
//     <img width="150" height="150"src="image.jpg"/>
// </div>
// `
