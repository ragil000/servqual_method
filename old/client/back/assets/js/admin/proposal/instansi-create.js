// remove all active menu
$('.nav-link').removeClass('active')
$('.nav-link').attr('aria-expanded', false)
$('.collapse').removeClass('show')
// sett active menu
$('#parent-nav-proposal').addClass('active')
$('#parent-nav-proposal').attr('aria-expanded', true)
$('#nav-proposal').addClass('show')
$('#child-nav-proposal-1').addClass('active')

$('.alert').delay(3500).fadeOut()

$('.toolbar-item.toolbar-item-image').hide()

function validateForm() {
    let class_validation    = $('.rmy-validation')
    $('.alert-rmy-validation').remove()
    for(i=0; i < class_validation.length; i++) {
        if($(class_validation[i]).val().trim() == null || $(class_validation[i]).val().trim() == '') {
            $('<small class="alert-rmy-validation text-danger pt-0 mt-0">Tidak boleh kosong.</small>').insertBefore($(class_validation[i]).closest('.form-group'))
            $(class_validation[i]).val('')
            $(class_validation[i]).focus()
            return false
        }
    }
}