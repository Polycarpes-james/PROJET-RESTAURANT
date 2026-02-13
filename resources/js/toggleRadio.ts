document.addEventListener("DOMContentLoaded", () => {
    const radios = document.querySelectorAll<HTMLInputElement>(".radio-input");
    const labels = document.querySelectorAll<HTMLLabelElement>(".radio-label");
    const addInput = document.querySelector<HTMLElement>('.add-input');

    if (!addInput) return;

    
    function updateLabels() {
        labels.forEach(label => label.classList.remove("active-yes", "active-no"));

        radios.forEach(radio => {
            if (radio.checked) {
                const label = document.querySelector<HTMLLabelElement>(`label[for="${radio.id}"]`);
                if (!label) return;

                if (radio.value === "yes") {
                    addInput?.classList.add('hidden-content');
                    label.classList.add("active-yes");
                } else {
                    label.classList.add("active-no");
                    addInput?.classList.remove('hidden-content');
                }
            }
        });
    }

    radios.forEach(radio => {
        radio.addEventListener("change", updateLabels);
    });

    updateLabels();
});
