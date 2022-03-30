function _dateID(date){
    let bulan = [
        'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    ];

    let hari = [
        'Minggu',
        'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jum\'at',
        'Sabtu',
    ];

    let tanggal = new Date(date);

    return hari[tanggal.getDay()]+', '+tanggal.getDate()+' '+bulan[tanggal.getMonth()]+' '+tanggal.getFullYear();
}

function _dateShortID(date, isDay=true){
    let bulan = [
        'Jan',
        'Feb',
        'Mar',
        'Apr',
        'Mei',
        'Jun',
        'Jul',
        'Agu',
        'Sep',
        'Okt',
        'Nov',
        'Des'
    ];

    let hari = [
        'Ming',
        'Sen',
        'Sel',
        'Rab',
        'Kam',
        'Jum',
        'Sab',
    ];

    let tanggal = new Date(date);

    return (isDay ? hari[tanggal.getDay()]+', ' : '')+tanggal.getDate()+' '+bulan[tanggal.getMonth()]+' '+tanggal.getFullYear();
}

function _splitText(string, limit = 100) {

    string = string.replace(/(<([^>]+)>)/ig,"")
    
    if (string.length > limit) {

        // truncate string
        let stringCut = string.substring(0, limit)
        let endPoint = stringCut.indexOf(' ')

        //if the string doesn't contain any space then it will cut without word basis.
        string = endPoint? string.substring(0, limit) : string.substring(0)
    }
    return string
}

const decimalFormatter = new Intl.NumberFormat('en-US', {
    minimumFractionDigits: 0,      
    maximumFractionDigits: 2,
})

function copyText(text) {
    navigator.clipboard.writeText(text).then(function () {
        // alert('It worked! Do a CTRL - V to paste')
        Swal.fire({
            html: '<span class="text-info">Berhasil disalin!</span>',
            timer: 2000,
            showConfirmButton: false,
            toast: true,
            position: 'top-right'
          })
    }, function () {
        Swal.fire({
            html: '<span class="text-danger">Gagal disalin!</span>',
            timer: 2000,
            showConfirmButton: false,
            toast: true,
            position: 'top-right'
          })
    });
  }