/*
	STATE {"Zahtev poslat", "Zahtev prihvacen", "Zahtev odbijen", "NULL"}
*/





window.onload = function(){
	loadAllOffers();
}




function loadOneOffer(id, datum_termina, vreme_termina, naslov, adresa, cena, brIgraca, user, ocena, opis, state){
	var row = document.createElement("div");
	row.classList.add("row");
	row.classList.add("termin");
	row.setAttribute.id=id;
	
	/* *** DATUM I VREME *** */
	var datum_vreme = document.createElement("div");
	datum_vreme.classList.add("datum_vreme");
	
	var string="";
	var newElement;
	
	newElement = document.createElement("div");
	newElement.classList.add("datum");
	string = document.createTextNode(""+datum_termina);
	newElement.appendChild(string);
	
	datum_vreme.appendChild(newElement);
	
	newElement = document.createElement("div");
	newElement.classList.add("vreme");
	string = document.createTextNode(""+vreme_termina);
	newElement.appendChild(string);
	
	datum_vreme.appendChild(newElement);
	
	
	/* *** IFNORMACIJE *** */
	var info = document.createElement("div");
	info.classList.add("info");
	
		/* *** OSNOVNE INFORMACIJE *** */
		var osnovno = document.createElement("div");
		osnovno.classList.add("osnovno");
		
		newElement = document.createElement("div");
		newElement.classList.add("naslov");
		string = document.createTextNode(""+naslov);
		newElement.appendChild(string);
		
		osnovno.appendChild(newElement);
		
		newElement = document.createElement("div");
		newElement.classList.add("adresa");
		string = document.createTextNode(""+adresa);
		newElement.appendChild(string);
		
		osnovno.appendChild(newElement);
		
		newElement = document.createElement("div");
		newElement.classList.add("cena");
		string = document.createTextNode(""+cena);
		newElement.appendChild(string);
		
		osnovno.appendChild(newElement);
		
		newElement = document.createElement("div");
		newElement.classList.add("brIgraca");
		string = document.createTextNode(""+brIgraca);
		newElement.appendChild(string);
		
		osnovno.appendChild(newElement);
		
		newElement = document.createElement("div");
		newElement.classList.add("korisnik");
		newElement.classList.add("member");
		string = document.createTextNode(""+user);
		newElement.appendChild(string);
			ocena = document.createElement("span");
			ocena.classList.add("rejting");
			string = document.createTextNode(""+ocena);
			ocena.appendChild(string);
			newElement.appendChild(ocena);
		
		osnovno.appendChild(newElement);
	
	
		/* *** OPIS *** */
		var opis = document.createElement("div");
		opis.classList.add("opis");
		
		string = document.createTextNode(""+opis);
		opis.appendChild(string);
		
		//NE PRIKAZUJ DUGME ZA SOPSTVENI POST
		if(""+user != ""+username){
			var dugme = document.createElement("div");
			dugme.classList.add("dugme");
			dugme.classList.add("member");
			
			newElement = document.createElement("button");
			newElement.setAttribute("type", "button");
			newElement.setAttribute("onclick", "sendRequest('id')");
			newElement.id="btn"+id;
			if(state != null){
				newElement.style.opacity = "0.5";
				newElement.onmouseover = function(){
					this.style.cursor="not-allowed";
				}
			}
			string = document.createTextNode(""+state);
			newElement.appendChild(string);
			
			opis.appendChild(newElement);
		}
	
	info.appendChild(osnovno);
	info.appendChild(opis);
	
	row.appendChild(datum_vreme);
	row.appendChild(info);
	
	return row;
}

function loadAllOffers(){
	
	return; // !!!!!!! UKLONITI KADA SE NAPRAVI SERVERKSA STRANA
	
	var id;
	var datum_termina;
	var vreme_termina;
	var naslov;
	var adresa;
	var cena;
	var brIgraca;
	var user;
	var ocena;
	var opis;
	var state;
	
	//TODO: primi poruku od servera
	// AKO NE POSTOJI NIJEDNA PORUKA ODMAH RETURN
	//TODO: for each row in baza_podataka
	
	var start = document.getElementsByClassName("termini")[0];
	var row = loadOneOffer(id, datum_termina, vreme_termina, naslov, adresa, cena, brIgraca, user, ocena, opis, state);
	start.appendChild(row);
}





// DEFINISATI "STATE" za slucajeve kada zahtev nije poslat, kada se ceka na odgovor i kada je odgovor primljen(prihvacen ili odbijen)
function sendRequest(id){
	var btn = document.getElementById("btn"+id);
	if(alphaOnly(btn.innerHTML) == alphaOnly("Zahtev poslat") || alphaOnly(btn.innerHTML) == alphaOnly("Zahtev prihvacen") || alphaOnly(btn.innerHTML)
		== alphaOnly("Zahtev odbijen"))
			return;
	
	//TODO: posalji poruku serveru sa trenutnim username i prosledjenim id_termin
	
	btn.textContent = "Zahtev poslat";
	btn.style.opacity="0.5";
	btn.onmouseover = function(){
		this.style.cursor="not-allowed";
		
	}
}






function alphaOnly(a) {
    var b = '';
    for (var i = 0; i < a.length; i++) {
        if (a[i] >= 'A' && a[i] <= 'z') b += a[i];
    }
    return b;
}