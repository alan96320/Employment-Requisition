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
                var page = $(this).attr('page');
                var urls = "";
                if (page == "karyawan") {
                    urls = "../action/actionKaryawan.php?status=delete"
                }
                if (page == "budget") {
                    urls = "../action/actionBudget.php?status=delete"
                }
                if (page == "department") {
                    urls = "../action/actionDepartment.php?status=delete"
                }
                if (page == "jabatan") {
                    urls = "../action/actionJabatan.php?status=delete"
                }
                if (page == "marrid") {
                    urls = "../action/actionMarrid.php?status=delete"
                }
                $.ajax({
                    type: 'POST',
                    url: urls,
                    data: { id: id },
                    success: function (response) {
                        Swal.fire({
                            title: 'Tunggu',
                            html: 'Data Sedang di hapus dalam <b></b> milliseconds.',
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
                                if (response = 'sukses') {
                                    location.reload(true);
                                } else {
                                    Toast.fire({
                                        icon: 'error',
                                        title: `Oppsss... Gagal Menghapus Data`
                                    })
                                }
                            }
                        })
                    }
                });
                
            }
        })
    });
});