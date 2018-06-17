
{{--<div class="connections-item expertise">--}}

{{--<div class="connections-userdetails">--}}

{{--<div class="userdetails">--}}

{{--<div class="right-lane">--}}

{{--<p>Work or Education</p>--}}

{{--<p>--}}

{{--<span>Connection Status </span>--}}

{{--<span>(Acq. or Friend or Tracking)</span>--}}

{{--</p>--}}

{{--<p>Mutual Connection (#)</p>--}}

{{--<a class="userdetails-link" href="#">Connect with</a>--}}

{{--<a class="userdetails-link" href="#">Track</a>--}}

{{--</div>--}}

{{--<div class="userdetails-username"><a href="#">Name, Last Name</a></div>--}}

{{--</div>--}}

{{--</div>--}}

{{--<div class="connections-image"></div>--}}

{{--<div class="connections-summary">--}}

{{--<h3 class="user-name"><a href="#">Name</a></h3>--}}

{{--Work/Education--}}

{{--<span class="user-expertise">Expert (Category)</span>--}}

{{--</div>--}}

{{--</div>--}}

{{--<div class="connections-item troll">--}}

{{--<div class="connections-userdetails">--}}

{{--<div class="userdetails">--}}

{{--<div class="right-lane">--}}

{{--<p>Work or Education</p>--}}

{{--<p>--}}

{{--<span>Connection Status </span>--}}

{{--<span>(Acq. or Friend or Tracking)</span>--}}

{{--</p>--}}

{{--<p>Mutual Connection (#)</p>--}}

{{--<a class="userdetails-link" href="#">Connect with</a>--}}

{{--<a class="userdetails-link" href="#">Track</a>--}}

{{--</div>--}}

{{--<div class="userdetails-username"><a href="#">Name, Last Name</a></div>--}}

{{--</div>--}}

{{--</div>--}}

{{--<div class="connections-image"></div>--}}

{{--<div class="connections-summary">--}}

{{--<h3 class="user-name"><a href="#">Name</a></h3>--}}

{{--Work/Education--}}

{{--<span class="user-troll">Troll</span>--}}

{{--</div>--}}

{{--</div>--}}

@foreach($trackings as $tracking)
    <div class="connections-item">

        <div class="connections-userdetails">

            <div class="userdetails">

                <div class="right-lane">

                    <p>Work or Education</p>

                    <p>

                        <span>Connection Status </span>

                        <span>(Acq. or Friend or Tracking)</span>

                    </p>

                    <p>Mutual Connection (#)</p>

                    <a class="userdetails-link" href="#">Connect with</a>

                    <a class="userdetails-link" href="#">Track</a>

                </div>

                <div class="userdetails-username"><a href="#">{{ $tracking->first_name.' '.$tracking->last_name}}</a></div>

            </div>

        </div>

        <div class="connections-image">
            <img src='{{ !empty($tracking->profilephoto) ? "/upload/user/profile/original/{$tracking->profilephoto}" : "/images/profile/profile-pic.jpg" }}'/>
        </div>

        <div class="connections-summary">

            <h3 class="user-name"><a href="{{ URL::route('route.profile', $tracking->tracking_id ) }}">{{ $tracking->first_name.' '.$tracking->last_name}}</a></h3>

            {{--{{ $tracking->workinfo.'/'.$tracking->educationinfo }}--}}

        </div>
    </div>
@endforeach