document.addEventListener("DOMContentLoaded", () => {
    const avatarPreview = document.getElementById("avatarPreview") as HTMLImageElement | null;
    const avatarInput = document.getElementById("avatarInput") as HTMLInputElement | null;
    const avatarLoader = document.getElementById("avatarLoader") as HTMLElement | null;
    const avatarForm = document.getElementById("avatarForm") as HTMLFormElement | null;

    if (!avatarPreview || !avatarInput || !avatarLoader || !avatarForm) return;

    avatarForm.addEventListener('mousemove', () => {
        avatarLoader.classList.remove('hidden');
        avatarForm.style.cursor = "pointer";
    });

    avatarForm.addEventListener('mouseleave', () => {
        avatarLoader.classList.add('hidden');
    });

    // Quand on clique sur l'image -> clique sur input file
    avatarForm.addEventListener("click", () => {
        avatarInput.click();
    });

    // Quand un fichier est choisi
    avatarInput.addEventListener("change", () => {
        if (!avatarInput.files || !avatarInput.files[0]) return;

        const file = avatarInput.files[0];
        const formData = new FormData();
        formData.append("avatar", file);
        formData.append("_token", "{{ csrf_token() }}"); // à remplacer dynamiquement en TS si nécessaire

        // Afficher loader
        avatarLoader.classList.remove("hidden");

        fetch("{{ route('profile.update.avatar') }}", { // à remplacer dynamiquement
            method: "POST",
            body: formData
        })
        .then(res => res.json())
        .then((data: { success: boolean; avatar_url?: string }) => {
            if (data.success && data.avatar_url) {
                // mise à jour immédiate de l’aperçu
                avatarPreview.src = data.avatar_url + "?t=" + new Date().getTime();
            }
        })
        .catch(err => console.error(err))
        .finally(() => {
            setTimeout(() => {
                avatarLoader.classList.add("hidden");
            }, 1000);
        });

        // Affichage instantané de l'aperçu
        const reader = new FileReader();
        reader.onload = (e) => {
            if (e.target?.result) {
                avatarPreview.src = e.target.result as string;
            }
        };
        reader.readAsDataURL(file);

        // Envoie direct du formulaire
        avatarForm.submit();
    });
});
