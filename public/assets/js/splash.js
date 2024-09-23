//import Swal from 'sweetalert2';
// Set timeout for splash screen display
setTimeout(() => {
    document.getElementById('splash-screen').classList.add('fade-out');

    // Redirect to the next page after fade-out animation completes
    setTimeout(() => {
        window.location.href = "{{ route('welcome') }}";
    }, 1000); // Adjust the delay for redirect as needed
}, 3000); // Adjust the display time for the splash screen as needed
