import Swal from "sweetalert2";
import { AlertOptions } from "./AlertTypes";


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
            backdrop:"rgba(0,0,0,0.35)",
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
     static async confirmDelete(options: {title: string;btn:string;text: string;onConfirm: () => Promise<void> | void;}) {

        const result = await Swal.fire({
            icon: "warning",
            title: options.title,
            text: options.text,
            showCancelButton: true,
            confirmButtonText: "Supprimer",
            cancelButtonText: "Annuler",
            backdrop:"rgba(0,0,0,0.35)",
            confirmButtonColor: "#ff7171",
            customClass: {
                confirmButton: options.btn,
                cancelButton: "btn-cancel"
            }
        });

        if (result.isConfirmed) {
            await options.onConfirm();
        }
    }

    static async videPanier (options: {title: string;text: string;onConfirm: () => Promise<void> | void;}) {

        const result = await Swal.fire({
            icon: "warning",
            title: options.title,
            text: options.text,
            showCancelButton: true,
            confirmButtonText: "Vider",
            cancelButtonText: "Annuler",
            backdrop:"rgba(0,0,0,0.35)",
            confirmButtonColor: "#ff7171",
            customClass: {
                confirmButton: "multi_vide_btn",
                cancelButton: "btn-cancel"
            }
        });

        if (result.isConfirmed) {
            await options.onConfirm();
        }
    }

    static async modal (options: {title: string;html:string;text: string}) {
        const result = await Swal.fire({
            icon: "warning",
            title: options.title,
            text: options.text,
            html: options.html,
            showCancelButton: true,
            confirmButtonText: "Enregistrer",
            cancelButtonText: "Annuler",
            backdrop:"rgba(0,0,0,0.35)",
            confirmButtonColor: "#ff7171",
            customClass: {
                confirmButton: "submit-btn",
                cancelButton: "btn-cancel"
            }
        });

        // if (result.isConfirmed) {
        //     await options.onConfirm();
        // }
    }

}