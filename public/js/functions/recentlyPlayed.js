export function saveRecentlyPlayed(track) {
    const MAX = 10;
    let recent = JSON.parse(localStorage.getItem('recentlyPlayed')) || [];
    recent = recent.filter(t => t.src !== track.src);
    recent.unshift(track);
    if (recent.length > MAX) recent = recent.slice(0, MAX);
    localStorage.setItem('recentlyPlayed', JSON.stringify(recent));
}

export function getRecentlyPlayed() {
    return JSON.parse(localStorage.getItem('recentlyPlayed')) || [];
}
