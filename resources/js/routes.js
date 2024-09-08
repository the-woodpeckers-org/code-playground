import {createRouter, createWebHistory} from "vue-router";
import Panel from "@/components/Panel.vue";
import ProblemList from "@/components/ProblemList.vue";
import Login from "@/components/authentication/Login.vue";
import Register from "@/components/authentication/Register.vue";

const routes = [
    {
        path: '/problem/:id',
        component: Panel,
        name: 'problem'
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
    }
]

export default createRouter({
    history: createWebHistory(),
    routes
})
