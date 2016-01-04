@include('template.blocks.missionary.sidebar')

<ul class="side-nav">
    <li><a href="{{route('admin.index')}}">Dashboard</a></li>
	<li><a href="{{route('admin.pages.index')}}">Pages</a></li>
    <li><a href="{{route('admin.users.index')}}">Users</a></li>
	<li><a href="{{route('admin.transfers.show')}}">Transfers</a></li>
	<li><a href="{{route('admin.checks.show')}}">Checks</a></li>
	<li><a href="{{route('admin.monthlies.show')}}">Monthlies</a></li>
	<li><a href="{{route('admin.applications.index')}}">Applications</a></li>
</ul>
