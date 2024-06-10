
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


let carets = document.querySelectorAll('.card-shop-product  .fa-cart-plus');
carets.forEach((e)=>{

    let productId = e.nextElementSibling.value;
    e.addEventListener('click',function (){
        const obj = {
            id: e.nextElementSibling.value,
            name: $('#productTitle'+productId).val(),
            category: $('#productCategoryCart'+productId).val(),
            image: $('#productImageCart'+productId).val(),
            tags: $('#productTagCart'+productId).val(),
            price: $('#productPriceCart'+productId).val(),
            quantity:1,
            maxQuantity:Number($("#maxQuantity"+productId).val()) -  getCartQuantityProduct(Number(e.nextElementSibling.value))
        }

        console.log(obj);
        add_to_shopping_cart(obj);
    })

})



let form = document.querySelector('.select-form');
let selectSort = document.querySelector('#select_sort');

selectSort.addEventListener('change', () => {

    form.submit();
});
