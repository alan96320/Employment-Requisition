$(document).ready(function () {
    if(localStorage.getItem('url') == 'formBudget'){
        $('#tes .ss-multi-selected').addClass('ss-multi-selected-custom');
        var select = new SlimSelect({
            select: '#multiple',
            placeholder: 'To Repleace',
            closeOnSelect: false,
            hideSelectedOption: true
        });
        // console.log();
        select.selected().forEach(element => {
            var b = '';
                if (b == '' || element.length == 1) {
                    b = element;
                } else {
                    b = b + ',' + element;
                }
            $('#convert').val(b);
        });
        
        $('#convert').val($('#multiple').val());
        $('#multiple').change(function () {
            var a = $(this).val();
            var b = '';
            a.forEach(element => {
                if (b == '') {
                    b = element;
                }else{
                    b = b + ',' + element;
                }
            });
            $('#convert').val(b);
        });
        localStorage.removeItem('url')
    }
    $('#toast').toast('show');

    $('.action').click(function () {
        var id = $(this).attr('idForm');
        var status = $(this).attr('id');
        action(id, status);
    });
    
    // approve
    
});

function toastError(message) {
    var a = message.split(",");
    
    $.toast({
        heading: 'Error',
        text: a,
        icon: 'error',
        position: 'bottom-right',
        showHideTransition: 'slide',
        hideAfter: 'false',
        stack: 10,
    })
}

function action(id, status) {
    if (status == 'approve' || status == 'verify') {
        var Placeholder = 'Berikan sedikit komentar atau alasan kenapa data ini di setujui...';
    }
    if (status == 'notVerify' || status == 'notApprove') {
        var Placeholder = 'Berikan sedikit komentar atau alasan kenapa data ini di tolak...';
    }
    (async () => {
        const { value: text } = await Swal.fire({
            input: 'textarea',
            allowOutsideClick: false,
            inputPlaceholder: Placeholder,
            inputAttributes: {
                'aria-label': 'Type your message here'
            },
            showCancelButton: true
        })

        if (text) {
            location.href = "../action/actionVerify.php?status=" + status + "&id=" + id;
        } else {
            if (status == 'approve' || status == 'verify') {
                location.href = "../action/actionVerify.php?status=" + status + "&id=" + id;
            } else {
                Swal.fire('Sorry...', 'Anda tidak bisa menolak pengajuan ini tanpa alasan..', 'warning')
            }
        }

    })()
}

function reject(id, komentar) {
    
}

