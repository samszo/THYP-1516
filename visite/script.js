var map;
var markers = [];
var position;
var people= [];
var scores= [];


/* init Maps and load all documents
**/
function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
	center: {lat: 40.416775, lng: -3.703790},
	zoom: 5
  });
  
  // center of CA to compute the distance
  myCoordinates = new google.maps.LatLng(38.134557,-120.585938);

  map.addListener('click',addMarker);
  
 
  populateGridPersonnes();
  populateGridDocuments();
  populateGridScores();
}

/* add a Marker on the Map 
**/
function addMarker(event) 
{
	var marker = new google.maps.Marker({
	position: event.latLng,
	map: map
	});
  
	if(markers.length > 0) {
		markers[0].setMap(null);
	}
	
	markers[0] = marker;
	position = marker.getPosition();
	document.getElementById("latlng_document").value = "POINT("+position.lat()+" "+position.lng()+")";
}

function insertDocument()
{
	var data = {"table":"document"};
	
	var nom = document.getElementById("nom_document").value;
	var latlng =  "ST_GeomFromText('POINT("+position.lat()+"  "+position.lng()+")')";
	var url = document.getElementById("url_document").value;
	
	if(nom.length >0 && latlng.length >0 && url.length >0)
	{
		data.nom = nom;
		data.latlng = latlng;
		data.url = url;

		$.ajax({
		  url: 'php/c.php',
		  data: data,
		  success: function(html){
				document.getElementById("nom_document").value = " ";
				document.getElementById("latlng_document").value = " ";
				document.getElementById("url_document").value = " ";
		
				notify("log_document","Document ajouté");	
       		},
		  error: function(xhr, ajaxOptions, thrownError){
				notify("log_document","Erreur serveur impossible d'ajouté ce document");	
			}
		});
	}
	else
	{
		notify("log_document","Saisissez tous les champs s.v.p");
	}

}

function populateGridPersonnes()
{
	$('#grid').w2grid({ 
		name: 'grid',
		url : {
				get    : 'php/r.php?table=personnesw2ui',
				remove : 'php/d.php?table=personnesw2ui',
				save : 'php/u.php?table=personnesw2ui'
			},
		show: { 
			toolbar: true,
			footer: true,
			toolbarDelete: true,
			toolbarSave: true
		},
		columns: [                
			{ field: 'recid', caption: 'ID', size: '80px', sortable: true, resizable: true },
			{ field: 'text', caption: 'Login Github', size: '740px', sortable: true, resizable: true, 
				editable: { type: 'text' }
			},
			{ field: 'check', caption: 'cocher', size: '100px', sortable: true, resizable: true, 
				editable: { type: 'checkbox' } 
			}],
		postData: {
			table : 'personnesw2ui'
		}
	});    
}

function populateGridDocuments()
{	
	$('#griddocument').w2grid({ 
		name: 'griddocument', 
		url : {
			get : 'php/r.php?table=documentsw2ui',
			remove : 'php/d.php?table=documentsw2ui'
		},
		show: { 
			toolbar: true,
			footer: true,
			toolbarDelete : true,
			toolbarSave: true
		},
		columns: [                
			{ field: 'recid', caption: 'ID Document', size: '40px', sortable: true, resizable: true },
			{ field: 'text', caption: 'nom', size: '220px', sortable: true, resizable: true},
			{ field: 'position', caption: 'position', size: '240px', sortable: true, resizable: true},
			{ field: 'url', caption: 'link', size: '280px', sortable: true, resizable: true},
			{ field: 'check', caption: 'Cocher', size: '100px', sortable: false, resizable: true, editable: { type: 'checkbox' }} 
			]
	});    
	
}

function populateGridScores()
{	
	$('#gridscores').w2grid({ 
		name: 'gridscores', 
		url : {
			get    : 'php/r.php?table=scoresw2ui',
			remove : 'php/d.php?table=scoresw2ui'
		},
		show: { 
			toolbar: true,
			footer: true,
			toolbarDelete: true
		},
		columns: [                
			{ field: 'recid', caption: 'ID Score', size: '80px', sortable: true, resizable: true },
			{ field: 'text', caption: 'Login Github', size: '120px', sortable: true, resizable: true, editable: false},
			{ field: 'document', caption: 'Document', size: '240px', sortable: true, resizable: true, editable: false},
			{ field: 'distance', caption: 'Distance', size: '160px', sortable: true, resizable: true, editable: false},
			{ field: 'time', caption: 'Date', size: '140px', sortable: true, resizable: true, editable: false},
			{ field: 'check', caption: 'Cocher', size: '140px', sortable: false, resizable: true, editable: { type: 'checkbox' }} 
			]
	});    
}

/* display and auto hide msgs errors 
**/
function notify(attr, msg)
{
	showElementById(attr);
	document.getElementById(attr).innerHTML = msg;
	// hide log after 3 sec
	setTimeout(function(){
		hideElementById(attr);
	}, 3000);
}
/* show an element given its Id
**/
function showElementById(attr) 
{
	document.getElementById(attr).style.display = "block";
}

/* hide an element given its Id
**/
function hideElementById(attr)
{
	document.getElementById(attr).style.display = "none";
}