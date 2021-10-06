function confermaLogin(user2, pass2) {
    var user=user2.value;
    var password=pass2.value;
    var regexPassword = /^[\W\w\d]{6,12}$/;
    var regexUsername=/^[a-zA-Z][a-zA-Z0-9\-_]{2,7}$/
    
    if(!regexUsername.test(user)){
            window.alert("USERNAME NON CONFORME, Username deve essere una stringa lunga da 3 a 8 caratteri, con solo lettere, numeri e trattini ammessi");
			return false;
    }
    if ( password.length==0 ) {
		window.alert("Inserisci password");
		return false;
	}
        if(regexPassword.test(password)){
        if(!(/([0-9].*[0-9])/.test(password) && /[A-Z]/.test(password) && /[a-z]/.test(password) && /([\W].*[\W])/.test(password))){
            window.alert("Password non conforme,Password deve essere una stringa lunga da 6 a 12 caratteri, che puo contenere lettere, numeri e segni di interpunzione, e deve contenere almeno 1 lettera maiuscola, 1 lettera minuscola, 2 numeri, e 2 caratteri di interpunzione");
            return false
        }  
    }else{
        window.alert("Password non conforme,Password deve essere una stringa lunga da 6 a 12 caratteri, che puo contenere lettere, numeri e segni di interpunzione, e deve contenere almeno 1 lettera maiuscola, 1 lettera minuscola, 2 numeri, e 2 caratteri di interpunzione");
    } 
	return true;
}
