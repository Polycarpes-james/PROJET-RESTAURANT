import ProfilePage from "./pages/ProfilePage";

export default function Root() {
        // console.log(window.profileData);
            console.log("PROFILE DATA :", window.profileData);

    if (!window.profileData) {
        return <p>Données utilisateur introuvables</p>;
    }

    return <ProfilePage />;
}