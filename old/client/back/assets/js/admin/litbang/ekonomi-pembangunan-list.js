// remove all active menu
$('.nav-link').removeClass('active')
$('.nav-link').attr('aria-expanded', false)
$('.collapse').removeClass('show')
// sett active menu
$('#parent-nav-litbang').addClass('active')
$('#parent-nav-litbang').attr('aria-expanded', true)
$('#nav-litbang').addClass('show')
$('#child-nav-litbang-2').addClass('active')

$('.alert').delay(3500).fadeOut()

function detailModal(id) {
    $.get(base_url+'admin/litbang/detail/ekonomi-pembangunan/'+id).then((result) => {
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
          window.location = base_url+'admin/litbang/delete/ekonomi-pembangunan/'+id
        }
      })
}