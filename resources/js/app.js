import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener("DOMContentLoaded", () => {

    const toggle = document.getElementById("themeToggle");

    const savedTheme = localStorage.getItem("theme");

    if (savedTheme === "dark") {
        document.documentElement.classList.add("dark-mode");
    }

    toggle.textContent =
        document.documentElement.classList.contains("dark-mode")
            ? "☀️"
            : "🌙";

    toggle.addEventListener("click", () => {
        const isDark = document.documentElement.classList.toggle("dark-mode");
        localStorage.setItem("theme", isDark ? "dark" : "light");
        toggle.textContent = isDark ? "☀️" : "🌙";
    });

});
