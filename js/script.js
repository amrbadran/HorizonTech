let stats_vals = [];
window.onload = () => {

    let stat = document.querySelectorAll('.section-stats p');
    stat.forEach((e)=>{stats_vals.push(e.innerText);e.innerText=0;})
}

let flag = false;
window.onscroll = function(){
    fixedHeader();
    let x = document.querySelectorAll('.section-services .col-lg-4');
    let services = document.querySelector('.section-services').offsetTop;
    if(window.pageYOffset > services - 200){
        x.forEach(element => {
            element.style.cssText = "transform:translateX(0px);opacity:1;";
        })
    }else{
        x.forEach(element => {
            element.style.cssText = "transform:translateX(-200px);opacity:0;";
        })
    }

    let stats = document.querySelector('.section-stats').offsetTop;

    if(window.pageYOffset > stats - 1000 && !flag){
        flag = true;
        let stat = document.querySelectorAll('.section-stats p');
        let i = 0;
        stat.forEach((elem,idx) => {

            let interval = setInterval(myFunc,5);
            function myFunc(){
                elem.innerText = +elem.innerText + 1;
                if(elem.innerText === stats_vals[i]) {i++;clearInterval(interval);}
            }
        })
    }
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
