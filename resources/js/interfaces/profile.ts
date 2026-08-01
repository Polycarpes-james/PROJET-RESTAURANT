export interface ProfilePageProps {
    user: App.Data.User.UserData;
    profile: {
        percentage: number;
        full: boolean;
    };
    role:string;
    panier: Panier;
    total: number;
    image:string
}

export interface UserCard {
    user: App.Data.User.UserData;
    role:string;
    image:string
}


export interface Panier {
    id: number;
    user_id: number;
    status: string;
    total: string;
    plats: [];
}

export interface Commande {
    id: number;
    user_id: number;
    status: string;
    total: string;
    plats: [];
}

export interface CommandeIndex {
    commande: App.Data.Commande.CommandeData,
    plats: App.Data.Plat.PlatData;
}

export interface PanierPlat {
    id: number;
    name: string;
    prix_total: number;
    quantite: number;
    price: number;
}