import Chart from 'chart.js/auto';



declare global {

    interface Window {

        commandes:any[];

        reservations:any[];

    }

}



document.addEventListener('DOMContentLoaded',()=>{


function createChart(
    idName:string,
    data:any[],
    label:string
){

console.log(data);

const chartCanvas =
document.getElementById(idName) as HTMLCanvasElement;


if(!chartCanvas) return;



new Chart(chartCanvas,{


type:'line',



data:{


labels:data.map((item:any)=>{


return new Date(item.date)
.toLocaleDateString(
"fr-FR",
{
    day:"numeric",
    month:"short"
}
);


}),



datasets:[{


label:label,


data:data.map(
(item:any)=>item.total
),


borderWidth:2



}]


},




options:{



responsive:true,


maintainAspectRatio:false,




onClick:(event,elements)=>{

    

if(elements.length === 0)
return;



const index = elements[0].index;



const item = data[index];




openChartModal(item);



},





scales:{


x:{


title:{


display:true,

text:"Dates des opérations"


}



},



y:{


title:{


display:true,

text:"Montant"


},



ticks:{


callback:(value)=>{


return value + " FCFA";


}


}


}


},




plugins:{


legend:{


display:true


},



tooltip:{


callbacks:{


label:(context)=>{


return context.parsed.y + " FCFA";


}


}


}


}



}



});



}







function openChartModal(item:any){

const modal = document.getElementById("chart-modal");
const title = document.getElementById("modal-title");
const content = document.getElementById("modal-description");
const price = document.getElementById("modal-price");

if(!modal || !content || !title || !price) return;

title.textContent = `Commande #${item.id}`;
price.textContent = `Total : ${item.total} FCFA`;

let html = "";

if(item.commandes && item.commandes.length > 0){

html += `
<h3>Plats commandés</h3>
<p>Nombre de commandes : ${item.totalCommande}</p>

`;


item.commandes.forEach((commande:any)=>{
html +=`
    <p>Prix Total des plats : ${commande.totalPrice}</p>
    <p>Quantite total des plats : ${commande.quantite_total}</p>
`
commande.plats.forEach((dish:any) => {
    
html += `
<div class="plat-detail">

<h4>${dish.name}</h4>

<p>Prix Total : ${dish.prix_unit}</p>
<p> Quantité: ${dish.quantite_total}</p>


<p>${dish.description}</p>
<img src="${dish.picture}" alt="">


</div>
`;
})

});

}else{
html = "Aucun plat trouvé";
}

content.innerHTML = html;
modal.style.display = "flex";
}





document
.getElementById("close-modal")
?.addEventListener(
"click",
()=>{


const modal =
document.getElementById("chart-modal");


if(modal){

modal.style.display="none";

}



});



createChart(

"salesChartCommandes",

window.commandes,

"Prix total des commandes"

);



createChart(

"salesChartReservations",

window.reservations,

"Prix total des réservations"

);



});