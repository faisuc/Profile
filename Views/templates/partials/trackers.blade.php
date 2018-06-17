<div class="connectionsResult-trackers connectionsResult-group hidden">
  @foreach($trackers as $tracker)
    <div class="connectionsResult-item">
        <div class="connectionsResult-user">
            <div class="connectionsResult-image">
                <a href="/profile/{{ $tracker->profile_code }}"><img src='{{ !empty($tracker->profilephoto) ? "/upload/user/profile/original/{$tracker->profilephoto}" : "/images/profile/default-profile-pic.jpg" }}'></a>
            </div>
            <h2><a href="/profile/{{ $tracker->profile_code }}">{{ $tracker->first_name.' '.$tracker->last_name}}</a></h2>
        </div>
        <div class="connectionsResult-status">
            <a href="#">Trackers</a>
        </div>
    </div>
  @endforeach
</div>
