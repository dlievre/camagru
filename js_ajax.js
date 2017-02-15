
class CAjax
{

  
img_delete(id)
{
    /*if (confirm('supprimer cette image ?'+ id)) {
    // Save it!
        } 
        else 
        {
    // Do nothing!
        }*/
    var image = document.getElementById(id); // div du fond souhaité
    image.style.border='2px solid #E8272C';
    alert('supprimer cette image '+ id);

    //var httpRequest = false;
    // source https://developer.mozilla.org/fr/docs/AJAX/Premiers_pas
    if (window.XMLHttpRequest) var XHR = new XMLHttpRequest(); // Mozilla, Safari, ...
    if (window.ActiveXObject) var XHR = new ActiveXObject("Microsoft.XMLHTTP"); // IE
    if (!window.XMLHttpRequest || window.ActiveXObject) {alert('Erreur initialisation Ajax'); return;}
    XHR.overrideMimeType('text/xml');

    //XHR.onreadystatechange = img_delete_srvchk(XHR); // fonction qui Ctrl le retour srv

    XHR.open('GET', 'delete.php', true);
    XHR.onreadystatechange = function (aEvt) 
    {
        if (XHR.readyState == 4)
        {
            if(XHR.status == 200)
                document.getElementById('user_texte').innerHTML = XHR.responseText; //alert(XHR.responseText);
            else
                alert("Erreur pendant le chargement de la page.\n");
        }
    };
    XHR.send('nom=valeur');
}

Fajax(to_send, page_php, id_div)
{
    if (window.XMLHttpRequest) var XHR = new XMLHttpRequest(); // Mozilla, Safari, ...
    if (window.ActiveXObject) var XHR = new ActiveXObject("Microsoft.XMLHTTP"); // IE
    if (!window.XMLHttpRequest || window.ActiveXObject) {alert('Erreur initialisation Ajax'); return;}
    XHR.overrideMimeType('text/xml');

    //XHR.onreadystatechange = img_delete_srvchk(XHR); // fonction qui Ctrl le retour srv

    XHR.open('GET', page_php, true);
    //XHR.open('GET', 'delete.php', true);
    XHR.onreadystatechange = function (aEvt)
    {
        if (XHR.readyState == 4)
        {
            if(XHR.status == 200)
                {
                
                //alert(XHR.responseText);
                //return XHR.responseText;
                retou (XHR.responseText, id_div);

                }
            else
                {
                alert("Erreur pendant le chargement de la page.\n");
                return 'Erreur';
                }
        }
    };
    XHR.send(to_send);
}

 oldrefresh_usr(id, id_div)
{
    //var image = document.getElementById(id); // div du fond souhaité
    //image.style.border='2px solid #E8272C';
    //alert('supprimer cette image '+ id);
    retour = Fajax(id, 'refresh_usr.php', id_div) ;
    
}

 oldretou(reponse, id_div)
{
//alert (reponse);
document.getElementById(id_div).innerHTML = reponse;
document.getElementById(id_div).visibility = "visible";
}



     img_delete_srvchk(XHR)
    {
        if (XHR.readyState == XMLHttpRequest.DONE) alert('ok');
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

 
//const ICAjax = new CAjax('');
}
