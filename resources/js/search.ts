document.addEventListener('DOMContentLoaded', () => {


function searchTable(
    firstClass:string,
    secondClass:string
){


const inputs =
document.querySelectorAll<HTMLElement>(firstClass);



const rows =
document.querySelectorAll<HTMLTableRowElement>(secondClass);



const noResults =
document.querySelector<HTMLElement>("#no-results");



const filters:{[key:string]:string} = {};





// Préparer les données des lignes

rows.forEach(row=>{


    row.dataset.id =
    row.querySelector(".item-id")?.textContent?.trim() ?? "";


    row.dataset.name =
    row.querySelector(".item-name")?.textContent?.trim() ?? "";


    row.dataset.price =
    row.querySelector(".item-price")?.textContent?.trim() ?? "";


    row.dataset.role =
    row.querySelector(".item-role")?.textContent?.trim() ?? "";


});





function filterRows(){


let visibleCount = 0;




rows.forEach(row=>{


let match = true;



for(const key in filters){


    const search =
    filters[key];


    if(search === "") continue;



    const value =
    (row.dataset[key] ?? "")
    .toLowerCase();



    // Recherche prix

    if(key === "price"){


        const price =
        value
        .replace(",", ".")
        .split(".")[0]
        .trim();



        if(!price.includes(search)){

            match = false;

        }



    }



    // Autres recherches

    else{


        if(!value.includes(search)){

            match = false;

        }


    }



}




if(match){


    row.style.display = "";

    visibleCount++;


}

else{


    row.style.display = "none";


}



});





if(noResults){


    noResults.style.display =
    visibleCount === 0
    ? ""
    : "none";


}



}









// Recherche input

inputs.forEach(input=>{


input.addEventListener("input",()=>{


const target =
input.dataset.target as string;



filters[target] =
(input as HTMLInputElement)
.value
.trim()
.toLowerCase();



filterRows();



});



});









// ===========================
// SELECT ROLE PERSONNALISE
// ===========================


const roleButton =
document.querySelector<HTMLButtonElement>(
".role-button"
);



const roleOptions =
document.querySelector<HTMLElement>(
".role-options"
);



const options =
document.querySelectorAll<HTMLLIElement>(
".role-options li"
);





// ouvrir / fermer

roleButton?.addEventListener(
"click",
()=>{


if(roleOptions){


    roleOptions.style.display =
    roleOptions.style.display === "block"
    ? "none"
    : "block";


}


});






// choisir un rôle

options.forEach(option=>{


option.addEventListener(
"click",
()=>{


const role =
option.dataset.value ?? "";



if(roleButton){


    roleButton.textContent =
    option.textContent ?? "";


    roleButton.dataset.value =
    role;


}





filters["role"] =
role.toLowerCase();



filterRows();





if(roleOptions){

    roleOptions.style.display =
    "none";

}



});



});





}





searchTable(
".input-search",
".user-row"
);



});