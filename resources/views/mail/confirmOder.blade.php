<!DOCTYPE html>
<html lang="en">

@php
$giatien = 0;
$phivanchuyen = 0;
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello Word</title>

    <style>
        body {
            font-size: 62.5%;
            line-height: 1;
            padding: 22px 10px;
            padding-bottom: 55px;
        }

        .headear {
            font-weight: bold;
            font-size: 3em;
            margin: 0 35px;
        }

        .title {
            font-weight: bold;
            font-size: 1.6em;
            line-height: 1.7em;
            margin-bottom: 10px;
            margin-top: 0px;
            font-family: 'Google Sans';
            color: #0f146d;
        }

        .shop_name {
            text-align: left;
            margin: 0;
        }

        .shop_name b {
            text-transform: capitalize;
        }

        .product_name {
            font-weight: bold;
            margin-top: 0;
        }

        #table {
            display: block;
            width: 725px;
            margin: 5px auto;
            padding: 20px 25px;
            border: 1px solid #0f146d;
        }

        #thongtinmua {
            margin: 0 auto;
            font-size: 1.2em;
            margin-bottom: 15px;
        }

        #thongtinmua thead {
            cursor: pointer;
            background: #c9dff0;
        }

        #thongtinmua thead tr th {
            font-weight: bold;
            padding: 12px 30px;
            padding-left: 42px;
            text-align: left;
            font-family: 'Google Sans';
            color: #0f146d;
        }

        #thongtinmua thead tr th span {
            white-space: nowrap;
            padding-right: 20px;
            background-repeat: no-repeat;
            background-position: 100% 100%;
        }

        #thongtinmua td {
            text-align: left;
        }

        #thongtinmua img {
            margin-right: 15px;
            width: 165px;
        }

        .shop_info {
            display: flex;
            text-align: left;
        }

        .shop_info h4 {
            margin: 0;
            margin-right: 5px;
        }

        .logo {
            text-align: center;
        }

        .logo img {
            width: 150px;
        }

        .camon {
            text-align: center;
            font-size: 27px;
            color: #0f146d;
            font-weight: 500;
        }

        .dichvu {
            margin-top: 15px;
            width: 100%;
        }

        .dichvu a {
            font-size: 18px;
            color: #080c58;
        }

        .chaohoi .p1 {
            font-size: 18px;
            font-family: 'Google Sans';
        }

        .title_address {
            width: 200px;
            color: #080c58;
            font-weight: 500;

        }

        .diachi td {
            font-size: 15px;
        }

        .diachi td a {
            color: #047ebd;
        }

        .diachi .p1 {
            font-size: 18px;
            font-family: 'Google Sans';
        }

        .clear {
            background: #f2f2f2;
            height: 3px;
            margin: 10px 0;
        }

        .title__product {
            font-size: 17px;
            font-weight: 500;
            text-transform: capitalize;
            font-family: 'Google Sans';
        }

        .noidung__sanpham p {
            margin: 5px 0;
        }

        .t__end {
            text-align: end;
        }

        .total {
            color: #c7760c;
            font-weight: 500;
        }

        .tinhtrangdonhang {
            margin-top: 5px;
        }

        .thanhtien {
            width: 100%;
        }

        .thanhtien td {
            font-size: 1.2em;
        }
    </style>
</head>

<body>

    <div id="table">

        <div class="logo">
            <img src="https://drive.google.com/thumbnail?id=1CSckMtCRTxCxmXT7JZd_V9WwyoDoM7dK&sz=w200-h200">
        </div>

        <table class="camon dichvu">
            <tr>
                <td><a href="/">T???o xo???n ?????i vi???t</a></td>
                <td><a href="/">S??n ?????i vi???t</a></td>
                <td><a href="/">Khuy???n m???i l???n</a></td>
                <td><a href="/">H??? tr??? kh??ch h??ng</a></td>
            </tr>
        </table>

        <p class="camon">C???m ??n b???n ???? ?????t h??ng t???i Davichat</p>

        <div class="chaohoi">
            <p class="p1">Xin ch??o {{ $details['guest_name'] }}</p>
            <p style="margin-top: 0px;">Ch??ng t??i ???? nh???n ???????c y??u c???u ?????t h??ng c???a b???n v?? ??ang ti???n h??nh x??? l??. B???n s???
                nh???n ???????c th??ng b??o ti???p theo khi ????n h??ng ???? s???n s??ng ???????c giao.</p>
        </div>

        <div class="diachi">

            <p class="p1">????n h??ng c???a b???n ???????c giao ?????n</p>

            <table width="100%">
                <tr>
                    <td class="title_address">T??n:</td>
                    <td colspan="2">{{ $details['guest_name'] }}</td>
                </tr>
                <tr>
                    <td class="title_address">?????a ch??? nh???n h??ng:</td>
                    <td colspan="2">{{ $details['guest_address'] }}</td>
                </tr>
                <tr>
                    <td class="title_address">??i???n tho???i:</td>
                    <td colspan="2">{{ $details['guest_phone'] }}</td>
                </tr>
                <tr>
                    <td class="title_address">Email:</td>
                    <td colspan="2">{{ $details['guest_email'] }}</td>
                </tr>
            </table>

        </div>

        <div class="clear"></div>


        <div id="thongtinmua">
            @foreach($details['listOrders'] as $shop)
            @php
            $phivanchuyen += $shop['price_ship'];
            @endphp
            <p style="text-transform: capitalize;">
                <b>Ki???n H??ng #{{$loop->iteration}} - {{ $shop['name_booth'] }}</b>
            </p>
            <div>

                @foreach($shop['products'] as $product)
                @php
                $giatien += $product['total'];
                @endphp
                <table style="margin: 20px 0;">
                    <tr>
                        <td>
                            <img width="100" src="https://picsum.photos/{{ rand(200,210).'/'.rand(200,210) }}">
                        </td>
                        <td style="padding: 0 30px;"></td>
                        <td class="noidung__sanpham">

                            <div>
                                <p class="title__product">{{ $product['name'] }}</p>
                                <p>S??? l?????ng: {{ $product['qty'] }}</p>
                                <p>Loai: {{ $product['proAttrName'] }}, {{ $product['attrDetailName'] }}</p>
                                <p>Gia: {{ number_format($product['total']) }} VND</p>
                            </div>
                        </td>
                    </tr>
                </table>

                @endforeach

            </div>

            <p style="margin-bottom: 0;"><b>Ph?? v???n chuy???n:</b> {{ $shop['price_ship'] }} VND</p>
            <p style="margin: 0;"><b>Th???i gian giao h??ng:</b> t??? 02/2/1021, ?????n 04/2/2021.</p>
            <p style="margin-top: 0;"><b>Ghi ch??: </b> {{ $shop['note'] }}</p>

            <div class="clear"></div>

            @endforeach

        </div>


        <table class="thanhtien">
            <tr>
                <td>Th??nh ti???n:</td>
                <td class="t__end">{{ number_format($giatien) }}</td>
                <td class="t__end">VND</td>
            </tr>
            <tr>
                <td>Ph?? v???n chuy???n:</td>
                <td class="t__end">{{ number_format($phivanchuyen) }}</td>
                <td class="t__end">VND</td>
            </tr>
            <tr>
                <td>Gi???m gi??:</td>
                <td class="t__end">0</td>
                <td class="t__end">VND</td>
            </tr>
            <tr class="total">
                <td>T???ng c???ng:</td>
                <td class="t__end">{{ number_format($giatien + $phivanchuyen) }}</td>
                <td class="t__end">VND</td>
            </tr>
        </table>



        <div class="clear"></div>

        <div class="tinhtrangdonhang">
            <div>Ki???m tra t??nh tr???ng ????n h??ng <a href="/" target="_blank">Link</a></div>
        </div>

        <div class="luyy">
            <p>*L??u ?? nh??? cho b???n: B???n ch??? n??n nh???n h??ng khi tr???ng th??i ????n h??ng l?? ?????ang giao h??ng??? v?? nh??? ki???m tra M??
                ????n h??ng, Th??ng tin ng?????i g???i v?? M?? v???n ????n ????? nh???n ????ng ki???n h??ng nh??.</p>
        </div>

    </div>

</body>

</html>