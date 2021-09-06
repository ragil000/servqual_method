// remove all active menu
$('.nav-link').removeClass('active')
$('.nav-link').attr('aria-expanded', false)
$('.collapse').removeClass('show')
// sett active menu
$('#parent-nav-proposal').addClass('active')
$('#parent-nav-proposal').attr('aria-expanded', true)
$('#nav-proposal').addClass('show')
$('#child-nav-proposal-2').addClass('active')

$('.alert').delay(3500).fadeOut()

var editor = new Simditor({
    textarea: $('#editor')
});
$('.toolbar-item.toolbar-item-image').hide()

$('#input-image').change(function() {
    let image_name  = this.files[0].name
    $('.custom-file-label').html(image_name)
})

function validateForm() {
    let class_validation    = $('.rmy-validation')
    $('.alert-rmy-validation').remove()
    for(i=0; i < class_validation.length; i++) {
        if($(class_validation[i]).val().trim() == null || $(class_validation[i]).val().trim() == '') {
            $('<small class="alert-rmy-validation text-danger pt-0 mt-0">Tidak boleh kosong.</small>').insertBefore($(class_validation[i]).closest('.form-group'))
            $(class_validation[i]).val('')
            $(class_validation[i]).focus()
            return false
        }else {
            if($(class_validation[i]).attr('type') == 'file') {
                let file_type  = $(class_validation[i]).get(0).files[0].type
                let file_size  = $(class_validation[i]).get(0).files[0].size
                let file_mime  = $(class_validation[i]).data('mime').split(',')
                file_mime      = file_mime.map(function (element) {
                    return element.trim();
                })
                if($.inArray(file_type, file_mime) <= -1) {
                    $('<small class="alert-rmy-validation text-danger pt-0 mt-0">Tipe file tidak diizinkan, hanya tipe file pdf.</small>').insertBefore($(class_validation[i]).closest('.form-group'))
                    return false
                }
                if(file_size > 2500000) {
                    $('<small class="alert-rmy-validation text-danger pt-0 mt-0">Ukuran file terlalu besar, maksimal 2,5 MB.</small>').insertBefore($(class_validation[i]).closest('.form-group'))
                    return false
                }
            }
        }
    }
}