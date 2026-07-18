import Swal from "sweetalert2";
import { AlertOptions } from "./AlertTypes";


// Swal.fire({
//     title: "Supprimer ce plat ?",
//     text: "Cette action est irréversible.",
//     icon: "warning",

//     confirmButtonColor: "#c26214",
//     cancelButtonColor: "#6c757d",

//     confirmButtonText: "Oui",
//     cancelButtonText: "Annuler",

//     showCancelButton: true
// });

export default class Alert {

    static success(options: AlertOptions) {
        return Swal.fire({
            icon: "success",
            title: options.title,
            text: options.text,
            html: options.html,
            confirmButtonText: options.confirmButtonText ?? "OK",
        });

    }

    static error(options: AlertOptions) {
        return Swal.fire({
            icon: "error",
            title: options.title,
            text: options.text,
            html: options.html,
            confirmButtonText: options.confirmButtonText ?? "OK",
        });

    }

    static warning(options: AlertOptions) {
        return Swal.fire({
            icon: "warning",
            title: options.title,
            text: options.text,
            html: options.html,
            confirmButtonColor: "#c26214",
            confirmButtonText: options.confirmButtonText ?? "Compris",
        });

    }

    static info(options: AlertOptions) {
        return Swal.fire({
            icon: "info",
            title: options.title,
            text: options.text,
            html: options.html,
            confirmButtonText: options.confirmButtonText ?? "OK",
        });

    }

    

    static async confirm(options: AlertOptions): Promise<boolean> {
        const result = await Swal.fire({
            icon: "question",
            title: options.title,
            text: options.text,
            html: options.html,
            showCancelButton: true,
            confirmButtonText: options.confirmButtonText ?? "Oui",
            cancelButtonText: options.cancelButtonText ?? "Annuler",
            customClass: {
                popup: "alert-popup",
                confirmButton: "btn-delete",
                cancelButton: "btn-cancel"
            }
        });

        return result.isConfirmed;

    }


        // static async confirmDelete(title: string, message: string, onConfirm: () => Promise<void> | void ) {

        //     const result = await Swal.fire({

        //         icon: "warning",

        //         title,

        //         text: message,

        //         showCancelButton: true,

        //         confirmButtonText: "Supprimer",

        //         cancelButtonText: "Annuler",

        //         buttonsStyling: false,

        //         customClass: {
        //             confirmButton: "btn-delete",
        //             cancelButton: "btn-cancel"
        //         }

        //     });

        //     if (result.isConfirmed) {
        //         await onConfirm();                
        //     }
        // }
     static async confirmDelete(options: {title: string;text: string;onConfirm: () => Promise<void> | void;}) {

        const result = await Swal.fire({
            icon: "warning",
            title: options.title,
            text: options.text,
            showCancelButton: true,
            confirmButtonText: "Supprimer",
            cancelButtonText: "Annuler",
            confirmButtonColor: "#ff7171",
            customClass: {
                confirmButton: "supprimerPlat",
                cancelButton: "btn-cancel"
            }
        });

        if (result.isConfirmed) {
            await options.onConfirm();
        }
    }

}