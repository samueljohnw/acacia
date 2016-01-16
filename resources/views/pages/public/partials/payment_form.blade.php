
  <script type="text/javascript">
    var theForm = 'null';

    Stripe.setPublishableKey('{{env("STRIPE_PUBLISHABLE")}}');
    var stripeResponseHandler = function(status, response) {

      var $form = $('#payment-form');

      if (response.error) {
        // Show the errors on the form
        $('.payment-errors').text(response.error.message);
        $form.find('button').removeProp('disabled');
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


      $('#payment-form').submit(function(e) {
        var fn = $('.first_name').val();
        var ln = $('.last_name').val();

        $('#full_name').val(fn+' '+ln);

        var $form = $(this);

        $form.find('button').prop('disabled', true);

        Stripe.card.createToken($form, stripeResponseHandler);
        return false;
      });
    });
  </script>


<form action="{{route('process.donation',$user->id)}}" method="POST" id="payment-form">
  <input type="hidden" name="_token" value="{{csrf_token()}}">
  <input type="hidden" id="full_name" value="" data-stripe="name">

    <div class="form-row small-6 columns">
      <label>
        <span>First Name</span>
        <input type="text" name="first_name" class="first_name" required="required" >
      </label>
    </div>

    <div class="form-row small-6 columns">
      <label>
        <span>Last Name</span>
        <input type="text" name="last_name" class="last_name" required="required">
      </label>
    </div>

    <div class="form-row small-12 columns">
      <label>
        <span>Email Address</span>
        <input type="email" name="email" required value=""/>
      </label>
    </div>

    <div class="form-row small-8 columns">
      <label>
        <span>Card Number</span>
        <input type="text" size="20" data-stripe="number" required value=""/>
      </label>
    </div>

    <div class="form-row small-4 columns">
      <label>
        <span>CVC</span>
        <input type="text" size="4" data-stripe="cvc" required value=""/>
      </label>
    </div>
	    <div class="medium-3 large-3 columns">
	    <label>Exp. Month</label>

	        <select data-stripe="exp-month" required name="exp_month">
	        @for($i=1;$i<=12;$i++)
	          <option value="{{$i}}">
	            {{$i}}
	          </option>
	        @endfor
	        </select>
	      </div>
	      <div class="medium-4 large-3 columns end">
	    <label>Exp. Year</label>

	        <select data-stripe="exp-year" required name="exp_year">
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
        <input type="number" name="amount" required value=""/>
      </label>
    </div>

    <div class="large-10 columns centered">
      <label>Do you want to give monthly?
        <input type="checkbox" name="monthly" >
      </label>
      <button class="button button-raised button-primary" type="submit">Submit Payment &nbsp;&nbsp;<i class="fa fa-globe"></i></button>
    </div>
    <small class="large-12 columns subheader" style="font-size:12px;">*By donating you agree to our <a target="_blank" href="/disclaimer">disclaimer</a></small>

  </form>
