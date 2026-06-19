document.addEventListener('DOMContentLoaded', () => {

    function searchTable(firstClass: string, secondClass: string) {

        const searchInputs = document.querySelectorAll<HTMLInputElement>(firstClass);

        const rows = document.querySelectorAll<HTMLTableRowElement>(secondClass);

        const noResults = document.querySelector<HTMLElement>("#no-results");

        // Sauvegarde du texte original une seule fois
        rows.forEach(row => {

            const cellId = row.querySelector<HTMLTableCellElement>(".item-id");
            const cellName = row.querySelector<HTMLTableCellElement>(".item-name");
            const cellEmail = row.querySelector<HTMLTableCellElement>(".item-email");
            const cellRole = row.querySelector<HTMLTableCellElement>(".item-role");
            const cellPrice = row.querySelector<HTMLTableCellElement>(".item-price");
            const cellPhone = row.querySelector<HTMLTableCellElement>(".item-phone");

            if (cellId && !row.dataset.id) {
                row.dataset.id = cellId.textContent ?? "";
            }
            if (cellName && !row.dataset.name) {
                row.dataset.name = cellName.textContent ?? "";
            }
            if (cellEmail && !row.dataset.email) {
                row.dataset.email = cellEmail.textContent ?? "";
            }
            if (cellRole && !row.dataset.role) {
                row.dataset.role = cellRole.textContent ?? "";
            }
            if (cellPrice && !row.dataset.proce) {
                row.dataset.price = cellPrice.textContent ?? "";
            }
            if (cellPhone && !row.dataset.phone) {
                row.dataset.phone = cellPhone.textContent ?? "";
            }
        });

        searchInputs.forEach((searchInput:any) => {

                searchInput.addEventListener("input", () => {

                const search = searchInput.value.trim().toLowerCase();
                // console.log(search);
                
                let visibleCount = 0;

                rows.forEach(row => {

                    const originalID = row.dataset.id ?? "";
                    const originalName = row.dataset.name ?? "";
                    const originalEmail = row.dataset.email ?? "";
                    const originalRole = row.dataset.role ?? "";
                    const originalPhone = row.dataset.phone ?? "";
                    const originalPrice = row.dataset.price ?? "";

                    const match = originalID.toLowerCase().includes(search) ||
                    originalName.toLowerCase().includes(search) || originalPrice.includes(search) 
                    || originalEmail.toLowerCase().includes(search) || originalRole.includes(search) || originalPhone.toLowerCase().includes(search);

                    const idCell = row.querySelector<HTMLTableCellElement>(".item-id");
                    const nameCell = row.querySelector<HTMLTableCellElement>(".item-name");
                    const emailCell = row.querySelector<HTMLTableCellElement>(".item-email");
                    const roleCell = row.querySelector<HTMLTableCellElement>(".item-role");
                    const phoneCell = row.querySelector<HTMLTableCellElement>(".item-phone");
                    const priceCell = row.querySelector<HTMLTableCellElement>(".item-price");

                    if (match) {

                        row.style.display = "";

                        visibleCount++;

                        const originalID = row.dataset.id ?? "";
                        const originalName = row.dataset.name ?? "";
                        const originalEmail = row.dataset.email ?? "";
                        const originalRole = row.dataset.role ?? "";
                        const originalPhone = row.dataset.phone ?? "";
                        const originalPrice = row.dataset.price ?? "";
                        
                        if (idCell) {
                            idCell.innerHTML = highlightText(originalID, search);
                        }
                        if (nameCell) {
                            nameCell.innerHTML = highlightText(originalName, search);
                        }
                        if (emailCell) {
                            emailCell.innerHTML = highlightText(originalEmail, search);
                        }
                        if (roleCell) {
                            roleCell.innerHTML = highlightText(originalRole, search);
                        }
                        if (phoneCell) {
                            phoneCell.innerHTML = highlightText(originalPhone, search);
                        }
                        if (priceCell) {
                            priceCell.innerHTML = highlightText(originalPrice, search);
                        }
                    } else {
                        row.style.display = "none";
                    }

                });

                if (noResults) {
                    noResults.style.display = visibleCount === 0 ? "" : "none";
                }

            });
        })

    }

    function highlightText(text: string, search: string) {

        if (!search) return text;

        const escaped = search.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
        const regex = new RegExp(`(${escaped})`, "gi");

        return text.replace(regex, (match) => `<mark>${match}</mark>`);

    }

    searchTable("#search-category-name", ".category-row");
    searchTable("#search-ingredient-name", ".ingredient-row");
    searchTable("#search-reservation-name", ".reservation-row");
    searchTable(".input-search", ".plat-row");
    searchTable(".input-search",  ".user-row")

});