document.addEventListener('DOMContentLoaded', () => {
    function searchTable (firstCLass:string, secondClass:string) {
    const searchInput = document.querySelector<HTMLInputElement>(firstCLass);

    const rows = document.querySelectorAll<HTMLTableRowElement>(secondClass);

    searchInput?.addEventListener("input", () => {

        const search =
        searchInput.value.toLowerCase();

        rows.forEach(row => {

            const name =
            row.dataset.name?.toLowerCase() ?? "";

            row.style.display = name.includes(search) ? "" : "none";

        });

    });
} 

searchTable(".search-category", ".category-row")
// searchTable(".search-ingredient", ".ingredient-row")

})