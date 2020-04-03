export function today() {
    let d = new Date();
    let monthA = 'января,февраля,марта,апреля,мая,июня,июля,августа,сентября,октября,ноября,декабря'.split(',');
    return new Date().getDate() + ' ' + monthA[d.getMonth()];
}

export function saveScrollPosition(key) {
    sessionStorage[key] = (window.pageYOffset || document.scrollTop) - (document.clientTop || 0);
}

export function loadScrollPosition(key) {
    if (key && sessionStorage[key]) {
        window.scrollTo(0, sessionStorage[key]);
    } else {
        window.scrollTo(0, 0);
    }
}

export function clearScrollPosition(key) {
    if (sessionStorage[key]) {
        sessionStorage[key] = 0;
    }
}

export function getNumEnding(iNumber, aEndings) {
    let sEnding, i;
    iNumber = iNumber % 100;
    if (iNumber >= 11 && iNumber <= 19) {
        sEnding = aEndings[2];
    } else {
        i = iNumber % 10;
        switch (i) {
            case (1):
                sEnding = aEndings[0];
                break;
            case (2):
            case (3):
            case (4):
                sEnding = aEndings[1];
                break;
            default:
                sEnding = aEndings[2];
        }
    }
    return sEnding;
}

export function updateHistory(hash, that) {
    let depth = that.$store.state.historyDepth + 1;

    // console.log('Увеличиваем историю: ' + depth);

    that.$store.commit('setHistoryDepth', depth);
    history.pushState(null, null, hash);
}

export function numberWithSpace(x) {
    let parts = x.toString().replace(".", ",").split(",");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, " ");
    return parts.join(",");
}

export function strippedString (str, count){
    if(str.length > count) {
        return str.slice(0, count - 1) + '...';
    }
    return str;
}