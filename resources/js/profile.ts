import AlertService from "./Services/AlertServices";
import FormService from "./Services/FormService";
import ValidationService from "./Services/ValidationService";

const form = document.querySelector("#profile-formulaire") as HTMLFormElement;
// const message = document.querySelector("#message") as HTMLDivElement;
// const errors = document.querySelector("#errors") as HTMLDivElement;


if(form){
    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        const { response, result } = await FormService.submit(form, "/rettine/profile/update");

        try {
            if (response.ok) {
                ValidationService.clear();
                await AlertService.messageSimple("Succès", result.message);
                location.reload();
            } else {
                ValidationService.display(result.errors);
            }
        } catch (e) {
            console.log(e);
            
            AlertService.erreur(e)
        }

    });
}
async function showModalContent (label: string) {
    const modal = document.getElementById('admin_item_delete');
    const content = document.querySelector('.admin_item_header');
    const h = document.querySelector('#item-font')

    if(!h || !modal || !content) return

    h.textContent = label
    modal.style.display = 'flex'
}


const btnProfiles = document.querySelectorAll('.edit-profile-btn')

btnProfiles.forEach(btn => {
    if(btn) {
        btn.addEventListener('click', () => {
            showModalContent("Modifier votre profile actuel")
        })
    }
})

