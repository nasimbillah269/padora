@php
    $order = $datas['order'];
    $brand = '#672678';
    $accent = '#b07f20';
    $ink = '#1f2430';
    $muted = '#6b7280';
    $line = '#e9e6ef';
    $soft = '#f6f4fa';

    $totalDiscount = $order->coupon_discount + $order->items->sum('total_coupon_discount');
    $payLabel = $order->payment_method === 'handCash' ? 'Cash on Delivery' : ucfirst(str_replace('_', ' ', (string) $order->payment_method));
    $statusLabel = ucfirst(str_replace('_', ' ', (string) $order->order_status));
@endphp
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="color-scheme" content="light only" />
    <meta name="supported-color-schemes" content="light only" />
    <title>Order Confirmation &ndash; {{ general()->title }}</title>
    <style type="text/css">
        body { margin: 0; padding: 0; width: 100% !important; background: #eceaf1; }
        table { border-collapse: collapse; }
        img { border: 0; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; }
        a { color: {{ $brand }}; }
        .px { padding-left: 32px; padding-right: 32px; }

        @media only screen and (max-width: 620px) {
            .wrap { width: 100% !important; }
            .px { padding-left: 20px !important; padding-right: 20px !important; }
            .stack { display: block !important; width: 100% !important; }
            .stack-r { text-align: left !important; padding-top: 2px !important; }
            .h1 { font-size: 20px !important; }
            .hide-sm { display: none !important; }
            .total-num { font-size: 20px !important; }
        }
    </style>
</head>
<body style="margin:0; padding:0; background:#eceaf1;">

    <div style="display:none; max-height:0; overflow:hidden; mso-hide:all; font-size:1px; line-height:1px; color:#eceaf1;">
        Order #{{ $order->invoice }} confirmed &mdash; total {{ priceFullFormat($order->grand_total) }}. Thank you for shopping with {{ general()->title }}.
    </div>

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#eceaf1;">
        <tr>
            <td align="center" style="padding:24px 12px;">

                <table role="presentation" width="600" cellpadding="0" cellspacing="0" class="wrap" style="width:600px; max-width:600px; background:#ffffff; border-radius:14px; overflow:hidden; box-shadow:0 1px 4px rgba(31,36,48,0.08); font-family:-apple-system,'Segoe UI',Roboto,Helvetica,Arial,'Noto Sans Bengali','Hind Siliguri',sans-serif;">

                    <!-- Logo -->
                    <tr>
                        <td align="center" class="px" style="padding:28px 32px 20px;">
                            <img src="{{ URL::asset(general()->logo()) }}" alt="{{ general()->title }}" height="40" style="height:40px; max-height:40px; width:auto; display:block;" />
                        </td>
                    </tr>

                    <!-- Confirmation banner -->
                    <tr>
                        <td style="background:{{ $brand }}; padding:26px 32px; text-align:center;">
                            <div style="font-size:13px; letter-spacing:2px; text-transform:uppercase; color:#e8d7ef; font-weight:600;">Order Confirmed</div>
                            <div class="h1" style="font-size:24px; font-weight:700; color:#ffffff; margin-top:6px;">Thank you, {{ $order->name }}!</div>
                            <div style="font-size:14px; color:#e8d7ef; margin-top:6px;">Your order has been received and is being processed.</div>
                        </td>
                    </tr>

                    <!-- Order meta -->
                    <tr>
                        <td class="px" style="padding:24px 32px 8px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td class="stack" style="width:50%; vertical-align:top; padding-bottom:12px;">
                                        <div style="font-size:11px; letter-spacing:1px; text-transform:uppercase; color:{{ $muted }}; font-weight:600;">Invoice</div>
                                        <div style="font-size:15px; color:{{ $ink }}; font-weight:700; margin-top:3px;">#{{ $order->invoice }}</div>
                                    </td>
                                    <td class="stack stack-r" style="width:50%; vertical-align:top; text-align:right; padding-bottom:12px;">
                                        <div style="font-size:11px; letter-spacing:1px; text-transform:uppercase; color:{{ $muted }}; font-weight:600;">Order Date</div>
                                        <div style="font-size:15px; color:{{ $ink }}; font-weight:700; margin-top:3px;">{{ $order->created_at->format('d M Y, h:i A') }}</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="stack" style="width:50%; vertical-align:top;">
                                        <div style="font-size:11px; letter-spacing:1px; text-transform:uppercase; color:{{ $muted }}; font-weight:600;">Payment</div>
                                        <div style="font-size:15px; color:{{ $ink }}; font-weight:700; margin-top:3px;">{{ $payLabel ?: 'N/A' }}</div>
                                    </td>
                                    <td class="stack stack-r" style="width:50%; vertical-align:top; text-align:right;">
                                        <div style="font-size:11px; letter-spacing:1px; text-transform:uppercase; color:{{ $muted }}; font-weight:600;">Status</div>
                                        <div style="display:inline-block; font-size:12px; color:{{ $brand }}; font-weight:700; background:{{ $soft }}; border:1px solid {{ $line }}; border-radius:20px; padding:3px 12px; margin-top:3px;">{{ $statusLabel }}</div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Items -->
                    <tr>
                        <td class="px" style="padding:20px 32px 0;">
                            <div style="font-size:13px; letter-spacing:1px; text-transform:uppercase; color:{{ $ink }}; font-weight:700; padding-bottom:8px; border-bottom:2px solid {{ $brand }};">Order Summary</div>

                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                @foreach($order->items as $item)
                                <tr>
                                    <td style="padding:14px 0; border-bottom:1px solid {{ $line }}; vertical-align:top;">
                                        <div style="font-size:14px; color:{{ $ink }}; font-weight:600; line-height:1.4;">{!! $item->product_name !!}</div>
                                        <div style="font-size:12px; color:{{ $muted }}; margin-top:4px;">
                                            {{ $item->quantity }} &times; {{ priceFullFormat($item->price) }}
                                            @if($item->total_coupon_discount > 0)
                                                &nbsp;&bull;&nbsp; <span style="color:{{ $accent }};">&minus;{{ priceFullFormat($item->total_coupon_discount) }} off</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td style="padding:14px 0; border-bottom:1px solid {{ $line }}; vertical-align:top; text-align:right; white-space:nowrap;">
                                        <div style="font-size:14px; color:{{ $ink }}; font-weight:700;">{{ priceFullFormat($item->final_price) }}</div>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>

                    <!-- Totals -->
                    <tr>
                        <td class="px" style="padding:16px 32px 0;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="padding:5px 0; font-size:14px; color:{{ $muted }};">Subtotal</td>
                                    <td style="padding:5px 0; font-size:14px; color:{{ $ink }}; text-align:right; white-space:nowrap;">{{ priceFullFormat($order->total_price) }}</td>
                                </tr>
                                @if($totalDiscount > 0)
                                <tr>
                                    <td style="padding:5px 0; font-size:14px; color:{{ $muted }};">Discount</td>
                                    <td style="padding:5px 0; font-size:14px; color:{{ $accent }}; text-align:right; white-space:nowrap;">&minus;{{ priceFullFormat($totalDiscount) }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td style="padding:5px 0 14px; font-size:14px; color:{{ $muted }};">Shipping charge</td>
                                    <td style="padding:5px 0 14px; font-size:14px; color:{{ $ink }}; text-align:right; white-space:nowrap;">
                                        @if($order->shipping_charge > 0){{ priceFullFormat($order->shipping_charge) }}@else <span style="color:#1a7f37; font-weight:600;">Free</span>@endif
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="px" style="padding:0 32px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:{{ $brand }}; border-radius:10px;">
                                <tr>
                                    <td style="padding:16px 20px; font-size:14px; color:#e8d7ef; font-weight:600; text-transform:uppercase; letter-spacing:1px;">Grand Total</td>
                                    <td class="total-num" style="padding:16px 20px; font-size:22px; color:#ffffff; font-weight:800; text-align:right; white-space:nowrap;">{{ priceFullFormat($order->grand_total) }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Delivery details -->
                    <tr>
                        <td class="px" style="padding:26px 32px 0;">
                            <div style="font-size:13px; letter-spacing:1px; text-transform:uppercase; color:{{ $ink }}; font-weight:700; padding-bottom:10px; border-bottom:2px solid {{ $brand }};">Delivery Details</div>
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin-top:12px;">
                                <tr>
                                    <td style="padding:3px 0; font-size:13px; color:{{ $muted }}; width:90px; vertical-align:top;">Name</td>
                                    <td style="padding:3px 0; font-size:13px; color:{{ $ink }}; font-weight:600;">{{ $order->name }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:3px 0; font-size:13px; color:{{ $muted }}; vertical-align:top;">Mobile</td>
                                    <td style="padding:3px 0; font-size:13px; color:{{ $ink }}; font-weight:600;">{{ $order->mobile }}</td>
                                </tr>
                                @if($order->email)
                                <tr>
                                    <td style="padding:3px 0; font-size:13px; color:{{ $muted }}; vertical-align:top;">Email</td>
                                    <td style="padding:3px 0; font-size:13px; color:{{ $ink }}; font-weight:600;">{{ $order->email }}</td>
                                </tr>
                                @endif
                                @if($order->address)
                                <tr>
                                    <td style="padding:3px 0; font-size:13px; color:{{ $muted }}; vertical-align:top;">Address</td>
                                    <td style="padding:3px 0; font-size:13px; color:{{ $ink }}; font-weight:600; line-height:1.5;">{{ $order->address }}</td>
                                </tr>
                                @endif
                            </table>
                        </td>
                    </tr>

                    <!-- CTA -->
                    <tr>
                        <td align="center" class="px" style="padding:28px 32px 4px;">
                            <table role="presentation" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="center" style="background:{{ $brand }}; border-radius:8px;">
                                        <a href="{{ route('invoiceView', $order->invoice) }}" target="_blank" style="display:inline-block; padding:13px 34px; font-size:15px; font-weight:700; color:#ffffff; text-decoration:none; font-family:-apple-system,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;">View Your Order</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td class="px" style="padding:24px 32px 0;">
                            <div style="border-top:1px solid {{ $line }};"></div>
                        </td>
                    </tr>

                    <!-- Contact -->
                    <tr>
                        <td class="px" style="padding:20px 32px 30px; text-align:center;">
                            <div style="font-size:13px; color:{{ $ink }}; font-weight:700;">{{ general()->title }}</div>
                            @if(general()->address_one)
                            <div style="font-size:12px; color:{{ $muted }}; margin-top:6px; line-height:1.6;">{!! general()->address_one !!}</div>
                            @endif
                            <div style="font-size:12px; color:{{ $muted }}; margin-top:6px; line-height:1.7;">
                                @if(general()->email)<a href="mailto:{{ general()->email }}" style="color:{{ $brand }}; text-decoration:none;">{{ general()->email }}</a>@endif
                                @if(general()->email && general()->mobile) &nbsp;&bull;&nbsp; @endif
                                @if(general()->mobile){{ general()->mobile }}@endif
                            </div>
                            @if(general()->website)
                            <div style="font-size:12px; margin-top:6px;">
                                <a href="{{ general()->website }}" target="_blank" style="color:{{ $brand }}; text-decoration:none;">{{ preg_replace('#^https?://#', '', rtrim(general()->website, '/')) }}</a>
                            </div>
                            @endif
                        </td>
                    </tr>
                </table>

                <div style="font-size:11px; color:#9aa0ab; padding:16px 12px 4px; font-family:-apple-system,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;">
                    &copy; {{ date('Y') }} {{ general()->title }}. This is an automated order confirmation.
                </div>

            </td>
        </tr>
    </table>
</body>
</html>
