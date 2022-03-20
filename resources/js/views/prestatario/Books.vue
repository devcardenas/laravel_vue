<template>
    <Navbar class="mb-3"></Navbar>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Libros</h1>
                <table
                    class="table table-bordered"
                    v-if="libros && libros.length > 0"
                >
                    <thead>
                        <tr>
                            <th scope="col">Titulo</th>
                            <th scope="col">Autor</th>
                            <th scope="col">Descripcion</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="table-sm">
                        <tr v-for="libro in libros" :key="libro.id">
                            <th scope="row">{{ libro.title }}</th>
                            <td>{{ libro.author }}</td>
                            <td>{{ libro.description }}</td>
                            <td>
                                <button
                                    class="btn alert-success btn-sm text-nowrap"
                                    v-if="!libro.borrowed"
                                    @click="pedirLibroPrestado(libro.id)"
                                >
                                    <i class="bi bi-check2-circle me-2"></i
                                    >Pedir
                                </button>
                                <small v-else>No disponible</small>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
                .get(`${Global.url}v1/books`, {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem(
                            "token"
                        )}`,
                    },
                })
                .then((response) => {
                    this.libros = response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        pedirLibroPrestado(book_id) {
            axios
                .post(`${Global.url}v1/loans`, {
                    book_id,
                })
                .then((response) => {
                    this.getLibros();
                    Swal.fire("¡Bien!", response.data.data.message, "success");
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>
