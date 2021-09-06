// remove all active menu
$('.nav-link').removeClass('active')
$('.nav-link').attr('aria-expanded', false)
$('.collapse').removeClass('show')
// sett active menu
$('#parent-nav-galery').addClass('active')
$('#parent-nav-galery').attr('aria-expanded', true)
$('#nav-galery').addClass('show')
$('#child-nav-galery-1').addClass('active')

$('.alert').delay(3500).fadeOut()

// var editor = new Simditor({
//     textarea: $('#editor')
// });
$('.toolbar-item.toolbar-item-image').hide()