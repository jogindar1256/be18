<!DOCTYPE html>
<html>
<head>
    <title>Merchant Check Out Page</title>
</head>
<body>
    <form method="post" action="{{ $paymentUrl }}" id="phonepe-payment-form">
        @foreach ($paymentParams as $name => $value)
            <input type="hidden" name="{{ $name }}" value="{{ $value }}">
        @endforeach
    </form>

    <button type="button" id="pay-with-phonepe">Pay with PhonePe</button>

    <script src="{{ asset('path/to/jquery.min.js') }}"></script>
    <script src="{{ asset('path/to/phonepe-redirect.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#pay-with-phonepe').click(function() {
                // Trigger form submission when the "Pay with PhonePe" button is clicked
                $('#phonepe-payment-form').submit();
            });
        });
    </script>
</body>
</html>
