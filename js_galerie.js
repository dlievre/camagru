
class Cgalerie
{

  constructor(fond)
  {
    //alert(document.querySelector('#activer_camera'));

    this.fond_select = fond; // this est important pour une variable de la classe et non de fonction 
    this.previous_imgt_id = ''; // gestion du bord de l'imagette fond 
    var video = document.querySelector('#video');
    //this.btn_activer_camera = document.querySelector('#activer_camera');
    // seul this.btn_activer_camera peut être utiliser dans une methode de la class
    // donc pas nécessaire
    // il suffit d'utiliser activer_camera.style.display == "none" sans document.querySelector ou getElementById

  }



  view_comment(id)
  {
   //alert('view_comment '+id);
    var image = document.getElementById(id); 
    var cmt = document.getElementById('div_galerie_cmt'); 
    

    //var image = document.getElementById(id); // div du fond souhaité

    div_galerie_cmt.style.visibility = "visible";

    image.style.border='2px solid #E8272C';
   
   // div_galerie_cmt.innerHTML = 'toto';


    //div_galerie_cmt.innerHTML = 'titi';
    // on desactive le bord de l'ancien fond
    /*if (this.previous_imgt_id) {var previous = this.previous_imgt_id; var imgt_fond_previous = document.getElementById(previous); imgt_fond_previous.style.border='0px solid #E8272C';}
    var url = "url('fonds/"+id+".png')"; // on recupère le nom du fond
    div_fond.style.backgroundImage = url ;//= 'fonds/fond01.png';
    this.previous_imgt_id = id;*/
    // mise a jour text div fond et hidden
    ////div_galerie_cmt.innerHTML = id;
    //div_fond_text.style.display = "none";   
  }



}

const galerie = new Cgalerie('fond02');

