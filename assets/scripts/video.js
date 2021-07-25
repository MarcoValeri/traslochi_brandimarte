console.log(`Hello JavaScript`);

const videoPlayer = document.getElementById("video-player");
const video = videoPlayer.querySelector("#video");
const playButton = document.getElementById("play_button");

playButton.addEventListener("click", (e) => {

    if (video.paused == true) {
        video.play()
        e.target.textContent = "Pause";
    } else {
        video.pause()
        e.target.textContent = "Play";
    }

})