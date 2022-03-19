<template>
    <Navbar class="mb-3"></Navbar>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <!-- Form for edit a bok -->
                <form @submit.prevent="editBook" v-if="book && book.title != null">
                    <h1>Editar libro</h1>
                    <div class="form-group">
                        <label for="title">Título</label>
                        <input
                            type="text"
                            class="form-control"
                            id="title"
                            v-model="book.title"
                        />
                    </div>
                    <div class="form-group">
                        <label for="author">Autor</label>
                        <input
                            type="text"
                            class="form-control"
                            id="author"
                            v-model="book.author"
                        />
                    </div>
                    <div class="form-group">
                        <label for="description">Descripción</label>
                        <textarea
                            class="form-control"
                            id="description"
                            v-model="book.description"
                            rows="5"
                        ></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">
                        Actualizar
                    </button>
                </form>
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
            book: {
                title: null,
                author: null,
                description: null,
            },
        };
    },
    mounted() {
        this.getBook();
    },
    methods: {
        getBook() {
            axios
                .get(`${Global.url}v1/books/${this.$route.params.id}`)
                .then((response) => {
                    this.book.title = response.data.data.book.title;
                    this.book.author = response.data.data.book.author;
                    this.book.description = response.data.data.book.description;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        editBook() {
            axios
                .put(`${Global.url}v1/books/${this.$route.params.id}`, this.book)
                .then((response) => {
                    if (!response.data.data.error) {
                        Swal.fire({
                            title: "Editado",
                            text: response.data.data.message,
                            icon: "success",
                            confirmButtonText: "Ok",
                        });
                        this.$router.push({ name: "admin-libros" });
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
                    swal.fire({
                            title: "Error",
                            text: error.data.data.message,
                            icon: "error",
                            confirmButtonText: "Ok",
                        });
                });
        },
    },
};
</script>
