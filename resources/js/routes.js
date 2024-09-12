import {createRouter, createWebHistory} from "vue-router";
import Panel from "@/components/Panel.vue";
import ProblemList from "@/components/ProblemList.vue";
import Login from "@/components/authentication/Login.vue";
import Register from "@/components/authentication/Register.vue";
import NotFound from "@/components/errors/NotFound.vue";
import AboutUs from "@/components/information/AboutUs.vue";

const routes = [
    {
        path: '/problem/:id',
        component: Panel,
        name: 'problem'
    },
    {
        path: '/',
        component: ProblemList,
        name: ''
    },
    {
        path: '/problems',
        component: ProblemList,
        name: 'problems'
    },
    {
        path: '/login',
        component: Login,
        name: 'login'
    },
    {
        path: '/register',
        component: Register,
        name: 'register'
    },
    {
        path: '/about-us',
        component: AboutUs,
        name: 'about-us'
    },
    {
        path: '/:pathMatch(.*)*',
        component: NotFound,
        name: 'notfound'
    }
]

export default createRouter({
    history: createWebHistory(),
    routes
})
