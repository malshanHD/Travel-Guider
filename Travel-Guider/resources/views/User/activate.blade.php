<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .card {
            background-color: #fff;
            border-radius: 10px;
            border: none;
            position: relative;
            margin-bottom: 30px;
            box-shadow: 0 0.46875rem 2.1875rem rgba(90, 97, 105, 0.1), 0 0.9375rem 1.40625rem rgba(90, 97, 105, 0.1), 0 0.25rem 0.53125rem rgba(90, 97, 105, 0.12), 0 0.125rem 0.1875rem rgba(90, 97, 105, 0.1);
        }

        .l-bg-cherry {
            background: linear-gradient(to right, #493240, #f09) !important;
            color: #fff;
        }

        .l-bg-blue-dark {
            background: linear-gradient(to right, #373b44, #4286f4) !important;
            color: #fff;
        }

        .l-bg-green-dark {
            background: linear-gradient(to right, #0a504a, #38ef7d) !important;
            color: #fff;
        }

        .l-bg-orange-dark {
            background: linear-gradient(to right, #a86008, #ffba56) !important;
            color: #fff;
        }

        .card .card-statistic-3 .card-icon-large .fas,
        .card .card-statistic-3 .card-icon-large .far,
        .card .card-statistic-3 .card-icon-large .fab,
        .card .card-statistic-3 .card-icon-large .fal {
            font-size: 110px;
        }

        .card .card-statistic-3 .card-icon {
            text-align: center;
            line-height: 50px;
            margin-left: 15px;
            color: #000;
            position: absolute;
            right: -5px;
            top: 20px;
            opacity: 0.1;
        }

        .l-bg-cyan {
            background: linear-gradient(135deg, #289cf5, #84c0ec) !important;
            color: #fff;
        }

        .l-bg-green {
            background: linear-gradient(135deg, #23bdb8 0%, #43e794 100%) !important;
            color: #fff;
        }

        .l-bg-orange {
            background: linear-gradient(to right, #f9900e, #ffba56) !important;
            color: #fff;
        }

        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
    @php
        // Collect parameters for hashing
        $merchant_id = '1227290'; 
        $order_id = $customer->id;
        $items = 'registration fee';
        $currency = 'LKR';
        $amount = '1499';
        $secret = 'MzgyMTk2ODQzODM4MzcxNjQyNDUyMjUxODI5NjY2MTkwOTY4NDk0Mw=='; // Retrieve secret key from .env file

        // // Concatenate parameters
        // $concatenated = $merchant_id . $order_id . $items . $currency . $amount;

        // // Generate hash
        // $hash = hash('sha256', $concatenated . $secret);

        $hash = strtoupper(
            md5($merchant_id . $order_id . number_format($amount, 2, '.', '') . $currency . strtoupper(md5($secret))),
        );
    @endphp

    <form method="post" action="https://sandbox.payhere.lk/pay/checkout">
        <input type="hidden" name="merchant_id" value="1227290">
        <!-- Replace your Merchant ID -->
        <input type="hidden" name="return_url" value="http://localhost/Travel-Guider/public/payhere/callback">
        <input type="hidden" name="cancel_url" value="/payment/cancel">
        <input type="hidden" name="notify_url" value="http://localhost/Travel-Guider/public/payhere/callback">
        {{-- </br></br>Item Details</br> --}}
        <input type="hidden" name="order_id" value="{{ $customer->id }}">
        <input type="hidden" name="items" value="registration fee">
        <input type="hidden" name="currency" value="LKR">
        <input type="hidden" name="amount" value="1499">
        {{-- </br></br>Customer Details</br> --}}
        <input type="hidden" name="first_name" value="{{ $customer->first_name }} ">
        <input type="hidden" name="last_name" value="{{ $customer->last_name }}">
        <input type="hidden" name="email" value="{{ $customer->email }}">
        <input type="hidden" name="phone" value="{{ $customer->phone_number }}">
        <input type="hidden" name="address"
            value="{{ $customer->city }} {{ $customer->state }} {{ $customer->zip_code }}">
        <input type="hidden" name="city" value="{{ $customer->city }}">
        <input type="hidden" name="country" value="{{ $customer->country }}">
        <input type="hidden" name="hash" value="{{ $hash }}">
        <!-- Replace with generated hash -->
        {{-- <input type="submit" value="Buy Now"> --}}

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card l-bg-orange-dark">
                        <div class="card-body">
                            <div class="alert alert-danger" role="alert">
                                We kindly request you to proceed with payment of the registration fee 
                            </div>
                        </div>
                        <div class="card-footer text-center l-bg-orange-dark">
                            <input type="submit" class="btn btn-danger" value="Pay Now">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>


</body>

</html>
