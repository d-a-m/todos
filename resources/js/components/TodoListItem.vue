<template>
    <div>
        <div class="row mb-4">
            <div class="col todo-item-list" @click="clickTodo(todo)">
                <h5>{{ todo.title }}</h5>

                <div>
                    {{ strippedString(todo.description, 100) }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { strippedString } from "../lib/utils";

    export default {
        name: "TodoListItem",
        props: ['todo'],
        methods: {
            clickTodo(todo) {
                this.$root.$emit('showTodo', {
                    data: todo
                });
            },

            strippedString(string, length) {
                return strippedString(string, length)
            }
        }
    }
</script>

<style scoped lang="scss">
    .todo-item-list {
        cursor: pointer;
    }

</style>