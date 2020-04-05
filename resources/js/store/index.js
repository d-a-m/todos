import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {

        activePanel: 'home',
        lastActivePanel: '',

        todo: {},
        todos: [],

    },

    getters: { },

    mutations: {
        setActivePanel(state, panel) {
            state.activePanel = panel;
        },

        setLastActivePanel(state, panel) {
            state.lastActivePanel = panel;
        },

        setTodo(state, todo) {
            state.todo = todo;
        },

        setTodos(state, todos) {
            if (todos.length === 0) {
                state.todos.words = [];
            }

            todos.forEach(function (item) {
                state.todos.push(item);
            });
        },
    },

    actions: { },
});