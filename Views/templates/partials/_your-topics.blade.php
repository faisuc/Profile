<div id="container-your-topics" class="activityTopics-result activityTopics-self">

	@foreach ($ownedTopics as $topic)
		<div class="feed-topic">
			<a href="#">
				<img src="{{ !empty($topic->coverphoto) ? '/upload/topics/original/' . $topic->coverphoto : '/images/profile/feed-topic-03.png' }}">
				<span class="topic-overlay">
					<h3>{{ $topic->title }}</h3>
				</span>
			</a>
		</div>
	@endforeach

</div>
