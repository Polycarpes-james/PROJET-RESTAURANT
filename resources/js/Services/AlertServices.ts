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

    static UpdateUser () {
        return Alert.modal({
            title : "Modifier vos informations",
            html : `
                <div class="formulaire">
                    <h2>Modifier votre profile actuel</h2>
                    <form action="{{ route('rettine.profile.update') }}" method="POST" id="profile-formulaire" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <x-form.index name="name" :value="Auth::user()->name" label="Mon nom de profile"/>
                        <x-form.index name="firstname" :value="Auth::user()->firstname" label="Mon prenom de profile"/>
                        <x-form.index type="email" name="email" :value="Auth::user()->email" label="Mon adresse email"/>
                        <div class="change-password">
                            <h2>Changer de mot de passe</h2>
                            <p>Vous pouvez changer votre mot de passe actuel</p>
                        </div>
                        <x-form.index type="password" name="password" label="Nouveau mot de pass" placeholder="................"/>
                        <x-form.index type="password" name="password_confirmation" label="Comfirmer le mot de pass" placeholder="................"/>
                    </form>
                </div>
            `,
            text:'',
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


    
    static platAjoute(message:string) {
        return Alert.success({
            title: "Succès",
            text: message
        });

    }

    static messageSimple (title: string, message:string|undefined) {
        return Alert.success({
            title: title,
            html: `<p>${message}</p>`
        })
    }
   static messageAlert (title: string, message:string) {
        return Alert.warning({
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