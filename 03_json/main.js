document.getElementById("btnSend").addEventListener("click", saveData);

function loadData(){
  var ajax = new XMLHttpRequest();

  ajax.onload = function(){
    data = JSON.parse(ajax.responseText);
    showData(data, 'messages');
  };
  var bustCache = '?' + new Date().getTime();
  ajax.open("GET", "data.json" + bustCache, true);
  ajax.send();
}


/**
 * showData - Shows given json-object in targeted html ul-element as a list
 * @param {json object} json
 * @param {string} target 
 */
function showData(d, target){

  var htmlTarget = document.getElementById(target);
  htmlTarget.innerHTML = '';

  for (var i=0; i<d.length; i++){
    var li = document.createElement("li");
    var linkText = document.createTextNode(d[i].viesti);
    var nimi = document.createElement('span');
    var nimiText = document.createTextNode(d[i].nimi);
    var a = document.createElement("a");
    var aText = document.createTextNode('poista');
    a.appendChild(aText);
    a.addEventListener('click', del);
    a.myParam = i;
    nimi.appendChild(nimiText);
    li.appendChild(linkText);
    li.appendChild(nimi);
    li.appendChild(a);
    htmlTarget.appendChild(li);
  }
}

/**
 * saveData - Saves calls save.php -script to save form data
 */
function saveData(){
  var ajax = new XMLHttpRequest();
  ajax.onload = function() {
    console.log(ajax.responseText);
    loadData();
    document.forms['lomake'].reset();
  };

  var nimi = document.getElementById('nimi').value;
  var viesti = document.getElementById('viesti').value;
  var obj = {nimi: document.getElementById('nimi').value, viesti: document.getElementById('viesti').value }
  ajax.open("POST", "save.php", true);
  ajax.setRequestHeader("Content-Type", "application/json");
  ajax.send(JSON.stringify(obj));

}

/**
 * del - Makes Ajax-call to del.php -srcipt to delete json-object form a file
 * @param {integer} p 
 */
function del(p){
  var ajax = new XMLHttpRequest();
  ajax.onload = function() {
    console.log(ajax.responseText);
    loadData();
  };
  var getParam = 'id=' + p.target.myParam;
  alert(getParam);
  var bustCache = '&' + new Date().getTime();
  ajax.open("GET", "del.php?" + getParam + bustCache, true);
  ajax.send();

}
