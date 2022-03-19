<template>
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-12">
                <nav
                    class="navbar navbar-expand-lg navbar-light border rounded"
                    style="background-color: #e3f2fd"
                >
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">Biblioteca</a>
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
                            <ul class="navbar-nav" v-if="user">
                                <li
                                    class="nav-item"
                                    v-if="
                                        hasPermissionTo('view_books') &&
                                        hasPermissionTo('borrow_books')
                                    "
                                >
                                    <router-link
                                        class="nav-link active"
                                        active-class="active"
                                        aria-current="page"
                                        to="/libros"
                                        >Libros</router-link
                                    >
                                </li>
                                <li
                                    class="nav-item"
                                    v-if="hasPermissionTo('return_books_loans')"
                                >
                                    <router-link
                                        class="nav-link"
                                        active-class="active"
                                        to="prestamos"
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
        this.getPermissions();
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
                    localStorage.removeItem("user");
                    this.$router.push("/");
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        getPermissions() {
            axios
                .get(`${Global.url}v1/user/permissions`, {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem(
                            "token"
                        )}`,
                    },
                })
                .then((response) => {
                    this.user = response.data.data;
                    // recorremos los permisos y si el nombre del permiso contiene la cadena de texto que pasamos por parametro entonces retornamos true
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        hasPermissionTo(permission) {
            return this.user.permissions.includes(permission);
        },
    },
};
</script>
