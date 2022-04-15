$(document).ready(function () {
    $(":input").inputmask();



    $("#phone").inputmask({
        mask: '(99) 9 9999-9999',
        placeholder: ' ',
        showMaskOnHover: false,
        showMaskOnFocus: false,
        onBeforePaste: function (pastedValue, opts) {
            var processedValue = pastedValue;

            //do something with it

            return processedValue;
        }
    });
});