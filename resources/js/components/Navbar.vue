<template>
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-12">
                <nav
                    class="navbar navbar-expand-lg navbar-light border rounded"
                    style="background-color: #e3f2fd"
                >
                    <div class="container-fluid">
                        <router-link class="navbar-brand" :to="user && user.role == 'prestatario' ? '/libros' : '/admin/libros'">Biblioteca</router-link>
                        <button
                            class="navbar-toggler"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#navbarNav"
                            aria-controls="navbarNav"
                            aria-expanded="false"
                            aria-label="Toggle navigation"
                        >
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav" v-if="user && user.role == 'prestatario'">
                                <li class="nav-item">
                                    <router-link
                                        class="nav-link active"
                                        active-class="active"
                                        aria-current="page"
                                        to="/libros"
                                        >Libros</router-link
                                    >
                                </li>
                                <li class="nav-item">
                                    <router-link
                                        class="nav-link"
                                        active-class="active"
                                        to="/prestamos"
                                        >Mis prestamos</router-link
                                    >
                                </li>

                                <li class="nav-item">
                                    <button
                                        class="btn btn-link text-danger"
                                        active-class="active"
                                        @click="signOut"
                                    >
                                        Salir
                                    </button>
                                </li>
                            </ul>
                            <ul class="navbar-nav" v-if="user && user.role == 'administrativo'">
                                <li class="nav-item">
                                    <router-link
                                        class="nav-link active"
                                        active-class="active"
                                        aria-current="page"
                                        to="/admin/libros"
                                        >Libros</router-link
                                    >
                                </li>
                                <li class="nav-item">
                                    <router-link
                                        class="nav-link"
                                        active-class="active"
                                        to="/admin/libros/crear"
                                        >Nuevo libro</router-link
                                    >
                                </li>
                                <li class="nav-item">
                                    <router-link
                                        class="nav-link"
                                        active-class="active"
                                        to="/admin/prestamos"
                                        >Prestamos</router-link
                                    >
                                </li>


                                <li class="nav-item">
                                    <button
                                        class="btn btn-link text-danger"
                                        active-class="active"
                                        @click="signOut"
                                    >
                                        Salir
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { Global } from "../Global";

export default {
    data() {
        return {
            user: null,
            Global,
        };
    },
    created() {
        this.getUserInfo();
    },
    methods: {
        signOut() {
            axios
                .post(`${Global.url}logout`, {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem(
                            "token"
                        )}`,
                    },
                })
                .then((response) => {
                    localStorage.removeItem("token");
                    localStorage.removeItem("authenticated");
                    localStorage.removeItem("role");
                    this.$router.push("/");
                    this.user = null;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        /*hasPermissionTo(permission) {
            return this.user.permissions.includes(permission);
        },*/
        getUserInfo() {
            axios
                .get(`${Global.url}v1/user`, {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem(
                            "token"
                        )}`,
                    },
                })
                .then((response) => {
                    this.user = response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>
