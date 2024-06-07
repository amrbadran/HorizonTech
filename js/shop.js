
let rangeSlider = document.querySelector('.range-slider');
rangeSlider.onchange = () => {
    document.querySelector('.filter-price span').innerText = rangeSlider.value + '$';
}


let filterPriceButton = document.getElementById('filter-price');

filterPriceButton.onclick = function(){
    let priceElement = document.getElementById('price-to-filter').innerText;
    let price = +priceElement.substring(0,priceElement.length - 1);

    let products = document.querySelectorAll('.col-lg-10 .col-lg-4');

    products.forEach((e)=>{
        let p = +e.children[0].children[2].innerText.substring(0,e.children[0].children[2].innerText.length - 1);

        if(p > price){
            e.style.display = 'none';
        }else{
            e.style.display = 'block';
        }

    })


}

let form = document.querySelector('.select-form');
let selectSort = document.querySelector('#select_sort');

selectSort.addEventListener('change', () => {

    form.submit();
});
