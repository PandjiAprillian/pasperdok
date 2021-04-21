let button = document.getElementById('btn-keluar');
button.addEventListener('click', confirmation);

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

$('input[type="file"]').on('change', function () {
    let filenames = [];
    let files = document.getElementById('photo').files;

    for (let i in files) {
        if (files.hasOwnProperty(i)) {
            filenames.push(files[i].name);
        }
    }

    $(this).next('.custom-file-label').addClass("selected").
        html(filenames.join(', '));
});
