import { hideContainer } from "./panier";

document.addEventListener('DOMContentLoaded', () => {
    
let openInjected: HTMLElement | null = null;

const filters:{[key:string]:string} = {};


const rows = document.querySelectorAll<HTMLTableRowElement>(".user-row, .plat-row, .category-row, .ingredient-row, .reservation-row");

const noResults = document.querySelector<HTMLElement>("#no-results");



function filterRows(){

    let count = 0;


    rows.forEach(row=>{

        let match = true;

        const cells = row.querySelectorAll<HTMLElement>("[class^='item-']");

        cells.forEach(cell=>{
            const key = cell.className.replace("item-", "");
            if(row.dataset[key]){
                cell.textContent = row.dataset[key];
            }
        }); 

        for(const key in filters){
            const search = filters[key];
            if(search === "") continue;
            const value = (row.dataset[key] ?? "").toLowerCase();            
            if(!value.includes(search)) match = false;
        }

        if(match){
            row.style.display = "";
            count++;
            // appliquer coloration
            for(const key in filters){
                const search = filters[key];
                if(search === "") continue;
                const cell = row.querySelector(`.item-${key}`) as HTMLElement;
                if(cell){
                    cell.innerHTML = highlightText(row.dataset[key] ?? "", search);
                }
            }
        } else{
            row.style.display = "none";
        }
    });

    if(noResults){
        noResults.style.display = count === 0 ? "" : "none";
    }
}



document.querySelectorAll<HTMLInputElement>(".input-search").forEach(input=>{
    input.addEventListener("input",()=>{
        const target = input.dataset.target!;
        filters[target] = input.value.trim().toLowerCase();        
        filterRows();
    });
});



function highlightText(text:string, search:string){
    if(!search) return text;
    const escaped = search.replace(/[.*+?^${}()|[\]\\]/g,'\\$&');
    const regex = new RegExp(`(${escaped})`, "gi");
    return text.replace(regex,"<mark>$1</mark>");
}


function initCustomSelect(){
    const selects = document.querySelectorAll<HTMLElement>(".item-select");

    selects.forEach(select=>{
        const button = select.querySelector<HTMLElement>(".item-btn-select");
        const options = select.querySelector<HTMLElement>(".item-options");

        if(!button || !options) return;
        // ouvrir le select
        button.addEventListener("click",(e)=>{
            e.stopPropagation();
            // fermer les autres avant d'ouvrir celui-ci
            document.querySelectorAll<HTMLElement>(".item-options").forEach(option=>{
                if(option !== options){
                    option.classList.remove("active");
                }
            });
            options.classList.toggle("active");
        });
        // choisir une option

        options.querySelectorAll<HTMLLIElement>("li").forEach(option=>{

            option.addEventListener("click",(e)=>{
                e.stopPropagation();

                const value = option.dataset.value ?? "";

                button.innerHTML = `
                    <p>${option.textContent}</p>
                    <button class="clear-select" type="button">×</button>
                `;

                button.dataset.value = value;

                const target = `${options?.dataset.target}`
                
                const inputs = document.querySelectorAll('#hidden-input');
                // si ce select est un filtre
                if(target){
                    filters[target] = value.toLowerCase();
                    inputs.forEach((input:any) => {
                        input.value = value
                    })                
                    if(select.dataset.filtable){
                        filterRows();
                    }
                }
                options.classList.remove("active");
                // supprimer choix
                const clear = button.querySelector(".clear-select");

                clear?.addEventListener("click",(e)=>{
                    changeOptimize(button, e, inputs)
                    if(target){
                        filters[target]="";
                        filterRows();
                    }
                });
            });
        });
    });

    // document.addEventListener("click",()=>{
    //     hideContainer(".item-options", true, true, 'active')   
    // });

document.addEventListener("click", (e) => {

    const target = e.target as HTMLElement;

    const injected = target.closest(".injected-part") as HTMLElement | null;
    const select = target.closest(".item-select") as HTMLElement | null;

    // =========================
    // CAS 1 : clic dans injected-part
    // =========================
    if (injected) {

        // fermer dropdowns
        hideContainer(".item-options", true, true, "active");

        // si autre injected ouvert → fermer
        if (openInjected && openInjected !== injected) {
            openInjected.classList.add("none");
        }

        openInjected = injected;

        return;
    }


    // =========================
    // CAS 2 : clic dans dropdown
    // =========================
    if (select) {

        // fermer injected
        if (openInjected) {
            openInjected.classList.add("none");
            openInjected = null;
        }

        return;
    }


    // =========================
    // CAS 3 : clic dehors → tout fermer
    // =========================

    hideContainer(".item-options", true, true, "active");

    if (openInjected) {
        openInjected.classList.add("none");
        openInjected = null;
    }

});

}


// initialisation

initCustomSelect();


});

/**
 * 
 * @param button 
 * @param e 
 */
function changeOptimize (button:HTMLElement, e:Event, inputs:any) {
    e.stopPropagation();
    button.textContent = "Choisir un rôle";
    button.dataset.value="";
    inputs.forEach((input:any) => {
        input.value = ""
    })  
}


export {
    changeOptimize
}

// import { hideContainer } from "./panier";

// document.addEventListener("DOMContentLoaded", () => {

// const filters: { [key: string]: string } = {};

// const rows = document.querySelectorAll<HTMLTableRowElement>(
//     ".user-row, .plat-row, .category-row, .ingredient-row, .reservation-row"
// );

// const noResults = document.querySelector<HTMLElement>("#no-results");


// // =======================
// // FILTER ENGINE
// // =======================

// function filterRows() {

//     let count = 0;

//     rows.forEach(row => {

//         let match = true;

//         const cells = row.querySelectorAll<HTMLElement>("[class^='item-']");

//         cells.forEach(cell => {
//             const key = cell.className.replace("item-", "");
//             if (row.dataset[key]) {
//                 cell.textContent = row.dataset[key];
//             }
//         });

//         for (const key in filters) {

//             const search = filters[key];

//             if (!search) continue;

//             const value = (row.dataset[key] ?? "").toLowerCase();

//             if (!value.includes(search)) {
//                 match = false;
//                 break;
//             }
//         }

//         if (match) {
//             row.style.display = "";
//             count++;

//             for (const key in filters) {

//                 const search = filters[key];
//                 if (!search) continue;

//                 const cell = row.querySelector(`.item-${key}`) as HTMLElement;

//                 if (cell) {
//                     cell.innerHTML = highlightText(
//                         row.dataset[key] ?? "",
//                         search
//                     );
//                 }
//             }

//         } else {
//             row.style.display = "none";
//         }
//     });

//     if (noResults) {
//         noResults.style.display = count === 0 ? "" : "none";
//     }
// }


// // =======================
// // HIGHLIGHT
// // =======================

// function highlightText(text: string, search: string) {
//     if (!search) return text;

//     const escaped = search.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
//     const regex = new RegExp(`(${escaped})`, "gi");

//     return text.replace(regex, "<mark>$1</mark>");
// }


// // =======================
// // INIT SELECT CUSTOM
// // =======================

// function initCustomSelect() {

//     const selects = document.querySelectorAll<HTMLElement>(".item-select");

//     selects.forEach(select => {

//         const button = select.querySelector<HTMLElement>(".item-btn-select");
//         const options = select.querySelector<HTMLElement>(".item-options");

//         if (!button || !options) return;


//         // =======================
//         // OPEN / CLOSE
//         // =======================
//         button.addEventListener("click", (e) => {

//             e.stopPropagation();

//             document.querySelectorAll(".item-options")
//                 .forEach(opt => {
//                     if (opt !== options) {
//                         opt.classList.remove("active");
//                     }
//                 });

//             options.classList.toggle("active");
//         });


//         // =======================
//         // SELECT OPTION
//         // =======================
//         options.querySelectorAll<HTMLLIElement>("li")
//             .forEach(option => {

//                 option.addEventListener("click", (e) => {

//                     e.stopPropagation();

//                     const value = option.dataset.value ?? "";

//                     const target = options.dataset.target ?? "";


//                     // UI update
//                     button.innerHTML = `
//                         <span>${option.textContent}</span>
//                         <button type="button" class="clear-select">×</button>
//                     `;

//                     button.dataset.value = value;


//                     // FILTER update
//                     if (target) {
//                         filters[target] = value.toLowerCase();
//                         filterRows();
//                     }

//                     options.classList.remove("active");


//                     // =======================
//                     // CLEAR BUTTON
//                     // =======================
//                     const clear = button.querySelector(".clear-select");

//                     clear?.addEventListener("click", (e) => {

//                         e.stopPropagation();

//                         resetSelect(button, target);

//                     });
//                 });
//             });
//     });


//     // =======================
//     // CLOSE OUTSIDE CLICK
//     // =======================
//     document.addEventListener("click", () => {

//         document.querySelectorAll(".item-options")
//             .forEach(opt => opt.classList.remove("active"));

//     });
// }


// // =======================
// // RESET FUNCTION (IMPORTANT)
// // =======================

// function resetSelect(button: HTMLElement, target: string) {

//     button.innerHTML = "Choisir un rôle";

//     button.dataset.value = "";

//     button.blur();

//     if (target) {
//         filters[target] = "";
//         filterRows();
//     }
// }


// // init
// initCustomSelect();

// });

// // export {
// //     resetSelect
// // };



