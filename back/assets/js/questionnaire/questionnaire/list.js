// remove all active menu
$('.nav-link').removeClass('active')
$('.nav-link').attr('aria-expanded', false)
$('.collapse').removeClass('show')
// set active menu
$('#questionnaire-menu').addClass('active')
$('#navbar-questionnaire').addClass('show')
$('#questionnaires').addClass('active')

$('.alert').delay(3500).fadeOut()

function detailModal(url) {
    window.location = url
}

function beforeActivate(url) {
    Swal.fire({
        title: 'Anda yakin?',
        text: "Saat kuesioner ini diaktifkan, kuesioner yang lain otomatis akan non aktif.",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, aktifkan',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            window.location = url
        }
    })
}

function beforeDelete(url) {
    Swal.fire({
        title: 'Anda yakin?',
        text: "Anda akan menghapus data ini.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            window.location = url
        }
    })
}