import { User } from "../../interfaces/profile";

interface SidebarProps {
    user: User;
}

export default function Sidebar({ user }: SidebarProps) {

    const handleLogout = () => {
        // TODO
        // axios.post('/logout')
        // ou Inertia.post('/logout')
    };

    return (
        <aside className="sidebar">

            <div className="profile-side-bar">

                {user.avatar ? (
                    <img
                        src={user.avatar}
                        alt={user.firstname}
                        className="profile-avatar"
                    />
                ) : (
                    <p className="cutName">
                        {user.firstname.charAt(0)}
                        {user.name.charAt(0)}
                    </p>
                )}

                <div>
                    <h3>
                        {user.name} {user.firstname}
                    </h3>

                    <span>{user.role_label}</span>
                </div>

            </div>

            <button
                className="deconnexion"
                onClick={handleLogout}
            >
                <svg xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path
                        d="m16 17 5-5-5-5"
                        strokeWidth="2"
                        strokeLinecap="round"
                        strokeLinejoin="round"
                    />

                    <path
                        d="M21 12H9"
                        strokeWidth="2"
                        strokeLinecap="round"
                        strokeLinejoin="round"
                    />

                    <path
                        d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"
                        strokeWidth="2"
                        strokeLinecap="round"
                        strokeLinejoin="round"
                    />

                </svg>

            </button>

        </aside>
    );
}