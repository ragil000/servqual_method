// remove all active menu
$('.nav-link').removeClass('active')
$('.nav-link').attr('aria-expanded', false)
$('.collapse').removeClass('show')
// set active menu
$('#questionnaire-menu').addClass('active')
$('#navbar-questionnaire').addClass('show')
$('#questionnaires').addClass('active')

$('.alert').delay(3500).fadeOut()

function validateForm() {
    let class_validation    = $('.rmy-validation')
    $('.alert-rmy-validation').remove()
    for(i=0; i < class_validation.length; i++) {
        let type = $(class_validation[i]).attr('type')
        if(type == 'select') {
            let className = $(class_validation[i]).attr('name')
            if(!$(`select[name=${className}] option`).filter(':selected').val()) {
                $('<small class="alert-rmy-validation text-danger pt-0 mt-0">Tidak boleh kosong.</small>').insertAfter($(class_validation[i]).closest('.form-group'))
                return false
            }
        }else if(type == 'text' || type == 'date') {
            if(!$(class_validation[i]).val().trim()) {
                $('<small class="alert-rmy-validation text-danger pt-0 mt-0">Tidak boleh kosong.</small>').insertAfter($(class_validation[i]).closest('.form-group'))
                $(class_validation[i]).val('')
                $(class_validation[i]).focus()
                return false
            }
        }
    }

    // tambahan validasi
    let start_periode = $('#start_periode').val()
    let end_periode = $('#end_periode').val()

    if(start_periode >= end_periode) {
        $('<small class="alert-rmy-validation text-danger pt-0 mt-0">Harus tanggal berbeda dan harus tanggal setelah awal periode.</small>').insertAfter($('#end_periode').closest('.form-group'))
        return false
    }
}