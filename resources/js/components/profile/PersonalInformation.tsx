import { User } from "../../interfaces/profile";

interface Props {
    user: User;
}

export default function PersonalInformation({ user }: Props) {
    return (
        <section className="card">

            <div className="card-header">

                <h2>Informations personnelles</h2>

                <button className="edit-profile-btn btn-edit">
                    ✏️
                </button>

            </div>

            <div className="grille-infos">

                <div className="item">
                    <span>Nom</span>
                    <strong>{user.name}</strong>
                </div>

                <div className="item">
                    <span>Prénom</span>
                    <strong>{user.firstname}</strong>
                </div>

                <div className="item">
                    <span>Email</span>
                    <strong>{user.email}</strong>
                </div>

                <div className="item">
                    <span>Téléphone</span>
                    <strong>{user.phone_number ?? "-"}</strong>
                </div>

                <div className="item">
                    <span>Rôle</span>
                    <strong>{user.role_label}</strong>
                </div>

            </div>

        </section>
    );
}