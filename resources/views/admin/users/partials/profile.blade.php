
<h3>{{$user->first_name}}'s' Profile</h3>




@if (count($errors) > 0)
<div class="alert callout" data-closable>
    @foreach ($errors->all() as $error)
        <div data-alert class="alert-box warning">
          {{ $error }}
        </div>
    @endforeach
    <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
      <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif



<form action="{{route('admin.users.update',$user->id)}}" method="POST">
{!!csrf_field()!!}
<input type="hidden" name="_method" value="PUT">
<div class="row">
  <div class="large-4 columns">
    {!! inputField('text','first_name',$user->first_name, NULL,'required') !!}
  </div>
  <div class="large-4 columns">
    {!! inputField('text','last_name',$user->last_name, NULL,'required') !!}
  </div>
  <div class="large-4 columns">
    {!! inputField('text','display_name',$user->display_name, 'Display Name','') !!}
  </div>
</div>
<div class="medium-6 columns">
    {!! csrf_field() !!}
    <label>Shareable Url</label>
    <input type="text" name="slug" placeholder="URL" value="{{$user->slug}}">
    <label>Email Address</label>
    <input type="email" name="email" placeholder="Email" value="{{$user->email}}">
    <label>Website</label>
    <input type="url" name="website" placeholder="Website" value="{{$user->website}}">
    <label>Nation You Serve In</label>
    <select name="country">
      <option value="">
        - Select Nation
      </option>
      @foreach(config('countries') as $short_code => $country)
      <option value="{{$short_code}}" @if($user->country == $short_code) selected @endif>
        {{$country}}
      </option>
      @endforeach
    </select>
</div>
<div class="medium-6 columns">
  <img style="width:100%;" src="{{$user->image}}">
</div>
<div class="row">
  <div class="large-12 columns">
    <textarea name="bio">{{$user->bio}}</textarea>
    <br/>
  </div>
</div>

<div class="switch">
  <input id="userActive" class="switch-active" type="checkbox" name='status' value="active" @if($user->status == 'active') checked @endif >
  <label class="switch-paddle" for="userActive">
    <span class="show-for-sr">Active</span>
    <span class="switch-active" aria-hidden="true">On</span>
    <span class="switch-inactive" aria-hidden="true">Off</span>
</div>
<button class="button button-raised button-action" type="submit">Update</button>
</form>
