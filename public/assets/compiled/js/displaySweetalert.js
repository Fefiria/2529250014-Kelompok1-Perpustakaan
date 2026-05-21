function displayMessageAnimation(type, title, message){
    Swal.fire({
        icon: type,
        title: title,
        text: message,
        showConfirmButton: false,
        timer: 3000,
        background: document.body.classList.contains('theme-dark') ? '#1e1e2d' : '#fff',
        color: document.body.classList.contains('theme-dark') ? '#fff' : '#000'
    });
}