import './bootstrap';
import {createApp} from 'vue/dist/vue.esm-bundler'

import Header from './components/Header.vue'
import Footer from './components/Footer.vue'
import Panel from './components/Panel.vue'

const app = createApp({})
app.component('v-header', Header)
app.component('v-footer', Footer)
app.component('v-panel', Panel)
app.mount('#app')
