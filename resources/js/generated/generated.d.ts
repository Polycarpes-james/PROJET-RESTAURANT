declare namespace App {
    namespace Data {
        namespace Category {
            export type CategoryData = {
                id: number;
                name: string;
            };
        }
        namespace Ingredient {
            export type IngredientData = {
                id: number;
                name: string;
                price: number;
            };
        }
        namespace Picture {
            export type PictureData = {
                id: number;
                filename: string;
            };
        }
        namespace Plat {
            export type PlatCardData = {
                id: number;
                name: string;
                description: string;
                price: number;
                priceFormatted: string;
                slug: string;
                link: string;
                note: number;
                avis: number;
                category: App.Data.Category.CategoryData | null;
                image: string;
            };
            export type PlatData = {
                name: string;
                id: string;
                description: string;
                price: number;
                disponible: string;
                temps_preparation: string | null;
                raison_indisponible: string | null;
                category_id: number | null;
                pictures: undefined | undefined;
            };
            export type PlatModalData = {
                id: number;
                name: string;
                description: string;
                price: number;
                category: App.Data.Category.CategoryData | null;
                pictures: undefined;
                ingredients: undefined;
            };
        }
        namespace User {
            export type UserData = {
                id: number;
                name: string;
                firstname: string | null;
                email: string;
                avatar: string | null;
                role: string;
                phone_number:string
            };
        }
        namespace Commande {
            export type CommandeData = {ù
                id:number;
                user_id: number;
                status: string;
                total_price: string | null;
                user: App.Data.User.UserData
            };
        }
    }
    namespace Enums {
        export type AnyEnum = "super_admin" | "admin" | "client" | "yes" | "no";
    }
}
