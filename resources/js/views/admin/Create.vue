<template>
    <Navbar class="mb-3"></Navbar>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <!-- Form for edit a bok -->
                <Form
                    @submit.prevent="createBook"
                    v-if="book"
                    :titulo_form="'Nuevo libro'"
                    :text_button="'Crear libro'"
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
    methods: {
        createBook() {
            axios
                .post(`${Global.url}v1/books`, this.book)
                .then((response) => {
                    if (!response.data.data.error) {
                        Swal.fire({
                            title: "Creado",
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
                    console.log(response);
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
