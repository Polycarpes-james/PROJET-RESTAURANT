import { Pencil } from "lucide-react";
import { UserCard } from "../../interfaces/profile";
import Button  from "../ui/Button";
import Modal from "../ui/Modal/Modal";
import { ProfileForm } from "./ProfileForm";
import { useModal } from "@/hooks/useModal";
import { toast } from "sonner";
import { useState } from "react";


export default function PersonalInformation({ user, role }: UserCard) {
    const modal = useModal();
    const [currentUser, setCurrentUser] = useState(user);

    return (
        <section className="card">
            <div className="card-header">
                <h2>Informations personnelles</h2>
                <Modal open={modal.isOpen} onClose={modal.close} title="Modifier le profil">
                    <ProfileForm user={currentUser}  onSuccess={(response) => {
                            setCurrentUser(response.user)
                            modal.close();
                            
                            toast.success(
                                response.message
                            );

                        }}
                    />
                </Modal>
                <Button className="bnt-edite" onClick={modal.open}><Pencil width={18}/></Button>
            </div>
            <div className="grille-infos">
                <div className="item">
                    <span>Nom</span>
                    <strong>{user.name}</strong>
                </div>
                <div className="item">
                    <span>Prénom</span>
                    <strong>{currentUser.firstname}</strong>
                </div>
                <div className="item">
                    <span>Email</span>
                    <strong>{currentUser.email}</strong>
                </div>
                <div className="item">
                    <span>Téléphone</span>
                    <strong>{currentUser.phone_number ?? "-"}</strong>
                </div>
                <div className="item">
                    <span>Rôle</span>
                    <strong>{role}</strong>
                </div>
            </div>
        </section>
    );
}