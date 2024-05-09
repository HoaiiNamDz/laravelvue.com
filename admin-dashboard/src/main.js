import { createApp } from 'vue'
import App from './App.vue'

import './assets/styles/tailwind.css'
import './assets/main.css'
import router from './router/index.js'

import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { fab } from '@fortawesome/free-brands-svg-icons'
import { far } from '@fortawesome/free-regular-svg-icons'
import { fas } from '@fortawesome/free-solid-svg-icons'
import { library, dom } from '@fortawesome/fontawesome-svg-core'
import { registerGlobalComponents } from './utils/import'

import { createPinia } from 'pinia'

const pinia = createPinia()
const app = createApp(App)

library.add(fab, far, fas)
dom.watch()
app.component('font-awesome-icon', FontAwesomeIcon)
registerGlobalComponents(app)

app.use(router)
app.use(pinia)

app.mount('#app')
