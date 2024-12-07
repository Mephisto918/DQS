console.log('inquiries.js loaded');
const form = document.getElementById('date_range_selector');

form.addEventListener('submit', function(e){
    e.preventDefault();
    
    const start = document.getElementById('start_date').value;
    const end = document.getElementById('end_date').value;

    const url_of_php = `./report/inquiries_proccessor.php?start=${start}&end=${end}`;
    fetch(url_of_php,{
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log(data[0].status);
        if(data[0].status == false){
            console.log('naay error');
            const total_sales = document.getElementById('total_sales');
            sales_table.innerHTML = '';
            total_sales.textContent = 'Invalid date range!';
        }else{
            const sales_table = document.getElementById('sales_table');
            const total_sales = document.getElementById('total_sales');
            sales_table.innerHTML = '';
            let count = 0;
            let total_sales_value = 0;
            data.forEach(row => {
                const tr = document.createElement('tr');
                const date = document.createElement('td');
                const quantity = document.createElement('td');
                const amount = document.createElement('td');

                const item = data[count];

                tr.append(date, quantity, amount);
                date.textContent = item.date;
                quantity.textContent = item.quantity;
                amount.textContent = item.total;
                sales_table.appendChild(tr);
                // console.log(data.date)
                // console.log(data.quantity)
                // console.log(data.total);
                total_sales_value += parseFloat(item.total);
                count++;
            });
            
            console.log('total_sales_value:', total_sales_value);
            total_sales.textContent = total_sales_value;
        }
    })
    .catch(error => console.error('Error:', error));
});