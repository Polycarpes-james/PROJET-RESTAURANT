document.addEventListener('DOMContentLoaded',()=>{


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
            // console.log(row.dataset[key]?.includes(search));
            
            if(!value.includes(search) 
                // && document.querySelector<HTMLButtonElement>(".item-btn-select")?.value === " "
        ){
                match = false;
            }
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


const roleButton = document.querySelector<HTMLButtonElement>(".item-btn-select");

const roleOptions = document.querySelector<HTMLUListElement>(".item-options");
 
roleButton?.addEventListener("click",()=>{
   closeBox()
});

function closeBox () {
    if(roleOptions){
        roleOptions.classList.toggle("hidden_options")
        
// roleOptions.style.display = roleOptions.style.display === "block" ? "none" : "block";
    }
}

// if (roleOptions?.style.display === "block") {
//     // roleOptions.style.display = "none"; 
//     document.addEventListener('click', () => {
//         roleOptions.style.display = "none"      
//     })
// }

document.querySelectorAll<HTMLLIElement>(".item-options li").forEach(option=>{

    option.addEventListener("click",()=>{
        const role = option.dataset.value ?? "";
        
        if(roleButton){
            roleButton.innerHTML = `
                <p>${option.textContent}</p>
                <button type="button" class="drop-role">×</button>
            `;
        }


        const dropBtn = document.querySelector<HTMLButtonElement>('.drop-role')

        const roleOptions = document.querySelector<HTMLUListElement>(".item-options");

        const el = `${roleOptions?.dataset.target}`

        filters[el] = role.toLowerCase();  
        filterRows();


        
        dropBtn?.addEventListener('click', () => {
            if (roleButton) {
                roleButton.innerHTML = "Choisir un rôle"     
                roleOptions?.classList.add("hidden_options");
            }

        })

        if(roleOptions){
            roleOptions.classList.add("hidden_options");
        }
    });
});



});

