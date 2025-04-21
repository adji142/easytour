<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Voucher</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            color: #000;
            margin: 40px;
        }

        h1 {
            font-size: 20px;
        }

        .logo {
            width: 150px;
            margin-bottom: 20px;
        }

        .bold {
            font-weight: bold;
        }

        .gray-box {
            background-color: #888;
            color: #fff;
            padding: 8px;
            margin: 20px 0 10px 0;
            font-weight: bold;
        }

        .section {
            display: flex;
            justify-content: space-between;
        }

        .left, .right {
            width: 48%;
        }

        .info-label {
            font-weight: bold;
        }

        .voucher-box {
            background-color: #eee;
            padding: 10px;
            font-size: 16px;
            font-weight: bold;
            margin-top: 10px;
        }

        .footer {
            margin-top: 40px;
        }

        .small-text {
            font-size: 12px;
        }
    </style>
</head>
<body>

    <h1>VOUCHER</h1>

    <img src="{{ asset('images/misc/easytour.png') }}" class="logo" alt="Easy Tour Logo">

    <p>Dear {{ $data['BookingFullName'] }}</p>

    <p>
        Thank you for choosing Easy Tour for your perfect vacation.<br>
    </p>

    <div class="gray-box">RESERVATION INFO:</div>

    <div class="section">
        <div class="left">
            <p><span class="info-label">Reservation ID:</span> {{ $data['DocumentNumber'] }}</p>
            <p><span class="info-label">Client:</span> {{ $data['BookingFullName'] }}</p>
            <p><span class="info-label">Agency:</span><br>
                {{ $data['PartnerName'] }}<br>
                {{ $data['BillingAddress'] }}<br>
                Tel: {{ $data['CompanyPhone'] }}<br>
                E-mail: {{ $data['CompanyEmail'] }}
            </p>
        </div>
        <div class="right">
            <p><span class="info-label">Item:</span> {{ $data['BookingItem'] }}</p>
            <p><span class="info-label">Package:</span> {{ $data['BookingPackage'] }}</p>
            <p><span class="info-label">Adult Guest :</span> {{ $data['AdultBookingPerson'] }}</p>
            <p><span class="info-label">Child Guest :</span> {{ $data['ChildBookingPerson'] }}</p>
            <p><span class="info-label">Infant Guest :</span> {{ $data['InfantBookingPerson'] }}</p>

            <p><span class="info-label">Travel Date:</span><br> {{ $data['BookingDate'] }}
        </div>
    </div>

    <p>
        <strong>Special Request: </strong><br>
        {{ $data['SpecialRequest'] }}
    </p>

    <div class="gray-box">Voucher amount :</div>
    <div class="voucher-box">Rp. {{ number_format($data['TotalNetTransaction'], 2, ',', '.') }}</div>

    <div class="footer">
        <p>Thank you for choosing us and we look forward to welcoming you on board again very soon.</p>
        <p>Your Easy Tour Solution</p>
    </div>

</body>
</html>
