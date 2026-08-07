import { Pencil } from "lucide-react";
import { UserCard } from "../../interfaces/profile";
import Button  from "../ui/Button";
import Modal from "../ui/Modal/Modal";
import { ProfileForm } from "./ProfileForm";
import { useModal } from "@/hooks/useModal";
import { useProfile } from "@/context/ProfileContext";
import { LabelPar } from "../ui/pieceLabel";


export default function PersonalInformation() {
    const modal = useModal();
    const { data, setData  } = useProfile();
    const { user } = data  

    return (
        <section className="card">
            <div className="card-header">
                <h2>Informations personnelles</h2>
                <Modal open={modal.isOpen} onClose={modal.close} title="Modifier le profil">
                    <ProfileForm user={user}  onSuccess={(response) => {
                            setData(previous => ({
                                ...previous,
                                user: response.user
                            }));
                            modal.close();
                        }}
                    />
                </Modal>
                <Button className="bnt-edite" onClick={modal.open}><Pencil width={18}/></Button>
            </div>
            <div className="grille-infos">
                <LabelPar className="" column='column' label={user.name} par="Nom"/>
                <LabelPar className="" column='column' label={user.firstname} par="Prénom"/>
                <LabelPar className="" column='column' label={user.email} par="email"/>
                <LabelPar className="" column='column' label={user.phone_number} par="téléphone"/>
                <LabelPar className="" column='column' label={data.role} par="role"/>
            </div>
        </section>
    );
}