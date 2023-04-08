$(document).ready(function(){
    $.get($('#box-gold').data('url'),function(res){
        $('#box-gold').html(res)
    },'html')

    $.get($('#box-coin').data('url'),function(res){
        $('#box-coin').html(res)
    },'html')
})