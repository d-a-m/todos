import {heightIFrame, loadScrollPosition, saveScrollPosition} from "./utils";

export function managePanels(that) {
    const decrementHistoryDepth = function () {
        let depth = that.$store.state.historyDepth - 1;
        that.$store.commit('setHistoryDepth', depth);
    };

    switch (that.$store.state.activePanel) {

    }
}

export function manageScrollPosition(store, type) {
    let activePanel = store.state.activePanel;

    if (type === 'load') {
        loadScrollPosition(activePanel);
    }

    if (type === 'save') {
        saveScrollPosition(activePanel);
    }
}