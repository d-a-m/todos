<template>
    <div>
        <div class="row mb-4">
            <div class="col todo-item-list">
                <div v-if="! is_delegated">
                    <h5>{{ this.todo.title }}</h5>

                    <p class="text-muted mb-0">Описание задачи:</p>
                    <p>{{ this.todo.description }}</p>

                    <p class="text-muted mb-0 mt-3">Дата создания:</p>
                    <p class="small">{{ this.todo.created_at }}</p>

                    <p class="text-muted mb-0 mt-3">Дата обновления:</p>
                    <p class="small">{{ this.todo.updated_at }}</p>

                    <div v-if="! userLoading && ! is_delegated">
                        <p class="mb-0 mt-3">Делегировать задачу</p>
                        <select name="users" class="form-control">
                            <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }} #{{ user.id }}</option>
                        </select>

                        <button class="btn btn-default btn-block mt-3" @click="delegateTodo">
                            Делегировать
                        </button>
                    </div>

                </div>

                <div v-if="is_delegated">
                    <div class="alert alert-success">
                        <p>Задача успешно делегирована!</p>
                        <p class="small mb-0">Через 3 секунды вернёмся к списку задач.</p>
                    </div>
                </div>

                <back-link></back-link>

                <div class="mb-5 mt-1 text-center" v-if="userLoading">
                    <span class="loading"></span>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import BackLink from "./BackLink";

    export default {
        name: "TodoItem",
        components: {BackLink},
        data() {
            return {
                todo: '',
                users: [],

                userLoading: false,
                is_delegated: false
            }
        },
        mounted() {
            this.todo = this.$store.state.todo;
            this.getUsers();
        },
        methods: {
            getUsers() {
                let endpoint = '/api/users/get-all';
                let token = document.querySelector('meta[name="api-token"]').getAttribute('content');
                let data = {
                    'api_token': token,
                };

                this.userLoading = true;

                axios.get(endpoint, {
                    params: data
                })
                    .then((result => {
                        let items = result['data']['response']['items'];

                        items.forEach(item => {
                            this.users.push(item);
                        });

                        this.userLoading = false;
                    }))
                    .catch(error => {
                        console.log('Error: ', error);
                    });
            },

            delegateTodo: function () {
                let endpoint = '/api/todos/delegate-todo';
                let token = document.querySelector('meta[name="api-token"]').getAttribute('content');
                let usersInput = document.querySelector('select[name="users"]');
                let userTo = usersInput.options[usersInput.selectedIndex].value;

                let data = {
                    'api_token': token,
                    'user_to': userTo,
                    'todo_id': this.$store.state.todo.id,
                };

                this.userLoading = true;

                axios.put(endpoint, data)
                    .then((result => {
                        let is_delegated = result['data']['response']['is_delegated'];
                        this.is_delegated = !!is_delegated;
                        this.userLoading = false;

                        if (is_delegated) {
                            setTimeout(() => {
                                this.$store.commit('setLastActivePanel', 'todo');
                                this.$store.commit('setActivePanel', 'home');
                            }, 3000);
                        }

                    }))
                    .catch(error => {
                        console.log('Error: ', error);
                    });
            }
        }
    }
</script>

<style scoped>

</style>