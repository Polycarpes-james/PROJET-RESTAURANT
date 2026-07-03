// import flatpickr from "flatpickr";
// import "flatpickr/dist/flatpickr.min.css";
import flatpickr from "flatpickr";
import { French } from "flatpickr/dist/l10n/fr.js";

flatpickr.localize(French);

document.addEventListener("DOMContentLoaded", () => {

    const dateInput = document.querySelector<HTMLInputElement>("#reservation_date");
    const timeInput = document.querySelector<HTMLInputElement>("#reservation_time");

    if (dateInput) {
        flatpickr(dateInput, {
            locale: French,
            dateFormat: "Y-m-d",
            minDate: "today"
        });
//         flatpickr(dateInput, {
//     locale: French,
//     dateFormat: "d/m/Y",
//     minDate: "today",
//     altInput: true,
//     altFormat: "l d F Y"
// });
    }

    if (timeInput) {
        flatpickr(timeInput, {
            locale: French,
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true
        });
    }

});


const btnReservationShow = document.querySelectorAll('.reservation_show')


btnReservationShow.forEach((btn) => {
    btn.addEventListener("click", (e) => {
        const target = e.currentTarget as HTMLElement;

        const user = JSON.parse(target.dataset.user as string);
        // console.log(user);
        showReservationModal(user);
    });
});


function showReservationModal (user:any) {
    const content = document.querySelector('#container-user-reservation') as HTMLDivElement
    const h1 = content.querySelector('#containerUser') as HTMLParagraphElement

    h1.innerText = user.name
    

    content.style.display = "flex"
}


