@extends('template.layouts.blank')
@section('content')
<h1 class="text-center">YWAM Together</h1>
<div class="row">
  <div class="large-6 large-centered columns">


  <form action="http://ma26.createsend.com/t/i/s/naiui/" method="post" id="subForm">
      <p>
          <label for="fieldName">Name</label>
          <input id="fieldName" name="cm-name" type="text" />
      </p>
      <p>
          <label for="fieldEmail">Email</label>
          <input id="fieldEmail" name="cm-naiui-naiui" type="email" required />
          <small class="float-right"><a data-open="exampleModal1">Terms</a></small>
      </p>
      <p>
          <button class="primary button " type="submit">Subscribe</button><br/>

      </p>

  </form>
  </div>
</div>

<br/>
<div class="reveal" id="exampleModal1" data-reveal>
  <h4>Terms For Form</h4>
  <small>By putting your email address here you're agreeing to accept emails from Acacia Ministries International. We will not sell or give away your information.</small>
  <button class="close-button" data-close aria-label="Close modal" type="button">
    <span aria-hidden="true">&times;</span>
  </button>
</div>


@stop
