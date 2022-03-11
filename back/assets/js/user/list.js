$(document).ready(function() {
    // remove all active menu
    $('.nav-link').removeClass('active')
    $('.nav-link').attr('aria-expanded', false)
    $('.collapse').removeClass('show')
    // set active menu
    $('#account-menu').addClass('active')
    $('#navbar-account').addClass('show')
    $(`#${ROLE}_accounts`).addClass('active')

    $('.alert').delay(3500).fadeOut()

})

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
        console.log('url', url)
        if (result.value) {
            window.location = url
        }
    })
}