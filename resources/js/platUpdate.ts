document.addEventListener('DOMContentLoaded', () => {

    function showModalAdmin(title:string | null) {
        
        const modal = document.getElementById('category_modal');
        const btnSubmt = document.getElementById('btn-submit');
        const titleEl = document.getElementById('modalTitle');


        if(!modal || !titleEl || !btnSubmt) return;

        btnSubmt.textContent = title;
        titleEl.textContent = title;
        modal.style.display = "flex"
    }
    

    document.querySelectorAll('.open-category-modal').forEach(element => {
        element.addEventListener('click', (e:any) => {
            showModalAdmin('Creation de la categorie')
        })
    })

    document.querySelectorAll('.open-ingredient-modal').forEach(element => {
        element.addEventListener('click', (e:any) => {
            showModalAdmin("Creation de l'ingredient")
        })
    })
    
    document.querySelectorAll(".btn-delete-dish").forEach((btn:any) => {
        btn.addEventListener('click', (e:any) =>{            
            showModal(btn.dataset.id, ".btn-delete-admin", "Suppression d'un plat", "admin_plat_delete", ".paragraphe_message", `Voulez vous vraiment retirer le plat ${btn.dataset.name} du panier ? `)
        })
    })
    
    function hideBox (button:string, content:string) {
        document.querySelectorAll(button).forEach(btn => {
            btn.addEventListener('click', ()=>{
                hide(content)
            })
        })
    }

    function hide(content:string) {
        const modal = document.getElementById(content);
        if (modal) modal.style.display = "none"
    }

    hideBox(".modal-close", "category_modal")
    hideBox(".modal-close-admin", "admin_plat_delete")
    
    document.querySelectorAll(".btn-delete-admin").forEach((btn:any) => {
        btn.addEventListener('click', () => {
            supprimerPlat(btn.dataset.id)
        })
    })

   async function supprimerPlat(platId:string):Promise<void>{
        const token = (document.querySelector('meta[name="csrf-token"]') as HTMLMetaElement).content;
        const res = await fetch(`/admin/plat/${platId}`,{
            method:"DELETE",

            headers:{
                "X-CSRF-TOKEN": token,
                "Accept":"application/json"
            }
        });
        location.reload();
    }

    const buttonsCategory = document.querySelectorAll<HTMLButtonElement>(".edit-category");
    const buttonsingredient = document.querySelectorAll<HTMLButtonElement>(".edit-ingredient");

   buttonsingredient.forEach(button => {

    button.addEventListener("click",()=>{
        const id = button.dataset.id;
        const name = button.dataset.name;
        const price = button.dataset.price;
        const form = document.querySelector<HTMLFormElement>("#ingredient-form");
        const inputName = document.querySelector<HTMLInputElement>("#name");
        const inputPrice = document.querySelector<HTMLInputElement>("#price");
        const idInput = document.querySelector<HTMLInputElement>("#ingredient-id");

        if(inputName){
            inputName.value = name ?? "";
        }
        if(inputPrice){
            inputPrice.value = price ?? "";
        }
        if(idInput){
            idInput.value = id ?? "";
        }

        // changer vers update

        if(form){
            form.action =`/admin/ingredient/${id}`;
            const method = document.createElement("input");
            method.type = "hidden";
            method.name = "_method";
            method.value = "PUT";
            form.appendChild(method);
        }
        showModalAdmin("Modifier l'ingredient");
    });

});

    buttonsCategory.forEach(button => {

        button.addEventListener("click",()=>{

            const id = button.dataset.id;
            const name = button.dataset.name;

            const form = document.querySelector<HTMLFormElement>("#category-form");
            const input = document.querySelector<HTMLInputElement>("#name");
            const idInput = document.querySelector<HTMLInputElement>("#category-id");

            if(input){
                input.value = name ?? "";
            }

            if(idInput){
                idInput.value = id ?? "";
            }

            if(form){

                form.action = `/admin/category/${id}`;
                const method = document.createElement("input");

                method.type="hidden";
                method.name="_method";
                method.value="PUT";

                form.appendChild(method);

            }
            showModalAdmin("Modifier la catégorie");
        });

    });



    
})

    /**
     * 
     * @param element_id l'id de l'element
     * @param btnDelete l'id du boutton pour la suppression de l'element
     * @param kindOperate je genre d'operation: soit la suppression, simple message...
     * @param content l'id de la div principale
     * @param messageContent l'id du message dans le contenu
     * @param message le message du contenu
     * @returns 
     */
    export function showModal(element_id:string, btnDelete:string, kindOperate:string, content:string, messageContent:string, message:string) {
        const modal = document.getElementById(content);
        const contentMessage = document.querySelector(messageContent) 
        const title = modal?.querySelector('#item-font')
        const btnSuppression = document.querySelector(btnDelete) 
    
        // console.log(contentMessage);
        
        if(!modal || !contentMessage || !title || !btnSuppression) return;

        contentMessage.innerHTML = `${message}`
        btnSuppression.setAttribute('data-id', element_id)
        title.textContent = kindOperate
        modal.style.display = "flex"
    }