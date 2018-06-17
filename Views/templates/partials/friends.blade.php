<div class="connectionsResult-friends connectionsResult-group">
    @foreach($friends as $friend)
      <div class="connectionsResult-item">
          <div class="connectionsResult-user">
              <div class="connectionsResult-image">
                  <a href="/profile/{{ $friend->profile_code }}"><img src='{{ !empty($friend->profilephoto) ? "/upload/user/profile/original/{$friend->profilephoto}" : "/images/profile/default-profile-pic.jpg" }}'></a>
              </div>
              <h2><a href="/profile/{{ $friend->profile_code }}">{{ $friend->first_name.' '.$friend->last_name}}</a></h2>
          </div>
          <div class="connectionsResult-status">
              <a href="#">Friends</a>
          </div>
      </div>
    @endforeach
</div>
