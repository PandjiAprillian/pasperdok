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


let btnHapus = document.getElementById('btn-hapus');
btnHapus.addEventListener('click', deleteConfirmation);

function deleteConfirmation(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Anda yakin?',
        text: 'Hapus data  ' + event.target.getAttribute('data-name'),
        icon: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#6c757d',
        confirmButtonColor: '#dc3545',
        confirmButtonText: 'Ya, hapus!',
        reverseButtons: true,
    }).then((result) => {
        if (result.value) {
            event.target.parentElement.submit();
        }
    })
};

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
