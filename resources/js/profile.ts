import { apiFetch } from "./apiFetch";


async function valideFormulaire (data:Object) {
    try {
        let resultat = await apiFetch('rettine/profile/update', 'POST')
        let data = resultat.data

        if(data.success){
            console.log(data);
        }

    } catch (e) {
        console.log(e);
        
    }
}


document.querySelector('')