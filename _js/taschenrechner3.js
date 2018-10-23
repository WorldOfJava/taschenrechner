let a;
let b;
let c;
let result;
var count=0;
function setValues()
{
  a = Number(document.getElementById("firstNumb").value);
  b = Number(document.getElementById("secondNumb").value);
  c = String(document.getElementById("operation").value);
  var count=0;
}
function sum()
{
  setValues();
  count++;
  result =a+b;
  document.getElementById("ergebnis").value = result ;

}
function rest()
{
  setValues();
  result =a-b;
  document.getElementById("ergebnis").value = result ;
}
function multiply()
{
  setValues();
  result =a*b;
  document.getElementById("ergebnis").value = result ;
}
function div()
{
  setValues();
  result =a/b;
  document.getElementById("ergebnis").value = result ;


  if (b == 0) {
    alert("Teilen durch 0 nicht möglich!!!");
  }
}


function potenzieren() {
  setValues();
  result = Math.pow(a, b);
  document.getElementById("ergebnis").value = result ;
}


function meldung() {



  if (document.getElementById("c").value ==1) {
    sum();
  } else if (document.getElementById("c").value ==2) {
    rest();
  } else if (document.getElementById("c").value ==3) {
    multiply();
  } else if (document.getElementById("c").value ==4){
    div();
  } else {
    potenzieren();
  }

}

var count = 0;

function addAChild() {

  count++;

  var firstNumb = document.getElementById("a").value;
  var secondNumb = document.getElementById("b").value;
  var operation =  document.getElementById("c").value;

  if (operation == "plus") {

    var result = Number(firstNumb) + Number(secondNumb);
    var create = document.createElement('P');
    var text = document.createTextNode(count+'. '+firstNumb+'+'+ secondNumb+"="+result);
    create.appendChild(text);

    document.getElementById("resultList").appendChild(create)
  }

  if (operation == "minus") {

    var result = Number(firstNumb) - Number(secondNumb);
    var create = document.createElement('P');
    var text = document.createTextNode(count+'. '+firstNumb+'-'+ secondNumb+"="+result);
    create.appendChild(text);

    document.getElementById("resultList").appendChild(create)
  }

  if (operation == "mal") {

    var result = Number(firstNumb) * Number(secondNumb);
    var create = document.createElement('P');
    var text = document.createTextNode(count+'. '+firstNumb+'*'+ secondNumb+"="+result);
    create.appendChild(text);

    document.getElementById("resultList").appendChild(create)
  }

  if (operation == "durch") {

    var result = Number(firstNumb) / Number(secondNumb);
    var create = document.createElement('P');
    var text = document.createTextNode(count+'. '+firstNumb+'/'+ secondNumb+"="+result);
    create.appendChild(text);

    document.getElementById("resultList").appendChild(create)
  }
}




