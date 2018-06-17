<div class="profile-activity-section profileSection-comments hidden" data-activity-parent="comments">

	<div class="sectionComments-stats">
		<ul class="comments-stats">
			<li class="total-comments">Total Comments<i></i>{{ $comments_tab_content[0]->countcomments }}</li>
			<li class="total-answers">Total Answers<i></i>{{ $comments_tab_content[0]->countanswers }} <!--(<span> <i class="best"></i>{{ $comments_tab_content[0]->totalopinion }} <i class="top"></i>{{ $comments_tab_content[0]->totalbestanswer }}</span>)--></li>
		</ul>
	</div>
	<div class="sectionComments-history">
		@if ( count( $comments_and_answers ) > 0 )
			<ul class="comments-history">
				@foreach ( $comments_and_answers as $list )
					{{--*/ 
						$friend_status = $list->friend_status == "1" ? "friends" : ""; 
						$link_color_class = "";

						if ($user->id == $list->owner_userid) {
							$link_color_class = "forNonFriendLinkColor";
            
				            
				                if ($list->owner_mask == 0) {
				                    if ($friend_status == "friends") {
				                      $link_color_class = "forFriendLinkColor";
				                    } else {
				                      $link_color_class = "forNonFriendLinkColor";
				                    }
				                } else if ($list->owner_mask == 1) {
				                    $link_color_class = "forMaskedLinkColor";
				                }
				           
						}
					/*--}}
					<li>
						<p class="text-comment">{!! $list->comment !!}</p>
						@if ($list->owner_mask == 0)
							<p class="text-link">On <a href="{{ $list->owner_profilecode }}" class="{{ $link_color_class }}">{{ $list->owner_name }}</a>'s <a href="/post/{{ $list->contenttopic_id }}">{{ $list->contenttype }}</a></p>
						@else
							<p class="text-link">On <a href="#" class="{{ $link_color_class }}">{{ $list->owner_name }}</a>'s <a href="/post/{{ $list->contenttopic_id }}">{{ $list->contenttype }}</a></p>
						@endif
						<span class="time">{{ time_ago(strtotime($list->created_at)) }}</span>
					</li>
				@endforeach
			</ul>
		@else
			<h3>No Comments</h3>
		@endif
	</div>

</div>