<h4>Agile Booking Details</h4></br>

<h4>Customer Name: </h4><p>{{ $booking->booking->customer_name  }}</p><br>
<h4>Customer Email: </h4><p>{{ $booking->booking->customer_email  }}</p><br>
<h4>Total Price: </h4><p>{{ $booking->booking->total_price  }}</p><br>
<h4>Confirmed: </h4><p>Yes</p><br>
<h4>Notes:</h4><p>{{ $booking->booking->notes  }}</p><br>
<h4>Country:</h4><p>{{ $booking->booking->country  }}</p><br>
<h4>Customer Phone:</h4><p>{{ $booking->booking->customer_phone  }}</p><br>
<h4>Transaction Id:</h4><p>{{ $booking->booking->txn_id  }}</p><br>
<h4>Payment Method:</h4><p>{{ $booking->booking->payment_method  }}</p><br>

<p>Thanks for Booking with Agile</p>
