var recaptcha1;
var recaptcha2;

console.log("ById: %s, %s",document.getElementById("recaptcha1"),document.getElementById("recaptcha2"));

var getMultipleRecaptcha = function(){
	//6LcTARcTAAAAACoT__f1eXK86k-dTIvSylc0I_Vk
	 //Render the recaptcha1 on the element with ID "recaptcha1"
    var sitekey = "6Ldy_yETAAAAAKxBOn9FyWzryvZRamoGKg7n95lZ";

    if(document.getElementById("recaptcha1")!= null){
        recaptcha1 = grecaptcha.render('recaptcha1', {
          	'sitekey' : sitekey, //Replace this with your Site key
        	'callback': verifyCallback
        });
    }
    if(document.getElementById("recaptcha2")!= null){
        //Render the recaptcha2 on the element with ID "recaptcha2"
        recaptcha2 = grecaptcha.render('recaptcha2', {
          	'sitekey' : sitekey, //Replace this with your Site key
        	'callback': verifyCallback
        });
    }
};
 
var verifyCallback = function( response ) {
    console.log( 'g-recaptcha-response: ' + response );
};

