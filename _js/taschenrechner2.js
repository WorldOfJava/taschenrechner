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
  document.getElementById("ergebnis").value = result ;

  if(isNaN(a) || isNaN(b) ) {
    document.forms[0].reset();
  }

}
function rest()
{
  setValues();
  result =a-b;
  document.getElementById("ergebnis").value = result ;

  if(isNaN(a) || isNaN(b) ) {
    document.forms[0].reset();
  }

}
function multiply()
{
  setValues();
  result =a*b;
  document.getElementById("ergebnis").value = result ;

  if(isNaN(a) || isNaN(b) ) {
    document.forms[0].reset();
  }


}
function div()
{
  setValues();
  result =a/b;
  document.getElementById("ergebnis").value = result ;

  if(isNaN(a) || isNaN(b) ) {
    document.forms[0].reset();
  }


  if (b == 0) {
    alert("Teilen durch 0 nicht möglich!!!");
  }
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





