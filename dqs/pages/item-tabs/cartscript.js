const dev_tool_btt = document.getElementById('dev-tool');
const dev_box = document.getElementById('input');

dev_tool_btt.addEventListener('click', function(){
    if(dev_box.style.display == 'none'){
        dev_box.style.display = 'flex';
    }
    else{
        dev_box.style.display = 'none';
    }
});


const container = document.getElementById('container-cart');
const total_sect = document.getElementById('total');
/* ---------------------  item remover ------------ */
container.addEventListener('click', function(e) {
    if( e.target.classList.contains('remove')){
        e.target.closest('.item').remove();
        total_sect.textContent = `₱ ${price_calc().toFixed(2)}`; //reference line 27\
    }
    // total_sect.textContent = `₱ ${price_calc()}`;
    
});
/* ---------------------  item remover ------------ */


/*      -------   item prices calculation ----------*/
let t1 = 0;
function price_calc(){
    const prices = document.querySelectorAll('.item-price');
    let total = 0;
    prices.forEach(element => {
        const price = parseFloat(element.textContent.replace('₱', ''));
        total += price;
        // console.log(total);
        t1 = total;
    });
    return parseFloat(t1);
}
/*      -------   item prices calculation ----------*/

// -------------------------------------------node observer in container------------------------------- 
const observer = new MutationObserver(function(mutationsList){
    for(let mutation of mutationsList){
        if(mutation.type === 'childList'){
            // console.log('naa daw na add line 49');
            
            // let prices = container.querySelectorAll('.item .info-sect .item-price');
            // prices.forEach(prices => {
                
            // }); 

            if(container.children.length == 0){
                total_sect.textContent = `₱ 0.00`;
            }else{
                total_sect.textContent = `₱ ${price_calc().toFixed(2)}`; //reference line 27\
            }
        }
    }
});
const config = { childList: true };
observer.observe(container, config);

// -------------------------------------------node observer in container------------------------------- 


// --------------------------------------?--------triggering php------------------------------------
// document.addEventListener('DOMContentLoaded', function(){
//     fetch("../session_data.php", {
//         method: "POST",
//         body: new FormData()
//     })
//     .then(response => response.json())
//     .then(data => {
//         console.log('session_data.php');
//     })
//     .catch(error => {
//         console.log("session_data.php -> error", error);
//     });
// });

// --------------------------------------?--------triggering php------------------------------------
// ------------------display infooooooo-------------------------
// const 


// ------------------display infooooooo-------------------------
