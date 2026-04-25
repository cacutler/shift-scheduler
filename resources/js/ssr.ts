import { createSSRApp, h, DefineComponent } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { renderToString } from '@vue/server-renderer'
import { ZiggyVue } from 'ziggy-js'
export const render = (page: any) => createInertiaApp({page, render: renderToString,
    resolve: (name: string) => {
        const pages = import.meta.glob<DefineComponent>('./Pages/**/*.vue', { eager: true })
        return pages[`./Pages/${name}.vue`]
    },
    setup({ App, props, plugin }) {
        const ziggyConfig = (props.initialPage.props as any).ziggy
        return createSSRApp({ render: () => h(App, props) }).use(plugin).use(ZiggyVue, ziggyConfig)
    },
})