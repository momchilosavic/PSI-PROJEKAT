/*MOMCILO SAVIC*/

/* 
	RANK = {"BANOVAN", "REGISTROVANI KORISNIK", "VIP KORISNIK", "ADMIN"}
*/

window.onload = function(){
	loadAllUsers();
}

function loadAllUsers(){
	
	//return; // OBRISATI KAD SE NARPAVI SERVERSKA STRANA
	
	var user;
	var ocena;
	var rank;
	
	//TODO: ZA SVE PORUKE POZOVI loadOneUser();
	//TODO: PRIMI I INFORMACIJU DA LI JE KORISNIK BANOVAN
	var jeBanovan;
	
	var start = document.getElementsByClassName("lista")[0];
	row = loadOneUser(user,ocena,rank);
	row.addEventListener("mouseenter", function _enter(){
		this.style.backgroundColor="#fafafa";
		this.style.cursor="pointer";
	});
	row.addEventListener("mouseleave", function _leave(){
		this.style.backgroundColor="inherit";
	});
	row.addEventListener("click", function(){
		loadAllInfo(user, rank);
		if(document.getElementsByClassName("ocene")[0].getElementsByClassName("title")[0].getElementsByTagName("span")[0] == null){
			var string = document.getElementsByClassName("ocene")[0].getElementsByClassName("title")[0].innerHTML += "<span style='color:lightgray; float: right'> " + user + "</span>";
		}
		else
			document.getElementsByClassName("ocene")[0].getElementsByClassName("title")[0].getElementsByTagName("span")[0].textContent=""+user;
		
	});
	start.appendChild(row);
}

function loadOneUser(user, ocena, rank){	
	var row = document.createElement("div");
	row.classList.add("row");
	
	var newElement;
	var string;
	
	newElement = document.createElement("span");
	newElement.classList.add("korisnik");
	string = document.createTextNode(""+user);
	newElement.appendChild(string);
	row.appendChild(newElement);
	
	newElement = document.createElement("span");
	newElement.classList.add("ocena");
	string = document.createTextNode(""+ocena);
	newElement.appendChild(string);
	row.appendChild(newElement);
	
	newElement = document.createElement("span");
	newElement.classList.add("rank");
	string = document.createTextNode(""+rank);
	newElement.appendChild(string);
	row.appendChild(newElement);
	
	return row;
}





function loadAllInfo(user, rank){
	var start = document.getElementsByClassName("ocene")[0];
	var i;
	var n = start.children.length-3;
	for(i=0; i < n;i++){
		start.removeChild(start.children[2]);
	}
	
	var btn = start.getElementsByTagName("button")[0];
	if(rank == "banovan"){
		btn.textContent="UNBAN KORISNIKA";
	}
	else{
		btn.textContent="BAN KORISNIKA";
	}
	if(rank=="admin"){
		if(typeof(_click) === typeof(Function))
			btn.removeEventListener("click", _click);
		btn.style.opacity = 0.5;
		btn.style.cursor = "not-allowed";
	}
	else{
	if(typeof(_click) === typeof(Function))
		btn.removeEventListener("click", _click);
		btn.addEventListener("click", function _click(){
			banUser(user, rank);
		});
	}
	
	btn=start.getElementsByTagName("button")[1];
	if(rank == "banovan" || rank == "admin"){
		if(typeof(_click2) === typeof(Function))
			btn.removeEventListener("click", _click2);
		btn.style.opacity = 0.5;
		btn.style.cursor = "not-allowed";
	}
	else {
		if(typeof(_click2) === typeof(Function))
			btn.removeEventListener("click", _click2);
		btn.addEventListener("click", function _click2(){
			upgradeUser(user, rank);
		});
		btn.style.opacity = 1;
		btn.style.cursor = "pointer"
	}
	
	//TODO: posalji poruku serveru
	//TODO: primi poruku od servera
	//TODO: za sve podatke u bazi izvrsi loadOneInfo pa start.append
	var opis;
	var ocena;
	var datum;
	var ocenjivac;
	var row;
	row = loadOneInfo(opis, ocena, datum, ocenjivac);
	start.insertBefore(row,start.getElementsByClassName("dugmad")[0]);
}

function loadOneInfo(opis, ocena, datum, ocenjivac) {
	var row = document.createElement("row");
	row.classList.add("row");
	
	var newElement;
	var string;
	
	newElement = document.createElement("span");
	newElement.classList.add("opis");
	string = document.createTextNode("" + opis);
	newElement.appendChild(string);
	
	row.appendChild(newElement);
	
	newElement = document.createElement("span");
	newElement.classList.add("ocena");
	string = document.createTextNode("" + ocena);
	newElement.appendChild(string);
	
	row.appendChild(newElement);
	
	newElement = document.createElement("span");
	newElement.classList.add("datum");
	string = document.createTextNode("" + datum);
	newElement.appendChild(string);
	
	row.appendChild(newElement);
	
	newElement = document.createElement("span");
	newElement.classList.add("korisnik");
	string = document.createTextNode("" + ocenjivac);
	newElement.appendChild(string);
	
	row.appendChild(newElement);
	
	return row;
}




function banUser(user, rank) {
		if(rank == "banovan"){
			//TODO: posalji informaciju serveru da promeni rank korisnika u "registrovani korisnik"
			
			var btn = document.getElementsByClassName("ocene")[0].getElementsByTagName("button")[0];
			btn.textContent = "BAN KORISNIKA";
				if(typeof(_click) === typeof(Function))
			btn.removeEventListener("click", _click);
			btn.addEventListener("click", function _click(){
				banUser(user, "registrovani korisnik");
			});
			
			btn = document.getElementsByClassName("ocene")[0].getElementsByTagName("button")[1];
			if(typeof(_click2) === typeof(Function))
				btn.removeEventListener("click", _click2);
			btn.addEventListener("click", function _click2(){
				upgradeUser(user, rank);
			});
			btn.style.opacity = 1;
			btn.style.cursor = "pointer"
		}
		else{
			//TODO: posalji informaciju serveru da promeni rank korisnika u "banovan"
			
			var btn = document.getElementsByClassName("ocene")[0].getElementsByTagName("button")[0];
			btn.textContent = "UNBAN KORISNIKA";
			if(typeof(_click) === typeof(Function))
				btn.removeEventListener("click", _click());
			btn.addEventListener("click", function _click(){
				banUser(user, "banovan");
			});
			
			btn = document.getElementsByClassName("ocene")[0].getElementsByTagName("button")[1];
			if(typeof(_click2) === typeof(Function))
				btn.removeEventListener("click", _click2);
			btn.style.opacity = 0.5;
			btn.style.cursor = "not-allowed";
		}
}







function upgradeUser(user, rank){
	switch(rank){
		case "banovan": return;
		case "registrovani korisnik":{
			//TODO: posalji poruku serveru
			location.reload();
			break;
		}
		case "vip korisnik":{
			//TODO: posalji poruku serveru
			location.reload();
			break;
		}
		case "admin": return;
	}
}