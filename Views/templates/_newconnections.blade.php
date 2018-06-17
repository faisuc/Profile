<div id="profileConnections-section" class="profile-section hidden">
	<div class="connectionsSection-container">
		<div class="connectionsRow">
			<h2>About</h2>
			@if($myprofile)
				<a href="#" class="btn-edit">Edit</a>
			@endif
		</div>
		<div class="about-container">


		</div>


		<div class="connectionsColumn column-link">

		</div>
	</div>
	<div class="connectionsSection-container">
		<div class="connections-tab">
			<ul id="connections-nav">
				<li class="active"><a href="#" data-target="friends">Friends</a></li>
				<li><a href="#" data-target="acquaintance">Connections</a></li>
				<li><a href="#" data-target="trackers">Trackers</a></li>
			</ul>
		</div>
		<div class="connections-result">
			@include('profile::templates.partials.friends')
			@include('profile::templates.partials.acquaintances')
			@include('profile::templates.partials.trackers')
		</div>
	</div>
</div>
