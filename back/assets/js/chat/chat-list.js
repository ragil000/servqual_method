// remove all active menu
$('.nav-link').removeClass('active')
$('.nav-link').attr('aria-expanded', false)
$('.collapse').removeClass('show')
// sett active menu
$('#chat').addClass('active')

$('.alert').delay(3500).fadeOut()

function detailModal(_id) {
    let row = ''
    $.get(base_api_url+'chat/'+_id).then((result) => {
        console.log('ssas', result)
        // result = JSON.parse(result)
        let user_id = null
        for(let i=0; i < result.data.length; i++) {
            user_id = result.data[i].user_id
            row +=  '<div class="row '+(result.data[i].user_id == result.data[i].sender_id ? '' : 'justify-content-end')+'">'+
                        '<div class="col-lg-8">'+
                            '<div class="form-group focused">'+
                                '<label class="form-control-label">'+(result.data[i].user_id == result.data[i].sender_id ? result.data[i].username : 'Admin')+'</label>'+
                                '<p class="bg-'+(result.data[i].user_id == result.data[i].sender_id ? 'primary': 'info')+' text-white" style="border-radius: 8px;padding:10px;margin-bottom:0px;"><small>'+result.data[i].chat+'</small></p>'+
                                '<small style="padding-top:0px !important;margin-top:0px !important;font-size:.6em;">'+result.data[i].created_at+'</small>'+
                            '</div>'+
                        '</div>'+
                    '</div>'
        }
        $('#user_id').val(user_id)
        $('#chats').html(row)
        $('#button-detail-modal').click()
    })
}

let countMessage = 0
function sendMessage(_id) {
    let userId = $('#user_id').val()
    let message = $('#message').val()
    let row =  '<div class="row justify-content-end">'+
                        '<div class="col-lg-8">'+
                            '<div class="form-group focused">'+
                                '<label class="form-control-label">Admin</label>'+
                                '<p class="bg-info text-white" style="border-radius: 8px;padding:10px;margin-bottom:0px;"><small>'+message+'</small></p>'+
                                '<small style="padding-top:0px !important;margin-top:0px !important;font-size:.6em;">baru saja</small>'+
                            '</div>'+
                        '</div>'+
                    '</div>'
    $('#chats').append(row)
    $.post(base_api_url+'chat/', {'user_id': userId, 'chat': message, 'created_by': 1}).then((result) => {
        console.log('sacssa', result)
    })
}