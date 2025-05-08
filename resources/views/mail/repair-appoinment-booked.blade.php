<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Repair Appointment Confirmation</title>
    </head>
    <body
        style="
            margin: 0;
            padding: 0;
            background: #f4f4f4;
            font-family: Arial, sans-serif;
        "
    >
        <div
            style="
                max-width: 600px;
                margin: 30px auto;
                background: #fff;
                border-radius: 8px;
                overflow: hidden;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            "
        >
            <div
                style="
                    background: #007bff;
                    padding: 20px;
                    text-align: center;
                    color: #fff;
                "
            >
                <h2 style="margin: 0">Repair Appointment Confirmed</h2>
            </div>

            <div style="padding: 30px">
                <p style="font-size: 16px">
                    Hello <strong>{{ $repairBooking->name }}</strong
                    >,
                </p>
                <p style="font-size: 16px">
                    Thank you for booking a repair service with us. Here are
                    your appointment details:
                </p>

                <table
                    style="
                        width: 100%;
                        font-size: 15px;
                        margin-top: 20px;
                        border-collapse: collapse;
                    "
                >
                    <!-- Booking ID -->
                    <tr style="background: #f9f9f9">
                        <td style="padding: 10px; font-weight: bold">
                            Booking ID
                        </td>
                        <td style="padding: 10px">#{{ $repairBooking->id }}</td>
                    </tr>

                    <!-- Services -->
                    <tr>
                        <td style="padding: 10px; font-weight: bold">
                            Services
                        </td>
                        <td style="padding: 10px">
                            <ul style="list-style: none; padding: 0; margin: 0">
                                @foreach($repairBooking->repairServices as $service)
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

                    <!-- Total Amount -->
                    <tr style="background: #f9f9f9">
                        <td style="padding: 10px; font-weight: bold">
                            Total Amount
                        </td>
                        <td style="padding: 10px">
                            £{{ number_format($repairBooking->total_amount, 2) }}
                        </td>
                    </tr>

                    @if($repairBooking->total_discount)
                    <!-- Total Discount -->
                    <tr>
                        <td style="padding: 10px; font-weight: bold">
                            Total Discount
                        </td>
                        <td style="padding: 10px">
                            -£{{ number_format($repairBooking->total_discount, 2) }}
                        </td>
                    </tr>
                    @endif

                    <!-- Final Amount -->
                    <tr style="background: #f9f9f9">
                        <td style="padding: 10px; font-weight: bold">
                            Final Amount
                        </td>
                        <td style="padding: 10px">
                            £{{ number_format($repairBooking->final_amount, 2) }}
                        </td>
                    </tr>

                    <!-- Store -->
                    <tr>
                        <td style="padding: 10px; font-weight: bold">Store</td>
                        <td style="padding: 10px">
                            {{ $repairBooking->store->name ?? 'N/A' }} –
                            {{ $repairBooking->store->city ?? 'N/A' }}
                        </td>
                    </tr>

                    @if ($repairBooking->notes)
                    <!-- Notes -->
                    <tr style="background: #f9f9f9">
                        <td style="padding: 10px; font-weight: bold">Notes</td>
                        <td style="padding: 10px">
                            {{ $repairBooking->notes }}
                        </td>
                    </tr>
                    @endif
                </table>

                <p style="margin-top: 30px; font-size: 15px">
                    If you have any questions or need to change your
                    appointment, feel free to contact us at
                    <a href="mailto:support@kaival.co.uk"
                        >support@kaival.co.uk</a
                    >.
                </p>
                <p style="font-size: 15px">
                    Thank you,<br />
                    The Team at Phones For All
                </p>
            </div>

            <div
                style="
                    background: #f1f1f1;
                    padding: 15px;
                    text-align: center;
                    font-size: 12px;
                    color: #888;
                "
            >
                &copy; {{ now()->year }} Phones For All. All rights reserved.
            </div>
        </div>
    </body>
</html>
