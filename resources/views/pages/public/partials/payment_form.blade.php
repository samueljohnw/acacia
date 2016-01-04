
  <script type="text/javascript">

    Stripe.setPublishableKey('{{env("STRIPE_PUBLISHABLE")}}');
    var stripeResponseHandler = function(status, response) {
      var $form = $('#payment-form{{$monthly}}');
      if (response.error) {
        // Show the errors on the form
        $('.payment-errors').text(response.error.message);
        $('.payment-errors').addClass('alert-box warning');
        $form.find('button').prop('disabled', false);
      } else {
        // token contains id, last4, and card type
        var token = response.id;
        // Insert the token into the form so it gets submitted to the server
        $form.append($('<input type="hidden" name="stripeToken" />').val(token));
        // and re-submit
        $form.get(0).submit();
      }
    };
    jQuery(function($) {


      $('#payment-form{{$monthly}}').submit(function(e) {
        var fn = $('.first_name').val();
        var ln = $('.last_name').val();

        $('#full_name').val(fn+' '+ln);

        var $form = $(this);
        // Disable the submit button to prevent repeated clicks
        $form.find('button').prop('disabled', true);
        Stripe.card.createToken($form, stripeResponseHandler);
        // Prevent the form from submitting with the default action
        return false;
      });
    });
  </script>


<form action="{{route('process.donation',$user->id)}}" method="POST" id="payment-form{{$monthly}}">
  <input type="hidden" name="_token" value="{{csrf_token()}}">
  <input type="hidden" id="full_name" value="" data-stripe="name">

    <div class="form-row small-6 columns">
      <label>
        <span>First Name</span>
        <input type="text" name="first_name" class="first_name" value="Sam"/>
      </label>
    </div>

    <div class="form-row small-6 columns">
      <label>
        <span>Last Name</span>
        <input type="text" name="last_name" class="last_name" value="Werner" />
      </label>
    </div>

    <div class="form-row small-12 columns">
      <label>
        <span>Email Address</span>
        <input type="email" name="email" value="samueljwerner@gmail.com" />
      </label>
    </div>

    <div class="form-row small-8 columns">
      <label>
        <span>Card Number</span>
        <input type="text" size="20" data-stripe="number" value="4242424242424242" />
      </label>
    </div>

    <div class="form-row small-4 columns">
      <label>
        <span>CVC</span>
        <input type="text" size="4" data-stripe="cvc" value="123" />
      </label>
    </div>
	    <div class="medium-3 large-3 columns">
	    <label>Exp. Month</label>

	        <select data-stripe="exp-month" name="exp_month">
	        @for($i=1;$i<=12;$i++)
	          <option value="{{$i}}">
	            {{$i}}
	          </option>
	        @endfor
	        </select>
	      </div>
	      <div class="medium-4 large-3 columns end">
	    <label>Exp. Year</label>

	        <select data-stripe="exp-year" name="exp_year">
	        @for($i=date('Y');$i<=date('Y')+20;$i++)
	          <option value="{{$i}}">
	            {{$i}}
	          </option>
	        @endfor
	        </select>


  	</div>

    <div class="small-6 columns centered">
      <label>
        <span>Amount</span>
        <input type="number" name="amount" value="10.00" />
      </label>
    </div>


    <input class="hide" type="checkbox" name="monthly" {{$monthly}}>

    <div class="large-10 columns centered">
      <button class="button" type="submit">Submit Payment</button>
    </div>
    <small class="large-12 columns" style="float:left;">By donating you agree to our <a target="_blank" href="/disclaimer">disclaimer</a></small>

  </form>
