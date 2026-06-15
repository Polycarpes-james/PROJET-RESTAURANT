document.addEventListener('DOMContentLoaded', () => {

    function showModalAdmin(title:string | null) {
        
        const modal = document.getElementById('category_modal');
        const btnSubmt = document.getElementById('btn-submit');
        const titleEl = document.getElementById('modalTitle');


        if(!modal || !titleEl || !btnSubmt) return;

        btnSubmt.textContent = title;
        titleEl.textContent = title;
        modal.style.display = "flex";

    }

    document.querySelectorAll('.open-category-modal').forEach(element => {
        element.addEventListener('click', (e:any) => {
            const element = e.target
            showModalAdmin('Creation de la categorie')
        })
    })

    document.querySelectorAll('.open-ingredient-modal').forEach(element => {
        element.addEventListener('click', (e:any) => {
            const element = e.target
            showModalAdmin("Creation de l'ingredient")
        })
    })


    document.querySelectorAll('.modal-close').forEach(btn => {
        btn.addEventListener('click', ()=>{
            const modal = document.getElementById('category_modal');
            if (modal) modal.style.display = "none"
        })
    })

    const buttonsCategory = document.querySelectorAll<HTMLButtonElement>(".edit-category");
    const buttonsingredient = document.querySelectorAll<HTMLButtonElement>(".edit-ingredient");

   buttonsingredient.forEach(button => {

    button.addEventListener("click",()=>{


        const id = button.dataset.id;
        const name = button.dataset.name;
        const price = button.dataset.price;


        const form =
        document.querySelector<HTMLFormElement>(
            "#ingredient-form"
        );


        const inputName =
        document.querySelector<HTMLInputElement>(
            "#name"
        );


        const inputPrice =
        document.querySelector<HTMLInputElement>(
            "#price"
        );


        const idInput =
        document.querySelector<HTMLInputElement>(
            "#ingredient-id"
        );



        // remplir les champs

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

            // éviter plusieurs _method PUT

            // const oldMethod =
            // form.querySelector(
            //     'input[name="_method"]'
            // );


            // oldMethod?.remove();

            const method =
            document.createElement("input");


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


            // ICI il manquait ça
            showModalAdmin("Modifier la catégorie");


        });

    });
})