// Sélectionner l'élément div
const div = document.getElementById("navbarsExample05");
const main = document.querySelector(".main");
const navbarButton = document.querySelector(".navbar-toggler");

// Créer une fonction qui sera exécutée quand la classe "collapsed" est ajoutée

const navbarButtonClasses = navbarButton.classList;

navbarButton.addEventListener("click", function () {

  navbarButtonClasses.forEach((e) =>
    e == "collapsed"
      ? main.classList.remove("menu-expanded")
      : main.classList.add("menu-expanded")
  );
});
