<!-- resources/views/mail/thanks-for-repair-payment.blade.php -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>Payment Confirmation & Thank You</title>
    </head>
    <body
        style="
            margin: 0;
            padding: 0;
            background: #f4f4f4;
            font-family: 'Inter', Arial, sans-serif;
            color: #1f2937;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        "
    >
        <div
            style="
                max-width: 600px;
                margin: 30px auto;
                background: #ffffff;
                border-radius: 12px;
                overflow: hidden;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            "
        >
            <!-- Header -->
            <div
                style="
                    background: #2563eb;
                    background-image: linear-gradient(135deg, #2563eb, #1d4ed8);
                    padding: 30px 20px;
                    text-align: center;
                    color: #ffffff;
                "
            >
                <h1
                    style="
                        margin: 0;
                        font-size: 26px;
                        font-weight: 700;
                        letter-spacing: -0.5px;
                    "
                >
                    Thank You for Your Payment!
                </h1>
                <p style="margin-top: 8px; opacity: 0.9; font-size: 16px">
                    Your repair service is confirmed
                </p>
            </div>

            <!-- Content -->
            <div style="padding: 35px 30px">
                <p
                    style="
                        font-size: 18px;
                        font-weight: 500;
                        margin-bottom: 20px;
                    "
                >
                    Hi <strong>{{ $repairBooking->name }}</strong
                    >,
                </p>

                <p
                    style="
                        font-size: 16px;
                        color: #4b5563;
                        margin-bottom: 25px;
                        line-height: 1.6;
                    "
                >
                    Thank you for your payment for the repair services at
                    <strong>{{ $repairBooking->store->name }}</strong
                    >. We really appreciate your business and hope you're
                    completely satisfied with the work we've done!
                </p>

                <!-- Invoice -->
                <div style="margin: 30px 0">
                    <h2
                        style="
                            font-size: 18px;
                            font-weight: 600;
                            color: #2563eb;
                            margin-bottom: 15px;
                            padding-bottom: 8px;
                            border-bottom: 1px solid #e5e7eb;
                        "
                    >
                        Payment Details
                    </h2>
                    <table
                        style="
                            width: 100%;
                            border-collapse: collapse;
                            margin-bottom: 25px;
                            font-size: 15px;
                        "
                    >
                        <tr style="border-bottom: 1px solid #e5e7eb">
                            <th
                                style="
                                    text-align: left;
                                    padding: 12px 15px;
                                    background-color: #f3f4f6;
                                    font-weight: 600;
                                    color: #1f2937;
                                    border-radius: 6px 0 0 6px;
                                "
                            >
                                Services
                            </th>
                            <td style="padding: 12px 15px">
                                <ul
                                    style="
                                        list-style: none;
                                        padding: 0;
                                        margin: 0;
                                    "
                                >
                                    @foreach($repairBooking->repairServices as
                                    $service)
                                    <li style="margin-bottom: 8px">
                                        <strong>{{ $service->name }}</strong>
                                        <br />
                                        <span style="color: #666">
                                            £{{ number_format($service->pivot->price, 2) }}
                                            @if($service->pivot->discount) - £{{ number_format($service->pivot->discount, 2) }}
                                            discount @endif
                                        </span>
                                    </li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e5e7eb">
                            <th
                                style="
                                    text-align: left;
                                    padding: 12px 15px;
                                    background-color: #f3f4f6;
                                    font-weight: 600;
                                    color: #1f2937;
                                "
                            >
                                Service Date
                            </th>
                            <td style="padding: 12px 15px">
                                {{ $repairBooking->selected_date }} at
                                {{ $repairBooking->selected_time }}
                            </td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e5e7eb">
                            <th
                                style="
                                    text-align: left;
                                    padding: 12px 15px;
                                    background-color: #f3f4f6;
                                    font-weight: 600;
                                    color: #1f2937;
                                "
                            >
                                Total Amount
                            </th>
                            <td
                                style="
                                    padding: 12px 15px;
                                    font-weight: 600;
                                    color: #2563eb;
                                "
                            >
                                £{{ number_format($repairBooking->total_amount, 2) }}
                            </td>
                        </tr>
                        @if($repairBooking->total_discount)
                        <tr style="border-bottom: 1px solid #e5e7eb">
                            <th
                                style="
                                    text-align: left;
                                    padding: 12px 15px;
                                    background-color: #f3f4f6;
                                    font-weight: 600;
                                    color: #1f2937;
                                "
                            >
                                Total Discount
                            </th>
                            <td
                                style="
                                    padding: 12px 15px;
                                    color: #dc2626;
                                    font-weight: 600;
                                "
                            >
                                -£{{ number_format($repairBooking->total_discount, 2) }}
                            </td>
                        </tr>
                        @endif
                        <tr style="border-bottom: 1px solid #e5e7eb">
                            <th
                                style="
                                    text-align: left;
                                    padding: 12px 15px;
                                    background-color: #f3f4f6;
                                    font-weight: 600;
                                    color: #1f2937;
                                "
                            >
                                Final Amount
                            </th>
                            <td
                                style="
                                    padding: 12px 15px;
                                    color: #dc2626;
                                    font-weight: 700;
                                    font-size: 16px;
                                "
                            >
                                £{{ number_format($repairBooking->final_amount, 2) }}
                            </td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e5e7eb">
                            <th
                                style="
                                    text-align: left;
                                    padding: 12px 15px;
                                    background-color: #f3f4f6;
                                    font-weight: 600;
                                    color: #1f2937;
                                "
                            >
                                Payment Method
                            </th>
                            <td style="padding: 12px 15px">
                                {{ $repairBooking->payment_method ?? 'Card Payment' }}
                            </td>
                        </tr>
                        <tr>
                            <th
                                style="
                                    text-align: left;
                                    padding: 12px 15px;
                                    background-color: #f3f4f6;
                                    font-weight: 600;
                                    color: #1f2937;
                                "
                            >
                                Reference Number
                            </th>
                            <td style="padding: 12px 15px">
                                {{ $repairBooking->reference ?? 'REP-' . $repairBooking->id}}
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- Additional info -->
                <p
                    style="
                        font-size: 16px;
                        color: #4b5563;
                        margin-bottom: 25px;
                        line-height: 1.6;
                    "
                >
                    Your repair has been registered in our system, and this
                    email serves as your receipt. Should you need any further
                    documentation or have questions about your service, please
                    don't hesitate to contact us.
                </p>

                <!-- Contact section -->
                <div
                    style="
                        margin: 30px 0;
                        padding: 20px;
                        background-color: #f3f4f6;
                        border-radius: 8px;
                        border-left: 4px solid #2563eb;
                    "
                >
                    <h3
                        style="
                            font-size: 16px;
                            font-weight: 600;
                            margin-bottom: 10px;
                            color: #1d4ed8;
                        "
                    >
                        Need Help or Have Questions?
                    </h3>
                    <p style="font-size: 15px; margin-bottom: 5px">
                        We're here to assist you with any queries about your
                        repair service.
                    </p>
                    <p style="font-size: 15px; margin-bottom: 5px">
                        <strong>Phone:</strong>
                        <a
                            href="tel:{{ $repairBooking->store->phone }}"
                            style="
                                color: #2563eb;
                                text-decoration: none;
                                font-weight: 500;
                            "
                            >{{ $repairBooking->store->phone }}</a
                        >
                    </p>
                    <p style="font-size: 15px; margin-bottom: 5px">
                        <strong>Email:</strong>
                        <a
                            href="mailto:{{ $repairBooking->store->email ?? 'support@' . str_replace(' ', '', strtolower($repairBooking->store->name)) . '.com' }}"
                            style="
                                color: #2563eb;
                                text-decoration: none;
                                font-weight: 500;
                            "
                            >{{ $repairBooking->store->email ?? 'support@' . str_replace(' ', '', strtolower($repairBooking->store->name)) . '.com' }}</a
                        >
                    </p>
                </div>

                <!-- Signature -->
                <div style="margin-top: 30px; font-size: 16px">
                    <p>
                        Thanks again for choosing
                        <span
                            style="font-weight: 700; color: #1f2937"
                            >{{ $repairBooking->store->name }}</span
                        >—we value your trust in our service!
                    </p>
                    <p style="margin-top: 10px">
                        Best regards,<br />The
                        {{ $repairBooking->store->name }} Team
                    </p>
                </div>
            </div>

            <!-- Footer -->
            <div
                style="
                    background-color: #f3f4f6;
                    padding: 20px;
                    text-align: center;
                    font-size: 13px;
                    color: #4b5563;
                    border-top: 1px solid #e5e7eb;
                "
            >
                <p>
                    &copy; {{ now()->year }} {{ $repairBooking->store->name }}.
                    All rights reserved.
                </p>
                <p style="margin-top: 15px; font-size: 12px">
                    This email was sent to {{ $repairBooking->email }}. If you
                    believe this was sent in error, please contact us.
                </p>
            </div>
        </div>
    </body>
</html>
