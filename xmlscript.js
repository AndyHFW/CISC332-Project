function showMovies(complexName) {
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("complexDisplay").display = "none";
			document.getElementById("movieDisplay").innerHTML = this.responseText;
		}
	};
	xmlhttp.open("GET", "ajax.php?q=c"+complexName,true);
	xmlhttp.send();
}