import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import PrimeVue from 'primevue/config';
import "primevue/resources/themes/tailwind-light/theme.css";     
import "primevue/resources/primevue.min.css";
import "primeicons/primeicons.css";
import { Link } from '@inertiajs/vue3'
import ToastService from 'primevue/toastservice';

createInertiaApp({
  resolve: name => require(`./Pages/${name}`),
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(PrimeVue)
      .use(ToastService)
      .component('Link', Link)
      .mount(el);
  },
})
