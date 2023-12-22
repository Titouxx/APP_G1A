function helloWorld() {
  document.write("Hello World !");
  document.write("<h1>Hello World !</h1>");
}

function calculatrice() {
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

function animals() {
  document.write("<br/>");
  var animals = new Array();
  animals[0] = "Dog";
  animals[1] = "Cat";
  animals[2] = "Dolphin";
  for (a in animals) {
    document.write(animals[a] + "<br />");
  }
  document.write("<br/>");
}

function produit(a, b) {
  return a * b;
}

function alerte() {
  var result = confirm("Voulez-vous vraiment quitter cette page?");
  if (result == true) {
    alert("Merci de votre visite");
  } else {
    alert("Merci de rester avec nous");
  }
}

function alerteBis() {
  var a = prompt("Entrez votre chiffre a");
  var b = prompt("Entrez votre chiffre b");
  alert(produit(a, b));
}
