document.addEventListener('DOMContentLoaded', () => {
    

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

const roleButton = document.querySelectorAll<HTMLButtonElement>(".item-btn-select");
 

roleButton.forEach((btn) => {
    btn.addEventListener("click", ()=>{
        const roleOptions = document.querySelectorAll<HTMLElement>(`.item-options[data-focus="${btn.dataset.focus}"]`)
        roleOptions.forEach(opt => {
            closeBox(opt)
        })
    })
});

function closeBox (opt:any) {
    if(opt) opt?.classList.toggle("active");
}


document.querySelectorAll<HTMLLIElement>(".item-options li").forEach(option=>{

    option.addEventListener("click",()=>{
        const role = option.dataset.value ?? "";
        
        roleButton.forEach((btn) => {
            if(btn){
                btn.innerHTML = `
                    <p>${option.textContent}</p>
                    <button type="button" class="drop-role">×</button>
                `;
            }
        })

        const roleOptions = document.querySelectorAll<HTMLUListElement>(".item-options");

        roleOptions.forEach((opt) => {
            const el = `${opt.dataset.target}`
            filters[el] = role.toLowerCase();  
            filterRows();
        })
         
        document.addEventListener("click", (e)=>{
            const target = e.target as HTMLElement;
            if(target.classList.contains("drop-role")){

                roleButton.forEach(btn => {
                    if(btn){
                        btn.innerHTML = "Choisir un rôle";
                        btn.blur();
                    }
                })
                roleOptions.forEach(opt => {
                    if(opt){
                        const el = opt.dataset.target ?? "";
                        filters[el] = "";
                        filterRows();
                        opt.classList.remove("active");
                    }
                })
            }
        });
        roleOptions.forEach(opt => {
            if(opt) opt.classList.remove("active");
        })
    });
});





});