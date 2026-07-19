
import { changeOptimize } from "@/search";
import AlertService from "@/Services/AlertServices";

document.addEventListener('DOMContentLoaded', () => {
   

    document.querySelectorAll('.btn-delete-user-admin').forEach((btn:any) => {    
        btn.addEventListener('click', () => {   
            console.log(btn.dataset.id);
            AlertService.suppressionUser(btn.dataset.id);
        })
    })

    // document.querySelectorAll('.btn-delete-user').forEach((btn:any) => {
    //     btn.addEventListener('click', () => {
            
    //         supprimerUser(btn.dataset.id)
    //     })
    // })
  
    document.querySelectorAll<HTMLButtonElement>(".delete-picture").forEach(button=>{

        button.addEventListener("click", async()=>{
            const id = button.dataset.target;

            const token = (document.querySelector('meta[name="csrf-token"]') as HTMLMetaElement).content;
            const response = await fetch(`/admin/picture/delete/${id}`, {
                method:"DELETE",
                headers:{
                    "X-CSRF-TOKEN":token,
                    "Accept":"application/json"
                }
            });

            const data = await response.json();

            if(data.success){
                button.parentElement?.remove();
            }
        });


    });     
    const contents = document.querySelectorAll('.user-row')

    contents.forEach(content => {
        const button = content.querySelector('#edit')
        const options = content.querySelector<HTMLElement>(".injected-part");

        if (!button || !options) return;
        
        button.addEventListener('click', (e) => {
            e.stopPropagation()
            document.querySelectorAll<HTMLElement>(".injected-part").forEach(option => {
                if(option !== options) {
                    option.classList.add('none')
                }
            }) 
            options.classList.toggle('none')
        })
    })
   
    document.addEventListener("click", (e)=>{
        document.querySelectorAll<HTMLElement>(".injected-part").forEach((content:any)=> {
            const button = content.querySelector(".item-btn-select")
            const inputs = document.querySelectorAll('#hidden-input');
            content.classList.add('none');
            setTimeout(() => {
                changeOptimize(button, e, inputs) 
            }, 200);
        })        
    });
})
    


 async function supprimerUser(userId:string){

    const token = (document.querySelector('meta[name="csrf-token"]') as HTMLMetaElement).content;
    const response = await fetch(`/admin/user/${userId}`,{
        method:"DELETE",
        headers:{
            "X-CSRF-TOKEN": token,
            "Accept":"application/json"
        }
    });
    const data = await response.json()
    

    if(response.status === 403){
        console.log(response);
        return;
    }

    if(data.success){
        location.reload();
    }

}

export {
    supprimerUser
}