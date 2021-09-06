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

function detailModal(id) {
    $.get(base_url+'admin/proposal/detail/usulan-penelitian/'+id).then((result) => {
        result = JSON.parse(result)
        console.log(result)
        let tor =  '<a href="'+base_url+'uploads/files/'+result[0].tor+'" class="btn btn-icon btn-success btn-sm" download>'+
                      '<span class="btn-inner--icon"><i class="fa fa-download"></i></span>'+
                    '</a>'+
                    '<span class="text-medium">'+result[0].tor+'</span>'
        let icp =  '<a href="'+base_url+'uploads/files/'+result[0].icp+'" class="btn btn-icon btn-success btn-sm" download>'+
                    '<span class="btn-inner--icon"><i class="fa fa-download"></i></span>'+
                  '</a>'+
                  '<span class="text-medium">'+result[0].icp+'</span>'

        $('#date').html(_dateID(result[0].created_at))
        $('#title').html(result[0].title)
        $('#instansi').html(result[0].instansi)
        $('#problem').html(result[0].problem)
        $('#purpose').html(result[0].purpose)
        $('#tor').html(tor)
        $('#icp').html(icp)
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
          window.location = base_url+'admin/proposal/delete/usulan-penelitian/'+id
        }
      })
}