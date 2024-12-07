// const reportsbtt = document.getElementById('reportbtt');
// const report_section = document.getElementById('report-section');

// const productsbtt = document.getElementById('productsbtt');
// const product_section = document.getElementById('products-section');

// const ordersbtt = document.getElementById('ordersbtt');
// const order_section = document.getElementById('orders-section');

// const inventorybtt = document.getElementById('inventorybtt');
// const inventory_section = document.getElementById('inventory-section');

// const employeesbtt = document.getElementById('employeesbtt');
// const employees_section = document.getElementById('employees-section');

// const log_out = document.getElementById('logoutbtt');
// const no_log_out = document.getElementById('no-logout');
// const log_panel = document.getElementById('logout-panel');

// reportsbtt.addEventListener('click', function(){
//     report_section.style.display = 'grid';
//     product_section.style.display = 'none';
//     order_section.style.display = 'none';
//     inventory_section.style.display = 'none';
//     employees_section.style.display = 'none';
// });
// productsbtt.addEventListener('click', function(){
//     report_section.style.display = 'none';
//     product_section.style.display = 'grid';
//     order_section.style.display = 'none';
//     inventory_section.style.display = 'none';
//     employees_section.style.display = 'none';
// });
// ordersbtt.addEventListener('click', function(){
//     report_section.style.display = 'none';
//     product_section.style.display = 'none';
//     order_section.style.display = 'grid';
//     inventory_section.style.display = 'none';
//     employees_section.style.display = 'none';
// });
// inventorybtt.addEventListener('click', function(){
//     report_section.style.display = 'none';
//     product_section.style.display = 'none';
//     order_section.style.display = 'none';
//     inventory_section.style.display = 'grid';
//     employees_section.style.display = 'none';
// });
// employeesbtt.addEventListener('click', function(){
//     report_section.style.display = 'none';
//     product_section.style.display = 'none';
//     order_section.style.display = 'none';
//     inventory_section.style.display = 'none';
//     employees_section.style.display = 'grid';
// });

// log_out.addEventListener('click', function(){
//     log_panel.classList.add('slide');
//     log_panel.style.display = 'grid';
// });
// no_log_out.addEventListener('click', function(){
//     log_panel.classList.remove('slide');
//     log_panel.style.display = 'none';
// });

////////////////////------------chatgptcode-----------////////////////\
// $(document).ready(function() {
//     const sections = {
//         '#reportbtt': '#report-section',
//         '#productsbtt': '#products-section',
//         '#ordersbtt': '#orders-section',
//         '#inventorybtt': '#inventory-section',
//         '#employeesbtt': '#employees-section'
//     };
//     //////////////////
//     function show_section(section){
//         console.log('Showing section:', section);
//         $.each(sections, function(_, sec){
//             $(sec).removeClass('display-visible').addClass('display-none');
//             // console.log(sec);
//         });
//         $(section).removeClass('display-none').addClass('display-visible');
//     }

//     const url_param = new URLSearchParams(window.location.search);
//     const current_section = url_param.get('section');
//     console.log('Current Section:', current_section); // Check what value is retrieved
//     if(current_section && sections.hasOwnProperty(current_section)){
//         show_section(current_section);
//         console.log('2');
//         console.log('Showing section:', current_section);
//     }else{
//         show_section('#report-section'); //default
//         // console.log('3');
//         console.log('Showing default section');
//     }
    
//     ///////////////

//     $.each(sections, function(button, section) {
//         $(button).click(function() {
//             show_section(section);

//             const state = {'section': section.slice(1)};
//             history.pushState(state, '', `?section=${section.slice(1)}`);
//             console.log('4');
//             // $.each(sections, function(_, sec) {      refractor
//             //     $(sec).removeClass('display-visible').addClass('display-none');
//             // });
//             // $(section).removeClass('display-none').addClass('display-visible');
//         });
//     });

//     // Logout panel
//     $('#logoutbtt').click(function() {
//         $('#logout-panel').addClass('slide').show();
//     });

//     $('#no-logout').click(function() {
//         $('#logout-panel').removeClass('slide').hide();
//     });
// });


$(document).ready(function() {
    $(document).on('click', '.section-button', function() { // Event delegation sa buttons
        const section = $(this).data('section');
        show_section(section);  
        history.pushState({ 'section': section.slice(1) }, '', `?section=${section.slice(1)}`);
    });

    function show_section(section) { //// toggle sections
        $('.section').addClass('display-none').removeClass('display-visible');
        $(section).removeClass('display-none').addClass('display-visible');
    }

   
    const url_param = new URLSearchParams(window.location.search);
    const initial_section = url_param.get('section');  // get link passed $section

    if (initial_section) {
        show_section(initial_section);
    } else {
        show_section('#report-section'); // Default section to show
    }

    
    window.onpopstate = function(event) {// ????????
        if (event.state && event.state.section) {
            show_section(event.state.section);
        } else {
            show_section('#report-section'); // default page
        }
    };

    $('#logoutbtt').click(function() {
        $('#logout-panel').addClass('slide').show();
    });

    // $('.inquiries').hide();
    $('#no-logout').click(function() {
        $('#logout-panel').removeClass('slide').hide();
    });

    $('.inquiries').hide();
    $('#chartbtt').click(function(){
        $('.report-section-items').show();
        $('.inquiries').hide();
        // console.log('hello1');
    })
    $('#inquiriesbtt').click(function(){
        $('.inquiries').show();
        $('.report-section-items').hide();
        // console.log('hello2');
    })
});




////////////////////------------chatgptcode-----------////////////////\
// ------------------------statusats---------------//
$(document).ready(function(){
    if ($('#status_message').is(':visible')) {
        return; // If visible, do nothing (message already displayed)
    }
    // console.log('hello');
    function getStatus(name){
        const url = new URLSearchParams(window.location.search);
        return url.get(name);
    }

    const status = getStatus('status');
    // console.log(status);
    // $('.status').hide();

    if(status){
        const statusMessage = $('#status_message');
        statusMessage.text(decodeURIComponent(status)).show(500);

        setTimeout(function(){
            statusMessage.hide(200);
        }, 3000);
    }
});
// ------------------------statusats---------------//