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
    return null
    // <section className="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm transition-shadow duration-300 hover:shadow-md">
{/* 
    <div className="flex items-center justify-between border-b border-gray-100 px-6 py-4">
        <div>
            <p className="text-xs font-semibold uppercase tracking-wider text-gray-400">
                Compte
            </p>

            <h2 className="mt-1 text-lg font-semibold text-gray-900">
                Mon profil
            </h2>
        </div>

        <span className="rounded-full bg-blue-50 px-3 py-1 text-xs font-medium text-blue-600">
            {data.role}
        </span>
    </div>

    <div className="flex flex-col gap-5 p-6 sm:flex-row sm:items-center">

       
        <div
            onClick={selectAvatar}
            className="group relative h-24 w-24 shrink-0 cursor-pointer"
        >
            <input
                id="avatarInput"
                type="file"
                hidden
                accept="image/*"
            />

            {user.avatar ? (
                <img
                    src={data.image}
                    alt={`${user.firstname ?? ""} ${user.name}`}
                    className="h-24 w-24 rounded-full border-4 border-white object-cover shadow-md transition duration-300 group-hover:scale-105"
                />
            ) : (
                <div className="flex h-24 w-24 items-center justify-center rounded-full bg-gradient-to-br from-blue-500 to-blue-700 text-2xl font-bold uppercase text-white shadow-md transition duration-300 group-hover:scale-105">
                    {user.firstname?.charAt(0)}
                    {user.name.charAt(0)}
                </div>
            )}

            <div className="absolute inset-0 flex items-center justify-center rounded-full bg-black/40 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                <span className="text-xs font-medium text-white">
                    Modifier
                </span>
            </div>

   
            <span className="absolute bottom-1 right-1 h-5 w-5 rounded-full border-4 border-white bg-green-500" />
        </div>

    
        <div className="min-w-0 flex-1 text-center sm:text-left">
            <h3 className="truncate text-xl font-bold text-gray-900">
                {user.firstname} {user.name}
            </h3>

            <p className="mt-1 text-sm font-medium text-blue-600">
                {data.role}
            </p>

            <p className="mt-2 truncate text-sm text-gray-500">
                {user.email}
            </p>
        </div>


        <button
            type="button"
            className="rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 shadow-sm transition hover:border-blue-200 hover:bg-blue-50 hover:text-blue-600 active:scale-95"
        >
            Modifier le profil
        </button>
    </div>
</section> */}

    // );
}