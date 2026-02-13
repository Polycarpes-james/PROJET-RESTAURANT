const hoursInput = document.getElementById("hours")! as HTMLInputElement;
const minutesInput = document.getElementById("minutes")! as HTMLInputElement;
const tempsPreparation = document.getElementById("temps-preparation")! as HTMLInputElement;
const contentElement = document.querySelector('.element-converted')! as HTMLElement;

function updateResult(): void {
    const hours = parseInt(hoursInput.value) || 0;
    const minutes = parseInt(minutesInput.value) || 0;

    const totalSeconds = hours * 3600 + minutes * 60;
    tempsPreparation.value = totalSeconds.toString();

    contentElement.textContent = `
    
    ${totalSeconds} secondes`;
}

hoursInput.addEventListener("input", updateResult);
minutesInput.addEventListener("input", updateResult);
