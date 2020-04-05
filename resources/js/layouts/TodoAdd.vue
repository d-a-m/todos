<template>
    <div>
        <div class="row mb-4">
            <div class="col todo-item-list">
                <div v-if="! is_added">
                    <h5>Новая задача</h5>

                    <p class="text-muted mb-0">Название задачи:</p>
                    <input id="title" class="form-control">

                    <p class="text-muted mb-0 mt-3">Описание задачи:</p>
                    <textarea id="description" class="form-control"></textarea>

                    <button class="btn btn-default btn-block mt-3" v-if="! loading" @click="addTodo">
                        Добавить
                    </button>
                </div>

                <div v-if="is_added">
                    <div class="alert alert-success">
                        <p>Задача успешно добавлена!</p>
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
        name: "TodoAdd",
        components: {BackLink},
        data() {
            return {
                loading: false,
                is_added: false,
            }
        },
        methods: {
            addTodo() {
                let endpoint = '/api/todos/add';
                let token = document.querySelector('meta[name="api-token"]').getAttribute('content');

                let title = document.querySelector('#title').value;
                let description = document.querySelector('#description').value;

                let data = {
                    'api_token': token,
                    'title': title,
                    'description': description,
                };

                this.loading = true;

                axios.post(endpoint, data)
                    .then((result => {
                        let is_added = result['data']['response']['is_added'];
                        this.is_added = !!is_added;
                        this.loading = false;

                        if (is_added) {
                            setTimeout(() => {
                                this.$store.commit('setLastActivePanel', 'todo-add');
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