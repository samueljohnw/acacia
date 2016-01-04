@extends('template.layouts.leftsidebar')

@section('header-scripts')

@stop
@section('content')
<h1>Donations</h1>
<div class="row">
    <div class="large-12 columns">
        <div class="row collapse">
            <canvas id="canvas" style="width:100%"></canvas>
        </div>
    </div>
</div>
<div id="donations">

  <input class="search" type="text" placeholder="Search For Donation">

  <table style="width:100%;">
    <thead>
      <tr>
        <th>Date</th>
        <th>Name</th>
        <th>Email</th>
        <th>Amount</th>
        <th>Type</th>
      </tr>
    </thead>
    <tbody class="list">

      @foreach($allDonations as $donation)
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

@stop
@section('footer-scripts')

<script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.1.1/list.min.js"></script>
<script type="text/javascript">
var options = {
  valueNames: [ 'name', 'email', 'amount','date', 'type' ]
};

var userList = new List('donations', options);

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>

<script type="text/javascript">

var lineChartData = {
    labels: [{!!$lastSixMonths!!}],
    datasets: 
    [
        {
            fillColor: "rgba(36, 189, 36,0)",
            strokeColor: "rgba(36, 189, 36,1)",
            pointColor: "rgba(36, 189, 36,.1)",
            data: [{!!$totalDonations!!}]
        }
    ]
}

Chart.defaults.global.animationSteps = 50;
Chart.defaults.global.tooltipYPadding = 16;
Chart.defaults.global.tooltipCornerRadius = 0;
Chart.defaults.global.tooltipTitleFontStyle = "normal";
Chart.defaults.global.tooltipFillColor = "rgba(0,0,0,0.8)";
Chart.defaults.global.multiTooltipTemplate = "<%= data %>";
Chart.defaults.global.tooltipTemplate = "$<%= value %>";

Chart.defaults.global.animationEasing = "easeOutBounce";
Chart.defaults.global.responsive = true;
Chart.defaults.global.scaleLineColor = "black";
Chart.defaults.global.scaleFontSize = 16;

var ctx = document.getElementById("canvas").getContext("2d");
var LineChartDemo = new Chart(ctx).Line(lineChartData, {
    pointDotRadius: 10,
    bezierCurve: false,
    scaleShowVerticalLines: false,
    scaleGridLineColor: "black"
});

</script>
@stop

