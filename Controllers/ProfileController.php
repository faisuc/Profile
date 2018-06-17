<?php
namespace Modular\Forms\Profile\Controllers;

use Modular\Controllers\BaseController;
use Modular\Forms\Authentication\Repositories\UserInterface;
use Modular\Forms\Authentication\Repositories\AuthenticationInterface;
use Modular\Forms\Authentication\Repositories\RegistrationInterface;
use Modular\Forms\Profile\Repositories\ProfileInterface as ProfileRepository;
use Modular\Forms\Notifications\Repositories\NotificationInterface;
use Modular\Forms\Activities\Repositories\ActivityInterface;
use Modular\Forms\Profile\Models\UserBasicInfoModel;
use Modular\Forms\Settings\Repositories\SettingsInterface;
use Modular\Libraries\Helpers\Helpers;

use File , Input;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Redirect;

use Modular\Libraries\Image\ImageRepository;
use Intervention\Image\ImageManagerStatic as Image;

class ProfileController extends BaseController {

    /**
     * @var UserInterface
     */
    protected $user;


    /**
     * @var AuthenticationInterface
     */
    protected $auth;

    /**
     * @var RegistrationInterface
     */
    protected $registration;

    protected $profile;

    public function __construct(
        UserInterface $user ,
        ProfileRepository $profile,
        NotificationInterface $notification,
        SettingsInterface $settings ,
        ActivityInterface $activity
        ) {

        parent::__construct($user);

        $this->user    = $user;
        $this->profile = $profile;
        $this->notification = $notification;
        $this->activity = $activity;
        $this->settings = $settings;

        //Load all global variables
        $this->_loadShareViews();

    }

    public function store($data)
    {

    }

    public function index($id)
    {
        $helpers = new Helpers;

        $user_id = $this->user->getUserID( $id )->id;

        if ($this->getMaskStatus() == 1 && $this->getUserID() == $user_id) {
            \Redirect::to('/')->send();
        }

        $this->views['title']     = $this->user->getFullName();
        $this->views['user']      = $this->user->findOneBy( array('profile_code' => $id) );

        $this->views['mobilenumbers'] = $this->user->getMobileNumbers($id);
        $this->views['emails']        = $this->user->getEmails($id);
        $this->views['webtitles']     = $this->user->getWebtitles($id);
        $this->views['weblinks']      = $this->user->getWeblinks($id);
        $this->views['countries']     = $this->profile->getCountries();
        $this->views['bloodTypes']    = $this->profile->getBloodTypes();
        $this->views['country']       = $this->profile->getCountryName($user_id);
        $this->views['bloodType']     = $this->profile->getBloodTypeName($user_id);

        $this->views['ownedTopics']   = $this->profile->getOwnedTopics($user_id);
        $this->views['trackedTopics'] = $this->profile->getTrackedTopics($user_id);



        /**
         * will check if you are on your profile
         *
         * return boolean
         */
        $this->views['myprofile'] = ($this->getUserID() == $user_id) ? true : false;

        /**
         * validate if the viewer is already acquiantances the viewer profile
         */
        $this->views['is_acquaintances'] = $this->user->is_acquaintances($this->getUserID() , $user_id);

        /**
         * validate if the viewer is already friend by the active profile
         */
        $this->views['is_friend'] = $this->user->is_friend($this->getUserID() , $user_id);

        /**
         * validate if the viewer is already tracked the viewer profile
         */
        $this->views['is_tracked'] = $this->user->is_tracked($user_id , $this->getUserID());

        $this->views['acquaintances']  = $this->user->user_acquaintances($user_id);
        $this->views['friends']        = $this->user->user_friends($user_id);
        $this->views['trackers']       = $this->user->user_tracker($user_id);
        $this->views['trackings']      = $this->user->user_tracking($user_id);

        /**
         *  check if the viewer has sent or has been sent an acquaintance request
         */
        $this->views['acquaintance_request_sent'] = $this->user->user_acquaintance_sent($user_id , $this->getUserID());

        /**
         *  check if the viewer has sent or has been sent an friend request
         */
        $this->views['friend_request_sent'] = $this->user->user_friend_sent($user_id , $this->getUserID());

        /**
         * check if already notified(friend)
         */
         $this->views['friend_notified'] = $this->user->friend_request_notified($user_id , $this->getUserID());

        /**
         * check if already notified(acquaintance)
         */
        $this->views['acquaintance_notified'] = $this->user->acquaintance_request_notified($user_id , $this->getUserID());

        /**
         * Generate Mask ID if not no ID
         */

        $this->views['activity_tab_content'] = $this->get_activity_tab_content( $user_id );
        $this->views['comments_tab_content'] = $this->get_comments_tab_content( $user_id );
        $this->views['comments_and_answers'] = $this->get_comments_and_answers( $user_id );
        $this->views['count_profile_views'] = $this->count_profile_views( $user_id );
        $this->views['profile_viewers'] = $this->get_profile_viewers( $this->getUserID() , $user_id );

        $maskname = !empty($this->userInfo()->maskname) ? $this->userInfo()->maskname : "anonymous". $helpers->shuffle_string($helpers->generateRandomChars(10 , $this->getUserID()));
        $this->views['mask_id'] = $maskname;

        $this->views['users_status'] = $this->user->get_users_status($user_id , $this->getUserID());
        $this->views['follow_status'] = $this->user->get_follow_status($user_id , $this->getUserID());
        $this->views['user_privacy_setting'] = $this->user->get_privacy_settings($user_id);

        $privacy_status = $this->user->get_privacy_status($user_id);

        $profile_heading_content = $this->user->get_user_data_heading($this->getUserID() , $user_id);
        $this->views['profile_heading_content'] = $profile_heading_content;

        $connection_status = $this->user->get_connection_status($this->getUserID() , $user_id);
        $this->views['connection_status'] = $connection_status;
        $this->views['mask_status'] = $this->getMaskStatus();
        $this->views['view_nsfw'] = $this->settings->findOneBy(['user_id' => $this->getUserID()]);

        $this->save_profile_views( $user_id );
        
        //echo '<pre>'; print_r($this->views); exit;
        //return view('profile::new.index')->with($this->views);
        return view('profile::user_profile')->with($this->views);
    }

    public function profile() {

        return view('profile::main')->with($this->views);

    }

    public function uploadProfilePhoto(Request $request  , ImageRepository $image)
    {
        if ($request->ajax())
        {
            if ($request->isMethod('POST')) {
                if ($request->hasFile('file')) {
                    $image = $image->make($request->file('file') , 'upload/user/profile/original' , 'upload/user/profile/thumbs' , false , 'profile-photo');


                    return \Response::json($image);
                }
            }
        }
    }

    public function uploadCoverPhoto(Request $request  , ImageRepository $image)
    {
        if ($request->ajax())
        {
            if ($request->isMethod('POST')) {
                /*
                if ($request->hasFile('file')) {
                    $image = $image->make($request->file('file') , 'upload/user/cover/original' , 'upload/user/cover/thumbs' , false , 'profile-cover');

                    if ($this->getMaskStatus() == 0)
                    {
                        $image['status'] ? $this->activity->add_activity(\Sentinel::getUser()->id , '' , 4 , '' , $image['filename']) : false;
                    }
                    return \Response::json($image);
                }
                */
                if (Input::hasFile('file')) {
    				//\ImageRepository::setThumbSize(100, 60);

    				$return = \ImageRepository::make(Input::file('file') , 'upload/user/cover/original' , 'upload/user/cover/thumbs' , false , 'mask');

    				$inputs = [
    					'user_id'  =>  $this->getUserID() ,
    					'filepath' =>  \ImageRepository::getImageName(Input::file('file')).'.'.\ImageRepository::getImageExt(Input::file('file')) ,
    					'filename' =>  \ImageRepository::getImageName(Input::file('file')) ,
    					'filesize' =>  \ImageRepository::getImageSize(Input::file('file'))
    				];

    				//$response = $this->settings->store_mask($inputs);

    				return \Response::json($return);
    			}
            }
        }
    }

    public function uploadPhotos(Request $request  , ImageRepository $image)
    {
      if ($request->isMethod('POST'))
      {
        if ( $request->hasFile('file')) {
      			$image = $image->make( $request->file('file') , 'upload/user/photos/original' , 'upload/user/photos/thumbs' , false , 'profile-images');

            if ($this->getMaskStatus() == 0)
            {
                $image['status'] ? $this->activity->add_activity(\Sentinel::getUser()->id , '' , 17 , '' , '') : false;
            }

      			return \Response::json($image);
      	}
      }
    }

    public function uploadMaskPhoto(Request $request  , ImageRepository $image)
    {
      if ($request->isMethod('POST'))
      {
          if ($request->hasFile('file'))
          {
              $image = $image->make($request->file('file') , 'upload/user/mask/original' , 'upload/user/mask/thumbs' , false , 'profile');
              $data = ['maskimage' => $image->getImageName() . "." . $image->getImageExt() , 'user_id' => $this->getUserID()];
              $response = $this->profile->storeMaskPhoto($data);
              return Response::json($response);
          }
      }
    }

	public function updateAccountSettings(Request $request)
    {
        if ($request->ajax())
        {

            $cat = $request->all()['cat'];

            $data = array_merge($request->all() , [
                'user_id' => $this->getUserID()
            ]);

            if ($cat == "update-account-name")
            {
                $exec = $this->profile->updateAccountName($data);
            }
            else if ($cat == "update-account-nickname")
            {
                $exec = $this->profile->updateAccountNickname($data);
            }
            else if ($cat == "update-account-email")
            {
                $exec = $this->profile->updateAccountEmail($data);
            }
            else if ($cat == "update-account-personalized-url")
            {
                $exec = $this->profile->updatePersonalizedUrl($data);
            }
            else if ($cat == "update-account-password")
            {
                $exec = $this->profile->updateAccountPassword($data);
            }
            else if ($cat == "update-basic-information")
            {
                $exec = $this->profile->updateBasicInformation($data);
            }
            else if ($cat == "update-contact-information")
            {
                $exec = $this->profile->updateContactInformation($data);
            }
            else if ($cat == "update-personal-info-workhistory")
            {
                $exec = $this->profile->updateWorkHistory($data);
            }
            else if ($cat == "update-personal-info-college")
            {
                $exec = $this->profile->updateEducCollege($data);
            }
            else if ($cat == "update-personal-info-highschool")
            {
                $exec = $this->profile->updateEducHighschool($data);
            }
            else if ($cat == "remove-work-history")
            {
                $exec = $this->profile->deleteWorkHistory($data);
            }
            else if ($cat == "remove-educcollege")
            {
                $exec = $this->profile->deleteEducCollege($data);
            }
            else if ($cat == "remove-educhighschool")
            {
                $exec = $this->profile->deleteEducHighSchool($data);
            }
            else if ($cat == "update-active-subcategory")
            {
                $exec = $this->profile->updateActivateSubcategory($data);
            }
            else if ($cat == "update-website-info")
            {
                $exec = $this->profile->updateWebsiteInfo($data);
            }
            else if ($cat == "update-mask-name")
            {
                $exec = $this->profile->updateMaskName($data);
            }
            else if ($cat == "update-account-bioinfo")
            {
                $exec = $this->profile->updateBioInfo($data);
            }

            if ($this->getMaskStatus() == 0)
            {
                $this->activity->add_activity($this->getUserID() , '' , 2 , '' , '');
            }

            return \Response::json($exec);
        }
    }

    public function updateBasicInformation(Request $request)
    {
        if ($request->ajax())
        {
            $data = array_merge($request->all() , [
                'user_id' => $this->getUserID()
            ]);

            $exec = $this->profile->updateBasicInformation($data);

            return \Response::json($exec);
        }
    }

    public function updateContactInformation(Request $request)
    {
        if ($request->ajax())
        {
            $data = array_merge($request->all() , [
                'user_id' => $this->getUserID()
            ]);

            $exec = $this->profile->updateContactInformation($data);

            return \Response::json($exec);
        }
    }

    public function getPhotos(Request $request)
    {
        if ($request->ajax())
        {
            if ($request->isMethod('GET'))
            {
                $inputs = $request->all();

                $response = $this->profile->getPhotos($inputs);
                return \Response::json($response);
            }
        }
    }

    public function save_photos(Request $request)
    {
      if ($request->ajax())
      {
          $inputs = array_merge($request->all() , [
              'user_id' => $this->getUserID()
          ]);

          $response = $this->profile->save_photos($inputs);
          return \Response::json($response);
      }
    }

    public function save_crop_profile_image(Request $request)
    {
        if ($request->ajax())
        {
            $inputs = array_merge($request->all() , [
                'user_id' => $this->getUserID()
            ]);

            /*
            $response = $this->profile->save_crop_profile_image($inputs);

            if ($this->getMaskStatus() == 0)
            {
                $this->activity->add_activity(\Sentinel::getUser()->id , '' , 3 , '' , $response);
            }

            return \Response::json($response);
            */
            $user_id = $inputs['user_id'];
            $filename = $inputs['filename'];
            $data = $inputs['toDataURL'];
            $path = public_path('upload/user/profile/thumbs/');

            $img = str_replace('data:image/png;base64,', '', $data);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $file = $path . $filename;
            file_put_contents($file, $data);

            Image::configure(array('driver' => 'imagick'));

            $img = Image::make($file);
            $img->fit(250,250);
            $img->save($file);

            if ($this->getMaskStatus() == 0)
            {
                //$this->activity->add_activity(\Sentinel::getUser()->id , '' , 3 , '' , '');
            }

            return \Response::json(['status' => true]);
        }
    }

    public function save_crop_profile_cover(Request $request)
    {
        if ($request->ajax())
        {
            $inputs = array_merge($request->all() , [
                'user_id' => $this->getUserID()
            ]);

            $response = $this->profile->save_crop_profile_cover($inputs);

            if ($this->getMaskStatus() == 0)
            {
                $this->activity->add_activity(\Sentinel::getUser()->id , '' , 4 , '' , $response);
            }

            return \Response::json($response);
        }
    }

    public function get_about_information(Request $request)
    {
        if ($request->ajax())
        {
            $user_id = $request->all()['user_id'];
            $id = $this->user->getProfileCode($user_id)->profile_code;

            $birthmonth     = $this->profile->getBirthMonth($user_id);
            $birthday       = $this->profile->getBirthDay($user_id);
            $birthyear      = $this->profile->getBirthYear($user_id);
            $gender         = $this->profile->getGender($user_id);
            $bloodtype      = $this->profile->getBloodTypeName($user_id);
            $religion       = $this->profile->getReligion($user_id);
            $mobilenumbers  = $this->user->getMobileNumbers($id);
            $city           = $this->profile->getCity($user_id);
            $country        = $this->profile->getCountryName($user_id);
            $emails         = $this->user->getEmails($id);
            $educcollege    = $this->profile->getEducCollege($user_id);
            $educhighschool = $this->profile->getEducHighschool($user_id);
            $webtitles      = $this->user->getWebtitles($id);
            $weblinks       = $this->user->getWeblinks($id);
            $politics       = $this->profile->getPolitics($user_id);
            $workhistory    = $this->profile->getWorkHistory($user_id);
            $webtitleslinks = [];

            $webtitleslinks = array_combine($webtitles , $weblinks);

            $response = array(
                'birthmonth'    => $birthmonth,
                'birthmonthname'    => convertMonthNumToName($birthmonth) ,
                'birthday'      => $birthday ,
                'birthyear'     => $birthyear ,
                'gender'        => getGenderPrefix($gender) ,
                'bloodtype'     => $bloodtype ,
                'religion'      => $religion ,
                'mobilenumbers' => $mobilenumbers ,
                'city'          => $city ,
                'country'       => $country ,
                'emails'        => $emails ,
                'educcollege'   => $educcollege ,
                'educhighschool'=> $educhighschool ,
                'webtitles'     => $webtitles ,
                'weblinks'      => $weblinks ,
                'politics'      => $politics ,
                'workhistory'   => $workhistory ,
                'webtitleslinks' => $webtitleslinks
            );

            return \Response::json($response);
        }
    }

    public function revert_profile_photo(Request $request)
    {
        if ( $request->ajax() )
        {
            if ( $request->isMethod('POST') )
            {
                $inputs = $request->all();
                $photo = $inputs['photo'];
                $user_id = $this->getUserID();

                $response = $this->profile->revert_profile_photo( $photo , $user_id );
                return \Response::json( array( 'status' , $response ) );
            }
        }
    }

    public function revert_profile_cover(Request $request)
    {
        if ( $request->ajax() )
        {
            if ( $request->isMethod('POST') )
            {
                $inputs = $request->all();
                $photo = $inputs['photo'];
                $user_id = $this->getUserID();

                $response = $this->profile->revert_profile_cover( $photo , $user_id );
                return \Response::json( array( 'status' , $response ) );
            }
        }
    }

    public function private_profile() {

        $this->views['title']         = \Sentinel::getUser()->first_name.' '.\Sentinel::getUser()->last_name;

        return view('profile::private')->with($this->views);

    }

    public function user_profile() {

        $this->views['title']         = \Sentinel::getUser()->first_name.' '.\Sentinel::getUser()->last_name;

        return view('profile::user_profile')->with($this->views);

    }

    public function user_profile_private() {

        $this->views['title']         = \Sentinel::getUser()->first_name.' '.\Sentinel::getUser()->last_name;

        return view('profile::user_profile-private')->with($this->views);

    }

    public function get_activity_tab_content( $user_id ) {
        return $this->profile->get_activity_tab_content( $user_id );
    }

    public function get_comments_tab_content( $user_id ) {
        return $this->profile->get_comments_tab_content( $user_id );
    }

    public function get_comments_and_answers( $user_id ) {
        return $this->profile->get_comments_and_answers( $user_id );
    }

    public function count_profile_views( $user_id ) {
        return $this->profile->get_count_profile_views( $user_id );
    }

    public function get_profile_viewers( $activelogin_userid , $owner_profile_userid ) {
        return $this->profile->get_profile_viewers( $activelogin_userid , $owner_profile_userid );
    }

    public function get_connections_lists(Request $request)
    {
        if ($request->ajax())
        {
            $data = $request->all();
            $type = $data['type'];

            if ($type == 'mutual')
            {
                return \Response::json( $this->user->lists_of_mutual_friends( $data['active_user_id'] , $data['viewing_user_id'] ) );
            }
            else if ($type == 'friends')
            {
                return \Response::json( $this->user->lists_of_friends( $data['active_user_id'] , $data['viewing_user_id'] ) );
            }
            else if ($type == 'following')
            {
                return \Response::json( $this->user->lists_of_following( $data['active_user_id'] , $data['viewing_user_id'] ) );
            }
            else if ($type == 'followers')
            {
                return \Response::json( $this->user->lists_of_followers( $data['active_user_id'] , $data['viewing_user_id'] ) );
            }
            else if ($type == 'requests')
            {
                return \Response::json( $this->user->lists_of_requests( $data['active_user_id'] , $data['viewing_user_id'] ) );
            }
        }
    }

    public function get_strings(Request $request)
    {
        if ($request->ajax())
        {
            $data = $request->all();
            $type = $data['type'];
            $active_user_id = $data['active_user_id'];
            $viewing_user_id = $data['viewing_user_id'];

            if ($type == 'self')
            {
                return \Response::json( $this->user->lists_of_created_strings($active_user_id , $viewing_user_id) );
            }
            else if ($type == 'tracked')
            {
                return \Response::json( $this->user->lists_of_tracked_strings($active_user_id , $viewing_user_id) );
            }
            else if ($type == 'mutual')
            {
                return \Response::json( $this->user->lists_of_mutual_strings($active_user_id , $viewing_user_id) );
            }
        }
    }

    public function save_profile_views($viewer_id)
    {
        return $this->profile->save_profile_views($viewer_id);
    }

    public function get_created_strings(Request $request)
    {
        if ($request->ajax())
        {
            $result = $this->user->show_created_strings($this->getUserID());

            return \Response::json( $result );
        }
    }

    public function get_tracked_strings(Request $request)
    {
        if ($request->ajax())
        {
            $result = $this->user->show_tracked_strings($this->getUserID());

            return \Response::json( $result );
        }
    }

    public function skip_modal(Request $request) {

        if($request->ajax())
        {  
            $response = $this->profile->skip_modal($this->getUserID());

            return response()->json($response);
        }

    }
    
    
    /**
     * Reence David
     * New Functions for the new new PROFILE
     */
}
