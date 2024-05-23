let cartProductNumber = document.querySelectorAll('.shopping-cart-page form input[type="number"]');
let subTotalPrice = document.getElementById('shopping-cart-subtotal');
let totalPrice = document.getElementById('shopping-cart-total');
let tax = 3;
let sum = +subTotalPrice.innerText.slice(1);

let trashIcons = document.querySelectorAll('.shopping-cart-page .fa-trash');

let noItemsCart = document.getElementById('no-items-in-cart');

let check =setInterval(()=>{
    if(sum == 0){
        totalPrice.innerText = '$0.00';
    }
},15);
trashIcons.forEach((icon)=>{
    icon.onclick = () => {
        let parentIcon = icon.parentElement.parentElement;
        let allProductInCart = document.querySelectorAll('.product-in-cart');
        parentIcon.remove();
        noItemsCart.innerText = noItemsCart.innerText - 1;
        let priceItem = parentIcon.children[3].innerText;
        priceItem = priceItem.trim();

        sum -= priceItem.slice(0,priceItem.length-1);
        totalCalc();

    }
})
cartProductNumber.forEach((num)=>{
    let cartProductPrice = num.parentElement.nextElementSibling;
    let val = cartProductPrice.innerText.slice(0,cartProductPrice.innerText.length-1);
    num.setAttribute("min","1");
    let old = num.value;
    num.onchange = () => {
        cartProductPrice.innerText = (num.value * val).toFixed(2) + '$';
        console.log(old + ' '+ num.value)
        if(num.value < old){
            sum -= +val;
        }
        else sum+= +val;
        old = num.value;
        totalCalc();
    }
})

let totalCalc = () =>{
    subTotalPrice.innerText = '$'+sum.toFixed(2);
    totalPrice.innerText = '$' + (tax + sum).toFixed(2);
}
