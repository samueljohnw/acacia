@extends('template.layouts.leftsidebar')
@section('header-scripts')
<script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>
<script>tinymce.init(
  {
    selector:'textarea',
    plugins: [
        "advlist autolink lists link image charmap print anchor",
        "insertdatetime media paste"
    ],
    menubar: false,

    toolbar: "undo redo | bold italic | bullist numlist outdent indent"
  });
</script>
@stop
@section('content')

<ul class="tabs users-tabs" id="users-tabs" data-tabs role="tablist" data-options="deep_linking: true">
  <li class="tabs-title is-active"><a href="#profile">Profile</a></li>
  <li class="tabs-title"><a href="#account">Account</a></li>
  <li class="tabs-title"><a href="#donations">Donations</a></li>
</ul>
<div class="tabs-content" data-tabs-content="users-tabs">
  <div class="tabs-panel content is-active" id="profile">
    @include('admin.users.partials.profile')
  </div>
  <div class="tabs-panel content" id="account">
    @include('admin.users.partials.account')
  </div>
  <div class="tabs-panel content" id="donations">
    @include('admin.users.partials.donations')
  </div>
</div>

@stop

@section('footer-scripts')
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
    // this identifies your website in the createToken call below
    Stripe.setPublishableKey('{{env('STRIPE_PUBLISHABLE')}}');

    function stripeResponseHandler(status, response) {
        if (response.error) {
            // re-enable the submit button
            $('.submit-button').removeAttr("disabled");
            // show the errors on the form
            $(".errors").html(response.error.message);
        } else {
            var form$ = $("#create-recipient");
            // token contains id, last4, and card type
            var token = response['id'];
            // insert the token into the form so it gets submitted to the server
            form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
            // and submit
            form$.get(0).submit();
        }
    }

    $(document).ready(function() {
        $("#create-recipient").submit(function(event) {
          event.preventDefault();
          Stripe.bankAccount.createToken({
              country: 'US',
              currency: 'USD',
              routing_number: $('.routing_number').val(),
              account_number: $('.account_number').val(),
          }, stripeResponseHandler);
                    return false; // submit from callback
                });
    });

	var active = $('#active');
	active.change(function()
		{
			if($(this).val() == 'inactive'){
				$(this).val('active');
			}else{
				$(this).val('inactive');
			}

			console.log($(this).val());
		});

</script>
@stop
