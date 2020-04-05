<template>
    <div>
        <h4 class="listing-title">Задачи</h4>

        <div v-if="todos.length > 0">
            <todo-list-item :todo="todo" :key="todo.id" v-for="todo in todos"></todo-list-item>

            <div class="text-center mb-3" v-if="visibleNextBtn && ! isLoadingTodos">
                <button class="btn btn-default btn-block" @click="getTodos">Загрузить ещё</button>
            </div>
        </div>

        <div v-if="todos.length === 0 && ! isLoadingTodos" class="text-center">
            <p>Список задач пуст.</p>
        </div>

        <button class="btn btn-success btn-block" @click="addTodo">
            Добавить задачу
        </button>

        <div class="mb-5 mt-1 text-center" v-if="isLoadingTodos">
            <span class="loading"></span>
        </div>

    </div>
</template>

<script>
    import axios from 'axios';
    import TodoListItem from "./TodoListItem";

    export default {
        name: "TodoList",
        components: {TodoListItem},
        data: function () {
            return {
                page: 1,
                perPage: 1,
                todosCount: 0,

                visibleNextBtn: false,

                todos: [],

                isLoadingTodos: false,
            }
        },
        mounted() {
            this.getTodos();
        },
        methods: {
            getTodos() {
                let endpoint = '/api/todos/get-by-user';
                let token = document.querySelector('meta[name="api-token"]').getAttribute('content');
                let data = {
                    'api_token': token,
                    'page': this.page,
                    'perPage': this.perPage,
                };

                this.isLoadingTodos = true;

                axios.get(endpoint, {
                    params: data
                })
                    .then((result => {
                        let items = result['data']['response']['items'];
                        let count = result['data']['response']['count'];

                        this.prepareTodos(items);

                        this.todosCount = count;
                        this.visibleNextBtn = this.todosCount > (this.page) * this.perPage;
                        this.page++;
                        this.isLoadingTodos = false;
                    }))
                    .catch(error => {
                        console.log('Error: ', error);
                    });
            },

            prepareTodos(todos){
                todos.forEach((item) => {
                    this.todos.push(item);
                });
            },

            addTodo() {
                this.$root.$emit('addTodo');
            },
        }
    }
</script>

<style scoped>

</style>