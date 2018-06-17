<div id="container-tracked-topics" class="activityTopics-result activityTopics-tracked hidden">

	@foreach ($trackedTopics as $topic)
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
