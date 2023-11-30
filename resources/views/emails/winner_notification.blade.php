<!DOCTYPE html>
<html>

<body>
    <h2>You have won the bidding competition</h2>

    <p>Product: {{ $bid->product->title }}</p>
    <p>User code: {{ $bid->bidder->user_code }}</p>
</body>

</html>
