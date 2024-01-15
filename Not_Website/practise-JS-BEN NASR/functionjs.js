function ecrire() {
  document.write("Hello World!");
  document.write("<h1>Hello World!</h1>");
  var x = 10; /* on peut faire l'affectation au meme moment de la declaration */
  document.write(x);
}

function calcul() {
  let x = 5 + 5;
  document.write(x);
  document.write("<br/>");
  x = "5" + "5";
  document.write(x + "<br/>");
  x = 5 + 1 + "5";
  document.write(x);
  document.write("<br/>");
  x = "5" + 5 + 1;
  document.write(x);
  document.write("<br/>");
}

function tab() {
  document.write("<br/>");
  var animals = new Array();
  animals[0] = "Dog";
  animals[1] = "Cat";
  animals[2] = "Delphin";
  for (a in animals) {
    document.write(animals[a] + "<br />");
  }
  document.write("<br/>");
}

function produit(a, b) {
  document.write("<br/>");
  return a * b;
  document.write("<br/>");
}

function alerte() {
  var result = confirm("Voulez-vous vraiment quitter cette page?");
  if (result == true) {
    alert("Merci de votre visite");
  } else {
    alert("Merci de rester avec nous");
  }
}
