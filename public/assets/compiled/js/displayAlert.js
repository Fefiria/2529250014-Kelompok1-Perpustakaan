function displayAlert(event, form, nama, type){
    event.preventDefault();

    Swal.fire({
        title: "Konfirmasi",
        text: `Apakah Anda yakin ingin menghapus data ${nama} ini?`,
        icon: type,
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Ya, Hapus!",
        cancelButtonText: "Batal",
    }).then((result) => {
        if(result.isConfirmed){
            form.submit();
        }
    });
}