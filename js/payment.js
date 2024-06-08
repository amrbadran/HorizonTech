$(document).ready(function() {

    $('#subTotal').text(localStorage.getItem('subTotalPrice'));
    $('#TotalP').text(localStorage.getItem('TotalPrice'));

    if(localStorage.getItem('TotalPrice') == ""){
        window.location.href="cart.php";
    }
    $('#payButton').on('click', function() {
        const cardNumber = $('#cardNumber').val().trim();
        const expiryDate = $('#expiryDate').val().trim();
        const cvc = $('#cvc').val().trim();
        const streetAddress = $('#streetAddress').val().trim();
        const aptUnit = $('#aptUnit').val().trim();
        const country = $('#country').val();
        const city = $('#city').val().trim();
        const state = $('#state').val().trim();
        const zipCode = $('#zipCode').val().trim();


        let errorMsg = '';

        if (!/^\d{16}$/.test(cardNumber)) {
            errorMsg += 'Invalid card number. ';

        }
        if (!/^\d{2}\/\d{2}$/.test(expiryDate)) {
            errorMsg += 'Invalid expiry date. ';

        }
        else if (!/^\d{3,4}$/.test(cvc)) {
            errorMsg += 'Invalid CVC. ';

        }
        else if (streetAddress === '') {
            errorMsg += 'Street address is required. ';

        }
        else if (country === '') {
            errorMsg += 'Country is required. ';

        }
        else if (city === '') {
            errorMsg += 'City is required. ';

        }
        else if (state === '') {
            errorMsg += 'State is required. ';

        }
        else if (!/^\d{5}$/.test(zipCode)) {
            errorMsg += 'Invalid zip code. ';

        }

        if (errorMsg) {
            $('#payment-error-msg').text(errorMsg);
        } else {
            $('#payment-error-msg').text('');


            let dataCart ="";
            let productInCart = JSON.parse(localStorage.getItem("shopping_cart"));
            productInCart.forEach(e => {
                let id = e.id.toString();
                let quantity = e.quantity.toString();

                dataCart += id + '+' + quantity + ',';
            })
            dataCart = dataCart.slice(0,dataCart.length - 1);
            $.ajax({
                url: 'php/ajax/ajax_checkout_order.php',
                type: 'POST',
                data: {
                    cardNumber: cardNumber,
                    expiryDate: expiryDate,
                    cvc: cvc,
                    streetAddress: streetAddress,
                    aptUnit: aptUnit,
                    country: country,
                    city: city,
                    state: state,
                    zipCode: zipCode,
                    dataCart:dataCart,

                },
                success: function(response) {
                    if(response == 'success'){
                        window.location.href="index.php";
                        localStorage.setItem('shopping_cart',JSON.stringify([]));
                        localStorage.setItem('count_shopping_cart','0');
                    }
                    else if(response.toString()[0] == 'E'){
                        let idToHandle = response.toString().slice(1);

                         window.location.href = `product.php?id=${idToHandle}&error=qaError`;
                    }
                    else {
                        $('#payment-error-msg').text('Payment processing failed: ' + response);
                    }

                },
                error: function(response) {
                    $('#payment-error-msg').text('Payment processing failed: ' + response);
                }
            });
        }
    });
});
