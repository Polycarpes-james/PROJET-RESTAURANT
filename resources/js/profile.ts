import AlertService from "./Services/AlertServices";
import FormService from "./Services/FormService";
import ValidationService from "./Services/ValidationService";

const form = document.querySelector("#profile-formulaire") as HTMLFormElement;
// const message = document.querySelector("#message") as HTMLDivElement;
// const errors = document.querySelector("#errors") as HTMLDivElement;

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
        AlertService.erreur(e)
    }

});