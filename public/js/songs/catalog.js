import { formatTime } from '../functions/formatTime.js';

const tracks = document.querySelectorAll('.track');
const pbTrack = document.querySelector('.pb-track');
const playBtn = pbTrack.parentElement.querySelector('.play-btn');
const pbTitle = document.querySelector('.pb-title');
const pbArtist = document.querySelector('.pb-artist');

const trackList = [...tracks].map((track) => ({
    src: track.dataset.src,
    title: track.dataset.title,
    artist: track.dataset.artist,
}));

localStorage.setItem('trackList', JSON.stringify(trackList));

tracks.forEach((track) => {
    track.addEventListener('click', () => {
        const src = track.dataset.src;
        const title = track.dataset.title;
        const artist = track.dataset.artist;
        pbTrack.src = src;
        pbTitle.textContent = title;
        pbArtist.textContent = artist;
        playBtn.textContent = 'Pause';
        pbTrack.play();

        localStorage.setItem('currentTrack', JSON.stringify({ src, title, artist }));
    });

});

tracks.forEach(track => {
    const src = track.dataset.src;
    const audio = new Audio(src);

    audio.addEventListener('loadedmetadata', () => {
        const duration = audio.duration;
        const durationEl = track.querySelector('.duration');
        durationEl.textContent = formatTime(duration);
    });
});