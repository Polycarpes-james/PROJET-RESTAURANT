import { useProfile } from "@/context/ProfileContext";
import { UserCard } from "@/interfaces/profile";


export default function ProfileCard() {

    const selectAvatar = () => {
        document.getElementById("avatarInput")?.click();
    };

    const { data } = useProfile();
    const { user } = data;

// type AvatarProps = {
//     src: string;
//     size?: number;
//     alt?: string;
// };

// export default function Avatar({
//     src,
//     size = 50,
//     alt = "",
// }: AvatarProps) {
//     return (
//         <img
//             src={src}
//             alt={alt}
//             width={size}
//             height={size}
//             style={{
//                 width: size,
//                 height: size,
//                 borderRadius: "50%",
//                 objectFit: "cover",
//             }}
//         />
//     );
// }
    return (
        <section className="card card-profile">
            <div className="card-header">
                <h2>Mon profil</h2>
            </div>
            <div className="profile-box">
                <div className="picture-profile" onClick={selectAvatar}>
                    <input id="avatarInput" type="file" hidden accept="image/*"/>
                    {user.avatar ? (
                        <img src={data.image} className="profile-avatar"/>
                    ) : (
                        <p className="cutName">
                            {user.firstname?.charAt(0)}
                            {user.name.charAt(0)}
                        </p>
                    )}
                </div>
                <div>
                    <h3>{user.firstname}</h3>
                    <span>{data.role}</span>
                    <small>{user.email}</small>
                </div>
            </div>
        </section>
    );
}