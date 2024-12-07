const table = document.getElementById('container-cart');
const box = document.getElementById('sample-items-section');

box.addEventListener('click', function(e){
    let targeted = Number(e.target.getAttribute('data-console-id'));

    if(!(targeted == 0)){
        const url_with_data = `./data_fetcher.php?prod_id=${encodeURIComponent(targeted)}`;
        // console.log(targeted);
        fetch(url_with_data)
            .then(function(response){
                return response.json();
            })
            .then(data => {
                    // console.log(data);
                    function content_creator(img_src, prod_id,prod_name, prod_size_type,prod_size, prod_price, prod_category){
                        const item = document.createElement('div');
                        const img = document.createElement('img');
                        const info_sect = document.createElement('div');
                            const item_name = document.createElement('p');
                            const item_weight = document.createElement('p');
                            const item_price = document.createElement('p');
                            const item_category = document.createElement('p');
                        const remove_btt = document.createElement('button');
                        
                        container.append(item);
                        item.classList.add('item');
                        item.setAttribute('data-id', prod_id);
                        item.append(img, info_sect, remove_btt);
                        info_sect.classList.add('info-sect');
                        info_sect.append(item_name, item_price, item_weight, item_category);
                            item_name.classList.add('item-name');
                            item_weight.classList.add('item-weight');
                            item_price.classList.add('item-price');
                            item_category.classList.add('item-category');
                        remove_btt.classList.add('remove');
                        
                        let unit;
                        if(prod_size_type == 'weight'){
                            unit = 'g';
                        }else{
                            unit = 'mL';
                        }
                        const file_path = '../../assets/product_images/';
                        img.setAttribute('src', file_path+img_src);
                            item_name.textContent = prod_name;
                            item_weight.textContent = prod_size + unit;
                            item_price.textContent =  `  ₱ ${prod_price}`;
                            item_category.textContent = prod_category;
                        remove_btt.textContent = 'X';
                    }
                    content_creator(data.prod_img,
                                    data.prod_id,
                                    data.prod_name,
                                    data.prod_size_type,
                                    data.prod_size,
                                    data.prod_price,
                                    data.prod_category);
            });
            
    }
    
});
//////////////////////////oooooooooo      CONTAINER LISTEENER >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
const info_name = document.getElementById('item-name');
const info_brand = document.getElementById('item-brand');
const info_size = document.getElementById('item-weight');
const info_price = document.getElementById('item-price');
const info_img = document.getElementById('item-img');
table.addEventListener('click', function(e){
    let target_spot = Number(e.target.getAttribute('data-id'));
    // console.log(target_spot);

    if(!(target_spot == 0)){
        const url_with_data = `./data_fetcher.php?prod_id=${encodeURIComponent(target_spot)}`;
        fetch(url_with_data)
            .then(function(response){
                return response.json();
            })
            .then(data => {
                    let unit;
                    if(data.prod_size_type == 'weight'){
                        unit = 'g';
                    }else{
                        unit = 'mL';
                    }
                    info_name.textContent = data.prod_name;
                    info_brand.textContent = data.prod_brand;
                    info_size.textContent = data.prod_size + unit;
                    info_price.textContent = data.prod_price;
                    const file_path = '../../assets/product_images/';
                    info_img.setAttribute('src',file_path + data.prod_img);
            });
            
    }
});
