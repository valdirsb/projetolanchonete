$(function(){

    $('.addtocartform button').on('click', function(e){
        e.preventDefault();

        var qt = parseInt($('.addtocart_qt').val());
        var vu = parseFloat($('.valor_unit').val());
        var action = $(this).attr('data-action');

        if(action == 'decrease') {
            if(qt-1 >= 1) {
                qt = qt - 1;
            }
        }
        else if(action == 'increase') {
            qt = qt + 1;
        }

        var vt = vu*qt;
        var texto = vt.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"});

        $('.addtocart_qt').val(qt);
        $('.valor').text(texto);
        
    });

    $('.money').mask('#.##0,00', {reverse: true});


});



    