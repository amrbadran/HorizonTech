window.onscroll = function(){
    fixedHeader();
}


function fixedHeader(){
    let landing_header = document.querySelector('.landing-header');
    let offset = landing_header.offsetTop;
    let offset2 = document.querySelector('.section-wlc h1').offsetTop;
    if(window.pageYOffset > offset2){
        landing_header.classList.add('navbar-sticky-bg');
    }
    else{
        landing_header.classList.remove('navbar-sticky-bg');
    }
}