interface ProfileProgressProps {
    percentage: number;
}

export default function ProfileProgress({
    percentage,
}: ProfileProgressProps) {

    return (

        <section className="profile-card">

            <div className="profile-warning">

                <div className="warning-icon">

                    <i className="fa-solid fa-circle-exclamation"></i>

                </div>

                <div className="warning-content">

                    <h3>
                        Complétez votre profil La Rettine
                    </h3>

                    <p>
                        Certaines informations sont encore
                        manquantes.

                        Complétez votre profil afin de profiter
                        pleinement des fonctionnalités.
                    </p>

                    <div className="progress-bar">

                        <div
                            className="progress-fill"
                            style={{
                                width: `${percentage}%`,
                            }}
                        />

                    </div>

                    <button className="edit-profile-btn btn-edit">

                        <span>{percentage}%</span>

                        Compléter maintenant

                    </button>

                </div>

            </div>

        </section>

    );
}