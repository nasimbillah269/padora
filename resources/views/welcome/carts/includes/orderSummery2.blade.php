<table class="table table-borderless">
    <tr>
        <td style="border:none;">Sub total</td>
        <td style="border:none;text-align: right;min-width: 130px">{{priceFullFormat($cartTotalPrice)}}</td>
    </tr>
    <!--<tr>-->
    <!--    <td style="border:none;">Vat</td>-->
    <!--    <td style="border:none;text-align: right;">{{priceFullFormat($cartTax)}}</td>-->
    <!--</tr>-->
    <tr>
        <td style="border:none;">Shipping Charge
        @if($isDhaka=='no')
        <span style="color: #c1bcbc;">
            (Cocksheet + courier)
        </span>
        @endif
        </td>
        <td style="border:none;text-align: right;">
        <span class="shippingChang">{{priceFullFormat($shippingCharge)}}</span>
        </td>
    </tr>
    @if($couponDisc > 0)
    <tr>
        <td style="border:none;">Discount</td>
        <td style="border:none;text-align: right;">
        <span class="shippingChang">{{priceFullFormat($couponDisc)}}</span>
        </td>
    </tr>
    @endif
    <tr>
        <th style="border-top: 1px solid #c3bfbf;border-bottom: 1px solid #c3bfbf;">Total</th>
        <th style="border-top: 1px solid #c3bfbf;text-align: right;border-bottom: 1px solid #c3bfbf;" >{{general()->currency}} 
        <span class="grandTotal">{{priceFormat($grandTotal)}}</span>
        </th>
    </tr>
</table>