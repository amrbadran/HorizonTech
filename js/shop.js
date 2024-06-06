
let rangeSlider = document.querySelector('.range-slider');
rangeSlider.onchange = () => {
    document.querySelector('.filter-price span').innerText = rangeSlider.value + '$';
}