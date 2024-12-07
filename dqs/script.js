const log_in_btt = document.getElementById('admin-access');
    const log_ad = document.getElementById('login-panel');

log_in_btt.addEventListener('click', function(){
    if(log_ad.style.display == 'none'){
        log_ad.style.display = 'flex';
    }
    else{
        log_ad.style.display = 'none';
    }
});

// const admin_btt = document.getElementById('admin-login');
// const admin_login_panel = document.getElementById('admin');

// const manager_btt = document.getElementById('manager-login');
// const manager_login_panel = document.getElementById('manager');

// admin_btt.addEventListener('click', function(){
//     admin_login_panel.style.display = 'flex';
//     manager_login_panel.style.display = 'none';
// });
// manager_btt.addEventListener('click', function(){
//     admin_login_panel.style.display = 'none';
//     manager_login_panel.style.display = 'flex';
// });

///////////////////             form validation///////////////////////////
$(document).ready(function () {              // index.php login form
        $('#admin-form').on('submit', function(event){
            event.preventDefault();

            $.ajax({
                type: "POST",
                url: "./login_logic.php",
                data: $(this).serialize() + "&submit=submit", //6 hours and reduced porject feature because submit value is empty
                dataType: "json",
                success: function (response) {
                    if(response.success){  ///------> login_logic.php
                        window.location.href = response.redirect;
                    }else{
                        $('#error').text(response.message);
                    }
                },
                error: function (xhr, textStatus, errorThrown) { 
                            // $('#error').text('No response');
                            $('#error').text('Error: ' + textStatus);
                }
            });
        });
        fetch("./pages/session_data.php", {
            method: "POST",
            body: new FormData()
        })
        .then(response => response.json())
        .then(data => {
            console.log('session_data.php');
        })
        .catch(error => {
            console.log("session_data.php -> error", error);
        });
});

///////////////////             form validation///////////////////////////
