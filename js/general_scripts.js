include('js/jquery-1.11.0.js');
include('js/modernizr-2.6.2.min.js');
include('js/bootstrap.min.js');

// --Include Function ---//
function include(url){
	document.write('<script src="'+ url +'" type="text/javascript"></script>');
	return false;
}