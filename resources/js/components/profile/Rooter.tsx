import { NavLink, Outlet, useNavigation } from "react-router-dom";
import { ProfilePageProps } from "../../interfaces/profile";
import { Calendar, CircleUserRound } from "lucide-react";
import { useProfile } from "@/context/ProfileContext";
import { Spinner } from "../ui/spinner";
import { useEffect } from "react";
import ProgressService from "@/Services/ProgressService";
import { useProgress } from "@/hooks/useProgress";
import UserCardSkeleton from "../UserSkeleton";



export default function Rooter ( )  {
    
  const navigation = useNavigation();
    useProgress()

    const handleLogout = () => {
        return null
    };
    const { data } = useProfile();

    // console.log("dkodfs", user);
    

    return <div className="profile-main">
        <aside className="sidebar">
            <div className="profile-side-bar">
                {data.user.avatar ? (
                    <img src={data.image} className="profile-avatar"/>
                ) : (
                    <p className="cutName">{data.user.firstname?.charAt(0)}{data.user.name.charAt(0)}</p>
                )}
                <div>
                    <h3>{data.user.name} {data.user.firstname}</h3>
                    <span>{data.role}</span>
                </div>
            </div>
            <nav>
                <NavLink to='/rettine/profile'><CircleUserRound />Profile</NavLink>
                <NavLink to='/rettine/profile/prop_commandes'><Calendar />Commandes</NavLink>
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
                {/* <DoorOpenIcon/> */}
            </button>
        </aside>
        <main className="content">
          {navigation.state === "loading" ? <UserCardSkeleton/> : <Outlet/>}
        </main>
    </div>
}