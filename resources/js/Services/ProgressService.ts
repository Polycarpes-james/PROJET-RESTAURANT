import NProgress from "nprogress";
import "nprogress/nprogress.css";

NProgress.configure({
    minimum: 0.05,
    trickle: true,
    trickleSpeed: 250,
    showSpinner: false,
    easing: "ease",
    speed: 500,
});

document.addEventListener("click", (e) => {
    const link = (e.target as HTMLElement).closest("a");
    if (!link) return;
    if (link.target === "_blank") return;
    if (link.href.startsWith(window.location.origin)) {
        ProgressService.start();
    } else {
        ProgressService.done()
    }
});



document.addEventListener("DOMContentLoaded", () => {
    ProgressService.done();
});
export default class ProgressService {

    static start() {
        NProgress.start();
    }

    static done() {
        NProgress.done(true);
    }

    static set(value: number) {
        NProgress.set(value);
    }

    static remove() {
        NProgress.remove();
    }
}