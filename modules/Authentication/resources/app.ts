import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";

createInertiaApp({
    resolve: (name) => {
        let page = null;

        let isModule = name.split("::");
        if (isModule.length > 1) {
            let module = isModule[0];
            let pathTo = isModule[1];
            // @modules is an alias of the module folder or just specify the path 
            // from the root directory to the folder modules             
            // for example ../../modules
            page = require(`@modules/${moduleName}/${pathToFile}.vue`);
        } else {
            page = require(`./Pages/${name}`);
        }
        //...
        return page.default;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el);
    },
});