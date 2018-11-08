/**
 * main.js - File handles all dynamic stuff on this XML-exmaple app
 * 
 * @license   MIT
 * @author    Tuomas Puro
 * 
 */

// Handler for sending new message
document.getElementById("btnSendJson").addEventListener("click", jsonSaveData);
document.getElementById("btnSendPostData").addEventListener("click", postSaveData);


// Defining constants
const xmlFile = "data.xml";

/**
 * loadData - Load defined XML-file through Ajax call
 */
function loadData(){
  var ajax = new XMLHttpRequest();
  ajax.onload = function(){
    showData(ajax.responseXML, 'messages');
  };
  var bustCache = '?' + new Date().getTime();
  ajax.open("GET", xmlFile + bustCache, true);
  ajax.send();
}

/**
 * showData - Shows XML-data as a HTML list
 * @param {object} data - XML-data
 * @param {string} target - defines DOM-node where list is to be generated
 */
function showData(data, target){

  // Define and clear target element
  var htmlTarget = document.getElementById(target);
  htmlTarget.innerHTML = '';
  
  // Get all elements by viesti-tag
  var d = data.getElementsByTagName('viesti');
  
  // Compose li-elements from data
  for (var i=0; i<d.length; i++){
    var li = document.createElement("li");
    var linkText = document.createTextNode(d[i].childNodes[0].nodeValue);
    var nimi = document.createElement('span');
    var nimiText = document.createTextNode(d[i].attributes.getNamedItem('lähettäjä').nodeValue);
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
 * Save form data in xml-file. Pass data as json blob-file
 */
function jsonSaveData(){
  var ajax = new XMLHttpRequest();
  ajax.onload = function() {
    console.log(ajax.responseText);
    loadData();
    document.forms['lomake'].reset();
  };

  var nimi = document.getElementById('nimi').value;
  var viesti = document.getElementById('viesti').value;
  var obj = {nimi: document.getElementById('nimi').value, viesti: document.getElementById('viesti').value }
  console.log(obj);
  ajax.open("POST", "json-save.php", true);
  ajax.setRequestHeader("Content-Type", "application/json");
  ajax.send(JSON.stringify(obj));

}


/**
 * Save form data in xml-file. Pass data as post multipart-form-data
 */
function postSaveData(){
  event.preventDefault();
  var ajax = new XMLHttpRequest();
  ajax.onload = function() {
    console.log(ajax.responseText);
    loadData();
    document.forms['lomake'].reset();
  };

  formData = new FormData(document.forms['lomake']);
  ajax.open("POST", "post-data-save.php", true);
  ajax.send(formData);

}

/**
 * del - removes xml-node from file at defined index, provided by parameter
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
