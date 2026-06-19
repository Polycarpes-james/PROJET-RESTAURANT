document.addEventListener('DOMContentLoaded', () => {


function searchTable(
    firstClass:string,
    secondClass:string
){


const inputs =
document.querySelectorAll<HTMLInputElement>(firstClass);


const rows =
document.querySelectorAll<HTMLTableRowElement>(secondClass);


const noResults =
document.querySelector<HTMLElement>("#no-results");



const filters:{[key:string]:string} = {};





rows.forEach(row=>{


    row.dataset.id =
    row.querySelector(".item-id")?.textContent?.trim() ?? "";


    row.dataset.name =
    row.querySelector(".item-name")?.textContent?.trim() ?? "";


    row.dataset.price =
    row.querySelector(".item-price")?.textContent?.trim() ?? "";



});






inputs.forEach(input=>{


input.addEventListener("input",()=>{


    const target =
    input.dataset.target as string;



    filters[target] =
    input.value.trim().toLowerCase();





    let visibleCount = 0;





    rows.forEach(row=>{



        let match = true;




        for(const key in filters){



            const search =
            filters[key];



            if(search === "") continue;




            const value =
            row.dataset[key] ?? "";




            // Prix uniquement
            if(key === "price"){



    const price =
    value
    .replace(",", ".")
    .split(".")[0]
    .trim();



    if(!price.includes(search)){


        match = false;


    }
                // const rowPrice =
                // parseFloat(
                //     value.replace(/[^\d.,]/g,"")
                //     .replace(",",".")
                // );



                // const searchPrice =
                // parseFloat(
                //     search.replace(",",".")
                // );



                // if(rowPrice !== searchPrice){

                //     match = false;

                // }



            }

            // Tous les autres champs
            else{



              if(
    !String(value)
    .toLowerCase()
    .includes(String(search))
){
    match = false;
}


            }



        }







        const cell =
        row.querySelector(
            `.item-${target}`
        ) as HTMLElement;






        if(match){


            row.style.display = "";

            visibleCount++;




            if(cell){


                if(target !== "price"){


                    cell.innerHTML =
                    highlightText(
                        row.dataset[target] ?? "",
                        filters[target]
                    );


                }else{


                    cell.textContent =
                    row.dataset[target] ?? "";


                }



            }





        }else{


            row.style.display = "none";


        }





    });






    if(noResults){


        noResults.style.display =
        visibleCount === 0
        ? ""
        : "none";


    }





});



});



}







function highlightText(
text:string,
search:string
){


if(!search) return text;



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






searchTable(
".input-search",
".ingredient-row"
);



});