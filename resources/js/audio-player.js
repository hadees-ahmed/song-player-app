const audioPlayer = document.getElementById('audioPlayer');
const songId = audioPlayer.getAttribute('data-song-id') // Pass the audio ID from the backend

document.addEventListener('DOMContentLoaded', () => {

    audioPlayer.addEventListener('play', () => {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        console.log('CSRF Token:', csrfToken);

        // Send a POST request to update the view count
    fetch(route('songs.views.increment'), {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Content-Type': 'application/json',
        },
    });
});
});
