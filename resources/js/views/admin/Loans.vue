<template>
    <Navbar class="mb-3"></Navbar>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Libros en prestamo</h1>
                <div class="table-responsive" v-if="loans && loans.length > 0">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Usuario</th>
                                <th scope="col">Libro</th>
                                <th scope="col">Fecha de prestamo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="loan in loans" :key="loan">
                                <td scope="row">
                                    <p class="m-0">
                                        <strong>Email:</strong>
                                        {{ loan.user.email }}
                                    </p>
                                    <p class="m-0">
                                        <strong>Nombre:</strong>
                                        {{ loan.user.name }}
                                    </p>
                                </td>
                                <td scope="row">{{ loan.book.title }}</td>
                                <td scope="row">{{ formatDate(loan.created_at) }}</td>
                            </tr>
                        </tbody>
                    </table>
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
import moment from "moment";

export default {
    components: {
        Navbar,
    },
    data() {
        return {
            loans: null,
        };
    },
    mounted() {
        this.getLoans();
    },
    methods: {
        getLoans() {
            axios
                .get(`${Global.url}v1/admin/loans`)
                .then((response) => {
                    this.loans = response.data.data.books;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        formatDate(date) {
            moment.locale("es");
            return moment(date).format('L') + ", " + moment(date).format('h:mm a');
        },
    },
};
</script>
