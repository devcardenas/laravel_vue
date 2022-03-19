<template>
    <Navbar class="mb-3"></Navbar>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Mis prestamos</h1>
                <table
                    class="table table-bordered"
                    v-if="prestamos && prestamos.length > 0"
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
                        <tr
                            v-for="prestamo in prestamos"
                            :key="prestamo.book_id"
                        >
                            <th scope="row">{{ prestamo.book.title }}</th>
                            <td>{{ prestamo.book.author }}</td>
                            <td>{{ prestamo.book.description }}</td>
                            <td>
                                <button
                                    class="btn alert-info border btn-sm text-nowrap"
                                    @click="regresarLibro(prestamo.book_id)"
                                >
                                    <i
                                        class="bi bi-arrow-counterclockwise me-2"
                                    ></i
                                    >Regresar
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div
                    v-else-if="prestamos && prestamos.length == 0"
                    class="text-center"
                >
                    <p>No hay prestamos actualmente</p>
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
            prestamos: null,
        };
    },
    mounted(){
        this.getPrestamos();
    },
    methods: {
        getPrestamos() {
            axios
                .get(`${Global.url}v1/loans`, {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem(
                            "token"
                        )}`,
                    },
                })
                .then((response) => {
                    this.prestamos = response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        regresarLibro(book_id) {
            axios({
                method: "put",
                url: `${Global.url}v1/loans/${book_id}`,
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`,
                },
            })
                .then((response) => {
                    this.getPrestamos();
                    Swal.fire("¡Bien!", response.data.data.message, "success");
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>
