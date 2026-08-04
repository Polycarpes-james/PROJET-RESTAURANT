import { useMutation, useQueryClient } from "@tanstack/react-query";
import { updateProfile } from "@/api/profile";
import { toast } from "sonner";
import ProgressService from "@/Services/ProgressService";

export function useUpdateProfile() {

    const queryClient = useQueryClient();

    return useMutation({

        mutationFn: updateProfile,

        onMutate() {
            ProgressService.start();
        },

        onSuccess(response) {

            queryClient.setQueryData(
                ["profile"],
                response.user
            );

            toast.success(response.message);
        },

        onError(error) {

            console.error(error);

        },

        onSettled() {

            ProgressService.done();

        }

    });

}