//script décompte minute

/* 60 000ms setInterval(1000) 
quand le timer arrive à 0, arrêter (afficher "boom")*/

function chronos(){
    var total=60;
    for(i=0; i< total; i++){
       setInterval('console.log("tick")', 1000);
       break;
    }
    setTimeout("alert('BOUM')", 60000);
    return false;
}


function car(){
    variable=document.getElementById("chrono").innerHTML;
    variable--;
    document.getElementById("chrono").innerHTML=variable;
    if(variable==0){
        return false;
    }
}
//var a= setInterval("car",1000);

function search(){
    // /*recherche=document.getElementById("recherche").value.toLowerCase();
    // console.log(recherche);
    // var doc = document.querySelectorAll('title');
    // //var.match(recherche)
    
    // for (var i = 0; i < doc.length; i++) {
    //     if (doc[i].innerText.toLowerCase().match(recherche) !== null) {
    //         var t= doc[i].innerHTML;
    //         console.log(t.match(recherche)); 
    //         doc[i].style.color = "#1788aa";
    //     } else {
    //         doc[i].style.color = "default";
    //     }
    // }
    // var doc = document.querySelectorAll('article');
    // for (var i = 0; i < doc.length; i++) {
    //     if (doc[i].innerText.toLowerCase().match(recherche) !== null) {
    //         var t= doc[i].innerHTML;
    //         console.log(t.match(recherche)); 
    //         doc[i].style.color = "#1788aa";
    //     } else {
    //         doc[i].style.color = "default";
    //     }
    // }
    // var doc = document.querySelectorAll('h1');
    // for (var i = 0; i < doc.length; i++) {
    //     if (doc[i].innerText.toLowerCase().match(recherche) !== null) {
    //         var t= doc[i].innerHTML;
    //         console.log(t.match(recherche)); 
    //         doc[i].style.color = "#1788aa";
    //     } else {
    //     }
    //         doc[i].style.color = "default";
    //     }
    
    // Attention: la correction contient également des bugs*/
    $("span").contents().unwrap();
    var mot= $('#recherche').val(); //récupère la valeur de l'input #recherche
    var zone = $('article').html(); // récupère le contenu html de l'article
    var pos = zone.indexOf(mot); // cherche les occurences du mot
    var re = new RegExp('('+mot+')><*+-?[]','gi'); //crée une expression régulière qui accepte le mot mais exclue les caractères spéciaux
    if(pos>=0) {
        //remplace tous les mots "mot" de la chaîne de caractère 
        var content= zone.replace(re, '<span style="background-color:#175588">'+word+'</span>');
        $('article').html(content); //remplace le contenu original par le nouveau
    }
}
