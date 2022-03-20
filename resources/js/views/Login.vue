<template>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6 col-lg-4">
                <form
                    @submit.prevent="signIn"
                    class="border rounded p-2 shadow"
                >
                    <h4>Acceso</h4>
                    <hr />
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo</label>
                        <input
                            type="email"
                            class="form-control"
                            id="email"
                            aria-describedby="emailHelp"
                            v-model="login.email"
                        />
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Clave</label>
                        <input
                            type="password"
                            class="form-control"
                            id="password"
                            v-model="login.password"
                        />
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Acceder
                    </button>
                </form>
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
            login: {
                email: "",
                password: "",
            },
        };
    },
    methods: {
        signIn() {
            axios
                .post(`${Global.url}login`, this.login)
                .then((response) => {
                    if (!response.data.data.error) {
                        axios.defaults.headers.common['Authorization'] = 'Bearer ' + response.data.data.token;
                        localStorage.setItem("token", response.data.data.token);
                        let user = response.data.data.user;
                        if (user.role == "administrativo") {
                            this.$router.push({ name: "admin-libros" });
                        } else if (user.role == "prestatario"){
                            this.$router.push({ name: "libros" });
                        }
                    } else {
                        swal.fire({
                            title: "Error",
                            text: response.data.data.message,
                            icon: "error",
                            confirmButtonText: "Ok",
                        });
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>
