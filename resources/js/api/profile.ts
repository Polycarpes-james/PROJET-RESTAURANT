import { request } from "@/https/fetch";
import ProfileController from "@/actions/ProfileController";


export function getProfile() {
    return request(
        ProfileController.show()
    );
}


export function updateProfile(data: FormData) {
    return request(ProfileController.update(), data);
}