<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stock PDF</title>
    <style>
        *{
            padding: 0;
            margin: 5px;
            outline: 0;
        }
        table{
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            overflow: hidden;
        }
        td, th{
            border-top: 1px solid #ECF0F1;
            padding: 10px;
        }
        
        td{
            border-left: 1px solid #ECF0F1;
            border-right: 1px solid #ECF0F1;
            color: #777;
            font-size: 14px;
        }
        
        th{
            background-color: #4ECDC4;
        }
        
        tr:nth-of-type(even) td{
            background-color: lighten(#4ECDC4, 35%);
        }

        tr td{
            text-align: center;
        }

    </style>
</head>
<body>

    <table>
        <thead>
            <tr>
                <td colspan="5">
                    <img src="{{asset(App\Models\Setting::first()->header_logo)}}" width="180" alt="Logo">
                    <h2>{{isset(App\Models\Setting::first()->company_name) ? App\Models\Setting::first()->company_name : ""}}</h2>
                    @if(isset($stocktype) && $stocktype == "stockin")
                        <h4>Stock in List</h4>
                    @else
                        <h4>Stock Out List</h4>
                    @endif

                    <div style="margin-bottom: 20px;">

                        @if(isset($start) && isset($end))
                            <h4 style="float: left;">Date: {{date("d-F-Y", strtotime($start))}} to {{date("d-F-Y", strtotime($end))}}</h4>
                        @else
                            <h4 style="float: left;">Date: {{date("d-F-Y")}}</h4>
                        @endif
                        <h4 style="float: right;">Total Entry: {{count($stockAddTotal)}}</h4>
                    </div>

                </td>
            </tr>
            <tr>
                <th colspan="3">Name: {{$product->name}}</th>
                <th colspan="1">Color: {{$product->color->name}}</th>
                <th>Size: {{$product->size->name}}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td>SL</td>
                <td>Qty</td>
                <td>Date</td>
            </tr>
            @foreach($stockAddTotal as $data)
            <tr>
                <td></td>
                <td></td>
                <td>{{$loop->index + 1}}</td>
                <td>{{$data->qty}}</td>
                <td>{{date("h:i a d-F-Y", strtotime($data->created_at))}}</td>
            </tr>
            @endforeach

        </tbody>
    </table>
</body>
</html>