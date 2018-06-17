<div class="content-grid grid-connections">

	<ul class="content-tabs connections-tab">
		<li class="active"><a connection-target=".connections-friends" href="#">Friends</a></li>
		<li><a connection-target=".connections-acquaintances" href="#">Acquaintances</a></li>
		<li><a connection-target=".connections-trackers" href="#">Trackers</a></li>
		<li><a connection-target=".connections-tracking" href="#">Tracking</a></li>
		<li><a connection-target=".connections-group" href="#">Group</a></li>
	</ul>

	<form id="form-connections" name="" action="" method="">

		<input type="text" name="search-connections" id="search-connections">

	</form>

</div>

<div class="content-grid grid-connections connections-content">

	<div class="connections-panel connections-friends">
		@include('profile::templates.partials.friends')
	</div> <!-- end of connections friends -->

	<div class="connections-panel connections-acquaintances">
		@include('profile::templates.partials.acquaintances')
	</div> <!-- end of connections acquaintances -->


	{{--Start Trackers Content--}}
	<div class="connections-panel connections-trackers">
		@include('profile::templates.partials.trackers')
	</div> <!-- end of connections trackers -->

	{{--Start Trackers Content--}}
	<div class="connections-panel connections-tracking">
		@include('profile::templates.partials.tracking')
	</div>
	<!-- end of connections tracking -->

	<div class="connections-panel connections-group">



	</div> <!-- end of connections group -->

</div> <!-- end of content grid for connections -->
