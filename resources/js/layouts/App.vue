<template>
    <div class="root">
        <div class="container">
            <section>
            </section>
            <div class="mb-5" style="text-align:center; margin-top: 5px;" v-if="this.isLoadingPage">
                <span class="loading"></span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                isLoadingPage: false,
            }
        },
        created() { },
        methods: { },
    }
</script>

<style scoped lang="scss">

</style>
