$('#history-section').hide();
console.log('out');
$(document).ready(function() {
    
    $('#orders-btt').click(function(){
        $('#orders-section').show();
        $('#history-section').hide();
        console.log('order');
    });
    $('#history-btt').click(function(){
        $('#orders-section').hide();
        $('#history-section').show();
        console.log('history');
    });
});