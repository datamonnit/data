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
    XMLData = ajax.responseXML;
    console.log(XMLData);
    showData(XMLData, 'messages');
  };
  var bustCache = '?' + new Date().getTime();
  ajax.open("GET", "data.xml" + bustCache, true);
  ajax.send();
}

function showData(d, target){
  var htmlTarget = document.getElementById(target);
  htmlTarget.innerHTML = '';
  var d = XMLData.getElementsByTagName('viesti');
  console.log(d);
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
