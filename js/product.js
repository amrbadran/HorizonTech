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