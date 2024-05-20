window.onscroll = function(){
    fixedHeader();
}

let rangeSlider = document.querySelector('.range-slider');
rangeSlider.onchange = () => {
    document.querySelector('.filter-price span').innerText = rangeSlider.value + '$';
}

function fixedHeader(){
    let landing_header = document.querySelector('.landing-header');
    let offset = landing_header.offsetTop;
    try{
        let offset2 = document.querySelector('.section-wlc h1').offsetTop;
        if(window.pageYOffset > offset2){
            landing_header.classList.add('navbar-sticky-bg');
        }
        else{
            landing_header.classList.remove('navbar-sticky-bg');
        }
    }
    catch (e) {
        //
    }
}