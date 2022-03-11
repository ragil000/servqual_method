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
            url: `${base_url}questionnaire/question/get_data_questionnaire`,
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
                console.log('data', data)
                params.page = params.page || 1;
                var res = data.total_data ? data.data.map(function (item) {
                    return {id: item._id, text: `${_dateShortID(item.start_periode, false)} / ${_dateShortID(item.end_periode, false)} ${(item.status == 'active' ? '(aktif)' : '')}`};
                }) : null;
                return {
                    results: res,
                    pagination: {
                        more: data.is_next
                    }
                };
            }
        }
    });
})

function detailModal(e) {
    let value = $(e).data('value')
    $('#modalDetailLabel').html('Detail')
    $('#modalDetailText').html(value)
    $('#modalDetail').modal('show')
}

function changeData(url, ...getQuery) {
    if(getQuery.length > 0) {
        let allQuery = getQuery.map((obj) => {
            let query = ''
            for (const [key, value] of Object.entries(obj)) {
                let typeValue = typeof value
                let actualValue = ''
                if(typeValue == 'string') {
                    actualValue = value
                }else if(typeValue == 'object') {
                    let elementType = value.type
                    let elementId = value.id
                    let getValueById = null
                    if(elementType == 'select') {
                        getValueById = $(`select[name=${elementId}] option`).filter(':selected').val()
                    }else if(elementType == 'input') {
                        getValueById = $(`#${elementId}]`).val()
                    }
                    actualValue = getValueById
                }
                query = `${key}=${actualValue}`
            }
            return query
        })
        url = `${url}?${allQuery.join('&')}`
    }
    window.location = url
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
        console.log('url', url)
        if (result.value) {
            window.location = url
        }
    })
}