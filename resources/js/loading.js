  document.addEventListener("DOMContentLoaded", () => {
            const overlay = document.getElementById("loading-overlay");
            const links = document.querySelectorAll("a[href]:not([href^='#']):not([target])");

            function show() {
                overlay.classList.remove("pointer-events-none");
                overlay.classList.remove("opacity-0");
            }

            function hide() {
                overlay.classList.add("opacity-0");
                setTimeout(() => overlay.classList.add("pointer-events-none"), 300);
            }

            links.forEach(link => {
                link.addEventListener("click", e => {
                    if (link.href === window.location.href) return;
                    show();
                });
            });

            window.addEventListener("load", hide);
        });

        lucide.createIcons();
