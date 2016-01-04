<div id="donations">

  <input class="search" type="text" placeholder="Search For Donation">

  <table style="width:100%;">
    <thead>
      <tr>
        <th width="125">Date</th>
        <th>Name</th>
        <th>Email</th>
        <th>Amount</th>
        <th>Type</th>
      </tr>
    </thead>
    <tbody class="list">

		@foreach($user->donations()->orderBy('created_at', 'DESC')->get() as $donation)
        <tr>
          <td class="date">{{$donation->created_at->format('M d, Y')}}</td>
          <td class="name">{{$donation->first_name}} {{$donation->last_name}}</td>
          <td class="email">{{$donation->email}}</td>
          <td class="amount"><span style="color:#a5a5a5;">${{$donation->money_amount}}</span> /<br/> ${{$donation->net_amount}}</td>
          <td class="type">{{$donation->category_name}}</td>
        </tr>
    @endforeach
      
    </tbody>
  </table>

</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.1.1/list.min.js"></script>
<script type="text/javascript">
	
	var options = {
	  valueNames: [ 'name', 'email', 'amount','date','type' ]
	};

	var userList = new List('donations', options);


</script>