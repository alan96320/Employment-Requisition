$(document).ready(function () {
    $('#dataTable').DataTable();
    $('.btnDelete').click(function () {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                var id = $(this).attr('id');
                $.ajax({
                    type: 'POST',
                    url: '../action/actionKaryawan.php?status=delete',
                    data: { id: id },
                    success: function (response) {
                        if (response = 'sukses') {
                            Swal.fire({
                                title: 'Tunggu',
                                html: 'Data bsedang di hapus dalam <b></b> milliseconds.',
                                timer: 2000,
                                timerProgressBar: true,
                                allowOutsideClick: false,
                                onBeforeOpen: () => {
                                    Swal.showLoading()
                                    timerInterval = setInterval(() => {
                                        const content = Swal.getContent()
                                        if (content) {
                                            const b = content.querySelector('b')
                                            if (b) {
                                                b.textContent = Swal.getTimerLeft()
                                            }
                                        }
                                    }, 100)
                                },
                                onClose: () => {
                                    clearInterval(timerInterval)
                                }
                            }).then((result) => {
                                /* Read more about handling dismissals below */
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    location.reload(true);
                                }
                            })
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: `Oppsss... Gagal Menghapus Data`
                            })
                        }
                    }
                });
                
            }
        })
    });
});