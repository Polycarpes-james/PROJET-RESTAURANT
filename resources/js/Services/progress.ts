import NProgress from "nprogress";
import "nprogress/nprogress.css";

NProgress.configure({
    showSpinner: false,
    minimum: 0.2,
    trickleSpeed: 100,
});

export const Progress = {
    start() {
        NProgress.start();
    },

    done() {
        NProgress.done();
    },

    set(value: number) {
        NProgress.set(value);
    },
};