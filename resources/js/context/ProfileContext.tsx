 import { ProfilePageProps } from "@/interfaces/profile";
import React, { createContext, useContext, useState } from "react";

type ProfileContextType = {
    data: ProfilePageProps;
    setData: React.Dispatch<React.SetStateAction<ProfilePageProps>>;
};


const ProfieContext = createContext<ProfileContextType | null>(null);

export function ProfileProvider({ children }: {
    children: React.ReactNode;
} ) {
    // console.log('window',window.profileData);

    const [data, setData] = useState(window.profileData);

    return (
        <ProfieContext.Provider value={{data, setData}}>
            {children}
        </ProfieContext.Provider>
    );
}

export function useProfile() {

    const context = useContext(ProfieContext);

    if (!context) {
        throw new Error("useUser must be used inside UserProvider");
    }

    return context;
}