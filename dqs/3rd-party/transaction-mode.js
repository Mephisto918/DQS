const dev_btt = document.getElementById('transaction-dev');
const dev_tool = document.getElementById('dev-tool')
dev_btt.addEventListener('click', function(){
    if(dev_tool.style.display == 'none'){
        dev_tool.style.display = 'flex';
    }
    else{
        dev_tool.style.display = 'none';
    }
});