<h3>Update Bank Information</h3>

<form action="{{route('users.account.bank', $user->id)}}" method="POST" class="create-recipient">
  {{csrf_field()}}
  <label>Routing Number
    <input type="text" name="routing" class="routing_number">
  </label>
  <label>Bank Account Number
    <input type="text" name="account" class="account_number">
  </label>
  <button type="submit" class="button button-raised button-primary">Submit</button>
</form>
