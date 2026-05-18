function tampilLoadingAnimation(){
    const buttonLogin = document.getElementById('btn-login');
    const textLogin = document.getElementById('text-login');
    const animasi = document.getElementById('spinner-login');
    const textLoading = document.getElementById('text-loading');
    
    buttonLogin.disabled = true;
    textLogin.classList.add('d-none');

    animasi.classList.remove('d-none');
    textLoading.classList.remove('d-none');
}