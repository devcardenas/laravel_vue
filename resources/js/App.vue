<template>
    <div>
        <router-view></router-view>
    </div>
</template>

<script>

import { Global } from "./Global.js";

export default {
    data() {
        return {
            Global,
        };
    },
};
</script>
