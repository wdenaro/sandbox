<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="refresh" content="10000">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Cutive+Mono" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #333333;
                font-family: 'Cutive Mono', monotype;
                font-weight: 200;
                margin: 0;
            }
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 4.8vw;
            }

            h4 {
                font-size: 200px;
                margin: 0;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            table {
                margin: 0 auto;
            }
            
            tr:nth-child(even) {background: #ececec}
            tr:nth-child(odd) {background: #fdfdfd}
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            <div class="content">

                <div class="title m-b-md">
                    eBAY FEE SCHEDULE
                </div>
                <table cellpadding="10">
                    <tr>
                        <td>Sale Price</td>
                        <td>eBay Fee</td>
                        <td>PayPal Fee</td>
                        <td>Postage</td>
                        <td>Net Sale</td>
                        <td>Cost</td>
                    </tr>
                    @foreach ($arr as $item)
                        <tr>
                            <td>${{ $item['gross'] }}</td>
                            <td>${{ $item['ebayFee'] }}</td>
                            <td>${{ $item['paypalFee'] }}</td>
                            <td>${{ $item['postage'] }}</td>
                            <td>${{ $item['net'] }}</td>
                            <td>{{ $item['cost'] }}%</td>

                        </tr>
                    @endforeach
                </table>

            </div>
        </div>
    </body>
</html>
