document.addEventListener('DOMContentLoaded', () => {

    function searchTable(firstClass: string, secondClass: string) {

        const searchInput =
            document.querySelector<HTMLInputElement>(firstClass);

        const rows =
            document.querySelectorAll<HTMLTableRowElement>(secondClass);

        const noResults =
            document.querySelector<HTMLTableRowElement>("#no-results");

        // Sauvegarde du texte original une seule fois
        rows.forEach(row => {

            const cell =
                row.querySelector<HTMLTableCellElement>(".ingredient-name");

            if (cell && !row.dataset.originalName) {
                row.dataset.originalName = cell.textContent ?? "";
            }

        });

        searchInput?.addEventListener("input", () => {

            const search = searchInput.value.trim().toLowerCase();

            let visibleCount = 0;

            rows.forEach(row => {

                const originalName =
                    row.dataset.originalName ?? "";

                const price =
                    row.dataset.price ?? "";

                const match =
                    originalName.toLowerCase().includes(search) ||
                    price.includes(search);

                const nameCell =
                    row.querySelector<HTMLTableCellElement>(".ingredient-name");

                if (match) {

                    row.style.display = "";

                    visibleCount++;

                   const originalName = row.dataset.originalName ?? "";

                    if (nameCell) {
                        nameCell.innerHTML = highlightText(originalName, search);
                    }

                } else {
                    row.style.display = "none";
                }

            });

            if (noResults) {
                noResults.style.display =
                    visibleCount === 0 ? "" : "none";
            }

        });

    }

    function highlightText(text: string, search: string) {

          if (!search) return text;

        const escaped = search.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
        const regex = new RegExp(`(${escaped})`, "gi");

        return text.replace(regex, (match) => `<mark>${match}</mark>`);

    }

    searchTable("#search-category", ".category-row");
    searchTable("#search-ingredient", ".ingredient-row");

});