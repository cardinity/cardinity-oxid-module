$(document).ready(function(){

    function removeErrorClass(el)
    {
        if(el){
            el.removeClass('oxInValid');
            el.find('.oxValidateError span').hide();
        }
    }

    function addErrorClass(el)
    {
        if(el){
            el.addClass('oxInValid');
            el.find('.oxValidateError span').show();
        }
    }

    function checkCreditCardValidity(){
        if(!$('#cardinity-month').is(':visible')){
            return true;
        }
        var currentDate = new Date();
        var selectedMonth = parseInt($('#cardinity-month').val());
        var selectedYear = parseInt($('#cardinity-year').val());
        var row = $('#cardinity-month').parents('li');

        if(selectedYear > currentDate.getFullYear() || (selectedYear === currentDate.getFullYear() && selectedMonth >= (currentDate.getMonth()+1))){
            removeErrorClass(row);
            return true;
        }

        addErrorClass(row);
        return false;
    };
    
    var paymentForm = $('form#payment');

    if(paymentForm){
        paymentForm.bind('submit', function(){
            return checkCreditCardValidity();
        });
    }
    
    $('#cardinity-month, #cardinity-year').change(function(){
        checkCreditCardValidity();
    });
});