<!DOCTYPE html>
<html>
<head>
    <title>Edit Donation</title>
</head>

<body>


<h1>Edit Food Donation</h1>


<form method="POST" action="{{ route('donations.update', $donation->id) }}">

    @csrf
    @method('PUT')


    <label>
        Food Name
    </label>

    <br>

    <input type="text"
           name="title"
           value="{{ $donation->title }}">


    <br><br>



    <label>
        Quantity
    </label>

    <br>

    <input type="number"
           name="quantity"
           value="{{ $donation->quantity }}">



    <br><br>



    <label>
        Expiry Time
    </label>

    <br>

    <input type="datetime-local"
           name="expiry_time"
           value="{{ $donation->expiry_time }}">



    <br><br>



    <label>
        Pickup Address
    </label>

    <br>

    <input type="text"
           name="pickup_address"
           value="{{ $donation->pickup_address }}">

    

    <br><br>


    <button>
        Update Donation
    </button>


</form>


</body>
</html>