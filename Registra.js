function Registra(name, surname, nascita, address, civico, soldi, user, password){
    var regnome = /^[\sA-Za-z]{2,25}$/;
        var regexcognome = /^[\sA-Za-z]{2,30}$/;
        var regexindirizzo = /^[\sA-Za-z]{1,40}$/;
        var regexusername = /^[a-zA-Z][a-zA-Z0-9-_]{2,7}$/;
        var regexpassword = /^[\W\w\d]{6,12}$/;
        var nome = name.value;
        var cognome = surname.value;
        var data = nascita.value;
        var indirizzo = address.value;
        var numCivico = civico.value;
        var credito = soldi.value;
        var username = user.value;
        var pass = password.value;
        var regexpData = /^\d{4}\-\d{1,2}\-\d{1,2}$/;
        var regexpGiorno = /^(0?[1-9]|[12][0-9]|3[01])$/;
        var regexpMese = /^(0?[1-9]|1[012])$/
        var regexpAnno = /^\d{4}$/
        var dataA = data.split("-");
        var annoStringa = dataA[0];
        var meseStringa = dataA[1];
        var giornoStringa = dataA[2];
        var dataFinale=new Date(data);
        var ora=new Date();
    
        if(cognome.length == 0){
            window.alert("Inserire cognome");
            return false;
        }else if(cognome.length<2 || cognome.length>30){
            window.alert("Il cognome deve essere avere minimo 2 massimo 30 caratteri");
            return false;
        }else if(/^[\s]/.test(cognome)){
          window.alert("Errore, primo carattere spazio");
          return false;
        }else if(/[\s]$/.test(cognome)){
            window.alert("Errore, ultimo carattere spazio");
            return false;
        }else if(!regexcognome.test(cognome)){
            window.alert("Errore formato cognome");
            return false;
        }
    
        if(nome.length == 0){
            window.alert("Inserire nome");
            return false;
        }else if(nome.length<2 || nome.length>25){
            window.alert("Dimensione nome errata, minimo 2, massimo 25 caratteri");
            return false;
        }else if(/^[\s]/.test(nome)){
            window.alert("Il primo carattere non può essere uno spazio");
            return false;
          }else if(/[\s]$/.test(nome)){
              window.alert("L'ultimo carattere non può essere uno spazio");
              return false;
          }else if(!regnome.test(nome)){
            window.alert("Errore nel formato del nome, il nome può contenere solo lettere e spazi");
            return false;
        }
        //controlli data
        if(dataFinale>ora){
            window.alert("Errore data futura");
            return false;
    }
        if(meseStringa==4 || meseStringa==6 || meseStringa==9 || meseStringa==11){
            if(giornoStringa>30){
             window.alert("Data incorretta, usare formato aaaa-mm-gg");
             return false;
            }
         }else if(meseStringa==1 || meseStringa==3 || meseStringa==5 || meseStringa==7 || meseStringa==8 || meseStringa==10 || meseStringa==12){
            if(giornoStringa>31){
             window.alert("Data incorretta, usare formato aaaa-mm-gg");
             return false;
            }
         }else if(meseStringa==2){
              if((annoStringa % 4)==0){
                    if(giornoStringa>29){
                    window.alert("Data incorretta, usare formato aaaa-mm-gg");
                    return false;
                    }
             }else {
                if(giornoStringa>28){
                window.alert("Data incorretta, usare formato aaaa-mm-gg");
                return false;
                }
             }
         }else if (!regexpGiorno.test(giornoStringa)){
            window.alert("Data incorretta, usare formato aaaa-mm-gg");
            return false;
         }else if (!regexpMese.test(meseStringa)){
            window.alert("Data incorretta, usare formato aaaa-mm-gg");
            return false;
         }else if (!regexpAnno.test(annoStringa)){
             window.alert("Data incorretta, usare formato aaaa-mm-gg");
             return false;
         } else if(!regexpData.test(data)){
             window.alert("Data incorretta, usare formato aaaa-mm-gg");
              return false;
         }
    
        if(indirizzo.length == 0){
            window.alert("Inserire indirizzo");
            return false;
        }else if(/^[\s]/.test(indirizzo)){
          window.alert("Errore indirizzo!");
          return false;
        }else if(/[\s]$/.test(indirizzo)){
            window.alert("Errore indirizzo!");
            return false;
        }else if(!regexindirizzo.test(indirizzo)){
            window.alert("Errore indirizzo,l'indirizzo può contenere solo lettere e spazi");
            return false;
        }
        if(numCivico.length == 0){
            window.alert("Inserire numero civico");
            return false;
        }else if(numCivico<0 || numCivico>9999){
            window.alert("Errore numero civico,deve essere minore di 10000 e maggiore di 0");
            return false;
        }
        if(credito==0){
            window.alert("Inserire credito");
            return false;
        }else if(credito<0){
            window.alert("Inserire credito positivo");
            return false;
        }
    
        //controlli username
        if(username.length == 0 ){
            window.alert("Errore username! Inserire username di dimensione compresa tra 2 e 8 caratteri");
            return false;
        }else  if(!regexusername.test(username)){
            window.alert("Errore username,l'username può contenere lettere, numeri e trattini, il primo carattere deve essere alfabetico e la dimensione deve essere compresa tra 2 e 8");
            return false;
        }
        
        //controlli pass
        if(pass.length == 0){
            window.alert("Inserire password");
            return false;
        }
        if(regexpassword.test(pass) && /([0-9].*[0-9])/.test(pass) && /[A-Z]/.test(pass) && /[a-z]/.test(pass) && /([\W].*[\W])/.test(pass)){
            return true;
        }else{
            window.alert("Errore nel formato della password,la password deve contenere almeno 1 maiuscolo, 1 minuscolo, 2 numeri e 2 caratteri speciali e deve avere una dimensione compresa tra 6 e 12 caratteri");
            return false;
        }
    }
    