$(document).ready(function() {
    // remove all active menu
    $('.nav-link').removeClass('active')
    $('.nav-link').attr('aria-expanded', false)
    $('.collapse').removeClass('show')
    // set active menu
    $('#analysis-menu').addClass('active')
    $('#navbar-analysis').addClass('show')
    $('#ranking').addClass('active')

    $('.alert').delay(3500).fadeOut()

})

async function detailModal(e) {
    let value = $(e).data('value')
    let question_id = $(e).data('id')
    console.log('question_id', question_id)

    let getData = await $.get(base_url+'analysis/gap5/get_data_summary_servqual?question_id='+question_id)
    getData = JSON.parse(getData)

    let data = null
    if(getData['status']) data = getData['data']

    $('#modalDetailLabel').html('Detail')
    let table = '<table class="modal-table" style="table-layout: fixed; width: 100%;">'+
                    '<tbody>'+
                        '<tr>'+
                            '<td><b>Kriteria/Pertanyaan:</b></td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td style="word-wrap: break-word;">I am using Sweet Alert for a popup on my product view in an E-commerce Application with two buttons: one for going on cart View and another for reloading the view.</td>'+
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

Swal.fire({
    title: 'Sedang menghitung!',
    html: 'Jangan keluar dari halaman ini.',
    timer: 1500,
    allowOutsideClick: false,
    didOpen: () => {
      Swal.showLoading()
    }
})