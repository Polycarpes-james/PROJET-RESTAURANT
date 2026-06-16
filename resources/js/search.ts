document.addEventListener('DOMContentLoaded', () => {



function searchTable(
    inputSelector:string,
    rowSelector:string
){


    const searchInput =
    document.querySelector<HTMLInputElement>(
        inputSelector
    );


    const rows =
    document.querySelectorAll<HTMLTableRowElement>(
        rowSelector
    );


    const noResults =
    document.querySelector<HTMLTableRowElement>(
        ".no-results"
    );



    searchInput?.addEventListener(
    "input",
    ()=>{


        const search =
        searchInput.value.trim();



        let visibleCount = 0;



        rows.forEach(row=>{


            const name =
            row.dataset.name ?? "";


            const price =
            row.dataset.price ?? "";



            // texte complet à rechercher
            const searchableText =
            [
                name,
                price
            ]
            .filter(Boolean)
            .join(" ")
            .toLowerCase();



            const match =
            searchableText.includes(
                search.toLowerCase()
            );



            const cell =
            row.querySelector<HTMLTableCellElement>(
                ".item-name"
            );



            if(match){


                row.style.display="";

                visibleCount++;



                if(cell){

                    cell.innerHTML =
                    highlightText(
                        name,
                        search
                    );

                }


            }else{


                row.style.display="none";


            }



        });



        if(noResults){

            noResults.style.display =
            visibleCount === 0
            ? ""
            : "none";

        }



    });



}



function highlightText(
    text:string,
    search:string
){


    if(!search){

        return text;

    }



    const escaped =
    search.replace(
        /[.*+?^${}()|[\]\\]/g,
        '\\$&'
    );



    const regex =
    new RegExp(
        `(${escaped})`,
        "gi"
    );



    return text.replace(
        regex,
        "<mark>$1</mark>"
    );


}




// Catégorie
searchTable(
    "#search-category",
    ".category-row"
);



// Ingredient
searchTable(
    "#search-ingredient",
    ".ingredient-row"
);



});