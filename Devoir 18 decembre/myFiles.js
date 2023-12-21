function fonction1() {
  document.write("Hello World!");
  document.write("<h1>Hello World!</h1>");
}

function fonction2() {
  let x = 5 + 5;
  document.write(x);
  document.write("<br/>");
  x = "5" + "5";
  document.write(x + "<br/>");
  x = 5 + 1 + "5";
  document.write(x);
  document.write("<br/>");
  x = "5" + 5 + 1;
  document.write(x + "<br/>");
}
function fonction3() {
  var animals = new Array();
  animals[0] = "Dog";
  animals[1] = "Cat";
  animals[2] = "Delphin";
  for (a in animals) {
    document.write(animals[a] + "<br />");
  }
}

function produit(a, b) {
  return a * b;
}

function prompt1() {
  var a = prompt("Entrer la valeur de a");
  var b = prompt("Entrer la valeur de b");
  alert(a * b);
}
