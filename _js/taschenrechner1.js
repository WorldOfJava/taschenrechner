let a;
let b;
let c;
let result;
function setValues()
{
  a = Number(document.getElementById("a").value);
  b = Number(document.getElementById("b").value);
  c = String(document.getElementById("c").value);
}
function sum()
{
  setValues();
  result =a+b;
  alert("Die Summe ist: " +result);
}
function rest()
{
  setValues();
  result =a-b;
  alert("Der Rest ist: " +result);
}
function multiply()
{
  setValues();
  result =a*b;
  alert("Die Operation ist: " +result);
}
function div()
{
  setValues();
  result =a/b;
  alert("Das Ergebnis ist: "+result);
}


function meldung() {

if (document.getElementById("c").value ==1) {
  sum();
} else if (document.getElementById("c").value ==2) {
  rest();
} else if (document.getElementById("c").value ==3) {
  multiply();
} else {
  div();
}


}


