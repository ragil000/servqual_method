// remove all active menu
$('.nav-link').removeClass('active')
$('.nav-link').attr('aria-expanded', false)
$('.collapse').removeClass('show')
// sett active menu
$('#parent-nav-galery').addClass('active')
$('#parent-nav-galery').attr('aria-expanded', true)
$('#nav-galery').addClass('show')
$('#child-nav-galery-2').addClass('active')

$('.alert').delay(3500).fadeOut()

// var editor = new Simditor({
//     textarea: $('#editor')
// });
$('.toolbar-item.toolbar-item-image').hide()

$('#input-video').change(function() {
    let image_name  = this.files[0].name
    console.log(image_name)
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
                let image_type  = $(class_validation[i]).get(0).files[0].type
                let image_size  = $(class_validation[i]).get(0).files[0].size
                let image_mime  = $(class_validation[i]).data('mime').split(',')
                image_mime      = image_mime.map(function (element) {
                    return element.trim();
                })
                if($.inArray(image_type, image_mime) <= -1) {
                    $('<small class="alert-rmy-validation text-danger pt-0 mt-0">Tipe file tidak diizinkan, hanya tipe file mp4.</small>').insertBefore($(class_validation[i]).closest('.form-group'))
                    return false
                }
                if(image_size > 30000000) {
                    $('<small class="alert-rmy-validation text-danger pt-0 mt-0">Ukuran file terlalu besar, maksimal 30 MB.</small>').insertBefore($(class_validation[i]).closest('.form-group'))
                    return false
                }
            }
        }
    }
}