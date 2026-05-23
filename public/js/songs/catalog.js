import { formatTime } from '../functions/formatTime.js';
import { saveRecentlyPlayed } from '../functions/recentlyPlayed.js';

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
        pbTrack.play();
        playBtn.innerHTML = '<svg style="display: flex; justify-content: center; align-items: center" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="black" viewBox="0 0 24 24">\n' +
            '                       <path d="M8 5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H8Zm7 0a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1Z" clip-rule="evenodd"/>\n' +
            '                </svg>\n';

        localStorage.setItem('currentTrack', JSON.stringify({ src, title, artist }));
        saveRecentlyPlayed({ src, title, artist });
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