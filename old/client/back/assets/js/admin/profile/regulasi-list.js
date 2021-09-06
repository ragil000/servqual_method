// remove all active menu
$('.nav-link').removeClass('active')
$('.nav-link').attr('aria-expanded', false)
$('.collapse').removeClass('show')
// sett active menu
$('#parent-nav-profile').addClass('active')
$('#parent-nav-profile').attr('aria-expanded', true)
$('#nav-profile').addClass('show')
$('#child-nav-profile-3').addClass('active')

$('.alert').delay(3500).fadeOut()

function detailModal(id) {
    $.get(base_url+'admin/profile/detail/regulasi/'+id).then((result) => {
        result = JSON.parse(result)
        let file =  '<a href="'+base_url+'uploads/files/'+result[0].file+'" class="btn btn-icon btn-success btn-sm" download>'+
                      '<span class="btn-inner--icon"><i class="fa fa-download"></i></span>'+
                    '</a>'+
                    '<span class="text-medium">'+result[0].file+'</span>'

        $('#date').html(_dateID(result[0].created_at))
        $('#title').html(result[0].title)
        $('#content').html(result[0].content)
        $('#file').html(file)
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
          window.location = base_url+'admin/profile/delete/regulasi/'+id
        }
      })
}