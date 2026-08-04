import { useUser } from "@/context/UserContext";
import { UserCard } from "@/interfaces/profile";


export default function ProfileCard({ role, image }: UserCard) {

    const selectAvatar = () => {
        document.getElementById("avatarInput")?.click();
    };

    const { currentUser } = useUser();


    return (
        <section className="card card-profile">
            <div className="card-header">
                <h2>Mon profil</h2>
            </div>
            <div className="profile-box">
                <div className="picture-profile" onClick={selectAvatar}>
                    <input id="avatarInput" type="file" hidden accept="image/*"/>
                    {currentUser.avatar ? (
                        <img src={image} className="profile-avatar"/>
                    ) : (
                        <p className="cutName">
                            {currentUser.firstname?.charAt(0)}
                            {currentUser.name.charAt(0)}
                        </p>
                    )}
                </div>
                <div>
                    <h3>{currentUser.firstname}</h3>
                    <span>{role}</span>
                    <small>{currentUser.email}</small>
                </div>
            </div>
        </section>
    );
}