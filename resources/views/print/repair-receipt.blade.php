<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Receipt - Print Ready</title>
    <style>
        /* Screen styles */
        .screen-only {
            display: block;
            padding: 20px;
            max-width: 400px;
            margin: 0 auto;
            font-family: Arial, sans-serif;
        }

        .print-button {
            background: #007cba;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin: 10px 0;
        }

        .print-button:hover {
            background: #005a87;
        }

        .receipt-preview {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px 0;
            background: #f9f9f9;
            font-family: 'Courier New', monospace;
            font-size: 12px;
        }

        /* Print styles - optimized for thermal printer */
        @media print {
            .screen-only {
                display: none !important;
            }

            body, html {
                margin: 0 !important;
                padding: 0 !important;
                width: 62mm;
                font-family: Arial, sans-serif;
                font-size: 10px;
                line-height: 1.2;
            }

            @page {
                size: 62mm auto;
                margin: 2mm;
            }

            .print-content {
                display: block !important;
                width: 58mm;
                margin: 0;
                padding: 0;
            }

            .divider {
                border-top: 1px solid #000;
                margin: 2mm 0;
            }

            .header {
                text-align: center;
                font-weight: bold;
                font-size: 12px;
                margin-bottom: 3mm;
            }

            .status {
                text-align: center;
                font-weight: bold;
                padding: 2mm;
                border: 1px solid #000;
                margin: 2mm 0;
            }

            .info-line {
                margin: 1mm 0;
                font-size: 9px;
            }

            .total {
                margin-top: 3mm;
                padding-top: 2mm;
                border-top: 2px solid #000;
                font-weight: bold;
                text-align: center;
            }
        }

        .print-content {
            display: none;
        }
    </style>
</head>
<body>
<!-- Screen display -->
<div class="screen-only">
    <h2>Receipt Preview</h2>

    <div class="receipt-preview">
        <div style="text-align: center; font-weight: bold;">
            {{ $repairBooking->store->name ?? 'PHONES & VAPES LTD' }}
        </div>
        <div style="text-align: center;">
            ================================
        </div>
        <div style="text-align: center; font-weight: bold; border: 1px solid;">
            {{ strtoupper($repairBooking->payment_status ?? 'PENDING') }}
        </div>
        <div style="text-align: center; font-weight: bold;">
            REF: {{ str_pad($repairBooking->id ?? '000001', 6, '0', STR_PAD_LEFT) }}
        </div>
        <div>--------------------------------</div>
        <div>Customer: {{ $repairBooking->name ?? 'Test Customer' }}</div>
        <div>Phone: {{ $repairBooking->phone ?? '07123456789' }}</div>
        <div>Date: {{ $repairBooking->created_at?->format('d/m/Y') ?? date('d/m/Y') }}</div>
        <div>--------------------------------</div>
        <div>Services:</div>
        @if($repairBooking->repairServices ?? false)
            @foreach($repairBooking->repairServices as $service)
                <div>• {{ $service->name }}</div>
            @endforeach
        @else
            <div>• Screen Repair</div>
            <div>• Battery Replacement</div>
        @endif
        <div>================================</div>
        <div style="font-weight: bold; text-align: center;">
            TOTAL: £{{ number_format($repairBooking->final_amount ?? 85.00, 2) }}
        </div>
        <div style="text-align: center;">
            Method: {{ ucfirst($repairBooking->payment_method ?? 'Card') }}
        </div>
        <div style="text-align: center; margin-top: 10px;">
            Thank you for your business!
        </div>
    </div>

    <button class="print-button" onclick="printReceipt()">Print Receipt</button>
    <button class="print-button" onclick="printReceiptNewWindow()" style="background: #28a745;">Print in New Window</button>

    <p><strong>Instructions for your client:</strong></p>
    <ul>
        <li>Click "Print Receipt" to print directly</li>
        <li>Use "Print in New Window" if the first option doesn't work</li>
        <li>In the print dialog, select your Brother QL-700 printer</li>
        <li>Set paper size to 62mm if prompted</li>
    </ul>
</div>

<!-- Print content (hidden on screen) -->
<div class="print-content">
    <div class="header">
        {{ $repairBooking->store->name ?? 'PHONES & VAPES LTD' }}
    </div>

    <div class="divider"></div>

    <div class="status">
        {{ strtoupper($repairBooking->payment_status ?? 'PENDING') }}
    </div>

    <div style="text-align: center; font-weight: bold; margin: 2mm 0;">
        REF: {{ str_pad($repairBooking->id ?? '000001', 6, '0', STR_PAD_LEFT) }}
    </div>

    <div class="divider"></div>

    <div class="info-line">Customer: {{ $repairBooking->name ?? 'Test Customer' }}</div>
    <div class="info-line">Phone: {{ $repairBooking->phone ?? '07123456789' }}</div>
    <div class="info-line">Date: {{ $repairBooking->created_at?->format('d/m/Y') ?? date('d/m/Y') }}</div>

    <div class="divider"></div>

    <div class="info-line"><strong>Services:</strong></div>
    @if($repairBooking->repairServices ?? false)
        @foreach($repairBooking->repairServices as $service)
            <div class="info-line">• {{ $service->name }}</div>
        @endforeach
    @else
        <div class="info-line">• Screen Repair</div>
        <div class="info-line">• Battery Replacement</div>
    @endif

    <div class="total">
        <div>TOTAL: £{{ number_format($repairBooking->final_amount ?? 85.00, 2) }}</div>
        <div>Method: {{ ucfirst($repairBooking->payment_method ?? 'Card') }}</div>
        <div style="margin-top: 3mm;">Thank you!</div>
    </div>
</div>

<script>
    function printReceipt() {
        window.print();
    }

    function printReceiptNewWindow() {
        const printContent = document.querySelector('.print-content').innerHTML;
        const printWindow = window.open('', '_blank', 'width=300,height=600');

        printWindow.document.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Receipt</title>
                    <style>
                        body {
                            margin: 0;
                            padding: 5mm;
                            font-family: Arial, sans-serif;
                            font-size: 10px;
                            line-height: 1.2;
                            width: 62mm;
                        }
                        @page {
                            size: 62mm auto;
                            margin: 2mm;
                        }
                        .divider {
                            border-top: 1px solid #000;
                            margin: 2mm 0;
                        }
                        .header {
                            text-align: center;
                            font-weight: bold;
                            font-size: 12px;
                            margin-bottom: 3mm;
                        }
                        .status {
                            text-align: center;
                            font-weight: bold;
                            padding: 2mm;
                            border: 1px solid #000;
                            margin: 2mm 0;
                        }
                        .info-line {
                            margin: 1mm 0;
                            font-size: 9px;
                        }
                        .total {
                            margin-top: 3mm;
                            padding-top: 2mm;
                            border-top: 2px solid #000;
                            font-weight: bold;
                            text-align: center;
                        }
                    </style>
                </head>
                <body>${printContent}</body>
                </html>
            `);

        printWindow.document.close();
        printWindow.focus();

        setTimeout(() => {
            printWindow.print();
            setTimeout(() => printWindow.close(), 1000);
        }, 500);
    }

    // Auto-print option (uncomment if needed)
    // window.addEventListener('load', function() {
    //     setTimeout(printReceipt, 1000);
    // });
</script>
</body>
</html>
