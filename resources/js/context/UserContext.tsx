import React, { createContext, useContext, useState } from "react";
import type { ProfilePageProps, User } from "@/interfaces/profile";

type UserContextType = {
    currentUser: App.Data.User.UserData;
    setCurrentUser:  React.Dispatch<
        React.SetStateAction<App.Data.User.UserData>
    >;
};

interface Props {
    user: App.Data.User.UserData,
    children: React.ReactNode
}

const UserContext = createContext<UserContextType | null>(null);

export function UserProvider({ user, children }: Props) {
    
    const [currentUser, setCurrentUser] = useState(user);
    console.log('User', currentUser);

    return (
        <UserContext.Provider
            value={{
                currentUser,
                setCurrentUser,
            }}
        >
            {children}
        </UserContext.Provider>
    );
}

export function useUser() {
    const context = useContext(UserContext);

    if (!context) {
        throw new Error("useUser must be used inside UserProvider");
    }

    return context;
}