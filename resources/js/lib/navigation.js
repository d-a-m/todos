export function managePanels(that) {
    switch (that.$store.state.activePanel) {
        case "todo":
            that.$store.commit('setActivePanel', 'home');
            that.$store.commit('setLastActivePanel', 'todo');

            break;

        case "todo-edit":
            that.$store.commit('setActivePanel', 'todo');
            that.$store.commit('setLastActivePanel', 'todo-edit');

            break;

        case "todo-add":
            that.$store.commit('setActivePanel', 'home');
            that.$store.commit('setLastActivePanel', 'todo-add');

            break;
    }
}
