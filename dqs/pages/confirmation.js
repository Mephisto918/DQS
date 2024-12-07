$(document).ready(function () {
    console.log('confirmation.js loaded');  
    ////////////////////////----------------submition---------\\\\\\\\\\\\\
    
    $('#submit_button').click(function(event){
        event.preventDefault();
                                                
        $('#confirmation-box').show(300);
    });
    $('#confirm_yes').click(function(){
        
        $('#edit-user-form').submit();
        $('#add-user-form').submit();
    });
    $('#confirm_no').click(function(){
        $('#confirmation-box').hide(300);
    });
    ////////////////////////----------------submition---------\\\\\\\\\\\\\

    ////////////////////////----------------confirmation to proceed to other page---------\\\\\\\\\\\\\

    $('#lessgo').click(function(event){
        event.preventDefault();
        const del_url = $(this).attr('href');
        const get_total = (document.getElementById('total').textContent.split(' '))[1];
        const error_window = $('#error-box');
        if((get_total == 0) || (get_total == '')){
            error_window.show(100);
                setInterval(function(){
                    error_window.hide(50);
                },3000);
                console.log(get_total);
        }else{
            $('#confirmation-box').show(300);
            $('.confirmation-text').text('Are you sure about your items?');
            $('#confirm_yes').click(function(){
                // window.location.href = del_url;
                fetch_array_to_php(del_url);   /// session_data_fecther.js  line 17 
            });
            $('#confirm_no').click(function(){
                $('#confirmation-box').hide(300);
            });
        }
        // const del_url = $(this).attr('href');
        
    });
    $('.link-to-where').click(function(event){ //         check out section
        event.preventDefault();
        const del_url = $(this).attr('href');
        const error_window = $('#error-pay-box');
        if(pay_display.textContent == ''){
            error_window.show(100);
                setInterval(function(){
                    error_window.hide(50);
                },2500);
        }else{
            $('#confirmation-box').show(300);
            $('.confirmation-text').text('Are you sure about the payment method?');
            $('#confirm_yes').click(function(){
                fetch_data_to_reciept_page(del_url);
                $('#confirmation-box').hide(200);
            });
            $('#confirm_no').click(function(){
                $('#confirmation-box').hide(300);
            });
            
        }
       
    });

    ////////////////////////----------------confirmation to proceed to other page---------\\\\\\\\\\\\\

    ////////////////////-------------form validation--------------\\\\\\\\\\\\\\\
    // $('#add-user-form').on('submit', function(event){
    //     let if_valid = true; ////bool

    //     $('#add-user-form input[required]').each(function (){
    //         if($(this).val().trim() === ''){
    //             if_valid = false;
    //             $(this).css('border-color', 'red');
    //         }
    //         else{
    //             $(this).css('border-color', '');
    //         }
    //     });
    //     if(!if_valid){
    //         $('#submit_button').click(function(event){
    //             event.preventDefault();
            
    //             $('#confirmation-box').show(300);
    //         });
    //     }
    // });
    ////////////////////-------------form validation--------------\\\\\\\\\\\\\\\
    
});