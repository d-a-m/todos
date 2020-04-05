<template>
    <div class="linkBack">
        <span @click="goBackLink">
            <slot>« Назад</slot>
        </span>
    </div>
</template>

<script>
    import {managePanels} from "../lib/navigation";

    export default {
        name: "BackLink",
        methods: {
            goBackLink: function() {
                managePanels(this);
            },
        }
    }
</script>

<style scoped>
    .linkBack {
        text-align: center;
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .linkBack span {
        cursor: pointer;
    }
</style>