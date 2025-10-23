document.addEventListener("DOMContentLoaded", () => {
    const overlay = document.getElementById("loading-overlay");
    const links = document.querySelectorAll("a[href]:not([href^='#']):not([target]):not([download])");
    const forms = document.querySelectorAll("form");

    // Mostra o overlay
    const show = () => {
        overlay.classList.remove("pointer-events-none", "opacity-0");
    };

    // Esconde o overlay
    const hide = () => {
        overlay.classList.add("opacity-0");
        setTimeout(() => overlay.classList.add("pointer-events-none"), 300);
    };

    // Mostrar quando clicar num link que leva pra outra página
    links.forEach(link => {
        link.addEventListener("click", e => {
            // ignora se é link da mesma página
            if (link.href === window.location.href) return;
            // ignora se é link com hash tipo #sobre
            if (link.href.includes("#")) return;
            show();
        });
    });

    // Mostrar quando enviar formulário
    forms.forEach(form => {
        form.addEventListener("submit", () => {
            show();
        });
    });

    // Esconde quando a página terminar de carregar
    window.addEventListener("load", hide);

    // Esconde também quando for navegação instantânea (back/forward cache)
    window.addEventListener("pageshow", hide);

    // Recria ícones (se estiver usando Lucide)
    if (window.lucide) lucide.createIcons();
    });