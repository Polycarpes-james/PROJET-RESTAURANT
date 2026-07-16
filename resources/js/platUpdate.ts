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
   
    
    async function showModalContent (plat:any) {
        const modal = document.getElementById('showUpDish');
        const content = modal?.querySelector('.admin_item_main') as HTMLElement;
        const titleEl = modal?.querySelector('#item-font');
        
        if(!modal || !content || !titleEl) return;

        let data

        const guestRes = await fetch(`/admin/plat/${plat.id}`, { 
            headers: { 
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            } 
        });
        
        data = await guestRes.json()

        const platShow = data.platShow        
        modal.style.display = "flex"

        titleEl.textContent = platShow.plat.name

        content.innerHTML = `
            <div class="plat-item">
                <div class="description">
                    <p>${ platShow.plat.description }</p>
                </div>
                <div class="item-picture">
                ${platShow.pictures.map((picture: any) => `
                        <img src="${picture.filename}" alt="Photo" >
                    `).join("")}
                </div>
                <div class="ingredients-item">
                    <h2>Les ingredients du plat</h2>
                        ${platShow.ingredients.map((ingredient: any) => `
                        <div class="ingredient">
                            <p>${ingredient.name}</p>
                            <p>${ingredient.price}€</p>
                        </div>
                    `).join("")}
                    <div class="total-price">
                        <p>Prix Total des ingredients : ${platShow.totalIngredientsPrice}€</p>
                    </div>
                </div>       
                <div class="status">
                    <p>Statut </p>
                    <p class="disponible ">{ $disponible }</p>
                    <p>{{ $plat->raison_indisponible }}</p>
                </div>
            </div>
        `
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
    
    async function aviShowModal (plat:any) {
        const modal = document.getElementById('showUpDish');
        const content = modal?.querySelector('.admin_item_main') as HTMLElement;
        const titleEl = modal?.querySelector('#item-font');
        
        if(!modal || !content || !titleEl) return;

        let data

        const guestRes = await fetch(`/admin/avis/${plat.id}`, { 
            headers: { 
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            } 
        });
        
        data = await guestRes.json()
        console.log(data);
        modal.style.display = "flex"
        
        content.innerHTML = `
            ${data.avi.commentaire}
        `
    }

    document.querySelectorAll(".plat-row #show").forEach((btn:any) => {
        btn.addEventListener('click', (e:any) => {            
            showModalContent(btn.dataset)
        })
    })

    document.querySelectorAll(".avi-row #show").forEach((btn:any) => {
        btn.addEventListener('click', (e:any) => {
            aviShowModal(btn.dataset)
        })
    })


    document.querySelectorAll(".btn-delete-dish").forEach((btn:any) => {
        btn.addEventListener('click', (e:any) =>{            
            showModal(btn.dataset.id, ".btn-delete-admin", "Suppression d'un plat", "admin_item_delete", ".paragraphe_message", `Voulez vous vraiment retirer le plat ${btn.dataset.name} du panier ? `)
        })
    })
    

    hideBox(".modal-close", "category_modal")
    hideBox(".modal-close-admin", "admin_item_delete")
    
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
function showModal(element_id:string, btnDelete:string, kindOperate:string, content:string, messageContent:string, message:string) {
    const modal = document.getElementById(content);
    const contentMessage = document.querySelector(messageContent) 
    const title = modal?.querySelector('#item-font')
    const btnSuppression = document.querySelector(btnDelete)

    // console.log(btnSuppression);
    
    if(!modal || !contentMessage || !title || !btnSuppression) return;

    contentMessage.innerHTML = `${message}`
    btnSuppression.setAttribute('data-id', element_id)
    // btnSuppression.setAttribute('class', btnDelete)
    title.textContent = kindOperate
    modal.style.display = "flex"
}

function hideBox (button:string, content:string) {
        document.querySelectorAll(button).forEach(btn => {
            btn.addEventListener('click', ()=>{
                hide(content)
                if(content){
                    const modal = document.getElementById(content)
                    if (modal) {
                        modal.querySelectorAll('input').forEach(input => {
                            input.value = "";
                        })
                    }
                }
            })
        })
    }

function hide(content:string) {
    const modal = document.getElementById(content);
    if (modal) modal.style.display = "none"
}

export {
    hide, 
    showModal,
    hideBox
}