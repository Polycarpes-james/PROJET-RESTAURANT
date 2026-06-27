import Chart from 'chart.js/auto';


    declare global {
        interface Window {
            commandes:any;
            reservations:any
        }
    }

document.addEventListener('DOMContentLoaded',()=>{
    function canvas (idName:string, target:any) {
    
        const canvas = document.getElementById(idName) as HTMLCanvasElement;

        if(canvas){


            const targetField = target;

            new Chart(canvas,{

                type:'line',

                data:{

                    labels:targetField.map((item:any)=>item.date),

                    datasets:[{
                        label:"Chiffre d'affaire",
                        data:targetField.map((item:any)=>item.total)
                    }]
                }

            });


        }


    } 

    canvas("salesChartCommandes", window.commandes)
    canvas("salesChartReservations", window.reservations)
});