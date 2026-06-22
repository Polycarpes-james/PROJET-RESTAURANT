import $ from "jquery";

import select2 from "select2";

select2();

import "select2/dist/css/select2.css";

import "../css/admin/header.css";

type Filters = { [key: string]: string };

document.addEventListener("DOMContentLoaded", () => {

    // =========================
    // SELECT2
    // =========================
    $("#role-select").select2({
        placeholder: "Choisir un rôle",
        width: "100%",
        allowClear: true
    });

    const filters: Filters = {};

    const rows = Array.from(
        document.querySelectorAll<HTMLTableRowElement>(
            ".user-row, .plat-row, .category-row, .ingredient-row, .reservation-row"
        )
    );

    const noResults = document.querySelector<HTMLElement>("#no-results");

    // =========================
    // UTILS
    // =========================
    function escapeRegex(text: string) {
        return text.replace(/[.*+?^${}()|[\]\\]/g, "\\$&");
    }

    function highlight(text: string, search: string) {
        if (!search) return text;

        const regex = new RegExp(`(${escapeRegex(search)})`, "gi");
        return text.replace(regex, "<mark>$1</mark>");
    }

    // =========================
    // FILTER CORE
    // =========================
    function applyFilters() {
        let visibleCount = 0;

        rows.forEach((row) => {

            let isMatch = true;

            for (const key in filters) {
                const value = filters[key];
                if (!value) continue;

                const dataValue = (row.dataset[key] ?? "").toLowerCase();

                if (!dataValue.includes(value)) {
                    isMatch = false;
                    break;
                }
            }

            // SHOW / HIDE
            if (!isMatch) {
                row.style.display = "none";
                return;
            }

            row.style.display = "";
            visibleCount++;

            // =========================
            // HIGHLIGHT (safe version)
            // =========================
            row.querySelectorAll<HTMLElement>("[class^='item-']").forEach((cell) => {
                const key = cell.className.replace("item-", "");
                const original = row.dataset[key];

                if (original) {
                    const search = filters[key] ?? "";
                    cell.innerHTML = highlight(original, search);
                }
            });
        });

        if (noResults) {
            noResults.style.display = visibleCount === 0 ? "" : "none";
        }
    }

    // =========================
    // INPUT FILTERS (debounced)
    // =========================
    function debounce(fn: Function, delay = 200) {
        let timer: number;
        return (...args: any[]) => {
            clearTimeout(timer);
            timer = window.setTimeout(() => fn(...args), delay);
        };
    }

    document.querySelectorAll<HTMLInputElement>(".input-search").forEach((input) => {

        const handler = debounce(() => {
            const key = input.dataset.target!;
            filters[key] = input.value.trim().toLowerCase();
            applyFilters();
        }, 150);

        input.addEventListener("input", handler);
    });

    // =========================
    // SELECT2 FILTER
    // =========================
    $("#role-select").on("change", function () {
        filters["role"] = String($(this).val() ?? "").toLowerCase();
        applyFilters();
    });
//     $("#role-select").on("select2:select", function () {
//     const container = $("#role-select").next(".select2-container");

//     const text = container.find(".select2-selection__rendered");

//     text.html(`
//         <span class="role-badge">👤</span>
//         ${text.text()}
//     `);
// });

// <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-icon lucide-user"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
// <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-check-icon lucide-shield-check"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/></svg>
// <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-cog-icon lucide-shield-cog"><path d="m10.929 14.467-.383.924"/><path d="M10.929 8.923 10.546 8"/><path d="M13.225 8.923 13.608 8"/><path d="m13.607 15.391-.382-.924"/><path d="m14.849 10.547.923-.383"/><path d="m14.849 12.843.923.383"/><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9.305 10.547-.923-.383"/><path d="m9.305 12.843-.923.383"/><circle cx="12.077" cy="11.695" r="3"/></svg>
});