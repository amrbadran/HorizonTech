<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .payment-form {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            box-sizing: border-box;
        }
        .payment-form h2 {
            margin-bottom: 20px;
            color: rgb(255, 35, 25);
            text-align: center;
        }
        .payment-form input, .payment-form select, .payment-form button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .payment-form input:focus, .payment-form select:focus, .payment-form button:focus {
            outline: none;
            border-color: rgb(255, 35, 25);
            box-shadow: 0 0 5px rgba(255, 35, 25, 0.5);
        }
        .payment-form input[type="text"]::placeholder {
            color: #aaa;
        }
        .payment-form button {
            background-color: rgb(255, 35, 25);
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        .payment-form button:hover {
            background-color: rgb(200, 25, 20);
        }
        .payment-form .flex-container {
            display: flex;
            gap: 10px;
        }
        .payment-form .flex-container > input {
            flex: 1;
        }
        .summary {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #ccc;
        }
        .summary div {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .summary .total {
            font-weight: bold;
            color: rgb(255, 35, 25);
        }
        @media (max-width: 600px) {
            .payment-form .flex-container {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
<div class="payment-form">
    <h2>Payment Details</h2>
    <form>
        <input type="text" name="cardnumber" placeholder="Card Number" required>
        <div class="flex-container">
            <input type="text" name="expiry" placeholder="MM / YY" required>
            <input type="text" name="cvc" placeholder="CVC" required>
        </div>
        <input type="text" name="address" placeholder="Street Address" required>
        <input type="text" name="apartment" placeholder="Apt, Unit, Suite, etc. (optional)">
        <select name="country" required>
            <option value="United States">United States</option>
            <!-- Add more country options as needed -->
        </select>
        <input type="text" name="city" placeholder="City" required>
        <div class="flex-container">
            <input type="text" name="state" placeholder="State" required>
            <input type="text" name="zipcode" placeholder="Zip Code" required>
        </div>
        <div class="summary">
            <div><span>Subtotal</span><span>$144.00</span></div>
            <div><span>Yearly plan discount</span><span>-$84.00</span></div>
            <div class="total"><span>Billed Now</span><span>$60.00</span></div>
        </div>
        <button type="submit">Pay</button>
    </form>
</div>
</body>
</html>
<?php
