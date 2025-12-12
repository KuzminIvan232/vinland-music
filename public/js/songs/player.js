import { formatTime } from '../functions/formatTime.js';

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
        pbTrack.play()
        playBtn.textContent = 'Pause';
    } else {
        pbTrack.pause()
        playBtn.textContent = 'Play';
    }
});

pbTrack.addEventListener('ended', () => {
    playBtn.textContent = 'Play';
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
})

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

     console.log(trackList);

    const track = trackList[index];
    pbTrack.src = track.src;
    pbTitle.textContent = track.title;
    pbArtist.textContent = track.artist;
    pbTrack.play();
    playBtn.textContent = 'Pause';
    localStorage.setItem('currentTrack', JSON.stringify(track));
    currentIndex = index;
}