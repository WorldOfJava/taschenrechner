function addAChild() {

  count++;

  var firstNumb = document.getElementById("firstNumb").value;
  var secondNumb = document.getElementById("secondNumb").value;
  var operation = document.getElementById("operation").value;


  if (operation === "plus") {

    let result = Number(firstNumb) + Number(secondNumb);
    let create = document.createElement('P');
    let text = document.createTextNode(count+'. '+firstNumb+'+'+ secondNumb+"="+result);
    create.appendChild(text);

    document.getElementById("resultList").appendChild(create)
  }

  if (operation === "minus") {

    let result = Number(firstNumb) - Number(secondNumb);
    let create = document.createElement('P');
    let text = document.createTextNode(count+'. '+firstNumb+'-'+ secondNumb+"="+result);
    create.appendChild(text);

    document.getElementById("resultList").appendChild(create)
  }

  if (operation === "mal") {

    let result = Number(firstNumb) * Number(secondNumb);
    let create = document.createElement('P');
    let text = document.createTextNode(count+'. '+firstNumb+'*'+ secondNumb+"="+result);
    create.appendChild(text);

    document.getElementById("resultList").appendChild(create)
  }

  if (operation === "durch") {

    let result = Number(firstNumb) / Number(secondNumb);
    let create = document.createElement('P');
    let text = document.createTextNode(count+'. '+firstNumb+'/'+ secondNumb+"="+result);
    create.appendChild(text);

    document.getElementById("resultList").appendChild(create)
  }
}
