<form action="{{route('admin.users.update',$user->id)}}" method="POST">
{!!csrf_field()!!}
<input type="hidden" name="_method" value="PUT">
{!! inputField('text','first_name',$user->first_name, NULL,'required') !!}
{!! inputField('text','last_name',$user->last_name, NULL,'required') !!}
{!! inputField('text','display_name',$user->display_name, 'Display Name','') !!}
{!! inputField('email','email',$user->email, NULL,'required') !!}
<div class="switch">
  <input id="userActive" class="switch-active" type="checkbox" name='status' @if($user->status == 'active') checked @endif >
  <label class="switch-paddle" for="userActive">
    <span class="show-for-sr">Active</span>
    <span class="switch-active" aria-hidden="true">On</span>
    <span class="switch-inactive" aria-hidden="true">Off</span>
</div>
<button class="button" type="submit">Update</button>
</form>
