import { ProfilePageProps } from "../interfaces/profile";
import { createBrowserRouter, Outlet, RouterProvider } from "react-router-dom";
import CommandeIndexPage from "@/components/profile/Commande";
import Rooter from "@/components/profile/Rooter";

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
        ]
    }
])

export default function ProfilePage() {
    return (
        <RouterProvider router={router} />
    );
}