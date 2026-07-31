import { User } from "../../interfaces/profile";

interface Props {
    user: User;
}

export default function ProfileCard({ user }: Props) {

    const selectAvatar = () => {
        document
            .getElementById("avatarInput")
            ?.click();
    };

    return (

        <section className="card card-profile">

            <div className="card-header">

                <h2>Mon profil</h2>

            </div>

            <div className="profile-box">

                <div
                    className="picture-profile"
                    onClick={selectAvatar}
                >

                    <input
                        id="avatarInput"
                        type="file"
                        hidden
                        accept="image/*"
                    />

                    {user.avatar ? (

                        <img
                            src={user.avatar}
                            className="profile-avatar"
                            alt={user.firstname}
                        />

                    ) : (

                        <p className="cutName">

                            {user.firstname.charAt(0)}
                            {user.name.charAt(0)}

                        </p>

                    )}

                </div>

                <div>

                    <h3>{user.firstname}</h3>

                    <span>{user.role_label}</span>

                    <small>{user.email}</small>

                </div>

            </div>

        </section>

    );
}