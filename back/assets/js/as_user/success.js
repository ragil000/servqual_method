Swal.fire({
    title: 'Sedang mengirim jawaban anda!',
    html: 'Jangan keluar dari halaman ini.',
    timer: 1500,
    allowOutsideClick: false,
    didOpen: () => {
      Swal.showLoading()
    }
})