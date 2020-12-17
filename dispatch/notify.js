let madeCallNotify = false;
// let madeBoloNotify = false;
function notifyCall() {
    if (madeCallNotify == false) {
        var audio = new Audio('../assets/audio/newCall.mp3');
        audio.volume = 0.2;
        audio.play();
        madeCallNotify = true
    }
}

function resetNotify() {
    madeCallNotify = false
}

// function notifyBoloCall() {
//     if (madeBoloNotify == false) {
//         var audio = new Audio('../assets/audio/newBolo.mp3');
//         audio.volume = 0.2;
//         audio.play();
//         madeBoloNotify = true
//     }
// }

// function resetBoloNotify() {
//     madeBoloNotify = false
// }