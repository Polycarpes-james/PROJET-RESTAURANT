import ProfilePage from "./pages/ProfilePage";

export default function Root() {
    if (!window.profileData) {
        return <p>Données utilisateur introuvables</p>;
    }

    return <ProfilePage />;
}