
class Cfusion
{

  constructor(fond)
  {
    //alert(document.querySelector('#activer_camera'));

    this.fond_select = fond; // this est important pour une variable de la classe et non de fonction 
    this.previous_imgt_id = ''; // gestion du bord de  l'imagette fond
    var video = document.querySelector('#video');
    this.btn_activer_camera = document.querySelector('#activer_camera');

    /*var transfert = document.getElementById('transfert');
    var canvas = document.getElementById("canvas"); // div du canvas
    var inputfond = document.getElementById("hidden_fond"); // div du canvas
    var msg_fonds = document.querySelector('#msg_fonds');
    var draw = document.querySelector('#draw');
    var div_video = document.querySelector('#div_video');
    var div_fond = document.querySelector('#div_fond');
    var div_fond_text = document.querySelector('#div_fond_text');
    var div_canvas = document.querySelector('#div_canvas');*/
    // Prefer camera resolution nearest to 1280x720.
    var constraints = { audio: false, video: { width: 514, height: 386 } }; 

    navigator.mediaDevices.getUserMedia(constraints)
    .then(function(mediaStream)
    {
      video.srcObject = mediaStream;
      video.onloadedmetadata = function(e) { video.play(); };
    })
    .catch(function(err) { console.log(err.name + ": " + err.message); })
  }

  uploadEx() {
    var dataURL = canvas.toDataURL("image/png"); // format sera image en png
    document.getElementById('hidden_data').value = dataURL; // input du form qui contiendra l'image pour envoi
    var fd = new FormData(document.forms["form1"]); // nom du form

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'fusion.php', true);

    xhr.upload.onprogress = function(e) {
        if (e.lengthComputable) {
            var percentComplete = (e.loaded / e.total) * 100;
            //console.log(percentComplete + '% uploaded');
            alert('Succesfully uploaded '+percentComplete+'%');
        }
    };

    xhr.onload = function() {

    };
    xhr.send(fd);
  }

  draw()
  {
   ////var canvas = document.querySelector('#canvas');
    var inputfond = document.querySelector('#hidden_fond');

    var ctx = canvas.getContext('2d');
    var canvaswidth = canvas.width;
    var canvasheight = canvas.height;
    // Draw photo
    ctx.drawImage(video, 1, 1, canvaswidth, canvasheight);
    // on transfère au serveur la photo avant fusion avec le nom du fond 
    inputfond.value = this.fond_select;
    traitement.uploadEx();
    // Draw background
    ctx.drawImage(document.getElementById(this.fond_select), 0, 0, canvaswidth, canvasheight);
    // effacer video et afficher fusion
    video.style.display = "none";
    div_video.hidden = true;
    div_fond.hidden = true;
    div_canvas.hidden = false;
    canvas.style.display = "inline";
    draw.style.display = "none";
    activer_camera.style.display = "inline";
    msg_fonds.style.display = "none";
  }

  changefond(id)
  {
    //alert(document.querySelector('this.btn_activer_camera'));
    this.fond_select = id;
    if (activer_camera.style.display == "none" ) draw.style.display = "inline";
    transfert.style.display = "inline";
    msg_fonds.style.display = "none";
    var imagette_fond = document.getElementById(id); // div du fond souhaité
    imagette_fond.style.border='1px solid #E8272C';
    // on desactive le bord de l'ancien fond
    if (this.previous_imgt_id) {var previous = this.previous_imgt_id; var imgt_fond_previous = document.getElementById(previous); imgt_fond_previous.style.border='0px solid #E8272C';}
    var url = "url('fonds/"+id+".png')"; // on recupère le nom du fond
    div_fond.style.backgroundImage = url ;//= 'fonds/fond01.png';
    this.previous_imgt_id = id;
    // mise a jour text div fond et hidden
    div_fond_text.innerHTML = id;
    div_fond_text.style.display = "none";
    


    
  }

  camera()
  {
    //msg_fonds.style.display = "inline";
    draw.style.display = "inline";
    video.style.display = "inline";
    canvas.style.display = "none";
    div_video.hidden = false;
    div_fond.hidden = false;
    div_canvas.hidden = true;
    //draw.style.display = "none";
    transfert.style.display = "inline";
    activer_camera.style.display = "none";
  }

}

const traitement = new Cfusion('fond02');

