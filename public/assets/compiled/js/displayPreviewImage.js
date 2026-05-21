function previewImage() {
    const image = document.querySelector('#foto-buku');
    const imgPreview = document.querySelector('#img-preview');

    if (image.files && image.files[0]) {
        const fileReader = new FileReader();
        fileReader.readAsDataURL(image.files[0]);
        fileReader.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
}