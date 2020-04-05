export function managePanels(that) {
    switch (that.$store.state.activePanel) {
        case "todo":
            that.$store.commit('setActivePanel', 'home');
            that.$store.commit('setLastActivePanel', 'todo');

            break;
    }
}
