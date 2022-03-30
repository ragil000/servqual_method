$(document).ready(function() {
    // remove all active menu
    $('.nav-link').removeClass('active')
    $('.nav-link').attr('aria-expanded', false)
    $('.collapse').removeClass('show')
    // set active menu
    $('#analysis-menu').addClass('active')
    $('#navbar-analysis').addClass('show')
    $('#gap5').addClass('active')

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

async function detailModal(e) {
    let value = $(e).data('value')
    let question_id = $(e).data('id')
    console.log('question_id', question_id)

    let getData = await $.get(base_url+'analysis/gap5/get_data_summary_servqual?question_id='+question_id)
    getData = JSON.parse(getData)

    let data = null
    if(getData['status']) data = getData['data']
    
    let question = $(e).data('value')

    $('#modalDetailLabel').html('Detail')
    let table = '<table class="modal-table" style="table-layout: fixed; width: 100%;">'+
                    '<tbody>'+
                        '<tr>'+
                            '<td><b>Kriteria/Pertanyaan:</b></td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td style="word-wrap: break-word;">'+question+'</td>'+
                        '</tr>'+
                        '<tr style="height: 10px">'+
                            '<td></td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td><b>Detail Perhitungan:</b></td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td>Bobot Harapan = (1x'+data['expectation'][1]+') + (2x'+data['expectation'][2]+') + (3x'+data['expectation'][3]+') + (4x'+data['expectation'][4]+') + (5x'+data['expectation'][5]+') = '+data['total_expectation_point']+'</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td>Rerata Harapan = '+data['total_expectation_point']+'/'+data['total_answere']+' = '+(decimalFormatter.format(data['total_expectation_point']/data['total_answere']))+'</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td>Bobot Kenyataan = (1x'+data['reality'][1]+') + (2x'+data['reality'][2]+') + (3x'+data['reality'][3]+') + (4x'+data['reality'][4]+') + (5x'+data['reality'][5]+') = '+data['total_reality_point']+'</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td>Rerata Kenyataan = '+data['total_reality_point']+'/'+data['total_answere']+' = '+(decimalFormatter.format(data['total_reality_point']/data['total_answere']))+'</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td class="bg-info text-white"><b>Nilai GAP 5 = '+(decimalFormatter.format(data['total_reality_point']/data['total_answere']))+' - '+(decimalFormatter.format(data['total_expectation_point']/data['total_answere']))+' = '+decimalFormatter.format((decimalFormatter.format(data['total_reality_point']/data['total_answere']))-(decimalFormatter.format(data['total_expectation_point']/data['total_answere'])))+'</b></td>'+
                        '</tr>'+
                    '</tbody>'+
                '</table>'

    $('#modalDetailText').html(table)
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
Swal.fire({
    title: 'Sedang menghitung!',
    html: 'Jangan keluar dari halaman ini.',
    timer: 1500,
    allowOutsideClick: false,
    didOpen: () => {
      Swal.showLoading()
    }
})