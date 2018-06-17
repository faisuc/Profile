<div class="connectionsResult-acquaintance connectionsResult-group hidden">
  @foreach($acquaintances as $acquaintance)
    <div class="connectionsResult-item">
        <div class="connectionsResult-user">
            <div class="connectionsResult-image">
                <a href="/profile/{{ $acquaintance->profile_code }}"><img src='{{ !empty($acquaintance->profilephoto) ? "/upload/user/profile/original/{$acquaintance->profilephoto}" : "/images/profile/default-profile-pic.jpg" }}'></a>
            </div>
            <h2><a href="/profile/{{ $acquaintance->profile_code }}">{{ $acquaintance->first_name.' '.$acquaintance->last_name}}</a></h2>
        </div>
        <div class="connectionsResult-status">
            <a href="#">Connections</a>
        </div>
    </div>
  @endforeach
</div>
