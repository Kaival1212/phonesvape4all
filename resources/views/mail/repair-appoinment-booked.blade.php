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

                    <!-- Service -->
                    <tr>
                        <td style="padding: 10px; font-weight: bold">
                            Service
                        </td>
                        <td style="padding: 10px">
                            {{ $repairBooking->repairService->name ?? 'N/A' }}
                            for
                            {{ $repairBooking->repairService->product->name ?? 'N/A' }}
                        </td>
                    </tr>

                    <!-- Name -->
                    <tr style="background: #f9f9f9">
                        <td style="padding: 10px; font-weight: bold">Name</td>
                        <td style="padding: 10px">
                            {{ $repairBooking->name }}
                        </td>
                    </tr>

                    <!-- Email -->
                    <tr>
                        <td style="padding: 10px; font-weight: bold">Email</td>
                        <td style="padding: 10px">
                            {{ $repairBooking->email }}
                        </td>
                    </tr>

                    <!-- Phone -->
                    <tr style="background: #f9f9f9">
                        <td style="padding: 10px; font-weight: bold">Phone</td>
                        <td style="padding: 10px">
                            {{ $repairBooking->phone }}
                        </td>
                    </tr>

                    <!-- Date -->
                    <tr>
                        <td style="padding: 10px; font-weight: bold">Date</td>
                        <td style="padding: 10px">
                            {{ $repairBooking->selected_date }}
                        </td>
                    </tr>

                    <!-- Time -->
                    <tr style="background: #f9f9f9">
                        <td style="padding: 10px; font-weight: bold">Time</td>
                        <td style="padding: 10px">
                            {{ $repairBooking->selected_time }}
                        </td>
                    </tr>

                    <!-- Price -->
                    <tr>
                        <td style="padding: 10px; font-weight: bold">Price</td>
                        <td style="padding: 10px">
                            £{{ number_format($repairBooking->price, 2) }}
                        </td>
                    </tr>

                    @if ($repairBooking->discount)
                    <!-- Discount -->
                    <tr style="background: #f9f9f9">
                        <td style="padding: 10px; font-weight: bold">
                            Discount
                        </td>
                        <td style="padding: 10px">
                            −£{{ number_format($repairBooking->discount, 2) }}
                        </td>
                    </tr>
                    <!-- Total -->
                    <tr>
                        <td style="padding: 10px; font-weight: bold">Total</td>
                        <td style="padding: 10px">
                            £{{ number_format($repairBooking->total ?? ($repairBooking->price - $repairBooking->discount), 2) }}
                        </td>
                    </tr>
                    @endif

                    <!-- Store -->
                    <tr style="background: #f9f9f9">
                        <td style="padding: 10px; font-weight: bold">Store</td>
                        <td style="padding: 10px">
                            {{ $repairBooking->store->name ?? 'N/A' }} –
                            {{ $repairBooking->store->city ?? 'N/A' }}
                        </td>
                    </tr>

                    @if ($repairBooking->notes)
                    <!-- Notes -->
                    <tr>
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
