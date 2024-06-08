
console.log(localStorage.getItem('shopping_cart'));


let productsInCart = JSON.parse(localStorage.getItem("shopping_cart"));
let content =document.getElementById('containerProducts');
let subTotalPrice = document.getElementById('shopping-cart-subtotal');
let totalPrice = document.getElementById('shopping-cart-total');

let s = 0;
productsInCart.forEach((e) => {
    s += (+e.price.slice(0,e.price.length - 1)) * +e.quantity;

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
        <form class='mt-lg-4 mx-lg-5' action="" >
            <input type="number" value='${e.quantity}' min="1" width="30">
        </form>
        <h5 class="product-cart-price mt-lg-4 pt-lg-2 mx-lg-5" >
            ${e.price}
        </h5>
        <span class="position-absolute"><i class="fa fa-trash"></i></span>
            </div>
            </div>
       `)

})

let tax = 3;
    let cartProductNumber = document.querySelectorAll('.shopping-cart-page form input[type="number"]');
    console.log(cartProductNumber);
    subTotalPrice.innerText = "$"+s.toFixed(2);
    totalPrice.innerText = "$"+(s+tax).toFixed(2);

    let sum = +subTotalPrice.innerText.slice(1);

    let trashIcons = document.querySelectorAll('.shopping-cart-page .fa-trash');

    let noItemsCart = document.getElementById('no-items-in-cart');
    noItemsCart.innerText = localStorage.getItem('count_shopping_cart');
    let check =setInterval(()=>{
        if(sum == 0){
            totalPrice.innerText = '$0.00';
        }
    },15);
    trashIcons.forEach((icon)=>{
        icon.onclick = () => {

            let parentIcon = icon.parentElement.parentElement;
            let allProductInCart = document.querySelectorAll('.product-in-cart');
            parentIcon.classList.add('fade-out');
            parentIcon.ontransitionend = () => {parentIcon.remove();}


            let priceItem = parentIcon.children[3].innerText;
            priceItem = priceItem.trim();

            sum -= priceItem.slice(0,priceItem.length-1);
            totalCalc();

            let id = parentIcon.children[1].value;
            console.log(id);

            let countSC = +localStorage.getItem('count_shopping_cart');
            let productsInCart = JSON.parse(localStorage.getItem('shopping_cart'));
            console.log(productsInCart);
            let idx = -1;
            for(let i = 0 ; i<productsInCart.length;i++){
                if(productsInCart[i].id == id){
                    idx = i;
                    break;
                }
            }
            console.log(idx);
            if(idx >= 0 && idx < productsInCart.length) {countSC-= productsInCart[idx].quantity;productsInCart.splice(idx,1);}

            localStorage.setItem('count_shopping_cart',countSC.toString());
            localStorage.setItem('shopping_cart',JSON.stringify(productsInCart));
            document.querySelector('header .fa-shopping-cart span').innerHTML = countSC.toString();
            noItemsCart.innerText = countSC;
        }
    })
    cartProductNumber.forEach((num)=>{
        let id = num.parentElement.parentElement.children[1];
        let cartProductPrice = num.parentElement.nextElementSibling;
        let val = cartProductPrice.innerText.slice(0,cartProductPrice.innerText.length-1);
        num.setAttribute("min","1");
        let countSC = +localStorage.getItem('count_shopping_cart');
        let productsInCart = JSON.parse(localStorage.getItem('shopping_cart'));
        let old = num.value;
        num.onchange = () => {
            if(+num.value + countSC > 15){console.log(11);num.value=old; return}
            cartProductPrice.innerText = (num.value * val).toFixed(2) + '$';
            console.log(old + ' '+ num.value)
            if(num.value < old){
                sum -= +val;
                countSC--;
                productsInCart.forEach((e)=>{
                    if(e.id == id.value) {
                        e.quantity -= 1;
                        return;
                    }
                })
            }
            else {
                sum+= +val;
                countSC++;
                productsInCart.forEach((e)=>{
                    if(e.id == id.value)e.quantity+=1;
                })
            }
            old = num.value;
            totalCalc();
            localStorage.setItem('count_shopping_cart',countSC.toString());
            localStorage.setItem('shopping_cart',JSON.stringify(productsInCart));
            document.querySelector('header .fa-shopping-cart span').innerHTML = countSC.toString();
            noItemsCart.innerText = countSC;


        }

    })

    let totalCalc = () =>{
        subTotalPrice.innerText = '$'+sum.toFixed(2);
        totalPrice.innerText = '$' + (tax + sum).toFixed(2);
    }




