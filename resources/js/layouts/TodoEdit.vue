<template>
    <div>
        <div class="row mb-4">
            <div class="col todo-item-list">
                <div v-if="! is_edited">
                    <h5>Редактировать задачу</h5>

                    <p class="text-muted mb-0">Название задачи:</p>
                    <input id="title" class="form-control" :value="this.todo.title">

                    <p class="text-muted mb-0 mt-3">Описание задачи:</p>
                    <textarea id="description" class="form-control">{{ this.todo.description }}</textarea>

                    <button class="btn btn-default btn-block mt-3" v-if="! loading" @click="editTodo">
                        Отредактировать
                    </button>
                </div>

                <div v-if="is_edited">
                    <div class="alert alert-success">
                        <p>Задача успешно отредактирована!</p>
                        <p class="small mb-0">Через 3 секунды вернёмся к списку задач.</p>
                    </div>
                </div>

                <div class="mb-5 mt-1 text-center" v-if="loading">
                    <span class="loading"></span>
                </div>

                <back-link></back-link>

            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import BackLink from "../components/BackLink";

    export default {
        name: "TodoEdit",
        components: {BackLink},
        data() {
            return {
                todo: {},

                loading: false,
                is_edited: false,
            }
        },
        mounted() {
            this.todo = this.$store.state.todo;
        },
        methods: {
            editTodo() {
                let endpoint = '/api/todos/edit';
                let token = document.querySelector('meta[name="api-token"]').getAttribute('content');

                let title = document.querySelector('#title').value;
                let description = document.querySelector('#description').value;

                let data = {
                    'api_token': token,
                    'title': title,
                    'description': description,
                    'todo_id': this.todo.id,
                };

                this.loading = true;

                axios.patch(endpoint, data)
                    .then((result => {
                        let is_edited = result['data']['response']['is_edited'];
                        this.is_edited = !!is_edited;

                        if (is_edited) {
                            setTimeout(() => {
                                this.$store.commit('setLastActivePanel', 'todo-edit');
                                this.$store.commit('setActivePanel', 'home');
                            }, 3000);
                        }

                    })).catch(error => {
                        console.log('Error: ', error);
                    }).finally(() => {
                        this.loading = false;
                    });
            }
        }
    }
</script>

<style scoped>

</style>