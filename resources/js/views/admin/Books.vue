<template>
    <Navbar class="mb-3"></Navbar>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Libros</h1>
                <div
                    class="table-responsive"
                    v-if="libros && libros.length > 0"
                >
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Título</th>
                                <th scope="col">Autor</th>
                                <th scope="col">Descripción</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="table-sm">
                            <tr v-for="libro in libros" :key="libro.id">
                                <th scope="row">{{ libro.title }}</th>
                                <td>{{ libro.author }}</td>
                                <td>{{ libro.description }}</td>
                                <td>
                                    <router-link
                                        class="btn btn-light border text-nowrap m-1"
                                        :to="{
                                            name: 'editar-libro',
                                            params: { id: libro.id },
                                        }"
                                        ><i class="bi bi-pencil-square"></i
                                    ></router-link>
                                    <button
                                        class="btn btn-light border text-nowrap m-1"
                                        @click="deleteLibro(libro.id)"
                                    >
                                        <i class="bi bi-trash text-danger"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div
                    v-else-if="libros && libros.length == 0"
                    class="text-center"
                >
                    <p>No hay libros para mostrar</p>
                </div>
                <div v-else class="d-flex justify-content-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Navbar from "../../components/Navbar.vue";
import axios from "axios";
import { Global } from "../../Global";

export default {
    components: {
        Navbar,
    },
    data() {
        return {
            libros: null,
        };
    },
    mounted() {
        this.getLibros();
    },
    methods: {
        getLibros() {
            axios
                .get(`${Global.url}v1/books`)
                .then((response) => {
                    this.libros = response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        deleteLibro(id) {
            // Pregunta si esta seguro de eliminar el libro
            Swal.fire({
                title: "Estas seguro?",
                text: "Una vez eliminado no podrás recuperarlo",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminar!",
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.value) {
                    axios
                        .delete(`${Global.url}v1/books/${id}`, {
                            headers: {
                                Authorization: `Bearer ${localStorage.getItem(
                                    "token"
                                )}`,
                            },
                        })
                        .then((response) => {
                            if (!response.data.data.error) {
                                Swal.fire({
                                    title: "Eliminado",
                                    text: response.data.data.message,
                                    icon: "success",
                                    confirmButtonText: "Ok",
                                });
                                this.getLibros();
                            } else {
                                Swal.fire({
                                    title: "Error",
                                    text: response.data.data.message,
                                    icon: "error",
                                    confirmButtonText: "Ok",
                                });
                            }
                        })
                        .catch((response) => {
                            console.log(response.data.data.message);
                        });
                }
            });
        },
    },
};
</script>
