const tracks = document.querySelectorAll('.track');

tracks.forEach((track) => {
    const playPauseBtn = track.parentElement.querySelector('.play-pause-btn');
    const seekBar = track.parentElement.querySelector('.seek-bar');
    const currentTime = track.parentElement.querySelector('.current-time');
    const duration = track.parentElement.querySelector('.duration');

    track.addEventListener('play', () => {
        tracks.forEach((a) => {
            if (a !== track) {
                a.pause()
                a.currentTime = 0;
            }
        });
    });

    track.addEventListener('loadedmetadata', () => {
        duration.textContent = formatTime(track.duration);
    });

    playPauseBtn.addEventListener('click', () => {
        if (track.paused) {
            track.play()
            playPauseBtn.textContent = 'Pause';
        } else {
            track.pause()
            playPauseBtn.textContent = 'Play';
        }
    });

    track.addEventListener('timeupdate', () => {
        seekBar.value = (track.currentTime / track.duration) * 100;
        currentTime.textContent = formatTime(track.currentTime);
    });

    seekBar.addEventListener('input', () => {
        track.currentTime = (seekBar.value / 100) * track.duration;
    });
})

function formatTime(seconds) {
    const m = Math.floor(seconds / 60);
    const s = Math.floor(seconds % 60);
    return `${m}:${s < 10 ? '0' : ''}${s}`;
}

