// JS Footer
document.addEventListener("DOMContentLoaded", function () {
  var footer = document.querySelector(".footer");
  if (footer) {
    var logosFooter = document.getElementById("LogosFooter");
    if (logosFooter) {
      logosFooter.style.maxHeight = footer.offsetHeight + "px";
    }
  }
});
