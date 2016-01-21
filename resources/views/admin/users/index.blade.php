@extends('template.layouts.leftsidebar')
@section('content')
<h1>Users</h1>



<a href="#" data-open="newUserModal" class="button button-raised">Add New User</a>

<div class="reveal" id="newUserModal" data-reveal>
<form action="{{route('admin.users.store')}}" method="POST">
    {!! csrf_field() !!}
    <input  type="text" name="first_name" placeholder="First Name" required>
    <input  type="text" name="last_name" placeholder="Last Name" required>
    <input  type="email" name="email" placeholder="Email Address" required>
    <button class="button button-raised button-primary" type="submit">Create User</button>
</form>
</div>

<hr/>
<div id="users">

  <input class="search" type="text" placeholder="Search For User">
Active Users
  <table style="width:100%;">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody class="list">

	@foreach($users as $user)
		<tr>
			<td class="name"><a href="{{route('admin.users.edit', $user->id)}}">{{$user->first_name}} {{$user->last_name}}</a></td>
			<td class="email">{{$user->email}}</td>
			<td></td>
		</tr>
    @endforeach


    </tbody>
  </table>

</div>

@stop
@section('footer-scripts')
<script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.1.1/list.min.js"></script>
<script type="text/javascript">
var options = {
  valueNames: [ 'name', 'email', 'amount','date' ]
};

var userList = new List('users', options);

</script>
@stop
