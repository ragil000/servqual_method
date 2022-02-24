$(document).ready(function() {
    // remove all active menu
    $('.nav-link').removeClass('active')
    $('.nav-link').attr('aria-expanded', false)
    $('.collapse').removeClass('show')
    // set active menu
    $('#questionnaire-menu').addClass('active')
    $('#navbar-questionnaire').addClass('show')
    $('#questions').addClass('active')

    $('.alert').delay(3500).fadeOut()

    $('.select2').select2({
        ajax: {
            url: `${base_url}questionnaire/question/test_data`,
            dataType: 'json',
            type: 'GET',
            data: function (params) {
              var query = {
                search: params.term,
                page: params.page || 1
              }

              // Query parameters will be ?search=[term]&page=[page]
              return query;
            },
            processResults: function (data, params) {
                console.log('sasas', data)
                params.page = params.page || 1;
                var res = data.data.map(function (item) {
                    return {id: item._id, text: `${item.start_periode} / ${item.end_periode} ${(item.status == 'active' ? '(aktif)' : '')}`};
                });
                return {
                    results: res,
                    pagination: {
                        more: data.total_data_displayed > 0
                    }
                };
            }
        }
    });
})

function detailModal(menu_id, _id) {
    $.get(base_api_url + 'content/detail/' + menu_id + '/' + _id).then((result) => {
        result = JSON.parse(result)
        let image = '<img class="card-img-top" style="width:100%; height:200px; object-fit:cover;" src="' + result[0].image + '" alt="Gambar">'
        $('#title').html(result[0].title)
        $('#date').html(_dateID(result[0].created_at))
        $('#image').html(image)
        $('#content').html(result[0].description)
        $('#button-detail-modal').click()
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