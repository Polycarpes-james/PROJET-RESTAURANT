import { User } from "@/interfaces/profile";
import Button from "../ui/Button";
import { InputLabel } from "../ui/pieceInput";
import { Spinner } from "../ui/spinner";
import { useUpdateProfile } from "@/hooks/useUpdateProfile";

type ProfileFormProps = {
    user: User["user"];
    onSuccess?: (response: any) => void;
};


export function ProfileForm({user, onSuccess}:ProfileFormProps) {
   
    const mutation = useUpdateProfile();

    async function handlerSubmit(
        e: React.FormEvent<HTMLFormElement>
    ) {
        e.preventDefault();

        const data = new FormData(e.currentTarget);
        
        mutation.mutate(data, {
            onSuccess: (response) => {
                onSuccess?.(response);
            },
            onError: (error) => {
                console.error(error);
            }
        });
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
                <Button type="submit" disabled={mutation.isPending} className="btn btn-primary" >{mutation.isPending ? <Spinner /> : "Enregistrer"}</Button>
            </div>
        </form>

    );
}