<!-- resources/views/mail/confirm-buying.blade.php -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Order Confirmation & Pickup Details</title>
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
            <!-- Header -->
            <div
                style="
                    background: #28a745;
                    padding: 20px;
                    text-align: center;
                    color: #fff;
                "
            >
                <h2 style="margin: 0">Thank you for your order!</h2>
            </div>

            <!-- Body -->
            <div style="padding: 30px">
                <p style="font-size: 16px">
                    Hello <strong>{{ $model->customer_name }}</strong
                    >,
                </p>
                <p style="font-size: 16px">
                    We’ve received your order and it’s now reserved for you.
                    Please pick up your item at the store below:
                </p>

                <table
                    style="
                        width: 100%;
                        font-size: 15px;
                        margin-top: 20px;
                        border-collapse: collapse;
                    "
                >
                    <!-- Order ID -->
                    <tr style="background: #f9f9f9">
                        <td style="padding: 10px; font-weight: bold">
                            Order ID
                        </td>
                        <td style="padding: 10px">#{{ $model->id }}</td>
                    </tr>

                    <!-- Product -->
                    <tr>
                        <td style="padding: 10px; font-weight: bold">
                            Product
                        </td>
                        <td style="padding: 10px">
                            {{ $variant->variant_name }} —
                            {{ $variant->product->name }}
                        </td>
                    </tr>

                    <!-- Price -->
                    <tr style="background: #f9f9f9">
                        <td style="padding: 10px; font-weight: bold">Price</td>
                        <td style="padding: 10px">
                            £{{ number_format($model->price,2) }}
                        </td>
                    </tr>

                    @if($model->discount)
                    <!-- Discount -->
                    <tr>
                        <td style="padding: 10px; font-weight: bold">
                            Discount
                        </td>
                        <td style="padding: 10px">
                            −£{{ number_format($model->discount,2) }}
                        </td>
                    </tr>
                    <!-- Total -->
                    <tr style="background: #f9f9f9">
                        <td style="padding: 10px; font-weight: bold">Total</td>
                        <td style="padding: 10px">
                            £{{ number_format($model->total ?? ($model->price - $model->discount),2) }}
                        </td>
                    </tr>
                    @endif

                    <!-- Payment Status -->
                    <tr>
                        <td style="padding: 10px; font-weight: bold">
                            Payment Status
                        </td>
                        <td style="padding: 10px">
                            {{ ucfirst($model->payment_status) }}
                        </td>
                    </tr>

                    @if($model->payment_method)
                    <tr style="background: #f9f9f9">
                        <td style="padding: 10px; font-weight: bold">
                            Payment Method
                        </td>
                        <td style="padding: 10px">
                            {{ ucfirst($model->payment_method) }}
                        </td>
                    </tr>
                    @endif

                    <!-- Pickup Location -->
                    <tr>
                        <td style="padding: 10px; font-weight: bold">
                            Pickup Location
                        </td>
                        <td style="padding: 10px">
                            <strong>{{ $store->name }}</strong
                            ><br />
                            {{ $store->address ?? 'Store address'

                            }}<br />
                            {{ $store->city ?? '' }}
                            {{ $store->postcode ?? '' }}
                        </td>
                    </tr>
                </table>

                <p style="margin-top: 30px; font-size: 15px">
                    When you arrive, please quote your Order ID at the counter.
                    If you need to change or cancel, reply to this email or call
                    us at
                    <a href="tel:{{ $store->phone }}">{{ $store->phone }}</a
                    >.
                </p>

                <p style="font-size: 15px">
                    Thank you for choosing Phones 4 All!
                </p>
            </div>

            <!-- Footer -->
            <div
                style="
                    background: #f1f1f1;
                    padding: 15px;
                    text-align: center;
                    font-size: 12px;
                    color: #888;
                "
            >
                &copy; {{ now()->year }} Phones 4 All. All rights reserved.
            </div>
        </div>
    </body>
</html>
