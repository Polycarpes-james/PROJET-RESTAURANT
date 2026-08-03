import { User } from "@/interfaces/profile";
import Button from "../ui/Button";
import { InputLabel } from "../ui/pieceInput";
import { request } from "@/https/fetch";
import ProfileController from "@/actions/ProfileController";
import { useState } from "react";
import { Spinner } from "../ui/spinner";
import { Progress } from "@/Services/Progress";

type ProfileFormProps = {
    user: User["user"];
    onSuccess?: (response: any) => void;
};

export function ProfileForm({user, onSuccess}:ProfileFormProps) {
   
    const [loading, setLoading] = useState(false);


   async function handlerSubmit(
        e: React.FormEvent<HTMLFormElement>
    ) { 
        e.preventDefault();

        // await new Promise(resolve => setTimeout(resolve, 2000));

        Progress.start()

        // setLoading(true);
        const form = e.currentTarget;
        const data = new FormData(form)

        try {
            const response = await request(ProfileController.update(), data);
            console.log(response);
            
            onSuccess?.(response)
            
        } catch (error) {
            console.error(error);
        } finally {
            Progress.done()
            setLoading(false);
        }
    }

    return (
        <form onSubmit={handlerSubmit}>
            <InputLabel type="text" name="name" className="" user={user.name}>Entrer le nom de votre profile</InputLabel>
            <InputLabel type="text" name="firstname" className="" user={user.firstname ?? ''}>Entrer le prenom de votre profile</InputLabel>
            <InputLabel type="text" name="phone_number" className="" user={user.phone_number ?? ''}>Entrer votre numero de telephone</InputLabel>
            <InputLabel type="email" name="email" className="" user={user.email} >Entrer l'addresse email</InputLabel>
             <div className="change-password">
                <h2>Changer de mot de passe</h2>
                <p>Vous pouvez changer votre mot de passe actuel</p>
            </div>
            <InputLabel type="password" name="password" className="">Entrer votre nouveau mot de pass</InputLabel>
            <InputLabel type="password" name="password_confirmation" className="">Comfirmer votre nouveau mot de pass</InputLabel>    
            <div className="modal-footer">
                <Button type="submit" disabled={loading} className="btn btn-primary" >{loading ? <Spinner/>  : "Enregistrer"}</Button>
            </div>
        </form>

    );
}