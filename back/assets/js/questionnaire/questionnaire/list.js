// remove all active menu
$('.nav-link').removeClass('active')
$('.nav-link').attr('aria-expanded', false)
$('.collapse').removeClass('show')
// set active menu
$('#questionnaire-menu').addClass('active')
$('#navbar-questionnaire').addClass('show')
$('#questionnaires').addClass('active')

$('.alert').delay(3500).fadeOut()

async function detail(url) {
    window.location = url
}

async function detailModal(e) {
    let group_id = $(e).data('id')
    console.log('ww', base_url+'group/get_data_group?group_id='+group_id)

    let getData = await $.get(base_url+'group/get_data_group?group_id='+group_id)
    getData = JSON.parse(getData)

    let data = null
    if(getData['status']) data = getData['data']
    
    $('#modalDetailLabel').html('Detail')

    let table = ''
    if(data) {
        table = '<table class="modal-table" style="table-layout: fixed; width: 100%;">'+
                    '<tbody>'
                    
                    let no = 1
                    data.forEach((e) => {
                        table +=  '<tr>'+
                                    '<td>'+no+'. '+e['lab_title']+'</td>'+
                                '</tr>'
                        no++
                    })

        table +=    '</tbody>'+
                '</table>'
    }

    $('#modalDetailText').html(table)
    $('#modalDetail').modal('show')
}

function beforePublish(url) {
    Swal.fire({
        title: 'Anda yakin?',
        text: "Saat kuesioner ini dipublis, tidak dapat diurungkan.",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, aktifkan',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            window.location = url
        }
    })
}

function beforeActivate(url) {
    Swal.fire({
        title: 'Anda yakin?',
        text: "Saat kuesioner ini diaktifkan, kuesioner yang lain otomatis akan non aktif.",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, aktifkan',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            window.location = url
        }
    })
}

function beforeNonactivate(url) {
    Swal.fire({
        title: 'Anda yakin?',
        text: "Yakin ingin non-aktif kan data ini?.",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, aktifkan',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            window.location = url
        }
    })
}

function beforeDelete(url) {
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
            window.location = url
        }
    })
}