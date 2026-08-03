import { User } from "@/interfaces/profile";
import Button from "../ui/Button";
import { InputLabel } from "../ui/pieceInput";

export function ProfileForm({user}:User) {
    const handlerClick = () => {
        // e.preventDefault()

    }

    const handlerSubmit = (e:any) => {
        e.preventDefault()
        console.log(e.target);
        
        const data = new FormData(e.target)

        console.log(data);
        fetch('/rettine/profile/update', {
            method: "PUT",
            body:data
        })
        .then((r) => r.json)
        .then((r) => {
            console.log(r);
            
        })
        .catch((e) => console.log(e))
    }

    return (
        <form  action='/rettine/profile/update' onSubmit={handlerSubmit}>
            <InputLabel type="text" name="name" className="" user={user.name}>Entrer le nom de votre profile</InputLabel>
            <InputLabel type="text" name="firstname" className="" user={user.firstname ?? ''}>Entrer le prenom de votre profile</InputLabel>
            <InputLabel type="email" name="email" className="" user={user.email} >Entrer l'addresse email</InputLabel>
             <div className="change-password">
                <h2>Changer de mot de passe</h2>
                <p>Vous pouvez changer votre mot de passe actuel</p>
            </div>
            <InputLabel type="password" name="password" className="">Entrer votre nouveau mot de pass</InputLabel>
            <InputLabel type="password" name="password_confirmation" className="">Comfirmer votre nouveau mot de pass</InputLabel>    
            <div className="modal-footer">
                <Button type="submit" className="btn btn-primary" onClick={handlerClick} >Enregistrer</Button>
            </div>
        </form>

    );
}