import { createRouter, createWebHistory } from "vue-router";

const routes = [
    { path: "/", component: () => import("../Pages/HomePage.vue")},
    { path: "/login", component: () => import("../Pages/HomePage.vue")},
    { path: "/test", component: () => import("../Pages/Test.vue")},
    { path: "/dashboard", component: () => import("../Pages/Admin/Dashboard.vue"), meta: { requiresAuth: true } },
    { 
        path: "/parameter", 
        component: () => import("../Pages/Admin/Parameter/Home.vue"), 
        meta: { requiresAuth: true },
        children: [
            { path: "pemda", component: () => import("../Pages/Admin/Parameter/Pemda.vue"), meta: { requiresAuth: true} }, 
            { path: "kecamatan/:kdProv/:kdKab", component: () => import("../Pages/Admin/Parameter/Kecamatan.vue"), meta: { requiresAuth: true} }, 
            { path: "desa/:kdProv/:kdKab/:kdKec", component: () => import("../Pages/Admin/Parameter/Desa.vue"), meta: { requiresAuth: true} }, 
            { path: "bidang", component: () => import("../Pages/Admin/Parameter/Bidang.vue"), meta: { requiresAuth: true} }, 
            { path: "subbidang/:kdBidang", component: () => import("../Pages/Admin/Parameter/Subbidang.vue"), meta: { requiresAuth: true} }, 
            { path: "kegiatan/:kdBidang/:kdSubbidang", component: () => import("../Pages/Admin/Parameter/Kegiatan.vue"), meta: { requiresAuth: true} }, 
            { path: "sumberdana", component: () => import("../Pages/Admin/Parameter/Sumberdana.vue"), meta: { requiresAuth: true} }, 
        ]
    },


    { path: "/:notFound", component: () => import("../Pages/NotFound.vue")},
    { path: "/:pathMatch(.*)*", component: () => import("../Pages/NotFound.vue")},
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

// Middleware untuk proteksi rute
router.beforeEach((to, from, next) => {
    const isAuthenticated = localStorage.getItem('token');
    if (to.meta.requiresAuth && !isAuthenticated) {
        next('/login');
    } else {
        next();
    }
});

export default router;