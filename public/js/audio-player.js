// console.info('23');
//
// document.addEventListener('DOMContentLoaded', () => {
//     console.info('loaded');
//
//     function doSomething(songId) {
//         fetch('songs/' + songId + '/views-increment', {
//             method: 'POST',
//             headers: {
//                 'X-CSRF-TOKEN': csrfToken,
//                 'Content-Type': 'application/json',
//             },
//         });
//     }
//
//     // const audioPlayer = document.getElementBy('audioPlayer');
//     //
//     // audioPlayer.addEventListener('play', () => {
//     //     const songId = audioPlayer.getAttribute('data-song-id') // Pass the audio ID from the backend
//     //
//     //     const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
//     //     console.log('CSRF Token:', csrfToken);
//     //     console.log(234, 'songs/'+songId+'/views-increment');
//     //
//     //     // Send a POST request to update the view count
//     //     fetch('songs/'+songId+'/views-increment', {
//     //         method: 'POST',
//     //         headers: {
//     //             'X-CSRF-TOKEN': csrfToken,
//     //             'Content-Type': 'application/json',
//     //         },
//     //     });
//     // });
// });
