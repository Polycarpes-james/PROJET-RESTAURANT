import { createBrowserRouter, RouterProvider, useRouteError } from "react-router-dom";
import CommandeIndexPage from "@/components/profile/Commande";
import Rooter from "@/components/profile/Rooter";
import { ProfileProvider } from "@/context/ProfileContext";
import ProfileHome from "@/components/profile/ProfileHome";



const router = createBrowserRouter([
    {
        path: '/rettine/profile',
        errorElement:<PageError />,
        element:(
            <ProfileProvider>
                
                <Rooter />
            </ProfileProvider>
        ) ,
        children: [
            {
                index: true,
                element: <ProfileHome/>
            },
            {
                path: 'commandes',
                element: <CommandeIndexPage />
            }
        ]
    }
])

function PageError () {
    const error = useRouteError()

    return <>
         <h1>Une erreur est survenu ! </h1>
        <p>
            {error?.toString()}
        </p>
    </>
}

export default function ProfilePage() {
    return (
        <RouterProvider router={router} />
    );
}