import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import PrimeVue from 'primevue/config'
import ToastService from 'primevue/toastservice'
import { Link } from '@inertiajs/vue3'
import BadgeDirective from 'primevue/badgedirective'
import Tooltip from 'primevue/tooltip';

// import "primevue/resources/themes/tailwind-light/theme.css";
import "primevue/resources/themes/lara-light-indigo/theme.css";     
import "primevue/resources/primevue.min.css";
import "primeicons/primeicons.css";

createInertiaApp({
    resolve: name => require(`./Pages/${name}`),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
        .use(plugin)
        .use(PrimeVue, { ripple: true })
        .use(ToastService)
        .directive('badge', BadgeDirective)
        .directive('tooltip', Tooltip)
        .component('Link', Link)
        .mixin({ methods: {route} })
        .mount(el)
    },
    progress: {
        delay: 0,
        color: '#BEC2CF',
    },
})