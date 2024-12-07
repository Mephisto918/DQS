console.log('checkout_handler.js');

window.onload = fetch_receipt();
function fetch_receipt(){
    fetch('./process_info.php')
    .then(response => response.json())
    .then(data => {
        function receipt_data(data){
            const receipt = document.getElementById('items');
            
            data.forEach(data => {
                const item = document.createElement('div');
                const item_name = document.createElement('p');
                const item_quantity = document.createElement('p');
                const item_price = document.createElement('p');

                receipt.append(item);
                item.append(item_name,item_quantity,item_price);

                item.classList.add('item');

                item_name.textContent = data.name + ' '+ data.size + data.size_type;
                item_quantity.textContent = " x "+data.quantity;
                item_price.textContent = data.price + ' V';
            });
        }//₱
        const total_p = document.getElementById('total-amount');
        const vatable_p = document.getElementById('vatable');
        const vat_p = document.getElementById('vat');
        const total_p2 = document.getElementById('total-amount2');
        const total_items = document.getElementById('total-items');

        const VAT_per = 0.12;
        const total_amount = parseFloat(data.total_amount);
        
        const vatable = total_amount - (total_amount * VAT_per);
        const vat = total_amount * VAT_per;
        
        // console.log(total_amount);
        // console.log(vatable);
        // console.log(vat);
        // console.log('vat + vatable' + (vatable + vat) );

        total_p.textContent = '₱'+ total_amount.toFixed(2);
        total_p2.textContent = total_amount.toFixed(2);
        vatable_p.textContent = vatable.toFixed(2);
        vat_p.textContent = vat.toFixed(2);
        total_items.textContent = data.total_items;
        // vat_p.textContent = 
        receipt_data(data.items_array);
    })
};

const payment_method = document.getElementById('payment-meth');
const pay_display = document.getElementById('pay-choice-display')
payment_method.addEventListener('click', function(e){
    let pointer = e.target.getAttribute('data-pay');
    // let pointer = toString(e.target.getAttribute('data-pay'));
    if(pointer == 'debit-card'){
        pay_display.textContent = 'Pay with a Credit or Debit Card';
        pay_display.setAttribute('data-tren', 'Debit');
    }else if(pointer == 'dito'){
        pay_display.textContent = 'Pay with Dito';
        pay_display.setAttribute('data-tren', 'Dito');
    }else if(pointer == 'coins'){
        pay_display.textContent = 'Pay with Coins.ph';
        pay_display.setAttribute('data-tren', 'Coins.ph');
    }else if(pointer == 'gcash'){
        pay_display.textContent = 'Pay with GCash';
        pay_display.setAttribute('data-tren', 'GCash');
    }else if(pointer == 'paymaya'){
        pay_display.textContent = 'Pay with Maya';
        pay_display.setAttribute('data-tren', 'Maya');
    }else if(pointer == 'grab'){
        pay_display.textContent = 'Pay using GrabPay';
        pay_display.setAttribute('data-tren', 'Grab');
    }else if(pointer == 'cash'){
        pay_display.textContent = 'Pay in Cash';
        pay_display.setAttribute('data-tren', 'Cash');
    }
})

function fetch_data_to_reciept_page(url_path){
    let pay_choice = document.getElementById('pay-choice-display').dataset.tren;

    fetch('./process_info.php')                    /////////first fetch
    .then(response => response.json())
    .then(data => {
        if(Array.isArray(data.items_array)){
            const items_array = data.items_array;
            const data_send = new FormData();
            for(var a = 0; a < items_array.length; a++){
                var item = items_array[a];
                data_send.append('data_pass['+a+']', JSON.stringify(item));
            }
            data_send.append('total_amount', data.total_amount);
            data_send.append('total_items', data.total_items);
            data_send.append('payment_choice', pay_choice);

            fetch('../receipt/info_proccessor.php',{      /////////////////second fetch
                method: 'POST',
                body: data_send
            })
            .then(response => response.json())
            .then(data => {                                        /////////second fetch response
                console.log('response', data);
                const error_sql = $('#error-sql-box');
                const message = $('#message');
                if(data.status == true){
                    error_sql.show(100);
                    message.text(data.message);
                    setInterval(function(){
                        error_sql.hide(50);
                    },2500);
                    setInterval(function(){
                        window.location.href = url_path;
                    },2500);
                }else{
                    error_sql.show(100);
                    message.text(data.message);
                    setInterval(function(){
                        error_sql.hide(50);
                    },2500);
                    console.log('error' ,data.error);
                }
            })
            .catch(error => {
                console.log('error sending the data to reciept info_proccessor.php', error); // must have an empty php json response or else will catch error
            });
        }else{
            console.log('ERROR: not an array');
        }
    })
    .catch(error => {
        console.log('error recieving data from process.php', error);      // must have an empty php json response or else will catch error
    });
}