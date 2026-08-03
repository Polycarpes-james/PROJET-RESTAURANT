import { ProfilePageProps } from "../interfaces/profile";
import { createBrowserRouter, RouterProvider } from "react-router-dom";
import CommandeIndexPage from "@/components/profile/Commande";
import Rooter from "@/components/profile/Rooter";
import Cart from "@/components/profile/Profile";
import AddressCard from "@/components/profile/AddressCard";
import PersonalInformation from "@/components/profile/PersonalInformation";
import ProfileCard from "@/components/profile/ProfileCard";
import ProfileProgress from "@/components/profile/ProfileProgress";

const router = createBrowserRouter([
    {
        path: '/rettine/profile',
        element: <Rooter {...window.profileData}/>,
        children: [
            // {
            //     path: 'commandes',
            //     element: <CommandeIndexPage {...window.commandeUserProfileData} />
            // },
            {
                path: 'avis/view',
                element: <CommandeIndexPage {...window.commandeUserProfileData} />
            },
            {
                path: '/rettine/profile',
                element: <>
                        <div className="section-item section-big-first">
                            <div className="header-line">
                                <h1>
                                    <span>Bonjour</span>, {window.profileData.user.name}
                                </h1>
                                <p>Bienvenue sur votre compte</p>
                            </div>
                            {!window.profileData.profile.full && (<ProfileProgress {...window.profileData} />)}
                            <ProfileCard user={window.profileData.user} role={window.profileData.role} image={window.profileData.image} />
                            <PersonalInformation  {...window.profileData} />
                            <AddressCard />
                        </div>
                        <div className="section-item section-small">
                            <Cart {...window.profileData }  />
                        </div>
                </>
            },
        ]
    }
])

export default function ProfilePage() {
    return (
        <RouterProvider router={router} />
    );
}