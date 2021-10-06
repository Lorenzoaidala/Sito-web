function ora(consegna, nameAddress, civico){
    var array = consegna.value.split(":");
    var utenteMinuti = parseInt(array[1]);
    var utenteOra = parseInt(array[0]);
    var totaleUtente = utenteMinuti + (utenteOra*60);
 
    var regOra = /^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/;
    var regexIndirizzo = /^[\sA-Za-z]{1,40}$/;
    var adesso = new Date();
    var minuti1 = parseInt(adesso.getMinutes());
    var ora1 = parseInt(adesso.getHours());
    var totale1 = minuti1 + (ora1 * 60);

    if(consegna.value>"23:14:00"){
        window.alert("Pizzeria chiusa! Siamo aperti tutti i giorni dalle 12:00 alle 23:14 ");
        return false;
     }
     if(consegna.value<"12:00:00"){
        window.alert("Pizzeria chiusa! Siamo aperti tutti i giorni dalle 12:00 alle 23:14 ");
      return false;
   }


    if(!(regexIndirizzo.test(nameAddress.value))){
      window.alert("L'indirizzo deve avere una dimensione compresa tra 1 e 40.");
      return false;
  }

  if(consegna.length==0){
    window.alert("Inserire ora consegna");
    return false;
  }

    if(!(regOra.test(consegna.value))){
        window.alert("Inserire formato hh:mm");
        return false;
    }
    var differenza = totaleUtente-totale1;
    if(ora1== 23 && minuti1>=15 ){
       differenza=60*24-totale1+(totaleUtente);
    }

    if((differenza) < 45 ){
        window.alert("Si prega di attendere almeno 45 minuti, tempo di preparazione dell'ordine");
        return false;
    }
    if(nameAddress.length == 0){
        window.alert("Inserire campo indirizzo");
        return false;
    }
    if(civico.value == "" || civico.value == 0){
        window.alert("Inserire civico");
        return false;
    }
    return true;

}