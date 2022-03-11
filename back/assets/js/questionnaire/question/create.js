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
        placeholder: '-- Pilih dimensi --',
        ajax: {
            url: `${base_url}questionnaire/question/get_data_dimension`,
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
                params.page = params.page || 1;
                var res = data.total_data ? data.data.map(function (item) {
                    return {id: item._id, text: item.title};
                }) : null;
                return {
                    results: res,
                    pagination: {
                        more: data.is_next
                    }
                }
            }
        }
    })
})

function validateForm() {
    let class_validation    = $('.rmy-validation')
    $('.alert-rmy-validation').remove()
    for(i=0; i < class_validation.length; i++) {
        let type = $(class_validation[i]).attr('type')
        if(type == 'select') {
            let className = $(class_validation[i]).attr('name')
            if(!$(`select[name=${className}] option`).filter(':selected').val()) {
                $('<small class="alert-rmy-validation text-danger pt-0 mt-0">Tidak boleh kosong.</small>').insertAfter($(class_validation[i]).closest('.form-group'))
                return false
            }
        }else if(type == 'text') {
            if(!$(class_validation[i]).val().trim()) {
                $('<small class="alert-rmy-validation text-danger pt-0 mt-0">Tidak boleh kosong.</small>').insertAfter($(class_validation[i]).closest('.form-group'))
                $(class_validation[i]).val('')
                $(class_validation[i]).focus()
                return false
            }
        }
    }
}