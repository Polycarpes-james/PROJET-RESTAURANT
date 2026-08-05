import { useEffect } from "react";
import { useNavigation } from "react-router-dom";
import ProgressService from "@/Services/ProgressService";

export function useProgress() {

    const navigation = useNavigation();

    useEffect(() => {
        console.log(navigation.state);

        if (navigation.state === "loading") {
            ProgressService.start();
        } else {
            ProgressService.done();
        }

    }, [navigation.state]);
}