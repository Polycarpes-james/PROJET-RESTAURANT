import { NavLink, Outlet } from "react-router-dom";
import { ProfilePageProps, UserCard } from "../../interfaces/profile";
import Cart from "./Profile";
import AddressCard from "./AddressCard";
import PersonalInformation from "./PersonalInformation";
import ProfileCard from "./ProfileCard";
import ProfileProgress from "./ProfileProgress";
import { Archive, Calendar, CircleUser, CircleUserRound } from "lucide-react";



export default function Rooter ({
    user,
    profile,
    panier,
    total,
    role,
    image
}: ProfilePageProps)  {
    
    const handleLogout = () => {
        return null
    };

    return <div className="profile-main">
        <aside className="sidebar">
            <div className="profile-side-bar">
                {user.avatar ? (
                    <img src={image} className="profile-avatar"/>
                ) : (
                    <p className="cutName">{user.firstname?.charAt(0)}{user.name.charAt(0)}</p>
                )}
                <div>
                    <h3>{user.name} {user.firstname}</h3>
                    <span>{role}</span>
                </div>
            </div>
            <nav>
                <NavLink to='/rettine/profile'><CircleUserRound />Profle</NavLink>
                <NavLink to='/rettine/profile/commandes'><Archive />Commande</NavLink>
                <NavLink to='/rettine/profile/avis/view'><Calendar />Avis</NavLink>
            </nav>
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
        <main className="content">
                 <div className="section-item section-big-first">
                 <div className="header-line">
                     <h1>
                         <span>Bonjour</span>, {user.name}
                     </h1>
                     <p>Bienvenue sur votre compte</p>
                 </div>
                 {!profile.full && (
                     <ProfileProgress percentage={profile.percentage} />
                 )}
                 <ProfileCard image={image} role={role} user={user} />
                 <PersonalInformation image={image} role={role} user={user} />
                 <AddressCard />
             </div>
             <div className="section-item section-small">
                 <Cart panier={panier} total={total} />
             </div>
            <Outlet/>
        </main>
    </div>
}