
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


let carets = document.querySelectorAll('.card-shop-product  .fa-cart-plus');
carets.forEach((e)=>{

    let productId = e.nextElementSibling.value;


    var incs = +$("#productQuantity"+productId).val();
    var cartQuan = new Number(document.querySelector('header .fa-shopping-cart span').innerHTML.toString());
    var title = $('#productTitle'+productId).val();
    var category = $('#productCategoryCart'+productId).val();
    var image_path = $('#productImageCart'+productId).val();
    var tag = $('#productTagCart'+productId).val();
    var price = $('#productPriceCart'+productId).val();
    var maxQuantity = +$("#maxQuantity"+productId).val();

    e.addEventListener('click',function (){
        var quantity = localStorage.getItem('productQuantityCart'+productId) === null ? '0' : localStorage.getItem('productQuantityCart'+productId);

        let x =Number(quantity) + 1;

        localStorage.setItem('productQuantityCart'+productId,x.toString());
        let z = 1;
        addToShoppingCart(productId, z,title, category, image_path, tag, price,maxQuantity);
    })

})
function addToShoppingCart2(id,quantity,title){
    addToShoppingCart(id,quantity,title);
}