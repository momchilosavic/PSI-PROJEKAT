var inputs;
var opis;

window.onload=function(){
	document.getElementsByTagName("button")[0].addEventListener("click", createOffer);
	document.getElementsByTagName("button")[1].addEventListener("click", goBack);
	inputs = document.getElementsByTagName("input");
	
	inputs[0].addEventListener("keyup", turnOffWarning_0);
	inputs[1].addEventListener("keyup", turnOffWarning_1);
	inputs[2].addEventListener("change", turnOffWarning_2);
	inputs[3].addEventListener("keyup", turnOffWarning_3);
	inputs[4].addEventListener("keyup", turnOffWarning_4);
	opis=document.getElementsByTagName("textarea")[0];
}


/* *** BUTTON FUNCTIONS *** */
function goBack(){
	window.open('termin.html', '_self');
}

function createOffer(){
	var greska = false;
	
	var i;
	for (i = 0; i < inputs.length; i++) { 
		if(inputs[i].value == ""){
			greska = true;
			inputs[i].style.border = "thin solid red";
		}
	}
	
	if(!greska){
		var dat = inputs[2].value;
		dat = dat.split("-");
		var datum = "" + dat[2] + "." + dat[1] + "." + dat[0] + ".";
		sendMessage(inputs[0].value, inputs[1].value, datum, inputs[3].value, inputs[4].value, opis.value);
		openPopup();
		setTimeout(function(){window.open('termin.html', '_self')}, 1000);
	}
}

function sendMessage(naslov, adresa, datum, vreme, cena, opis) {
	//TODO: uspostavi konekciju sa serverom i posalji mu poruku sa podacima o terminu
}

function openPopup(){
	var modal = document.getElementById('myModal');
	modal.style.display = "block";
}

function closePopup(){
	var modal = document.getElementById('myModal');
	modal.style.display = "none";
}
/* *** ***************** *** */


/* *** LISTENER FUNCTIONS *** */
function turnOffWarning_0(){
	inputs[0].style.border="thin solid gray";
}

function turnOffWarning_1(){
	inputs[1].style.border="thin solid gray";
}

function turnOffWarning_2(){
	inputs[2].style.border="thin solid gray";
}

function turnOffWarning_3(){
	inputs[3].style.border="thin solid gray";
}

function turnOffWarning_4(){
	inputs[4].style.border="thin solid gray";
}
/* *** ******************* *** */