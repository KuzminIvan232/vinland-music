import { formatTime } from '../functions/formatTime.js';
import { getRecentlyPlayed } from '../functions/recentlyPlayed.js';

const pbTrack = document.querySelector('.pb-track');
const playBtn = pbTrack.parentElement.querySelector('.play-btn');
const pbTitle = document.querySelector('.pb-title');
const pbArtist = document.querySelector('.pb-artist');

const container = document.querySelector('.recently-played-list');
const emptyMessage = document.querySelector('.recently-played-empty');

function renderRecentlyPlayed() {
    const recent = getRecentlyPlayed();

    if (!recent || recent.length === 0) {
        if (emptyMessage) emptyMessage.style.display = 'block';
        return;
    }

    if (emptyMessage) emptyMessage.style.display = 'none';

    localStorage.setItem('trackList', JSON.stringify(recent));

    recent.forEach((track, index) => {
        const div = document.createElement('div');
        div.className = 'track';
        div.dataset.src = track.src;
        div.dataset.title = track.title;
        div.dataset.artist = track.artist;
        div.dataset.index = index;

        div.innerHTML = `
            <span><strong>${track.title}</strong></span>
            <span>-</span>
            <span>${track.artist}</span>
            <span class="duration">0:00</span>
        `;

        const audio = new Audio(track.src);
        audio.addEventListener('loadedmetadata', () => {
            div.querySelector('.duration').textContent = formatTime(audio.duration);
        });

        div.addEventListener('click', () => {
            pbTrack.src = track.src;
            pbTitle.textContent = track.title;
            pbArtist.textContent = track.artist;
            pbTrack.play();
            playBtn.innerHTML = '<svg style="display: flex; justify-content: center; align-items: center" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="black" viewBox="0 0 24 24">\n' +
                '                       <path d="M8 5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H8Zm7 0a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1Z" clip-rule="evenodd"/>\n' +
                '                </svg>\n';
            localStorage.setItem('currentTrack', JSON.stringify({ src: track.src, title: track.title, artist: track.artist }));
        });

        container.appendChild(div);
    });
}

renderRecentlyPlayed();
