import { defineAsyncComponent } from 'vue'

export function registerGlobalComponents(app) {
    app.component(
        'default-layout',
        defineAsyncComponent(() => import('@/layouts/default.vue'))
    )
}
