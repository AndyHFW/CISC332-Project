function showMovies(complexName) {
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("chooseDate").innerHTML = "";
			document.getElementById("buyTickets").innerHTML = "";
			document.getElementById("movieDisplay").innerHTML = this.responseText;
		}
	};
	xmlhttp.open("GET", "ajax.php?q=c"+complexName,true);
	xmlhttp.send();
}

function buyTicket(showingInfo) {
	//showingInfo = $row['MovTitle'] . '~' . $complexName . '~' . $row['ThNum'] . '~' . $row['ST'] . '~' . $row['ED'] . '~' . $seatsLeft;
	//showingInfo[0] = MovTitle
	//showingInfo[1] = CplName
	//showingInfo[2] = ThNum
	//showingInfo[3] = ST
	//showingInfo[4] = End Date
	//showingInfo[5] = Tickets Remaining
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("chooseDate").innerHTML = this.responseText;
		}
	};
	xmlhttp.open("GET", "ajax.php?q=t~"+showingInfo,true);
	xmlhttp.send();
}

function chooseDateFunction() {
	let selectedDate = document.getElementById("chosenDate").value;
	let hiddenInfo = document.getElementById("hideShowingInfo").value;
		if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("buyTickets").innerHTML = this.responseText;
		}
	};
	xmlhttp.open("GET", "ajax.php?q=d~"+hiddenInfo+"~"+selectedDate,true);
	xmlhttp.send();
}

function cancelPurchase(showingInfo) {
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("chooseDate").innerHTML = this.responseText;
		}
	};
	xmlhttp.open("GET", "ajax.php?q=c~"+showingInfo,true);
	xmlhttp.send();
	
}