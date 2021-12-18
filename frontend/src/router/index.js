import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const routes = [
    {
        path: "/",
        name: "articles",
        component: () => import("../components/ArticlesList")
    },
    {
        path: "/upload",
        name: "upload",
        component: () => import("../components/UploadArticles")
    },
]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes,
})

export default router
