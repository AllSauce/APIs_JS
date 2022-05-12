const pMap = L.map('pMap').setView([51.505, -0.09], 13);

const attribution =
'&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors';

const tileUrl = 'https://{s}.tiles.stadiamaps.com/tiles/alidade_smooth/{z}/{x}/{y}.png';
  const tiles = L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_smooth/{z}/{x}/{y}{r}.png?api_key=a0b486d5-1bb7-4d20-a04f-a40912310009', {
	maxZoom: 20,
	attribution: '&copy; <a href="https://stadiamaps.com/">Stadia Maps</a>, &copy; <a href="https://openmaptiles.org/">OpenMapTiles</a> &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'
});
  tiles.addTo(pMap);
