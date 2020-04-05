<template>
    <div class="root">
        <div class="container">

            <section v-if="checkPanel('home')">
                <todo-list></todo-list>
            </section>

            <section v-if="checkPanel('todo')">
                <todo-item></todo-item>
            </section>

            <section v-if="checkPanel('todo-add')">
                <todo-add></todo-add>
            </section>

            <section v-if="checkPanel('todo-edit')">
                <todo-edit></todo-edit>
            </section>

            <div class="mb-5 mt-1 text-center" v-if="this.isLoadingPage">
                <span class="loading"></span>
            </div>

        </div>
    </div>
</template>

<script>
    import TodoList from "./TodoList";
    import TodoItem from "./TodoItem";
    import TodoAdd from "./TodoAdd";
    import TodoEdit from "./TodoEdit";
    export default {
        components: {TodoEdit, TodoAdd, TodoItem, TodoList},
        data: function () {
            return {
                isLoadingPage: false,
            }
        },
        created() { },
        mounted() {
            this.$root.$on('showTodo', (data) => {
                this.showTodo(data);
            });

            this.$root.$on('addTodo', () => {
                this.addTodo();
            });

            this.$root.$on('editTodo', (data) => {
                this.editTodo(data);
            });
        },
        methods: {
            checkPanel(panel) {
                return this.$store.state.activePanel === panel && this.isLoadingPage === false;
            },

            showTodo: function (data) {
                this.$store.commit('setLastActivePanel', 'home');
                this.$store.commit('setActivePanel', 'todo');
                this.$store.commit('setTodo', data['data']);
            },

            editTodo: function (data) {
                this.$store.commit('setLastActivePanel', 'home');
                this.$store.commit('setActivePanel', 'todo-edit');
                this.$store.commit('setTodo', data['data']);
            },

            addTodo: function () {
                this.$store.commit('setLastActivePanel', 'home');
                this.$store.commit('setActivePanel', 'todo-add');
            },
        },
    }
</script>

<style scoped lang="scss">

</style>
