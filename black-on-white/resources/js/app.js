/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap'
import { createApp } from 'vue'
import VueTippy from 'vue-tippy'

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

import router from './router'

const app = createApp({ router })

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

import Button from './components/Button.vue'
import Header from './components/Header.vue'
import Footer from './components/Footer.vue'
import ButtonUp from './components/ButtonUp.vue'
import Loader from './components/Loader.vue'
import store from "./store";

app.component('v-button', Button)
app.component('v-header', Header)
app.component('v-footer', Footer)
app.component('v-button-up', ButtonUp)
app.component('loader', Loader)

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.use(
    VueTippy,
    {
        directive: 'tippy',
        defaultProps: {
            placement: 'top',
            allowHTML: true,
            duration: [null, null],
        },
    }
)

app.use(store);
app.use(router)
app.mount('#app')
