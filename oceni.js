/* MOMCILO SAVIC */

/* 
	RANK = {"BANOVAN", "REGISTROVANI KORISNIK", "VIP KORISNIK", "ADMIN"}
	U BAZI PROVERITI DA LI POSTOJI U TABELI OCENE SA SLEDECIM REDOM - (OCENJIVAC OCENJENI IDTERMIN)
*/

var ocena = 0;
var razlog="";

window.onload = function(){
	loadAllGames();
	document.getElementById("z"+1).addEventListener("click",function(){
		ocena = 1;
		document.getElementById("z").style.border="none";
		this.style.color="gold";
		document.getElementById("z2").style.color="black";
		document.getElementById("z3").style.color="black";
		document.getElementById("z4").style.color="black";
		document.getElementById("z5").style.color="black";
	});
	document.getElementById("z"+2).addEventListener("click",function(){
		ocena = 2;
		document.getElementById("z").style.border="none";
		this.style.color="gold";
		document.getElementById("z1").style.color="gold";
		document.getElementById("z3").style.color="black";
		document.getElementById("z4").style.color="black";
		document.getElementById("z5").style.color="black";
	});
	document.getElementById("z"+3).addEventListener("click",function(){
		ocena = 3;
		document.getElementById("z").style.border="none";
		this.style.color="gold";
		document.getElementById("z1").style.color="gold";
		document.getElementById("z2").style.color="gold";
		document.getElementById("z4").style.color="black";
		document.getElementById("z5").style.color="black";
	});
	document.getElementById("z"+4).addEventListener("click",function(){
		ocena = 4;
		document.getElementById("z").style.border="none";
		this.style.color="gold";
		document.getElementById("z1").style.color="gold";
		document.getElementById("z2").style.color="gold";
		document.getElementById("z3").style.color="gold";
		document.getElementById("z5").style.color="black";
	});
	document.getElementById("z"+5).addEventListener("click",function(){
		ocena = 5;
		document.getElementById("z").style.border="none";
		this.style.color="gold";
		document.getElementById("z1").style.color="gold";
		document.getElementById("z2").style.color="gold";
		document.getElementById("z3").style.color="gold";
		document.getElementById("z4").style.color="gold";
	});

	document.getElementsByTagName("textarea")[0].addEventListener("keyup",function(){
		this.style.borderColor="gray";
	});
	
	document.getElementsByClassName("dugmad")[0].style.display="none";
}

function loadAllGames(){
	
	//return; // OBRISATI KAD SE NARPAVI SERVERSKA STRANA
	
	var termin_id;
	var naslov;
	var vreme;
	var adresa;
	var cena;
	
	//TODO: ZA SVE PORUKE POZOVI loadOneGame();
	
	var start = document.getElementsByClassName("lista")[0];
	row = loadOneGame(naslov, vreme, adresa, cena);
	
	row.addEventListener("mouseenter", function _enter(){
		this.style.backgroundColor="#lightgray";
		this.style.cursor="pointer";
	});
	row.addEventListener("mouseleave", function _leave(){
		this.style.backgroundColor="inherit";
	});
	row.addEventListener("click", function(){
		loadAllInfo(termin_id);
		if(document.getElementsByClassName("ocene")[0].getElementsByClassName("title")[0].getElementsByTagName("span")[0] == null){
			var string = document.getElementsByClassName("ocene")[0].getElementsByClassName("title")[0].innerHTML += "<span style='color:lightgray; float: right'> " + naslov + "</span>";
		}
		else
			document.getElementsByClassName("ocene")[0].getElementsByClassName("title")[0].getElementsByTagName("span")[0].textContent=""+naslov;
		
	});
	start.appendChild(row);
}

function loadOneGame(naslov, vreme, adresa, cena){	
	var row = document.createElement("div");
	row.classList.add("row");
	
	var newElement;
	var string;
	
	newElement = document.createElement("span");
	newElement.classList.add("naslov");
	string = document.createTextNode(""+naslov);
	newElement.appendChild(string);
	row.appendChild(newElement);
	
	newElement = document.createElement("span");
	newElement.classList.add("adresa");
	string = document.createTextNode(""+adresa);
	newElement.appendChild(string);
	row.appendChild(newElement);
	
	newElement = document.createElement("span");
	newElement.classList.add("vreme");
	string = document.createTextNode(""+vreme);
	newElement.appendChild(string);
	row.appendChild(newElement);
	
	newElement = document.createElement("span");
	newElement.classList.add("cena");
	string = document.createTextNode(""+cena);
	newElement.appendChild(string);
	row.appendChild(newElement);
	
	return row;
}





function loadAllInfo(termin_id){
	var start = document.getElementsByClassName("ocene")[0];
	var i;
	var n = start.children.length-3;
	for(i=0; i < n;i++){
		start.removeChild(start.children[2]);
	}
	
	
	//TODO: posalji poruku serveru
	//TODO: primi poruku od servera
	//TODO: za sve podatke u bazi izvrsi loadOneInfo pa start.append
	var user;
	var ocena;
	var rank;
	
	var row;
	row = loadOneInfo(user, ocena, rank);
	row.setAttribute("id", ""+user);
	start.insertBefore(row,start.getElementsByClassName("dugmad")[0]);
	
	
	row.addEventListener("mouseenter", function _enter(){
		this.style.backgroundColor="lightgray";
		this.style.cursor="pointer";
	});
	row.addEventListener("mouseleave", function _leave(){
		this.style.backgroundColor="inherit";
	});
	row.addEventListener("click", function(){
		var btn = start.getElementsByTagName("button")[0];
		if(typeof(_click) === typeof(Function))
			btn.removeEventListener("click", _click);
		btn.addEventListener("click", function _click(){
			razlog=document.getElementsByTagName("textarea")[0].value;
			rateUser(user);
		});
		var string = document.createElement("span");
		string.textContent = " > " + user;
		string.classList.add("k");
		if(document.getElementsByClassName("k")[0] != null)
			document.getElementsByClassName("ocene")[0].getElementsByClassName("title")[0].removeChild(document.getElementsByClassName("k")[0]);
		document.getElementsByClassName("ocene")[0].getElementsByClassName("title")[0].appendChild(string);
		
		document.getElementsByClassName("dugmad")[0].style.display="unset";
			
	});
}

function loadOneInfo(user, ocena, rank) {
	var row = document.createElement("row");
	row.classList.add("row");
	
	var newElement;
	var string;
	
	newElement = document.createElement("span");
	newElement.classList.add("user");
	string = document.createTextNode("" + user);
	newElement.appendChild(string);
	
	row.appendChild(newElement);
	
	newElement = document.createElement("span");
	newElement.classList.add("ocena");
	string = document.createTextNode("" + ocena);
	newElement.appendChild(string);
	
	row.appendChild(newElement);
	
	newElement = document.createElement("span");
	newElement.classList.add("rank");
	string = document.createTextNode("" + rank);
	newElement.appendChild(string);
	
	row.appendChild(newElement);
	
	return row;
}




function rateUser(user){
	if(ocena != 0 && razlog!=""){
		//TODO: posalji poruku serveru (ocenjivac, ocenjeni, idtermina)
		var row = document.getElementById(""+user).style.display="none";
	}
	else{
		if(ocena==0){
			document.getElementById("z").style.border="thin solid red";
		}
		if(razlog==""){
			document.getElementsByTagName("textarea")[0].style.borderColor="red";
		}
	}
}