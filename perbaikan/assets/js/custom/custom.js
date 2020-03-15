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