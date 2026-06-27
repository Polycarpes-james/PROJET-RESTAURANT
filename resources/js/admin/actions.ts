import { showModal } from "@/platUpdate";

document.addEventListener('DOMContentLoaded', () => {
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

    document.querySelectorAll('.btn-delete-user-admin').forEach((btn:any) => {    
        btn.addEventListener('click', () => {   
            showModal(btn.dataset.id, '.btn-delete-user', "Suppression d'un utilisateur", "admin_plat_delete", ".paragraphe_message", `Voulez vous vraiment supprimer le user ${btn.dataset.name} définitivement ? `)
        })
    })

    document.querySelectorAll('.btn-delete-user').forEach((btn:any) => {
        btn.addEventListener('click', () => {
            supprimerUser(btn.dataset.id)
        })
    })
  
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

    document.querySelectorAll('.user-row #edit').forEach((btn:any) => {
        btn.addEventListener('click', () => {
            const content = document.querySelector(`.injected-part[data-target="${btn.dataset.id}"]`) as HTMLElement
            content.classList.toggle('none')
        })
    })
})