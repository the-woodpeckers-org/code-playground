import Panel from "@/components/Panel.vue";
import ProblemList from "@/components/ProblemList.vue";
import {createRouter, createWebHistory} from "vue-router";

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
    }
]

export default createRouter({
    history: createWebHistory(),
    routes
})
