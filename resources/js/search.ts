document.addEventListener('DOMContentLoaded', () => {
    function searchTable (firstCLass:string, secondClass:string) {
    const searchInput = document.querySelector<HTMLInputElement>(firstCLass);

    const rows = document.querySelectorAll<HTMLTableRowElement>(secondClass);

    const noResults = document.querySelector<HTMLTableRowElement>("#no-results");

    searchInput?.addEventListener("input", () => {

        const search = searchInput.value.toLowerCase();

            let visibleCount = 0;


    rows.forEach(row => {

        const name = row.dataset.name?.toLowerCase() ?? "";

        const price = row.dataset.price?.toLowerCase() ?? "";

        const match = name.includes(search) || price.includes(search);

        row.style.display = match ? "" : "none";

        if (match) {
            visibleCount++;
        }

    });


    // 👇 afficher ou cacher le message
    if (noResults) {

        noResults.style.display =
        visibleCount === 0
            ? ""
            : "none";

    }


    });
} 

searchTable("#search-category", ".category-row")
searchTable("#search-ingredient", ".ingredient-row")

})