document.getElementById("btnSend").addEventListener("click", saveData);

function loadData(){
  var ajax = new XMLHttpRequest();
  // xhttp.onreadystatechange = function() {
  //   if (this.readyState == 4 && this.status == 200) {
  //     data = JSON.parse(xhttp.responseText);
  //     showData(data, 'messages');
  //   }
  // };
  ajax.onload = function(){
    data = JSON.parse(ajax.responseText);
    showData(data, 'messages');
  };
  ajax.open("GET", "data.json", true);
  ajax.send();
}

function showData(d, target){
  var htmlTarget = document.getElementById(target);
  htmlTarget.innerHTML = '';
  for (var i=0; i<d.viestit.length; i++){
    var li = document.createElement("li");
    var linkText = document.createTextNode(d.viestit[i].viesti);
    var nimi = document.createElement('span');
    var nimiText = document.createTextNode(d.viestit[i].nimi);
    nimi.appendChild(nimiText);
    li.appendChild(linkText);
    li.appendChild(nimi);
    htmlTarget.appendChild(li);
  }
}

function saveData(){
  var ajax = new XMLHttpRequest();
  ajax.onload = function() {

    console.log(ajax.responseText);
  };
  // ajax.on('error', function(){
  //   console.log("error");
  // });
  var nimi = document.getElementById('nimi').value;
  var viesti = document.getElementById('viesti').value;
  var obj = {nimi: document.getElementById('nimi').value, viesti: document.getElementById('viesti').value }
  console.log(obj);ajax.open("POST", "save.php", true);
  ajax.setRequestHeader("Content-Type", "application/json");
  ajax.send(JSON.stringify(obj));
}
