export interface User {
    id: number;
    name: string;
    firstname: string;
    email: string;
    phone_number?: string;
    role_label: string;
    avatar?: string | null;
}

export interface Profile {
    full: boolean;
    percentage: number;
}

export interface Plat {
    id: number;
    name: string;
    price: number;
    quantite: number;
    prix_total: number;
}

export interface Panier {
    plats: Plat[];
}

export interface ProfilePageProps {
    user: User;
    profile: Profile;
    panier?: Panier;
    total: number;
}