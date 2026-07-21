import { apiFetch } from "@/apiFetch";

export default class FormService {
    static async submit(form: HTMLFormElement, url: string) {
        const formData = new FormData(form);
        const data = Object.fromEntries(formData.entries());
        const response = await apiFetch(url, 'POST', data)
        return {
            response: response.response,
            result: response.data
        };
    }
}