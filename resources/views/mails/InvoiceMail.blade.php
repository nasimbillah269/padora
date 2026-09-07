<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="shortcut icon" href="{{asset(general()->favicon())}}" />
        <title>Order Invoice Mail Form {{general()->title}}</title>
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet" />

        <style>
            body {
                margin: 0;
                background: #f1f1f1;
            }
            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            td,
            th {
                border: 1px solid #dddddd;
                text-align: left;
                font-size: 14px;
                padding: 8px;
            }

            @media only screen and (max-width: 600px) {
            }
        </style>
    </head>
    <body>
        <div style="margin: 25px auto; width: 80%; min-width: 600px; overflow: auto; padding: 15px; background: #fff;">
            <center>
                <img src="{{URL::asset(general()->logo())}}" style="max-width: 200px;" />
                <h2 style="margin: 0;">{{$datas['order']->name}}</h2>
                <p style="margin: 0;">Welcome To {{general()->title}} !</p>
            </center>

            <div style="background: #f1f1f1; padding: 10px; margin: 10px 0;">
                <p style="margin: 0; border-bottom: 1px solid #c6c6c6; padding: 5px 0;">ORDER DETAILS</p>
                <p style="margin: 0;"><strong>Invoice:</strong> #{{ $datas['order']->invoice }}</p>
                <p style="margin: 0;"><strong>Name:</strong> {{ $datas['order']->name }}</p>
                <p style="margin: 0;"><strong>Email:</strong> {{$datas['order']->email}}</p>
                <p style="margin: 0;"><strong>Date:</strong> {{ $datas['order']->created_at->format('d-m-Y h:i A') }}</p>
                <br />
                <table class="table" style="background: white;">
                    <thead>
                        <tr>
                            <th>Product Name & Description</th>
                            <th>Price</th>
                            <th>Quatity</th>
                            <th>Discount</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datas['order']->items as $i=>$item)
                        <tr>
                            <td>
                                {!!$item->product_name!!}
                            </td>
                            <td style="text-align: center;">{{ priceFullFormat($item->price) }}</td>
                            <td style="text-align: center;">{{ $item->quantity }}</td>
                            <td style="text-align: center;">{{ priceFullFormat($item->total_coupon_discount) }}</td>
                            <td style="text-align: center;">{{ priceFullFormat($item->final_price) }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="4" style="text-align: end;">Subtotal</td>
                            <td style="text-align: center;">{{ priceFullFormat($datas['order']->total_price) }}</td>
                        </tr>
                        <tr>
                            <td colspan="4" style="text-align: end;">Total Discount</td>
                            <td style="text-align: center;">{{ priceFullFormat($datas['order']->coupon_discount + $datas['order']->items->sum('total_coupon_discount')) }}</td>
                        </tr>
                        <tr>
                            <td colspan="4" style="text-align: end;">Shipping charge</td>
                            <td style="text-align: center;">@if($datas['order']->shipping_charge>0) {{priceFormat($datas['order']->shipping_charge)}} @else Free Shipping @endif</td>
                        </tr>
                        <tr>
                            <td colspan="4" style="text-align: end;">Grand Total</td>
                            <td style="text-align: center;">{{ priceFullFormat($datas['order']->grand_total) }}</td>
                        </tr>
                        
                    </tbody>
                </table>
                <br />
            </div>

            <div style="background: #f1f1f1; padding: 10px; margin: 10px 0;">
                <p style="margin: 0; border-bottom: 1px solid #c6c6c6; padding: 5px 0;">CONTACT US</p>
                <p>
                    {!!general()->address_one!!} <br />
                    <strong>Email: </strong>{{general()->email}}<br />
                    <strong>Mob: </strong>{{general()->mobile}}<br />
                    <a href="{{general()->website}}" target="_blank">{{general()->website}}</a>
                </p>
            </div>
        </div>
    </body>
</html>
