<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Device Reference</title>
        <style>
            @page {
                size: 62mm auto;
                margin: 0;
            }
            body {
                font-family: "Courier New", monospace;
                width: 62mm;
                margin: 0;
                padding: 5mm;
                font-size: 12px;
                line-height: 1.2;
            }
            .header {
                text-align: center;
                margin-bottom: 5px;
            }
            .store-name {
                font-size: 14px;
                font-weight: bold;
            }
            .divider {
                border-top: 1px dashed #000;
                margin: 3px 0;
            }
            .payment-status {
                text-align: center;
                font-size: 16px;
                font-weight: bold;
                margin: 5px 0;
                padding: 3px;
                border: 2px solid #000;
            }
            .payment-status.paid {
                background-color: #90ee90;
            }
            .payment-status.pending {
                background-color: #ffb6c1;
            }
            .reference {
                font-size: 14px;
                font-weight: bold;
                text-align: center;
                margin: 5px 0;
            }
            .customer-info {
                margin: 5px 0;
            }
            .services {
                margin: 5px 0;
            }
            .service-item {
                margin: 2px 0;
            }
            .total {
                font-weight: bold;
                margin: 5px 0;
            }
            .footer {
                text-align: center;
                margin-top: 10px;
                font-size: 10px;
            }
        </style>
    </head>
    <body>
        <div class="header">
            <div class="store-name">{{ $repairBooking->store->name }}</div>
        </div>

        <div class="divider"></div>

        <div class="payment-status {{ $repairBooking->payment_status }}">
            {{ strtoupper($repairBooking->payment_status) }}
        </div>

        <div class="reference">
            REF: {{ str_pad($repairBooking->id, 6, '0', STR_PAD_LEFT) }}
        </div>

        <div class="divider"></div>

        <div class="customer-info">
            <div>Customer: {{ $repairBooking->name }}</div>
            <div>Phone: {{ $repairBooking->phone }}</div>
            <div>Date: {{ $repairBooking->created_at->format('d/m/Y') }}</div>
        </div>

        <div class="divider"></div>

        <div class="services">
            <div>Services:</div>
            @foreach($repairBooking->repairServices as $service)
            <div class="service-item">• {{ $service->name }}</div>
            @endforeach
        </div>

        <div class="divider"></div>

        <div class="total">
            <div>
                Total: £{{ number_format($repairBooking->final_amount, 2) }}
            </div>
            <div>Method: {{ ucfirst($repairBooking->payment_method) }}</div>
        </div>

        <script>
            window.onload = function () {
                window.print();
            };
        </script>
    </body>
</html>
