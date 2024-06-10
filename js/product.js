let images = document.querySelectorAll('.product-images img');
let productImage = document.querySelector('.image-product img');
productImage.onload = function () {
    setTimeout(() => {
        productImage.style.opacity = '1'
    }, 300);
}

shoppingCartArrReconstruct();
images.forEach((image) => {
    image.addEventListener('click', () => {

        if (productImage.src === image.src) return;
        productImage.style.opacity = '0';
        productImage.src = image.src;


    })
})

function getCartQuantityProduct(id){

    let carts = JSON.parse(localStorage.getItem('shopping_cart'));
    if(carts === null) return 0;
    let res = 0;
    carts.forEach((e) => {
        if(e.id == id){
            res = Number(e.quantity);
        }
    });
    return res;
}


let button1 = document.getElementById('buttonAddCart');
button1.onclick = ()=>{
    console.log(1);
    const obj = {
        id: $('#product_id').val(),
        name: $('#titleProduct').val(),
        category: $('#categoryProduct').val(),
        image: $('#productImageCart').val(),
        tags: $('#productTagCart').val(),
        price: $('#productPriceCart').val(),
        quantity:Number($('#quantityCart').val()),
        maxQuantity:Number($('#maxQuantity').val()) -  getCartQuantityProduct(Number($('#product_id').val()))
    }

    console.log(obj);
    add_to_shopping_cart(obj);
}

let carets2 = document.querySelectorAll('.card-shop-product  .fa-cart-plus');
carets2.forEach((e)=>{

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

$(document).ready(function () {
    console.log(localStorage.getItem('shopping_cart'));



    $('#ratingProduct input').on('click',function(){

        let rate = $(this).val();
        let productId = $('#ratingProductID').val();
        let usrId = $('#ratingUsrID').val();
        $.ajax({
            url: 'php/ajax/ajax_review.php',
            type: 'POST',
            data: {
                rate:rate,
                product_id:productId,
                user_id:usrId

            },
            success: function(response) {

                if(response == 'success'){
                    hideRatingProduct();
                }
                else{
                    console.log(response);
                }
            },
            error: function(response) {

            }
        });

    })


});

function validate_shopping_cart(obj,quantityAval){

    let productId = Number(obj.id);
    let quantity = Number(obj.quantity);
    quantityAval = Number(quantityAval);
    let currentQuantityCart = getCountCart(localStorage.getItem('shopping_cart'));

    if(currentQuantityCart + quantity > 15){
        alert("Max quantity is 15");
        return false;
    }

    if(quantityAval < quantity){
        alert("You Can't Add Above Available Quantity");
        return false;
    }


    return true;

}
function add_to_shopping_cart(obj)
{
    if(!validate_shopping_cart(obj,Number(obj.maxQuantity))){
        return;
    }

    let carts = JSON.parse(localStorage.getItem('shopping_cart'));
    let carts_count = localStorage.getItem('count_shopping_cart');
    if(carts === null) {
        localStorage.setItem('shopping_cart',JSON.stringify([]));
        carts = [];
    }

    // shopping_Cart inilized or ready to add

    carts.push(obj);
    localStorage.setItem('shopping_cart',JSON.stringify(carts));
    shoppingCartArrReconstruct();

}
console.log(localStorage.getItem('shopping_cart'))
function shoppingCartArrReconstruct(){

    let carts_old = JSON.parse(localStorage.getItem('shopping_cart'));

    let carts = [];
    carts_old.forEach((e)=>{

        if(cartExist(carts,e) == true){
            addQuantity(carts,e.id,e.quantity);
        }
        else{
            carts.push(e);
        }
    })

    localStorage.setItem('shopping_cart',JSON.stringify(carts));
}

function cartExist(carts,obj){
    let flag = false;

    carts.forEach((e) => {
        if(obj.id === e.id) flag= true;
    });
    return flag;
}
function addQuantity(carts,id,quantity){
    id = Number(id);
    quantity = Number(quantity);
    carts.forEach((e)=>{

        if(e.id == id){
            e.quantity = Number(e.quantity) + Number(quantity);
            return;
        }

    })
}


document.getElementById('closeRating').onclick = function () {
    hideRatingProduct();

}

function hideRatingProduct(){
    document.getElementById("ratingOverlay").remove();
    document.getElementById("ratingProduct").style.display = 'none';
}
