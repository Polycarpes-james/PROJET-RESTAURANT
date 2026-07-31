import axios from "axios";

export const getProfile = async () => {

    const response = await axios.get("/api/profile");

    return response.data;

};

export const uploadAvatar = async (file: File) => {

    const formData = new FormData();

    formData.append("avatar", file);

    return axios.post(
        "/api/profile/avatar",
        formData
    );

};

export const updateProfile = async (data: any) => {

    return axios.put(
        "/api/profile",
        data
    );

};

export const logout = async () => {

    return axios.post("/logout");

};