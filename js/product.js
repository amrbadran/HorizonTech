let images = document.querySelectorAll('.product-images img');
let productImage = document.querySelector('.image-product img');
productImage.onload = function () {
    setTimeout(() => {
        productImage.style.opacity = '1'
    }, 300);
}


images.forEach((image) => {
    image.addEventListener('click', () => {

        if (productImage.src === image.src) return;
        productImage.style.opacity = '0';
        productImage.src = image.src;


    })
})

$(document).ready(function () {
    console.log(localStorage.getItem('shopping_cart'))
    $('#buttonAddCart').click(function (e) {
        e.preventDefault();


        var productId = $('#product_id').val();

        var quantity = localStorage.getItem('productQuantityCart'+productId) ===null ? '0' : localStorage.getItem('productQuantityCart'+productId);

        let x =Number(quantity) + Number($('#quantityCart').val());
        localStorage.setItem('productQuantityCart'+productId,x.toString());


        var cartQuan = new Number(document.querySelector('header .fa-shopping-cart span').innerHTML.toString());
        var title = $('.col-lg-7 h2').text();
        var inc = $('#quantityCart').val();
        var category = $('#productCategoryCart').val();
        var image_path = $('#productImageCart').val();
        var tag = $('#productTagCart').val();
        var price = $('#productPriceCart').val();
        addToShoppingCart(productId,inc, title, category, image_path, tag, price);


    });


    console.log(localStorage.getItem('productQuantityCart'+10));
    console.log(localStorage.getItem('productQuantityCart'+5));
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


let carets2 = document.querySelectorAll('.col-lg-3 .card-shop-product  .fa-cart-plus');
carets2.forEach((e)=>{

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

function addToShoppingCart(productId,inc, title, category, image_path, tags, price,max_q) {

    var productId = productId;
    var quantity = Number(localStorage.getItem('productQuantityCart'+productId));
    var cartQuan = new Number(document.querySelector('header .fa-shopping-cart span').innerHTML.toString());
    var title = title;
    var maxQuantity = $('#maxQuantity').val();

    if (maxQuantity < +quantity) {
        localStorage.setItem('productQuantityCart'+productId,maxQuantity);
        alert("You can't Add Above Available Quantity");
        return;
    }
    console.log(+quantity);
    if (max_q < +quantity) {
        localStorage.setItem('productQuantityCart'+productId,max_q);
        alert("You can't Add Above Available Quantity");
        return;
    }

    if (localStorage.getItem('shopping_cart') === null) {
        localStorage.setItem('shopping_cart', JSON.stringify([]));
    }
    if (localStorage.getItem('count_shopping_cart') === null) {
        localStorage.setItem('count_shopping_cart', '0');
    }

    let countSC = Number(localStorage.getItem('count_shopping_cart'));
    let productsInCart = JSON.parse(localStorage.getItem('shopping_cart'));

    if (countSC + quantity > 15) {
        document.getElementById('error-msg-max-cart').style.display = 'block';
        if(document.getElementById('error-msg-max-cart'+productId) !== null)
            document.getElementById('error-msg-max-cart'+productId).style.display = 'block';
        return;
    }
    document.getElementById('error-msg-max-cart').style.display = 'hidden';
    if(document.getElementById('error-msg-max-cart'+productId) !== null)
        document.getElementById('error-msg-max-cart'+productId).style.display = 'hidden';
    const obj = {
        id: productId,
        name: title,
        category: category,
        image: image_path,
        tags: tags,
        price: price,
        quantity: quantity
    }
    let flag = false;
    productsInCart.forEach((e) => {
        if (e.id == productId) {
            e.quantity += inc;
            flag = true;
        }
    })
    if (!flag) productsInCart.push(obj);
    countSC = Number(countSC) +  Number(inc);
    $('#maxQuantity').val(Number(maxQuantity) - Number(quantity));
    localStorage.setItem('count_shopping_cart', countSC.toString());
    localStorage.setItem('shopping_cart', JSON.stringify(productsInCart));
    document.querySelector('header .fa-shopping-cart span').innerHTML = countSC.toString();


}

document.getElementById('closeRating').onclick = function () {
    hideRatingProduct();

}

function hideRatingProduct(){
    document.getElementById("ratingOverlay").remove();
    document.getElementById("ratingProduct").style.display = 'none';
}
