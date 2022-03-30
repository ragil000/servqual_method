const params = new Proxy(new URLSearchParams(window.location.search), {
    get: (searchParams, prop) => searchParams.get(prop),
})

function validateForm() {
    let totalElementCheck = $('#total_data').val()
    $('.alert-rmy-validation').remove()
    
    let status = true
    for(let i=1; i <= totalElementCheck; i++) {
        let valueOfElementExpectation = $(`input[name=expectation_answer_${i}]:checked`).val()
        let valueOfElementReality = $(`input[name=reality_answer_${i}]:checked`).val()
        if(!valueOfElementExpectation || !valueOfElementReality) {
            $('<small class="alert-rmy-validation text-danger pt-0 mt-0">Belum semua dicentang.</small>').insertAfter($(`#question_${i}`))
            status = false
        }
    }

    if(!status) return false
}

async function setUser(user_name, user_nim, questionnaire_id) {
    return await $.post(base_url+'as_user/set_user', {name: user_name, nim: user_nim, questionnaire_id: questionnaire_id})
}

function resetUser() {
    Swal.fire({
        title: 'Sedang menghitung!',
        html: 'Jangan keluar dari halaman ini.',
        allowOutsideClick: false,
        didOpen: () => {
          Swal.showLoading()
        }
    })

    $.get(base_url+'as_user/reset_user', function(response) {
        Swal.close()
        location.reload()
    })
}

if(!SESSION_USER) {
    if(!IS_DATA_READY) {
        Swal.fire({
            title: 'Maaf, tidak ada pertanyaan untuk dijawab',
            html: 'Silahkan hubungi admin untuk mengonfirmasi kuesioner ini!',
            allowOutsideClick: false,
            showConfirmButton: false
        })
    }else if(!params['lab_id']) {
        Swal.fire({
            title: 'Maaf, url tidak valid :(',
            html: 'Silahkan hubungi admin untuk mendapatkan url yang valid!',
            allowOutsideClick: false,
            showConfirmButton: false
        })
    }else {
        Swal.fire({
            title: 'Inputkan nama dan NIM anda!',
            html:
            '<input id="name" class="swal2-input" placeholder="nama">' +
            '<input id="nim" class="swal2-input" placeholder="NIM">',
            focusConfirm: false,
            confirmButtonText: 'Mulai Menjawab!',
            allowOutsideClick: false,
            preConfirm: () => {
                if(!document.getElementById('name').value || !document.getElementById('nim').value) {
                    Swal.showValidationMessage('Harus semua diisi!')
                }
                return {
                    name: document.getElementById('name').value,
                    nim: document.getElementById('nim').value,
                    questionnaire_id: document.getElementsByName('questionnaire_id')[0].value
                }
            }
        }).then(async (e) => {
            Swal.fire({
                title: 'Sedang menghitung!',
                html: 'Jangan keluar dari halaman ini.',
                allowOutsideClick: false,
                didOpen: () => {
                Swal.showLoading()
                }
            })
    
            let getResponse = await setUser(e.value.name, e.value.nim, e.value.questionnaire_id)
            // Swal.close()
            if(JSON.parse(getResponse)) {
                location.reload()
            }else {
                Swal.fire({
                    title: 'NIM anda sudah mengisi kuesioner ini!',
                    html: 'Anda tidak perlu mengisi kuesioner ini kembali.',
                    timer: 2500,
                    allowOutsideClick: false,
                    didOpen: () => {
                    Swal.showLoading()
                    }
                }).then(() => {
                    location.reload()
                })
            }
        })
    }
}