/*
	state = {"prihvatio", "odbio"}
	
	FORMAT DATUMA I VREMENA:
		Datum = dd.mm.gggg
		Vreme = hh:mm
	
*/




window.onload=function(){
	loadAllNotifications();
	loadAllRequests();
}




function answerRequest(user, id, isAccepted){
	var dat = new Date();
	var datum = "" + dat.getDate( )+ "." + dat.getMonth() + "." + dat.getFullYear() + "."; 
	var vreme = "" + dat.getHours() + ":" + dat.getMinutes();
	var state;
	if(isAccepted == "true")
		state="prihvatio";
	else
		state="odbio";
	
	//TODO: uspostavi konekciju sa serverom i posalji poruku
	//USER - ID_TERMINA - STATUS - VREME
	//[user] [id]		  [state] [datum][vreme]
	
	var start = document.getElementsByClassName("zahtevi")[0];
	var row=document.getElementById(id);
	if(row == null)
		return;
	
	row.removeChild(row.children[row.children.length-1]);
	row.removeChild(row.children[row.children.length-1]);
	row.children[0].textContent="" + datum + " " + vreme + " ";
	
	newElement = document.createElement("span");
	string = document.createTextNode(""+state + " si ");
	newElement.appendChild(string);
	row.insertBefore(newElement, row.children[1]);
	
	newElement = document.createElement("span");
	string = document.createTextNode(" za ");
	newElement.appendChild(string);
	row.insertBefore(newElement, row.children[3]);
	
	row.style.fontStyle="italic";
	row.style.backgroundColor = "linear-gradient(45deg,darkgreen, forestgreen)";
	
	row.classList.remove("zahtev_na_cekanju");
	row.classList.add("odgovor");
	row.removeAttribute("id");
}







function loadAllRequests(){
	
	return; //!!!!!!!!! IZBRISATI KAD SE NAPRAVI SERVERSKA STRANA
	
	var id;
	var datum_zahteva;
	var vreme_zahteva;
	var user;
	var ocena;
	var naziv;
	var adresa;
	var datum;
	var vreme;
	var state;
	
	var start = document.getElementsByClassName("zahtevi")[0];
	var row;
	
	//TODO: za sve primljene poruke od servera pozovi loadOneRequest->start.append
	//TODO: AKO NEMA NIJEDNA PORUKA ODMAH RETURN
	// USERNAME_POSILJAOCA - ID_TERMINA - STATUS - VREME_ZAHTEVA || USERNAME_ORGANIZATORA - NAZIV - ADRESA - DATUM_TERMINA - VREME_TERMINA || OCENA
	// 		[user]				[id]		[state] [vreme_zahteva]	[username - globalna var] [naziv] [adresa] [datum]			[vreme]			[ocena]
	
	row = loadOneRequest(id, datum_zahteva, vreme_zahteva, user, ocena, naziv, adresa, datum, vreme, state);
	start.appendChild(row);
	
}

function loadOneRequest(id, datum_zahteva, vreme_zahteva, user, ocena, naslov, adresa, datum, vreme, state){
	var row = document.createElement("div");
	row.classList.add("row");
	row.classList.add("zahtev_na_cekanju");
	row.setAttribute.id=id;
	
	var string="";
	var newElement;
	
	newElement = document.createElement("div");
	newElement.classList.add("datum");
	string = document.createTextNode(""+datum_zahteva + " " + vreme_zahteva);
	newElement.appendChild(string);
	
	row.appendChild(newElement);
	
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
	newElement.classList.add("status");
	string = document.createTextNode(""+state);
	newElement.appendChild(string);
	
	row.appendChild(newElement);
	
	newElement = document.createElement("span");
	newElement.classList.add("termin");
	string = document.createTextNode(""+naslov+ " na adresi " + adresa + " u " + vreme + ", dana " + datum);
	newElement.appendChild(string);
	
	row.appendChild(newElement);
	
	newElement = document.createElement("button");
	newElement.setAttribute.onclick=answerRequest(user, id, true);
	string = document.createTextNode("Prihvati");
	newElement.appendChild(string);
	
	row.appendChild(newElement);
	
	newElement = document.createElement("button");
	newElement.setAttribute.onclick=answerRequest(user, id, false);
	string = document.createTextNode("Odbij");
	newElement.appendChild(string);
	
	row.appendChild(newElement);
	
	return row;
}







function loadAllNotifications(){
	
	return; // !!!!!!!!!!!!!!!!!!!! IZBRISATI KAD SE NAPRAVI SERVERSKA STRANA
	
	var datum_odgovora
	var user;
	var ocena;
	var naziv;
	var adresa;
	var datum;
	var vreme;
	var state;
	
	var start = document.getElementsByClassName("obavestenja")[0];
	var row;
	
	//TODO: za sve primljene poruke od servera pozovi loadOneNotification->start.append
	//TODO: AKO NEMA NIJEDNA PORUKA ODMAH RETURN!!!
	row = loadOneNotification(datum_odgovora, user, ocena, naziv, adresa, datum, vreme, state);
	start.appendChild(row);
	//
}

function loadOneNotification(datum_odgovora, user, ocena, naslov, adresa, datum, vreme, state){
	var row = document.createElement("div");
	row.classList.add("row");
	row.classList.add("odgovor");
	
	var string="";
	var newElement;
	
	newElement = document.createElement("div");
	newElement.classList.add("datum");
	string = document.createTextNode(""+datum_odgovora);
	newElement.appendChild(string);
	
	row.appendChild(newElement);
	
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
	newElement.classList.add("status");
	string = document.createTextNode(""+state);
	newElement.appendChild(string);
	
	row.appendChild(newElement);
	
	newElement = document.createElement("span");
	newElement.classList.add("termin");
	string = document.createTextNode(""+naslov+ " na adresi " + adresa + " u " + vreme + ", dana " + datum);
	newElement.appendChild(string);
	
	row.appendChild(newElement);
	
	return row;
}



