<template>
    <Navbar class="mb-3"></Navbar>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <!-- Form for edit a bok -->
                <Form
                    @submit.prevent="editBook"
                    v-if="book && book.title != null"
                    :titulo_form="'Editar libro'"
                    :text_button="'Actualizar'"
                    :book="book"
                ></Form>
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
import Form from "../../components/Form.vue";
import axios from "axios";
import { Global } from "../../Global";

export default {
    components: {
        Form,
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
                .put(
                    `${Global.url}v1/books/${this.$route.params.id}`,
                    this.book
                )
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
                    if (error.response) {
                        let errors = error.response.data.errors;
                        let message = "";
                        for (let error in errors) {
                            message +=
                                '<i class="bi bi-x me-2 text-danger"></i>' +
                                errors[error][0] +
                                "<br>";
                        }
                        swal.fire({
                            title: "Error",
                            html: message,
                            icon: "error",
                            confirmButtonText: "Ok",
                        });
                    }
                });
        },
    },
};
</script>
