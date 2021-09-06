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

function detailModal(id) {
    $.get(base_url+'admin/galery/detail/video/'+id).then((result) => {
        result = JSON.parse(result)
        let video = '<video style="object-fit:cover; width:100%; height:auto;" autoplay muted>'+
                      '<source src="'+base_url+'uploads/videos/'+result[0].file+'" type="video/mp4">'+
                      'Your browser does not support the video tag.'+
                    '</video>'
        $('#title').html(result[0].title)
        $('#date').html(_dateID(result[0].created_at))
        $('#video').html(video)
        $('#content').html(result[0].content)
        $('#button-detail-modal').click()
    })
}

function beforeDelete(id) {
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
          window.location = base_url+'admin/galery/delete/video/'+id
        }
      })
}