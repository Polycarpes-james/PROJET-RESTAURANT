
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
}
export {};
