const fileInput = document.getElementById('file');
const durationInput = document.getElementById('duration');

fileInput.addEventListener('change', () => {
    const file = fileInput.files[0];
    if (!file) return;

    const audio = document.createElement('audio');
    audio.src = URL.createObjectURL(file);
    audio.addEventListener('loadedmetadata', () => {
        durationInput.value = Math.round(audio.duration);
    });
});