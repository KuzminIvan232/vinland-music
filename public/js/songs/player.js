import { formatTime } from '../functions/formatTime.js';
import { saveRecentlyPlayed } from '../functions/recentlyPlayed.js';

const pbTrack = document.querySelector('.pb-track');
const playBtn = pbTrack.parentElement.querySelector('.play-btn');
const prevBtn = pbTrack.parentElement.querySelector('.prev-btn');
const nextBtn = pbTrack.parentElement.querySelector('.next-btn');
const seekBar = pbTrack.parentElement.querySelector('.seek-bar');
const currentTime = pbTrack.parentElement.querySelector('.pb-current-time');
const pbDuration = pbTrack.parentElement.querySelector('.pb-duration');
const pbTitle = document.querySelector('.pb-title');
const pbArtist = document.querySelector('.pb-artist');

let currentIndex = 0;
let isSeeking = false;

const trackList = JSON.parse(localStorage.getItem('trackList')) || [];
const savedTrack = JSON.parse(localStorage.getItem('currentTrack'));
if (savedTrack) {
    pbTrack.src = savedTrack.src;
    pbTitle.textContent = savedTrack.title;
    pbArtist.textContent = savedTrack.artist;

    currentIndex = trackList.findIndex(track => track.src === savedTrack.src);
}

prevBtn.addEventListener('click', () => {
    playTrack(currentIndex - 1);
});

nextBtn.addEventListener('click', () => {
    playTrack(currentIndex + 1);
});

playBtn.addEventListener('click', () => {
    if (pbTrack.paused) {
        pbTrack.play();
        if (savedTrack || trackList[currentIndex]) {
            const track = trackList[currentIndex] || savedTrack;
            saveRecentlyPlayed({ src: track.src, title: track.title, artist: track.artist });
        }
        playBtn.innerHTML = '<svg style="display: flex; justify-content: center; align-items: center" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="black" viewBox="0 0 24 24">\n' +
            '                       <path d="M8 5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H8Zm7 0a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1Z" clip-rule="evenodd"/>\n' +
            '                </svg>\n';
    } else {
        pbTrack.pause();
        playBtn.innerHTML = '<svg style="display: flex; justify-content: center; align-items: center; position: relative; left: 2px" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="black" viewBox="0 0 24 24">\n' +
            '                       <path d="M8.6 5.2A1 1 0 0 0 7 6v12a1 1 0 0 0 1.6.8l8-6a1 1 0 0 0 0-1.6l-8-6Z" clip-rule="evenodd"/>\n' +
            '                </svg>';
    }
});

pbTrack.addEventListener('ended', () => {
    playBtn.innerHTML = '<svg style="display: flex; justify-content: center; align-items: center; position: relative; left: 2px" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="black" viewBox="0 0 24 24">\n' +
        '                       <path d="M8.6 5.2A1 1 0 0 0 7 6v12a1 1 0 0 0 1.6.8l8-6a1 1 0 0 0 0-1.6l-8-6Z" clip-rule="evenodd"/>\n' +
        '                </svg>';
    seekBar.value = 0;
    pbTrack.currentTime = 0;
});

pbTrack.addEventListener('loadedmetadata', () => {
    pbDuration.textContent = formatTime(pbTrack.duration);
});

pbTrack.addEventListener('timeupdate', () => {
    if (!isSeeking) {
        seekBar.value = (pbTrack.currentTime / pbTrack.duration) * 100;
        currentTime.textContent = formatTime(pbTrack.currentTime);
    }
});

seekBar.addEventListener('mousedown', () => {
    isSeeking = true;
});

seekBar.addEventListener('mouseup', () => {
    pbTrack.currentTime = (seekBar.value / 100) * pbTrack.duration;
    isSeeking = false;
});

seekBar.addEventListener('input', () => {
    currentTime.textContent = formatTime((seekBar.value / 100) * pbTrack.duration);
});

function playTrack(index) {
    if (index < 0) index = trackList.length - 1;
    if (index >= trackList.length) index = 0;

    const track = trackList[index];
    pbTrack.src = track.src;
    pbTitle.textContent = track.title;
    pbArtist.textContent = track.artist;
    pbTrack.play();
    playBtn.innerHTML = '<svg style="display: flex; justify-content: center; align-items: center" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="black" viewBox="0 0 24 24">\n' +
        '                       <path d="M8 5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H8Zm7 0a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1Z" clip-rule="evenodd"/>\n' +
        '                </svg>\n';
    localStorage.setItem('currentTrack', JSON.stringify(track));
    saveRecentlyPlayed({ src: track.src, title: track.title, artist: track.artist });
    currentIndex = index;
}