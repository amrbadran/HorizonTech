
let productsInCart = JSON.parse(localStorage.getItem("shopping_cart"));
let content = document.getElementById('containerProducts');
let subTotalPrice = document.getElementById('shopping-cart-subtotal');
let totalPrice = document.getElementById('shopping-cart-total');

function getSubPrice(){
    let carts = JSON.parse(localStorage.getItem('shopping_cart'));
    let sum =0;
    carts.forEach((e)=>{
        let p= e.price.slice(0 , e.price.length - 1);
        sum = Number(sum) + ( Number(p) * Number(e.quantity));
    })
    return sum;
}
console.log(localStorage.getItem('shopping_cart'));
console.log(111);
let s = getSubPrice();
console.log(s);
function countProductCart(id){
    let carts = JSON.parse(localStorage.getItem('shopping_cart'));
    let res = -1;
    carts.forEach((e)=>{
        if(e.id === id){res = e.quantity}
    })
    return res;
}
productsInCart.forEach((e) => {
    //s += (+e.price.slice(0, e.price.length - 1)) * Number(localStorage.getItem('productQuantityCart' + e.id));
    let quan = countProductCart(e.id);
    $('#containerProducts').prepend(`
            <div class="product-in-cart d-lg-flex w-100 position-relative">
            <div class="image-cart-product">
            <img src="${e.image}" width="100" height="120" alt="">
        </div>
        <input type="hidden" value="${e.id}"/>
        <div class="product-cart-info h-75">
            <p class="product-cart-cats">${e.category}</p>
            <h5><a href="">${e.name}</a></h5>
            <p class="product-cart-tags">${e.tags}</p>
        </div>
        
        <h5 class="product-cart-price mt-lg-4 pt-lg-2 mx-lg-5" >
             <span>${quan}</span>
             <span style="margin:0 35px;color:var(--main-color-low-opacity)">X</span>
             <span>${e.price}</span>            
        </h5>
        <span class="position-absolute"><i class="fa fa-trash"></i></span>
            </div>
            </div>
       `)

})

let tax = 3;
let cartProductNumber = document.querySelectorAll('.shopping-cart-page form input[type="number"]');
console.log(cartProductNumber);
subTotalPrice.innerText = "$" + s.toFixed(2);
totalPrice.innerText = "$" + (s + tax).toFixed(2);

let sum = +subTotalPrice.innerText.slice(1);

let trashIcons = document.querySelectorAll('.shopping-cart-page .fa-trash');

let noItemsCart = document.getElementById('no-items-in-cart');

noItemsCart.innerText = getCountCart(localStorage.getItem('shopping_cart'));


let check = setInterval(() => {
    if (sum == 0) {
        totalPrice.innerText = '$0.00';
    }
}, 15);
trashIcons.forEach((icon) => {
    icon.onclick = () => {

        let parentIcon = icon.parentElement.parentElement;
        let allProductInCart = document.querySelectorAll('.product-in-cart');
        parentIcon.classList.add('fade-out');
        parentIcon.ontransitionend = () => {
            parentIcon.remove();
        }


        let priceItem = parentIcon.children[3].children[2].innerText;
        let quantity = parentIcon.children[3].children[0].innerText;

        sum -= Number(priceItem.slice(0, priceItem.length - 1)) * Number(quantity);
        totalCalc();

        removeFromShoppingCart(parentIcon);

    }
})

function removeFromShoppingCart(parentIcon) {
    let id = parentIcon.children[1].value;
    console.log(id);

    let productsInCart = JSON.parse(localStorage.getItem('shopping_cart'));
    console.log(productsInCart);
    let idx = -1;
    for (let i = 0; i < productsInCart.length; i++) {
        if (productsInCart[i].id == id) {
            idx = i;
            break;
        }
    }
    console.log(idx);
    if (idx >= 0 && idx < productsInCart.length) {

        productsInCart.splice(idx, 1);
    }

    localStorage.setItem('shopping_cart', JSON.stringify(productsInCart));
    noItemsCart.innerText = getCountCart(localStorage.getItem('shopping_cart'));
}

let totalCalc = () => {
    subTotalPrice.innerText = '$' + sum.toFixed(2);
    totalPrice.innerText = '$' + (tax + sum).toFixed(2);
}

document.querySelector('.button-checkout button').addEventListener('click', () => {

    localStorage.setItem('subTotalPrice', subTotalPrice.innerText);
    localStorage.setItem('TotalPrice', totalPrice.innerText);

});



