document.addEventListener("DOMContentLoaded", () => {
    // --- MENU MOBILE ---
    const menuButton = document.querySelector(".menu-button");
    const sidebar = document.querySelector("aside");
    const menuIcon = menuButton?.querySelector("i");

    if (menuButton && sidebar) {
        menuButton.addEventListener("click", (e) => {
            e.stopPropagation();
            sidebar.classList.toggle("active");
            menuButton.classList.toggle("active");
            if (menuIcon) {
                menuIcon.classList.toggle("bi-list");
                menuIcon.classList.toggle("bi-x");
            }
        });

        document.addEventListener("click", (e) => {
            if (!sidebar.contains(e.target) && !menuButton.contains(e.target) && sidebar.classList.contains("active")) {
                sidebar.classList.remove("active");
                menuButton.classList.remove("active");
                if (menuIcon) {
                    menuIcon.classList.add("bi-list");
                    menuIcon.classList.remove("bi-x");
                }
            }
        });
    }

    // --- DROPDOWN DE NOTIFICAÇÕES ---
    const notifBtn = document.getElementById("notifBtn");
    const notifDropdown = document.getElementById("notifDropdown");

    if (notifBtn && notifDropdown) {
        notifBtn.addEventListener("click", (e) => {
            e.stopPropagation();
            notifDropdown.classList.toggle("hidden");
        });

        document.addEventListener("click", (e) => {
            if (!notifBtn.contains(e.target) && !notifDropdown.contains(e.target)) {
                notifDropdown.classList.add("hidden");
            }
        });
    }

    if (window.lucide) {
        window.lucide.createIcons();
    }
});

