// remove all active menu
$('.nav-link').removeClass('active')
$('.nav-link').attr('aria-expanded', false)
$('.collapse').removeClass('show')
// sett active menu
$('#content').addClass('active')
$('#navbar-content').addClass('show')
$('#materi').addClass('active')

$('.alert').delay(3500).fadeOut()

function detailModal(menu_id, _id) {
    $.get(base_api_url+'content/detail/'+menu_id+'/'+_id).then((result) => {
        result = JSON.parse(result)
        let image = '<img class="card-img-top" style="width:100%; height:200px; object-fit:cover;" src="'+result[0].image+'" alt="Gambar">'
        $('#title').html(result[0].title)
        $('#date').html(_dateID(result[0].created_at))
        $('#image').html(image)
        $('#content').html(result[0].description)
        $('#button-detail-modal').click()
    })
}

function beforeDelete(_id) {
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
          $.post(base_api_url+'content/delete/'+_id).then((result) => {
            location.reload()
          })
        }
      })
}