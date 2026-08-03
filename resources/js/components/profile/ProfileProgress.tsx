import { Commande, CommandeIndex, ProfilePageProps } from "@/interfaces/profile";
import { Info } from "lucide-react";

// interface ProfileProgressProps {
//     percentage: number;
// }

export default function ProfileProgress({
    profile,
}: ProfilePageProps) {

    return (
        <section className="profile-card">
            <div className="profile-warning">
                <div className="warning-icon"><Info width={50} height={50} /></div>
                <div className="warning-content">
                    <h3>Complétez votre profil La Rettine</h3>
                    <p>Certaines informations sont encore manquantes.Complétez votre profil afin de profiter pleinement des fonctionnalités.</p>
                    <div className="progress-bar">
                        <div className="progress-fill" style={{width: `${profile.percentage}%`}}/>
                    </div>
                    <button className="edit-profile-btn btn-edit">
                        <span>{profile.percentage}%</span>
                        Compléter maintenant
                    </button>
                </div>
            </div>
        </section>
    );
}