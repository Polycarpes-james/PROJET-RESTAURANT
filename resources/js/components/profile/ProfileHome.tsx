import { useProfile } from "@/context/ProfileContext";
import ProfileCard from "./ProfileCard";
import PersonalInformation from "./PersonalInformation";
import AddressCard from "./AddressCard";
import Cart from "./Cart";
import ProfileProgress from "./ProfileProgress";


export default function ProfileHome () {    
    const { data } = useProfile();
    const { user } = data;
    console.log("fklskfl", data);
    
    return <>
            <div className="section-item section-big-first">
                <div className="header-line">
                    <h1>
                        <span>Bonjour</span>, {user.name}
                    </h1>
                    <p>Bienvenue sur votre compte</p>
                </div>
                {!data.profile.full && (<ProfileProgress {...data} />)}
                <ProfileCard />
                <PersonalInformation />
                <AddressCard />
            </div>
            <div className="section-item section-small">
                <Cart />
            </div>
        </>
}


