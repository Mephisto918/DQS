console.log('session_data_fetcher.js');

// const container = document.getElementById('container-cart');
// const childIds = []; //array for child ids 

function array_of_id(){
    const childIds = []; //array for child ids  cauuses duplication of array if placed outside
        // loop for child ids
    for (let a = 0; a < container.children.length; a++) {
        const child = container.children[a];
        childIds.push(child.getAttribute('data-id')); //push into array
    }
    // console.log(childIds);
    return childIds;
}

function fetch_array_to_php(redirect_url){
    const data_array = array_of_id();
    const total = document.getElementById('total').textContent.split(' ');
    const total_cart = total[1];
    // data_array.forEach(id => data_array_id.append('id=[]',id));

    const one_data = new FormData();
    data_array.forEach(id => one_data.append('id=[]', id));
    
    one_data.append('total_cart', total_cart);

    fetch("../session_data.php", {
        method: 'POST',
        body: one_data
    })
    .then(function(response){
        return response;
    })
    .then(function (data) { 
        console.log('Data sent and session updated:', data);
        window.location.href = redirect_url;
     });
    console.log('trigggeerd');
    
    
}

// function fetch_array_to_php(){
//     const data_array = array_of_id();

//     const data_array_id = new FormData();
//     data_array.forEach(id => data_array_id.append('id=[]',id));

//     fetch("../session_data.php", {
//         method: 'POST',
//         body: data_array_id
//     })
//     .then(function(response){
//         return response;
//     });
//     console.log('trigggeerd');
// // |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//     const total = document.getElementById('total').textContent;
//     const total_cart = total.split(' ');

//     console.log(total_cart[1]);
//     const data_total_cart = new FormData();
//     data_total_cart.forEach(id => data_array_id.append('total_cart',id));
//     // const data_total = new FormData();
//     fetch("../session_data.php", {
//         method: 'POST',
//         body: data_total_cart
//     })
//     .then(function(response){
//         return response;
//     });
//     console.log('trigggeerd');
// }

