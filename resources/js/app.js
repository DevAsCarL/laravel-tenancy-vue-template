import { ZiggyVue } from "ziggy-vue";
import Axios from "axios";
//QUASAR
import { Quasar, Notify } from "quasar";
import "@quasar/extras/material-icons/material-icons.css";
import "quasar/src/css/index.sass";
import { createApp, h } from "vue";
import { createInertiaApp, Link, Head } from "@inertiajs/vue3";

import { userCan } from "@js/utilities/permissions.js";

import {
    Bars3Icon,
    XMarkIcon,
    SparklesIcon,
    CheckCircleIcon,
    XCircleIcon,
} from "@heroicons/vue/24/outline";

import AppLayout from "@js/Layouts/App.vue";

import Notice from "@js/Components/Notice.vue";
import Button from "@js/Components/Button.vue";
createInertiaApp({
    resolve: async (name) => {
        let page = null;

        let isModule = name.split("::");
        if (isModule.length > 1) {
            let moduleName = isModule[0];
            let pathToFile = isModule[1];
            // @modules is an alias of the module folder or just specify the path
            // from the root directory to the folder modules
            // for example ../../modules
            page = await import(`/modules/${moduleName}/${pathToFile}.vue`);
            return page.default;
        } else {
            const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
            page = pages[`./Pages/${name}.vue`];

            page.default.layout = page.default.layout || AppLayout;
            return page;
        }
        //...

    },
    setup({ el, App, props, plugin }) {
        const Vue = createApp({ render: () => h(App, props) });

        Vue.use(plugin).use(ZiggyVue);

        Vue.use(Quasar, {
            plugins: {
                Notify,
            },
            config: {},
        });
        Vue.mixin({ methods: { userCan } });

        Vue.component("Bars3Icon", Bars3Icon)
            .component("XMarkIcon", XMarkIcon)
            .component("SparklesIcon", SparklesIcon)
            .component("CheckCircleIcon", CheckCircleIcon)
            .component("XCircleIcon", XCircleIcon);

        Vue.component("Head", Head)
            .component("Link", Link)
            .component("Notice", Notice)
            .component("Button", Button);

        Vue.provide("Axios", Axios);
        Vue.mount(el);
    },

    title: (title) => (title ? `${title} | Template` : "Template"),

    progress: {
        color: "#000",
    },
});
