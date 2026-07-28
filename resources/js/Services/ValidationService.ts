class ValidationService {

    private readonly messages: Record<string, string> = {
        REQUIRED: "Ce champ est obligatoire.",
        INVALID_EMAIL: "Veuillez saisir une adresse email valide.",
        PASSWORD_TOO_SHORT: "Votre mot de passe doit contenir au moins 8 caractères.",
        PASSWORD_CONFIRMATION_FAILED: "Les deux mots de passe ne correspondent pas.",
        PASSWORD_REQUIRED: "Veuillez saisir votre mot de passe.",
        PASSWORD_CONFIRMATION_REQUIRED: "Veuillez confirmer votre mot de passe."
    };

    /**
     * Supprime toutes les erreurs.
     */
    clear(): void {
        document.querySelectorAll<HTMLElement>(".error_ts").forEach(error => {
            error.textContent = "";
            error.classList.remove("active");
        });
    }

    /**
     * Affiche les erreurs Laravel.
     */
    display(errors: Record<string, string[]>): void {
        this.clear();
        Object.entries(errors).forEach(([field, rules]) => {
            const target = document.querySelector<HTMLElement>(`.error_ts[data-target="${field}"]`);

            if (!target) return;

            const messages = rules.map(rule => {
                return this.messages[rule] ?? rule;
            });

            target.classList.add("active");
            target.innerHTML = messages.join("<br>");
        });

    }

}

export default new ValidationService();