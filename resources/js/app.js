import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener("DOMContentLoaded", () => {

    const toggle = document.getElementById("themeToggle");

    toggle.addEventListener("click", () => {
        document.documentElement.classList.toggle("dark-mode");

        toggle.textContent =
            document.documentElement.classList.contains("dark-mode")
                ? "☀️"
                : "🌙";
    });

});
