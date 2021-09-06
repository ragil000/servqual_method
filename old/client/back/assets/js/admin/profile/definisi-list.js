// remove all active menu
$('.nav-link').removeClass('active')
$('.nav-link').attr('aria-expanded', false)
$('.collapse').removeClass('show')
// sett active menu
$('#parent-nav-profile').addClass('active')
$('#parent-nav-profile').attr('aria-expanded', true)
$('#nav-profile').addClass('show')
$('#child-nav-profile-1').addClass('active')

$('.alert').delay(3500).fadeOut()

function detailModal(id) {
    $.get(base_url+'admin/profile/detail/definisi/'+id).then((result) => {
        result = JSON.parse(result)
        $('#date').html(_dateID(result[0].created_at))
        $('#title').html(result[0].title)
        $('#content').html(result[0].content)
        $('#button-detail-modal').click()
    })
}