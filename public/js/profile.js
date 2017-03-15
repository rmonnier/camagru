(function() {

var streaming = false,
    video        = document.querySelector('#video'),
    cover        = document.querySelector('#cover'),
    canvas       = document.querySelector('#canvas'),
    photo        = document.querySelector('#photo'),
    fileUploaded = document.querySelector('#fileUploaded'),
    uploadbutton   = document.querySelector('#uploadbutton'),
    gallery       = document.querySelector('.gallery'),
    startbutton  = document.querySelector('#startbutton'),
    deletebutton = document.querySelectorAll('.deletebutton'),
    filter      = document.querySelector('#filter-selector'),
	  savebutton  = document.querySelector('#savebutton'),
    width = 320,
    height = 0;

navigator.getMedia = ( navigator.getUserMedia ||
                       navigator.webkitGetUserMedia ||
                       navigator.mozGetUserMedia ||
                       navigator.msGetUserMedia);

navigator.getMedia(
  {
    video: true,
    audio: false
  },
  function(stream) {
    if (navigator.mozGetUserMedia) {
      video.mozSrcObject = stream;
    } else {
      var vendorURL = window.URL || window.webkitURL;
      video.src = vendorURL.createObjectURL(stream);
    }
    video.play();
  },
  function(err) {
    console.log("An error occured! " + err);
  }
);

video.addEventListener('canplay', function(ev){
  if (!streaming) {
    height = video.videoHeight / (video.videoWidth/width);
    video.setAttribute('width', width);
    video.setAttribute('height', height);
    canvas.setAttribute('width', width);
    canvas.setAttribute('height', height);
    streaming = true;
  }
}, false);

function takepicture() {
  canvas.width = width;
  canvas.height = height;
  canvas.getContext('2d').drawImage(video, 0, 0, width, height);
}


function newImage(id, src) {
  const newImg = document.createElement('img');
  newImg.setAttribute('id', id);
  newImg.setAttribute('class', 'photo');
  newImg.setAttribute('alt', 'photo');
  newImg.setAttribute('src', src);

  const newTextDelete = document.createTextNode('X');

  const newDelete = document.createElement('div');
  newDelete.setAttribute('class', 'deletebutton');
  newDelete.addEventListener('click', function(ev){
    deletePicture(ev);
  }, false);
  newDelete.appendChild(newTextDelete);

  const newContainer = document.createElement('div');
  newContainer.setAttribute('class', 'img-container flex-item');
  newContainer.appendChild(newImg);
  newContainer.appendChild(newDelete);
  return (newContainer);
}


// DOM refreshing : add and delete pictures

function addPicture(id, src) {
  const newImg = newImage(id, src);

  gallery.insertBefore(newImg, gallery.firstChild);
}

function deletePicture(event){
  const photoContainer = event.currentTarget.parentNode;

  const currentPhoto = photoContainer.firstElementChild;
  const id = currentPhoto.getAttribute("id");

  gallery.removeChild(photoContainer);
  ajaxDelete(id);
}


// AJAX : add and delete pictures

function ajaxAdd(data) {
  const xhttp = new XMLHttpRequest();
  xhttp.open("POST", "ajax.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  const params = "action=save&data=" + data + "&filter=" + filter.value;
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      //console.log("Added ! Response :\n" + xhttp.responseText + "\n");
      var myJSON = xhttp.responseText;
      var myObj = JSON.parse(myJSON);
      addPicture(myObj.id, myObj.src);
    }
  };
  xhttp.send(params);
}

function ajaxDelete(id) {
  const xhttp = new XMLHttpRequest();
  xhttp.open("POST", "ajax.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  const params = "action=delete&id=" + id;
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      console.log("Deleted ! Response :\n" + xhttp.responseText + "\n");
    }
  };
  xhttp.send(params);
}


// ---   Adding listeners at first load   ---

// Take-the-picture button

startbutton.addEventListener('click', function(event){
  if (filter.value == "")
    return ;
  takepicture();
  const data = canvas.toDataURL('image/png').split(',')[1];
	ajaxAdd(data);
  event.preventDefault();
  }, false);

// Delete-the-picture buttons

for (var i = 0; i < deletebutton.length; i++) {
  deletebutton[i].addEventListener('click', function(event){
  deletePicture(event)
  }, false);
}

function readImage() {
    if ( fileUploaded.files && fileUploaded.files[0] ) {
        const reader = new FileReader();
        reader.onload = function(e) {
           const img = new Image();
           img.onload = function() {
             const context = canvas.getContext('2d');
             context.drawImage(img, 0, 0, width, height);
             const data = canvas.toDataURL('image/png').split(',')[1];
             ajaxAdd(data);
           };
           img.src = e.target.result;
        };
        reader.readAsDataURL( fileUploaded.files[0] );
    }
}

uploadbutton.addEventListener('click', function(event){
  if (filter.value == "")
    return ;
  readImage();
  event.preventDefault();
}, false);


})();
