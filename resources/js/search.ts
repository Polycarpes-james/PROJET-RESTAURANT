import { hideContainer } from "./panier";


document.addEventListener('DOMContentLoaded', () => {


let openInjected: HTMLElement | null = null;


const filters:{[key:string]:string} = {};


// nouveau filtre global
let globalSearch = "";



const rows =
document.querySelectorAll<HTMLTableRowElement>(
".user-row, .plat-row, .category-row, .ingredient-row, .reservation-row"
);



const noResults =
document.querySelector<HTMLElement>(
"#no-results"
);




// ===============================
// FILTER ENGINE
// ===============================

function filterRows(){


let count = 0;



rows.forEach(row=>{


let match = true;



// ===============================
// Recherche globale
// ===============================

if(globalSearch !== ""){


const value =
(row.dataset.search ?? "")
.toLowerCase();



if(!value.includes(globalSearch)){


match = false;


}


}




// ===============================
// Tes filtres existants
// ===============================

for(const key in filters){


const search =
filters[key];


if(search === "")
continue;



const value =
(row.dataset[key] ?? "")
.toLowerCase();



if(!value.includes(search)){


match = false;

break;


}



}




if(match){


row.style.display = "";

count++;



}else{


row.style.display = "none";


}




});




if(noResults){


noResults.style.display =
count === 0
? ""
: "none";


}



}







// ===============================
// INPUT SEARCH
// ===============================


document
.querySelectorAll<HTMLInputElement>(
".input-search"
)
.forEach(input=>{


input.addEventListener("input",()=>{


const target =
input.dataset.target!;



filters[target] =
input.value
.trim()
.toLowerCase();



filterRows();



});


});





// ===============================
// SEARCH GLOBAL
// ===============================


const globalInput =
document.querySelector<HTMLInputElement>(
".global-search"
);



globalInput?.addEventListener(
"input",
()=>{


globalSearch =
globalInput.value
.trim()
.toLowerCase();



filterRows();



});







// ===============================
// HIGHLIGHT
// ===============================


function highlightText(
text:string,
search:string
){


if(!search)
return text;



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








// ===============================
// CUSTOM SELECT
// ===============================


function initCustomSelect(){



const selects =
document.querySelectorAll<HTMLElement>(
".item-select"
);




selects.forEach(select=>{



const button =
select.querySelector<HTMLElement>(
".item-btn-select"
);



const options =
select.querySelector<HTMLElement>(
".item-options"
);




if(!button || !options)
return;





button.addEventListener(
"click",
(e)=>{


e.stopPropagation();



// fermer les autres

document
.querySelectorAll<HTMLElement>(
".item-options"
)
.forEach(option=>{


if(option !== options){

option.classList.remove("active");


}


});



options.classList.toggle("active");



});







options
.querySelectorAll<HTMLLIElement>(
"li"
)
.forEach(option=>{



option.addEventListener(
"click",
(e)=>{


e.stopPropagation();



const value =
option.dataset.value ?? "";



button.innerHTML = `

<p>${option.textContent}</p>

<button class="clear-select" type="button">

<svg width="17px" height="17px"
viewBox="0 0 24 20"
fill="none"
stroke="currentColor"
stroke-width="2">

<line x1="18" y1="6"
x2="6" y2="18"/>

<line x1="6" y1="6"
x2="18" y2="18"/>

</svg>

</button>

`;



button.dataset.value = value;



const target =
options.dataset.target;



const inputs =
document.querySelectorAll(
"#hidden-input"
);





if(target){


filters[target] =
value.toLowerCase();



inputs.forEach(
(input:any)=>{

input.value=value;


});



filterRows();



}





options.classList.remove(
"active"
);






const clear =
button.querySelector(
".clear-select"
);



clear?.addEventListener(
"click",
(e)=>{


changeOptimize(
button,
e,
inputs
);



if(target){


filters[target]="";

filterRows();


}



});


});


});




});






document.addEventListener(
"click",
(e)=>{


const target =
e.target as HTMLElement;



const injected =
target.closest(
".injected-part"
) as HTMLElement | null;




const select =
target.closest(
".item-select"
) as HTMLElement | null;




if(injected){



hideContainer(
".item-options",
true,
true,
"active"
);



if(
openInjected &&
openInjected !== injected
){


openInjected.classList.add(
"none"
);


}



openInjected = injected;


return;


}





if(select){



if(openInjected){


openInjected.classList.add(
"none"
);


openInjected=null;


}



return;


}





hideContainer(
".item-options",
true,
true,
"active"
);



if(openInjected){


openInjected.classList.add(
"none"
);


openInjected=null;


}



});



}






initCustomSelect();





});







function changeOptimize(
button:HTMLElement,
e:Event,
inputs:any
){


e.stopPropagation();



button.innerHTML = `

Choisir un élément

<svg xmlns="http://www.w3.org/2000/svg"
width="24"
height="24"
viewBox="0 0 24 24"
fill="none"
stroke="currentColor"
stroke-width="1.3">

<path d="m6 9 6 6 6-6"/>

</svg>

`;



button.dataset.value="";



inputs.forEach(
(input:any)=>{

input.value="";

});



}



export {
changeOptimize
}