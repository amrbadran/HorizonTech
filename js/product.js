let images = document.querySelectorAll('.product-images img');
let productImage = document.querySelector('.image-product img');
productImage.onload = function(){
    setTimeout(()=>{productImage.style.opacity='1'},300);
}
images.forEach((image) => {
    image.addEventListener('click',()=>{

        if(productImage.src === image.src) return;
        productImage.style.opacity='0';
        productImage.src=image.src;


    })
})

$(document).ready(function(){
    console.log(localStorage.getItem('shopping_cart'))
    $('#buttonAddCart').click(function(e){
        e.preventDefault();


        var productId = $('#product_id').val();

        var quantity = +$('#quantityCart').val();
        var cartQuan = new Number(document.querySelector('header .fa-shopping-cart span').innerHTML.toString());
        var title = $('.col-lg-7 h2').text();
        var category = $('#productCategoryCart').val();
        var image_path = $('#productImageCart').val();
        var tag = $('#productTagCart').val();
        var price = $('#productPriceCart').val();
        addToShoppingCart(productId,quantity,title,category,image_path,tag,price);


    });

});

function addToShoppingCart(productId,quantity,title,category,image_path,tags,price){

    var productId = productId;
    var quantity = quantity;
    var cartQuan = new Number(document.querySelector('header .fa-shopping-cart span').innerHTML.toString());
    var title = title;


    if(localStorage.getItem('shopping_cart') === null){
        localStorage.setItem('shopping_cart',JSON.stringify([]));
    }
    if(localStorage.getItem('count_shopping_cart') === null){
        localStorage.setItem('count_shopping_cart','0');
    }

    let countSC = +localStorage.getItem('count_shopping_cart');
    let productsInCart = JSON.parse(localStorage.getItem('shopping_cart'));

    if(countSC + quantity > 15){
        document.getElementById('error-msg-max-cart').style.display = 'block';
        return;
    }

    const obj = {
        id:productId,
        name:title,
        category:category,
        image:image_path,
        tags:tags,
        price:price,
        quantity:quantity
    }
    let flag = false;
    productsInCart.forEach((e)=>{
        if(e.id == productId){
            e.quantity += quantity;
            flag =true;
        }
    })
    if(!flag) productsInCart.push(obj);
    countSC+= quantity;
    localStorage.setItem('count_shopping_cart',countSC.toString());
    localStorage.setItem('shopping_cart',JSON.stringify(productsInCart));
    document.querySelector('header .fa-shopping-cart span').innerHTML = countSC.toString();

}
