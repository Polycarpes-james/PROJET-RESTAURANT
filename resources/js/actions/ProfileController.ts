// actions/ProfileController.ts

import { Action } from "@/https/action";

const ProfileController = {
    edit() {
        return new Action("/rettine/profile", "GET");
    },

    update() {
        return new Action("/rettine/profile/update", "POST");
    },

    destroy() {
        // return new Action("/rettine/profile", "GET");
    },
};

export default ProfileController;