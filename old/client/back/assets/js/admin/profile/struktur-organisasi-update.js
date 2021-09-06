// remove all active menu
$('.nav-link').removeClass('active')
$('.nav-link').attr('aria-expanded', false)
$('.collapse').removeClass('show')
// sett active menu
$('#parent-nav-profile').addClass('active')
$('#parent-nav-profile').attr('aria-expanded', true)
$('#nav-profile').addClass('show')
$('#child-nav-profile-2').addClass('active')

$('.alert').delay(3500).fadeOut()

var editor = new Simditor({
    textarea: $('#editor')
});
$('.toolbar-item.toolbar-item-image').hide()

$('#input-image').change(function() {
    let image_name  = this.files[0].name
    $('.custom-file-label').html(image_name)
})