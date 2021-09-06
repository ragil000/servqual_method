// remove all active menu
$('.nav-link').removeClass('active')
$('.nav-link').attr('aria-expanded', false)
$('.collapse').removeClass('show')
// sett active menu
$('#quist').addClass('active')
$('#navbar-quist').addClass('show')
$('#question').addClass('active')

$('.alert').delay(3500).fadeOut()

function detailModal(_id) {
    let row = ''
    $.get(base_api_url+'quist/detail/'+_id).then((result) => {
        console.log('ssas', result)
        $('#question2').html(result.data.question)
        for(let i=0; i < result.data.answers.length; i++) {
            row +=  '<div class="form-group">'+
                        '<div class="custom-control custom-radio">'+
                            '<input type="radio" id="customRadioInline'+i+'" name="is_correct" value="0" '+(result.data.answers[i].is_correct == 'yes' ? 'checked' : '')+' class="custom-control-input form-control rmy-validation">'+
                            '<label class="custom-control-label" for="customRadioInline1">'+result.data.answers[i].answer+'</label>'+
                        '</div>'+
                    '</div>'
        }
        $('#answers').html(row)
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
          $.post(base_api_url+'quist/delete/'+_id).then((result) => {
            location.reload()
          })
        }
      })
}