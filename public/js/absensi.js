let btnKeluar = document.getElementById('btn-keluar');
btnKeluar.addEventListener('click', confirmation);

function confirmation(event) {
    event.preventDefault();
    Swal.fire({
        'title': 'Absensi Keluar?',
        'text': 'Anda sudah selesai bekerja?',
        'icon': 'warning',
        showCancelButton: true,
        cancelButtonColor: '#6c757d',
        confirmButtonColor: '#1cc88a',
        confirmButtonText: 'Selesai',
        reverseButtons: true,
    }).then((result) => {
        if (result.value) {
            event.target.parentElement.submit();
        }
    });
}
