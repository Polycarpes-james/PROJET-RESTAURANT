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
const ctx = chartCanvas.getContext("2d");


const gradient = ctx!.createLinearGradient(
    0,
    0,
    0,
    300
);


gradient.addColorStop(
    0,
    "rgba(0, 123, 255, 0.81)"
);


gradient.addColorStop(
    1,
    "rgba(0, 123, 255, 0.14)"
);


new Chart(chartCanvas,{


type:'bar',
// line + bar + doughnut


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


borderWidth:2,
            // stepped:true,
            //  borderColor:"rgba(0, 123, 255, 0.49)",

            // backgroundColor:gradient,

            // fill:true




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
const title = document.getElementById("modalTitle");
const content = document.querySelector(".chart-modal-description");

if(!modal || !content || !title) return;

title.textContent = `Commandes du ${item.date}`;

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
<img src="${dish.avatar}" alt="">

<p>${dish.email}</p>
<p>${dish.instructions}</p>
<p>${dish.phone}</p>
<p>${dish.address}</p>
<a href="${dish.link_commande}">Voir</p>



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
.getElementById("closeModal")
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