import {createRouter, createWebHistory} from "vue-router";
const CodePanel = () => import("@/components/pages/CodePanel.vue");
const Landing = () => import("@/components/pages/Landing.vue");
const Login = () => import("@/components/authentication/Login.vue");
const Register = () => import("@/components/authentication/Register.vue");
const NotFound = () => import("@/components/errors/NotFound.vue");
const AboutUs = () => import("@/components/pages/AboutUs.vue");
const Explore = () => import("@/components/pages/Explore.vue");
const Contests = () => import("@/components/pages/Contests.vue");
const Courses = () => import("@/components/pages/Courses.vue");
const Challenges = () => import("@/components/pages/Challenges.vue");
const Problems = () => import("@/components/pages/Problems.vue");
const Career = () => import("@/components/pages/Career.vue")
const Profile = () => import("@/components/pages/Profile.vue")

const routes = [
    {
        path: '/problem/:id',
        component: CodePanel,
        name: 'problem'
    },
    {
        path: '/',
        component: Landing,
        name: 'landing'
    },
    {
        path: '/landing',
        component: Landing,
        name: 'landing-problems'
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
        path: '/explore',
        component: Explore,
        name: 'explore'
    },
    {
        path: '/contests',
        component: Contests,
        name: 'contest'
    },
    {
        path: '/courses',
        component: Courses,
        name: 'courses'
    },
    {
        path: '/challenges',
        component: Challenges,
        name: 'challenges'
    },
    {
        path: '/problems',
        component: Problems,
        name: 'problems'
    },
    {
        path: '/career',
        component: Career,
        name: 'career'
    },
    {
        path: '/profile',
        component: Profile,
        name: 'profile'
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
