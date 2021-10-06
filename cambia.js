function cambia(nomePizza,ingredientiPizza,costoPizza,quantitaPizza){

    var name = nomePizza.value;
    var costo = costoPizza.value;
    var quantita = quantitaPizza.value;
    var ingr = ingredientiPizza.value;
   if(name.length==0 ){
        window.alert("Inserire nome");
        return false;
    }else if(costo.length==0){
        window.alert("Inserire costo");
        return false;

    }else if(quantita.length==0){
        window.alert("Inserire quantita");
        return false;

    }else if (quantita<0){
        window.alert("Errore, quantita negativa");
        return false;

    }else if(costo<0){
        window.alert("Errore costo negativo");
        return false;
    }else if(ingr.length==0){
        window.alert("Inserire ingredienti");
        return false;
    }
    return true;
}