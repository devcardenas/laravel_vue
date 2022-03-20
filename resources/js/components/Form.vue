<template>
    <form class="p-3 border">
        <h1>{{ titulo_form }}</h1>
        <div class="form-group">
            <label for="title">Título</label>
            <input
                type="text"
                class="form-control mt-2"
                id="title"
                v-model="book.title"
            />
        </div>
        <div class="form-group mt-2">
            <label for="author">Autor</label>
            <input
                type="text"
                class="form-control mt-2"
                id="author"
                v-model="book.author"
            />
        </div>
        <div class="form-group mt-2">
            <label for="description">Descripción</label>
            <textarea
                class="form-control mt-2"
                id="description"
                v-model="book.description"
                rows="5"
            ></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-3">
            {{ text_button }}
        </button>
    </form>
</template>

<script>
export default {
    props: ["book", "titulo_form", "text_button"],
};
</script>
