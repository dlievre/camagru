


  
  function img_delete(id)
  {
    var image = document.getElementById(id); // div du fond souhaité
    image.style.border='1px solid #E8272C';
    alert('supprimer cette image '+ id);

    //var httpRequest = false;
    // source https://developer.mozilla.org/fr/docs/AJAX/Premiers_pas
    if (window.XMLHttpRequest) var XHR = new XMLHttpRequest(); // Mozilla, Safari, ...
    if (window.ActiveXObject) var XHR = new ActiveXObject("Microsoft.XMLHTTP"); // IE
    if (!window.XMLHttpRequest || window.ActiveXObject) {alert('Erreur initialisation Ajax'); return;}
    XHR.overrideMimeType('text/xml');

    XHR.onreadystatechange = img_delete_srvchk(XHR); // fonction qui Ctrl le retour srv

    XHR.open('GET', 'delete.php', true);
    //var tosend = 'nom=test'; 
    XHR.send('nom=valeur');

    /*if (confirm('supprimer cette image ?'+ id)) {
    // Save it!
        } 
        else 
        {
    // Do nothing!
        }*/

  }

    function img_delete_srvchk(XHR)
    {
        if (XHR.readyState === 4)
        {
            if (XHR.status === 200) {  // On a recu une reponse correcte du serveur
            document.getElementById('content').innerHTML = XHR.responseText
            // XHR.responseText correspond à la valeur de la variable PHP $ajax;
            }
        } 
        else 
        { 
            alert ('status ' + XHR.readyState + ' reponse '+XHR.responseText); 
        }   // pas encore prête

    }

 
//}

//const gestion = new CGestion('');

