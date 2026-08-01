import { Panier } from "./interfaces/profile";

declare global {
    interface Window {
        appConfig: {
            routePanier: string;
            routeAddPanier: string;
            routeUpdatePanier: string;
            routeRemovePanier: string;
            routeInvitePanier: string;
            routeInviteAddPanier: string;
            routePanierCommande: string;
            routeInviteCommande: string;
            csrfToken: string;
        };
    }
    interface Window {
        profileData: {
            user: App.Data.User.UserData;
            profile: {
                full: boolean;
                percentage: number;
            };
            role:string;
            panier: Panier;
            total: number;
            image:string 
        };
    }

    interface Window {
        commandeUserProfileData: {
            commande: App.Data.Commande.CommandeData,
            plats: App.Data.Plat.PlatData;
        };
    }
}
export {};
