function ecrire() {
    document.write("Hello World!");
    document.write("<h1>Hello World!</h1>");
    var x = 10; /* on peut faire l'affectation au meme moment de la declaration */
    document.write(x);
    document.write("<br/>");
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
    document.write("<br/>");


  }

  function animaux(){
    var animals = new Array();
    animals[0] = "Dog";
    animals[1] = "Cat";
    animals[2] = "Delphin";
    for (a in animals)
    {
        document.write(animals[a] + "<br />");
    }
    document.write("<br/>");
    document.write("<br/>");
  }

  function produit(a,b){
    return a*b;
    document.write("<br/>");
    document.write("<br/>");
  }