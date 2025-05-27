document.addEventListener("DOMContentLoaded", function () {
  const imagePreviewInput = document.getElementById("image_preview_input");
  const preview = document.getElementById("image_preview");
  const imagePreviewSubmit = document.getElementById("image_preview_submit");

  if (!(imagePreviewInput && preview)) return;

  imagePreviewInput.style.display = "none";
  imagePreviewSubmit.style.display = "none";

  preview.addEventListener("click", function () {
    imagePreviewInput.click();
  });

  imagePreviewInput.addEventListener("change", function (event) {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        document.getElementById("image_preview").src = e.target.result;
        imagePreviewSubmit.style.display = "block";
      };
      reader.readAsDataURL(file);
    }
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const currentPath = window.location.pathname;
  const navLinks = document.querySelectorAll(".nav-link");

  navLinks.forEach((link) => {
    const linkPath = new URL(link.href).pathname;

    // Compara o caminho atual da URL com o href do link
    if (currentPath === linkPath) {
      link.classList.add("active");
    } else {
      link.classList.remove("active");
    }
  });
});

const menuButton = document.querySelector(".menu-button");
const navbar = document.querySelector(".sidebar");
const menuIcon = menuButton.querySelector("i");

menuButton.addEventListener("click", () => {
  navbar.classList.toggle("active");
  menuButton.classList.toggle("active");

  if (navbar.classList.contains("active")) {
    menuIcon.classList.remove("bi-list");
    menuIcon.classList.add("bi-x");
  } else {
    menuIcon.classList.remove("bi-x");
    menuIcon.classList.add("bi-list");
  }
});

// Fechar sidebar ao clicar fora
document.addEventListener("click", function (event) {
  const isClickInsideSidebar = navbar.contains(event.target);
  const isClickOnButton = menuButton.contains(event.target);

  if (
    !isClickInsideSidebar &&
    !isClickOnButton &&
    navbar.classList.contains("active")
  ) {
    navbar.classList.remove("active");
    menuButton.classList.remove("active");
    menuIcon.classList.remove("bi-x");
    menuIcon.classList.add("bi-list");
  }
});
