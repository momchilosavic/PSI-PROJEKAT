var isLogged = false;
var isVIP = false;
var isAdmin = false;
var username ="";
// display:none - display:unset


// poziva se kada se ucitava strana
function loadPage(){
	if(isLogged){
		switchOnContent();
	}
	else{
		switchOffContent();
	}
}

function switchOffContent(){
	//TODO: "display:none" za elemente koji pripadaju klasi "member"
	//TODO: "display:none" za elemente koji pripadaju klasi vip
	//TODO: display:none" za elemente koji pripadaju klasi admin
}

function switchOnContent(){
	//TODO: display:all" za elemente koji pripadaju klasi "member"
	if(isVIP){
		//TODO: dipslay:all za elemente koji pripadaju klasi vip
	}
	if(isAdmin){
		//TODO: display:all za elemente koji pripadaju klasi admin
	}
}
////////////////////////////////////



// poziva se prilikom logovanja
function checkLog(rank){
	switch(rank){
		case "admin": isAdmin = true;
		case "vip": isVIP = true;
		case "member": isLogged = true;
		default: return;
	}
}

function logIn(){
	
	//TODO: procitaj podatke iz forme
	
	//TODO: posalji poruku serveru
	
	//TODO: primi odgovor od servera
	
	checkLog(rank);
	
	if(!isLogged){
		//TODO: ispisi poruku za neuspesno logovanje
	}
	else{
		//TODO: zapamti korisnicko ime u promenljivu username		
		location.reload();
	}
}

function logOut(){
	isLogged = false;
	isVIP = false;
	isAdmin = false;
	username = "";
	
	//TODO: otvori index stranu
}


function registrate(){
	//TODO: procitaj podatke iz forme
	//TODO: posalji poruku serveru
	//TODO: primi poruku od servera
	if(isRegistrated){
		logIn();
		//TODO: ispisi poruku o uspesnoj registraciji
	}
	else{
		//TODO: ispisi poruku o neuspesnoj registraciji
	}
}
///////////////////////////////////////




