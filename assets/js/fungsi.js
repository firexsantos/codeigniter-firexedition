const swalInit = swal.mixin({
    buttonsStyling: false,
    customClass: {
        confirmButton: 'btn btn-primary',
        cancelButton: 'btn btn-light',
        denyButton: 'btn btn-light',
        input: 'form-control'
    }
});

function sukses($data) {
    if ($data == "tambah") {
        swalInit.fire({
            title: 'Berhasil Tambah!',
            icon: 'success',
            text: 'Data telah sukses ditambahkan',
        });
    } else if ($data == "edit") {
        swalInit.fire({
            title: 'Berhasil Edit!',
            icon: 'success',
            text: 'Data telah sukses diubah',
        });
    } else if ($data == "hapus") {
        swalInit.fire({
            title: 'Berhasil Hapus!',
            icon: 'success',
            text: 'Data telah sukses dihapus',
        });
    } else if ($data == "terima") {
        swalInit.fire({
            title: 'Berhasil Diterima!',
            icon: 'success',
            text: 'Data telah sukses diterima',
        });
    } else if ($data == "tolak") {
        swalInit.fire({
            title: 'Berhasil Ditolak!',
            icon: 'success',
            text: 'Data telah sukses ditolak',
        });
    }else if ($data == "proses") {
        swalInit.fire({
            title: 'Berhasil Diproses!',
            icon: 'success',
            text: 'Data telah sukses diproses',
        });
    }else if ($data == "login") {
        swalInit.fire({
            title: 'Login Successfully!',
            icon: 'success',
            text: 'Please wait...',
        });
    }else if ($data == "block") {
        swalInit.fire({
            title: 'Berhasil Diblokir!',
            icon: 'success',
            text: 'User telah sukses diblokir',
        });
    }else if ($data == "unblock") {
        swalInit.fire({
            title: 'Berhasil Buka Blokir!',
            icon: 'success',
            text: 'User telah sukses dibuka blokirnya',
        });
    }else if ($data == "editpass") {
        swalInit.fire({
            title: 'Berhasil Edit Password!',
            icon: 'success',
            text: 'Password telah sukses diubah',
        });
    }

}

function gagal($data) {
    if ($data == "tambah") {
        swalInit.fire({
            title: 'Failed!',
            icon: 'error',
            text: 'Process failed, please try again',
        });
    } else if ($data == "edit") {
        swalInit.fire({
            title: 'Failed!',
            icon: 'error',
            text: 'Process failed, please try again',
        });
    } else if ($data == "hapus") {
        swalInit.fire({
            title: 'Failed!',
            icon: 'error',
            text: 'Process failed, please try again',
        });
    } else if ($data == "terima") {
        swalInit.fire({
            title: 'Failed!',
            icon: 'error',
            text: 'Process failed, please try again',
        });
    } else if ($data == "tolak") {
        swalInit.fire({
            title: 'Failed!',
            icon: 'error',
            text: 'Process failed, please try again',
        });
    }else if ($data == "proses") {
        swalInit.fire({
            title: 'Failed!',
            icon: 'error',
            text: 'Process failed, please try again',
        });
    }else if ($data == "login") {
        swalInit.fire({
            title: 'Login Failed!',
            icon: 'error',
            text: 'Your username and password  dont match',
        });
    }else if ($data == "block") {
        swalInit.fire({
            title: 'Failed',
            icon: 'error',
            text: 'Process failed, please try again',
        });
    }else if ($data == "unblock") {
        swalInit.fire({
            title: 'Failed',
            icon: 'error',
            text: 'Process failed, please try again',
        });
    }else if ($data == "editpass") {
        swalInit.fire({
            title: 'Failed',
            icon: 'error',
            text: 'Process failed, please try again',
        });
    }else if ($data == "tambahuserada") {
        swalInit.fire({
            title: 'Failed',
            icon: 'error',
            text: 'The username you entered is already registered',
        });
    }else if ($data == "edituserada") {
        swalInit.fire({
            title: 'Failed!',
            icon: 'error',
            text: 'Process failed, please try again',
        });
    }
}




function login($data) {
    if ($data == "salah") {
        swalInit.fire({
            title: 'Failed!',
            icon: 'error',
            cancelButtonClass: 'btn btn-light',
            confirmButtonClass: 'btn btn-danger',
            text: 'Your username and password  dont match.',
            background: '#fff url(../global/images/backgrounds/seamless.png) repeat'
        });
    } else if ($data == "blocked") {
        swalInit.fire({
            title: 'Failed!',
            icon: 'error',
            cancelButtonClass: 'btn btn-light',
            confirmButtonClass: 'btn btn-danger',
            text: 'Your account is blocked, contact the Administrator.',
            background: '#fff url(../global/images/backgrounds/seamless.png) repeat'
        });
    }  else if ($data == "gagal") {
        swalInit.fire({
            title: 'Failed!',
            icon: 'error',
            cancelButtonClass: 'btn btn-light',
            confirmButtonClass: 'btn btn-danger',
            text: 'Process failed, please try again',
            background: '#fff url(../global/images/backgrounds/seamless.png) repeat'
        });
    } 
}




function rupiah(angka, prefix){
	var number_string = angka.toString().replace(/[^,\d]/g, '').toString(),
	split   		= number_string.split(','),
	sisa     		= split[0].length % 3,
	rupiah     		= split[0].substr(0, sisa),
	ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
	// tambahkan titik jika yang di input sudah menjadi angka ribuan
	if(ribuan){
		separator = sisa ? '.' : '';
		rupiah += separator + ribuan.join('.');
	}
 
	rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
	return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}


var DateTimePickers = function() {
    const _componentDaterange = function() {
        if (!$().daterangepicker) {
            console.warn('Warning - daterangepicker.js is not loaded.');
            return;
        }

        $('.tgl_firex').daterangepicker({
            parentEl: '.content-inner',
            // showDropdowns: true,
            singleDatePicker: true,
            locale: {
                format: 'DD/MM/YYYY',
                monthNames: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agus', 'Sept', 'Okt', 'Nov', 'Des'],
            }
        });
    }

    return {
        init: function() {
            _componentDaterange();
        }
    }
}();

document.addEventListener('DOMContentLoaded', function() {
    DateTimePickers.init();
});