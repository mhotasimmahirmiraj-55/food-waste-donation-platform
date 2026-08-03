<!DOCTYPE html>
<html>
<head>
    <title>Edit Donations</title>
</head>

<body>

<h1>
    Edit Your Donations
</h1>


@foreach($donations as $donation)

<div>

    <h3>
        {{ $donation->title }}
    </h3>


    <p>
        Quantity:
        {{ $donation->quantity }}
    </p>


    <p>
        Expiry:
        {{ $donation->expiry_time }}
    </p>


    <p>
        Address:
        {{ $donation->pickup_address }}
    </p>


    <a href="{{ route('donations.edit', $donation->id) }}">
    Edit
    </a>


</div>


<hr>


@endforeach


</body>
</html>