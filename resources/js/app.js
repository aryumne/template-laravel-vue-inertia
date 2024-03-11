import "./bootstrap";
import "../css/app.css";
import "../assets/library/jquery/dist/jquery.min.js";
import "../assets/library/bootstrap/dist/js/bootstrap.min.js";
import "../assets/library/jquery.nicescroll/dist/jquery.nicescroll.min.js";
// import "../assets/js/stisla.js";
import "../assets/js/scripts.js";
// import "../assets/js/custom.js";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";

createInertiaApp({
    id: "app",
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        return pages[`./Pages/${name}.vue`];
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mixin({ methods: { route } })
            .mount(el);
    },
});