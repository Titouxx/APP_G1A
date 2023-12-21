const tab = document.getElementById("pullTab");
const image = document.getElementById("img-news");
const content = document.querySelector(".news");

let isActive = false;

image.addEventListener("click", (event) => {
  isActive = !isActive;
  if (isActive) {
    tab.classList.add("active");
  } else {
    tab.classList.remove("active");
  }
  event.stopPropagation(); // Prevents the click from propagating to the document
});

// Hide tab when clicking outside of the content area or image
document.addEventListener("click", (event) => {
  const isClickInsideContent = content.contains(event.target);
  if (!isClickInsideContent && isActive) {
    tab.classList.remove("active");
    isActive = false;
  }
});

// Prevent tab from hiding when clicking on the tab itself
tab.addEventListener("click", (event) => {
  event.stopPropagation();
});
