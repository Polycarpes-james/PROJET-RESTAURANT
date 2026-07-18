import { supprimerPlat } from "@/panier";
import Alert from "../Alert/Alert";

export default class AlertService {

    static platIndisponible (raison?: string) {

        return Alert.warning({

            title: "Plat indisponible",

            html: `
                <p>Ce plat ne peut pas être ajouté au panier.</p>

                ${raison ? `<br><b>Pourquoi ?</b> ${raison}` : ""}
            `

        });

    }

    static suppressionPlat (platId: string) {
        return Alert.confirmDelete({
            title: "Vous voulez supprimer ce plat ?",
            text: "Cette action est irréversible.",
            async onConfirm() {
                await supprimerPlat(platId);
            }
        })
    }

    
    static platAjoute() {

        return Alert.success({

            title: "Succès",

            text: "Le plat a été ajouté au panier."

        });

    }

    static commandeEnvoyee() {

        return Alert.success({

            title: "Commande envoyée",

            text: "Votre commande a bien été enregistrée."

        });

    }

    static erreur(message: string) {

        return Alert.error({

            title: "Erreur",

            text: message

        });

    }

}