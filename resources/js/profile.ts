import AlertService from "./Services/AlertServices";

const form = document.querySelector("#profile-formulaire") as HTMLFormElement;
// const message = document.querySelector("#message") as HTMLDivElement;
// const errors = document.querySelector("#errors") as HTMLDivElement;

form.addEventListener("submit", async (e) => {

    e.preventDefault();

    const formData = new FormData(form);

    const data = Object.fromEntries(formData.entries());

    try {

        const response = await fetch("/rettine/profile/update", {

            method: "POST",

            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-TOKEN": (
                    document.querySelector('meta[name="csrf-token"]') as HTMLMetaElement
                ).content
            },

            body: JSON.stringify(data)

        });

        const result = await response.json();

        if (response.ok) {

            await AlertService.messageSimple('Success', result.message)
            location.reload();
            form.reset();
            return;

        } else {
            const errorsPassword = result.errors.password ?? []
            const targets = document.querySelectorAll('.error_ts')
            // console.log(errorsPassword);            
            targets.forEach((target: any) =>{
                if(errorsPassword.includes("TOO_SHORT") && target.dataset.target === "password"){
                    target.classList.add('active')
                    target.textContent = "Votre mot de passe est invalide"
                }
                if(errorsPassword.includes("TOO_SHORT") && target.dataset.target === "password"){
                    target.classList.add('active')
                    target.textContent = "Votre mot de passe est invalide"
                }

                if (response.ok) {
                    target.textContent = ""
                    target.classList.remove('active')
                }
            })

            AlertService.erreur(result.message)
        }
     
    } catch (e) {
        AlertService.erreur(e)
    }

});