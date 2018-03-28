function showTheatres(complexName) {
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("showingDisplayAdmin").innerHTML = "";
			document.getElementById("movieDisplayAdmin").innerHTML = this.responseText;
		}
	};
	xmlhttp.open("GET", "ajax.php?t="+complexName,true);
	xmlhttp.send();
}

function addShowing(theatreInfo) {
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("showingDisplayAdmin").innerHTML = this.responseText;
		}
	};
	xmlhttp.open("GET", "../ajax.php?q=s~"+theatreInfo,true);
	xmlhttp.send();
}