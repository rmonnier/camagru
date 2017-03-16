(function() {

var likeButtons = document.querySelectorAll('.like'),
    width = 320,
    height = 0;


function changeFirstChildTextNode(element, newText) {
  const oldTextNode = element.firstChild;
  const newTextNode = document.createTextNode(newText);
  element.removeChild(oldTextNode);
  element.appendChild(newTextNode);
}

// DOM refreshing : add and delete pictures

function changeStateLike(event) {
  const a = event.currentTarget;
  const status = event.currentTarget.firstChild;
  const photoContainer = event.currentTarget.parentNode.parentNode;
  var number = photoContainer.getElementsByClassName('number')[0];
  const currentPhoto = photoContainer.firstElementChild;
  console.log(currentPhoto);
  const id = currentPhoto.getAttribute("id");

  let newStatus;
  if (status.data == "Like") {
    changeFirstChildTextNode(a, 'Unlike');
    const newNumber = number.firstChild.data * 1 + 1;
    changeFirstChildTextNode(number, newNumber);
    addLike(id);
  }
  else {
    changeFirstChildTextNode(a, 'Like');
    const newNumber = number.firstChild.data * 1 - 1;
    changeFirstChildTextNode(number, newNumber);
    deleteLike(id);
  }
}

// AJAX : add and delete pictures

function addLike(id) {
  const xhttp = new XMLHttpRequest();
  xhttp.open("POST", "ajax.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  const params = "action=like&id=" + id;
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      console.log("Liked ! Response :\n" + xhttp.responseText + "\n");
    }
  };
  xhttp.send(params);
}

function deleteLike(id) {
  const xhttp = new XMLHttpRequest();
  xhttp.open("POST", "ajax.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  const params = "action=unlike&id=" + id;
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      console.log("Unliked ! Response :\n" + xhttp.responseText + "\n");
    }
  };
  xhttp.send(params);
}


// ---   Adding listeners at first load   ---

// Like buttons

for (var i = 0; i < likeButtons.length; i++) {
  likeButtons[i].addEventListener('click', function(event){
    changeStateLike(event);
  }, false);
}


})();
