import { createRouter, createWebHistory } from "vue-router";
import Home from "../components/Home.vue";

const routes = [
  { path: "/", name: "Home", component: Home },
  {
    path: "/login",
    name: "Login",
    component: () => import("../components/Login.vue"),
  },
  {
    path: "/register",
    name: "Register",
    component: () => import("../components/Register.vue"),
  },
  {
    path: "/forgot-password",
    name: "ForgotPassword",
    component: () => import("../components/ForgotPassword.vue"),
  },
  {
    path: "/password-reset/:token",
    name: "ResetPassword",
    component: () => import("../components/ResetPassword.vue"),
  },
  {
    path: "/contact/create",
    name: "AddContact",
    component: () => import("../components/contact/AddContact.vue"),
  },
  {
    path: "/contact/list",
    name: "ContactList",
    component: () => import("../components/contact/ContactList.vue"),
  },
  {
    path: "/contact/edit/:id?",
    name: "EditContact",
    component: () => import("../components/contact/EditContact.vue"),
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});


export default router;
