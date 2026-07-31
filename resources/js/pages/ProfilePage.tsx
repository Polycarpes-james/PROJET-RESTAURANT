

import Sidebar from "@/components/profile/Sidebar";
import { ProfilePageProps } from "../interfaces/profile";
import ProfileProgress from "@/components/profile/ProfileProgress";
import ProfileCard from "@/components/profile/ProfileCard";
import PersonalInformation from "@/components/profile/PersonalInformation";
import AddressCard from "@/components/profile/AddressCard";
import Cart from "@/components/profile/Profile";

export default function ProfilePage({
    user,
    profile,
    panier,
    total,
}: ProfilePageProps) {

    return (
        <div className="profile-main">

            <div className="container">

                <Sidebar user={user} />

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

                        <ProfileCard user={user} />

                        <PersonalInformation user={user} />

                        <AddressCard />

                    </div>

                    <div className="section-item section-small">

                        <Cart
                            panier={panier}
                            total={total}
                        />

                    </div>

                </main>

            </div>

        </div>
    );
}