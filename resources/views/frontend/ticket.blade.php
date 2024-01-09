<!DOCTYPE html>
<html>

<head>
    <title>Concert Invoice</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .invoice {
            border: 1px solid #ddd;
            padding: 20px;
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .invoice h2 {
            text-align: center;
            color: #333;
        }

        .invoice .details {
            margin-top: 20px;
        }

        .invoice .details p {
            margin: 5px 0;
            color: #555;
            font-weight: bold
        }

         .invoice .details span{
            font-weight: normal;
         }

        .invoice .items {
            margin-top: 20px;
        }

        .invoice .items table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .invoice .items th,
        .invoice .items td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .invoice .items th {
            background-color: #f2f2f2;
        }

        .invoice .total {
            margin-top: 20px;
            text-align: right;
        }

        .invoice .total p {
            color: #555;
            font-size: 18px;
            margin: 5px 0;
        }

        .invoice .footer {
            margin-top: 20px;
            text-align: center;
            color: #888;
        }
    </style>
</head>

<body>
    <div class="invoice">
        <h2>CONCERT INVOICE</h2>
        <div class="details">
            <p>Concert Name: <span>{{$ticket->concert->name}}</span></p>
            <p>Date: <span>{{ \Carbon\Carbon::parse($ticket->concert->date_time)->format('j F Y (l)') }}</span></p>
            <p>Time: <span>{{ \Carbon\Carbon::parse($ticket->concert->date_time)->format('g:i A') }}</span></p>
            <p>Venue: <span>{{$ticket->concert->venue}}</span></p>
            <p>Organizer: <span>{{$ticket->concert->organizer_name}}</span></p>
        </div>
        <div class="items">
            <table>
                <tr>
                    <th>Ticket ID</th>
                    <th>Quantity</th>
                    <th>Seat Number</th>
                </tr>
                <tr>
                    <td>{{$ticket->ticket_id}}</td>
                    <td>{{$ticket->seat_quantity}}</td>
                    <td>{{$ticket->seat_numbers}}</td>
                </tr>
            </table>
        </div>
        <div class="total">
            <p style="font-weight:bold">Total Price: ${{ $ticket->total_price }}</p>
        </div>
        <div class="footer">
            <p>Thank you, {{ $ticket->user->name }} ({{ $ticket->user->email }}), for your purchase! Enjoy the concert!</p>
        </div>
    </div>
</body>


</html>
