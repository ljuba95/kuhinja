$(document).ready(function () {

    $('#input-box').on('keyup input',function () {

        $.get('/recept/search/' + $('#input-box').val(),function(data){
            if(data == ''){
                data = 'Nema takvih recepata.';
            }
            $('#main-table-body').html(data);
        })
    });


});