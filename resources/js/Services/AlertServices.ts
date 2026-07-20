import { supprimerPlat, viderPanier } from "@/panier";
import Alert from "../Alert/Alert";
import { supprimerUser } from "@/admin/actions";

export default class AlertService {

    static platIndisponible (message?: string, raison?: string) {

        return Alert.warning({
            title: "Plat indisponible",
            html: `
                <p>Ce plat ne peut pas être ajouté au panier.</p>
                <p>${message}.</p>
                ${raison ? `<br><b>Pourquoi ?</b> ${raison}` : ""}
            `,
            confirmButtonText:"Ok"

        });

    }

    static suppressionPlat (platId: string) {
        return Alert.confirmDelete({
            title: "Vous voulez supprimer ce plat ?",
            text: "Cette action est irréversible.",
            btn:"supprimerPlat",
            async onConfirm() {
                await supprimerPlat(platId);
            }
        })
    }
    static suppressionUser (userId: string) {
        return Alert.confirmDelete({
            title: "Vous voulez supprimer cet utilisateur ?",
            text: "Cette action est irréversible.",
            btn:"btn-delete-user",
            async onConfirm() {
                await supprimerUser(userId);
            }
        })
    }


    static viderPanier () {
        return Alert.videPanier({
            title: "Vous voulez vider votre ?",
            text: "Cette action est irréversible.",
            async onConfirm() {
                await viderPanier();
            }
        })
    }


    
    static platAjoute() {

        return Alert.success({

            title: "Succès",

            text: "Le plat a été ajouté au panier."

        });

    }

    static messageSimple (title: string, message:string) {
        return Alert.success({
            title: title,
            html: `<p>${message}</p>`
        })
    }

    static panierVide (message:string) {
        return Alert.warning({
            title: "Votre panier est entierement vide !",
            html: `<p>${message}</p>`
        });

    }

    static commandeEnvoyee() {

        return Alert.success({

            title: "Commande envoyée",

            text: "Votre commande a bien été enregistrée."

        });

    }

    static erreur(message: any) {

        return Alert.error({

            title: "Erreur",

            text: message

        });

    }

}