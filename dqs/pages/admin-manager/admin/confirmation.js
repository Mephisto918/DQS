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

    ////////////////////////----------------deletion-confirmation---------\\\\\\\\\\\\\
    $('a[name = "delete-employee"]').click(function(event){
        event.preventDefault();
        const del_url = $(this).attr('href');
        console.log(del_url);
        $('#confirmation-box').show(300);
        $('.confirmation-text').text('Are you sure you want to delete this user?');
        $('#confirm_yes').click(function(){
            window.location.href = del_url;
        });
        $('#confirm_no').click(function(){
            $('#confirmation-box').hide(300);
        });
    });
    $('a[name = "delete-product"]').click(function(event){
        event.preventDefault();
        const del_url = $(this).attr('href');
        console.log(del_url);
        $('#confirmation-box').show(300);
        $('.confirmation-text').text('Are you sure you want to delete this product?');
        $('#confirm_yes').click(function(){
            window.location.href = del_url;
        });
        $('#confirm_no').click(function(){
            $('#confirmation-box').hide(300);
        });
    });

    ////////////////////////----------------deletion-confirmation---------\\\\\\\\\\\\\

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