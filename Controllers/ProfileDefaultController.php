<?php
namespace Modular\Forms\Profile\Controllers;

use Modular\Controllers\BaseController;
use Modular\Forms\Authentication\Repositories\UserInterface;
use Modular\Forms\Notifications\Repositories\NotificationInterface;
use Modular\Forms\Activities\Repositories\ActivityInterface;
use Modular\Forms\Settings\Repositories\SettingsInterface;
use Modular\Libraries\Helpers\Helpers;
use Modular\Libraries\Helpers\HumanizeTime;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Redirect;

use Modular\Libraries\Image\ImageRepository;
use Intervention\Image\ImageManagerStatic as Image;

use Modular\Forms\Profile\Repositories\ProfileDefaultRepository;
use Modular\Forms\Topics\Repositories\StringRepository;

/*
 * Modals
 */
use Modular\Forms\Users\Models\UserModel;

class ProfileDefaultController extends BaseController {
    /**
     * @var UserInterface
     */
    protected $user;

    /**
     * @var TopicInterface
     */
    protected $topic;

    /**
     * @var ActivityInterface
     */
    protected $activity;

    /**
    * @var TaggingInterface
    */
    protected $tags;
    
    /**
     * @var SettingsInterface 
     */
    protected $settings;

    public function __construct(
        UserInterface $user ,
        NotificationInterface $notification ,
        ActivityInterface $activity,
        SettingsInterface $settings
    )
    {
        parent::__construct($user);

        $this->user         = $user;
        $this->notification = $notification;
        $this->activity     = $activity;
        $this->settings     = $settings;

        //Load all global variables
        $this->_loadShareViews();
    }
    
    /**
     * Default Page for Profile
     */
    public function index($profile_code, ProfileDefaultRepository $profileRepo, UserModel $userModal)
    {
        $helpers  = new Helpers;
        $humanize = new HumanizeTime();
//        $time = "2016-05-23 23:38:16";
//        echo $humanize->humanize(1, $time);
//        echo $helpers->change_time_humanize_text($humanize->humanize(1, $time));
//        exit;
        $user = $this->user->getUserID($profile_code);
        if(count($user) == 0) redirect()->to('/');
        
        $user_id = $user->id;
        if ($this->getMaskStatus() == 1 && $this->getUserID() == $user_id) {
            redirect()->to('/')->send();
        }
        
        $this->views['title']     = $this->user->getFullName();
        $this->views['user']      = $this->user->findOneBy(array('profile_code' => $profile_code) );
        
        //save the user for viewers
        $profileRepo->save_profile_views($this->getUserID(), $user_id);
        
        $profile_settings = $this->settings->get_profile_settings($user_id);
        
        $this->views['con_friends'] = $userModal->get_user_friends_by_filter([
            'user_one_id'   => $this->getUserID(),
            'user_two_id'   => $user_id
        ]);
        
        $this->views['con_acquaintances'] = $userModal->get_user_acquaintances_by_filter([
            'user_one_id'   => $this->getUserID(),
            'user_two_id'   => $user_id
        ]);
        
        //User Numbers
        $this->views['user_numbers'] = $profileRepo->user_numbers($user_id);
        
        //Top 3 strings
        $this->views['top_strings'] = $profileRepo->get_top_strings($user_id);

        $connection_status = $this->user->get_connection_status($this->getUserID() , $user_id);
        $this->views['connection_status'] = $connection_status;
        $this->views['mask_status'] = $this->getMaskStatus();
        
        $this->views['user_profile']     = $profileRepo->get_profile_details($user_id);
        $this->views['created_strings']  = $profileRepo->show_created_strings($user_id);
        $this->views['followed_strings'] = $profileRepo->show_followed_strings($user_id);
        $this->views['top_tags']         = $profileRepo->show_top_tags($user_id);
        
        //Comment Tab Part
        $this->views['comments'] = [
            'total_comments' => $profileRepo->count_total_comments($user_id),
            'total_replies'  => $profileRepo->count_total_replies($user_id)
        ];
        
        //images tab
        $this->views['images'] = $profileRepo->count_images($user_id, $this->getUserID());
        
        //$this->views['credentials']  = $profileRepo->get_user_credentials($user_id);
        
        /**
         * will check if you are on your profile
         *
         * return boolean
         */
        $this->views['myprofile']    = ($this->getUserID() == $user_id) ? true : false;
        $this->views['profile_code'] = $profile_code;
        
        $this->views['view_nsfw']        = $this->settings->findOneBy(['user_id' => $this->getUserID()]);
        $this->views['profile_settings'] = $profile_settings;
        
        $this->views['helpers']  = $helpers;
        
        /**
         * Connections Tab
         */
        $this->views['connections_total']   = $profileRepo->count_connections_tab($user_id);
        
        //echo '<pre>'; print_r($this->views['images']); exit;
        //return view('profile::user_profile')->with($this->views);
        return view('profile::new.index')->with($this->views);
    }
    
    /**
     * Load personal info via ajax
     * 
     * @param string $profile_code
     * @param ProfileDefaultRepository $profileRepo
     * @param UserModel $userModal
     * @param Request $request
     * @return type
     */
    public function load_about_personal($profile_code, ProfileDefaultRepository $profileRepo, UserModel $userModal, Request $request)
    {
        $helpers = new Helpers;
        
        $user = $this->user->getUserID($profile_code);
        
        $user_id = $user->id;
        $this->views['user']                = $this->user->findOneBy(['profile_code' => $profile_code]);
        $this->views['user_profile']        = $profileRepo->get_profile_details($user_id);
        $this->views['myprofile']           = ($this->getUserID() == $user_id) ? true : false;
        $this->views['profile_settings']    = $this->settings->get_profile_settings($user_id);
        
        $this->views['con_friends'] = $userModal->get_user_friends_by_filter([
            'user_one_id'   => $this->getUserID(),
            'user_two_id'   => $user_id
        ]);
        
        $this->views['con_acquaintances'] = $userModal->get_user_acquaintances_by_filter([
            'user_one_id'   => $this->getUserID(),
            'user_two_id'   => $user_id
        ]);
        
        $this->views['helpers']  = $helpers;
        
        return view('profile::new.ajaxpage.personal-list')->with($this->views)->render();
    }
    
    /**
     * Load Options in about
     * 
     * @param string $profile_code
     * @param ProfileDefaultRepository $profileRepo
     * @param UserModel $userModal
     * @param Request $request
     * @return type
     */
    public function load_option($profile_code, ProfileDefaultRepository $profileRepo, UserModel $userModal, Request $request)
    {
        $type = $request->get('option');
        
        $user = $this->user->getUserID($profile_code);
        $user_id = $user->id;
        $this->views['user']         = $this->user->findOneBy(['profile_code' => $profile_code]);
        $this->views['user_profile'] = $profileRepo->get_profile_details($user_id);
        $this->views['myprofile']    = ($this->getUserID() == $user_id) ? true : false;
        
        if($type == "personal") {
            return view('profile::new.ajaxpage.personal-option')->with($this->views)->render();
        }
    }
    
    /**
     * Load personal info via ajax
     * 
     * @param string $profile_code
     * @param ProfileDefaultRepository $profileRepo
     * @param UserModel $userModal
     * @param Request $request
     * @return type
     */
    public function load_about_credentials($profile_code, ProfileDefaultRepository $profileRepo, UserModel $userModal, Request $request)
    {
        $user = $this->user->getUserID($profile_code);
        
        $user_id = $user->id;
        $this->views['credentials']  = $profileRepo->get_user_credentials($user_id);
        $this->views['myprofile']    = ($this->getUserID() == $user_id) ? true : false;
        
        return view('profile::new.ajaxpage.about-credentials')->with($this->views)->render();
    }
    
    /**
     * Load credentials selector info via ajax
     * 
     * @param string $profile_code
     * @param ProfileDefaultRepository $profileRepo
     * @param UserModel $userModal
     * @param Request $request
     * @return type
     */
    public function load_about_credentials_selector($profile_code, ProfileDefaultRepository $profileRepo, UserModel $userModal, Request $request)
    {
        $user = $this->user->getUserID($profile_code);
        
        $user_id = $user->id;
        $this->views['user_profile'] = $profileRepo->get_profile_details($user_id);
        $this->views['credentials']  = $profileRepo->get_user_credentials($user_id);
        $this->views['myprofile']    = ($this->getUserID() == $user_id) ? true : false;
        
        return view('profile::new.ajaxpage.credentials-selector')->with($this->views)->render();
    }
    
    /**
     * Load personal info via ajax
     * 
     * @param string $profile_code
     * @param ProfileDefaultRepository $profileRepo
     * @param UserModel $userModal
     * @param Request $request
     * @return type
     */
    public function load_about_links($profile_code, ProfileDefaultRepository $profileRepo, UserModel $userModal, Request $request)
    {
        $user = $this->user->getUserID($profile_code);
        
        $user_id = $user->id;
        $this->views['user_profile'] = $profileRepo->get_profile_details($user_id);
        $this->views['myprofile']    = ($this->getUserID() == $user_id) ? true : false;
        
        return view('profile::new.ajaxpage.personal-links')->with($this->views)->render();
    }
    
    /**
     * Uploading profile photo primary
     * 
     * @param Request $request
     * @param ImageRepository $image
     * @return type
     */
    public function upload_primary_photo(Request $request, ImageRepository $image)
    {
        sleep(5);
        if ($request->ajax())
        {
            if ($request->isMethod('POST')) {
                if ($request->hasFile('file')) {
                    $image = $image->make($request->file('file') , 'upload/user/profile/original' , 'upload/user/profile/thumbs' , false , 'profile-photo');

                    return response()->json($image);
                }
            }
        }
    }
    
    /**
     * Save the image for crop
     * 
     * @param Request $request
     * @return type
     */
    public function upload_crop_primary_photo(Request $request)
    {
        if ($request->ajax()) {
            $inputs = array_merge($request->all(), [
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
            $user_id    = $inputs['user_id'];
            $filename   = $inputs['filename'];
            $data       = $inputs['toDataURL'];
            $path       = public_path('upload/user/profile/thumbs/');

            $img    = str_replace('data:image/png;base64,', '', $data);
            $img    = str_replace(' ', '+', $img);
            $data   = base64_decode($img);
            $file   = $path . $filename;
            file_put_contents($file, $data);

            Image::configure(array('driver' => 'imagick'));

            $img = Image::make($file);
            $img->fit(250, 250);
            $img->save($file);

            if ($this->getMaskStatus() == 0) {
                //$this->activity->add_activity(\Sentinel::getUser()->id , '' , 3 , '' , '');
            }

            return response()->json(['status' => true]);
        }
    }
    
    /**
     * Upload User Cover Photo
     * 
     * @param Request $request
     */
    public function upload_cover_photo(Request $request, ImageRepository $image, UserModel $userModal)
    {
        if ($request->ajax()) {
            if ($request->hasFile('file')) {
                $image->setThumbSize(300, 180);
                $return = $image->make($request->file('file'), 'upload/user/cover/original', 'upload/user/cover/thumbs', false, 'mask');

                $inputs = [
                    'user_id' => $this->getUserID(),
                    'filepath' => $image->getImageName($request->file('file')) . '.' . $image->getImageExt($request->file('file')),
                    'filename' => $image->getImageName($request->file('file')),
                    'filesize' => $image->getImageSize($request->file('file'))
                ];

                $userModal->update_user_basicinfo($inputs['user_id'], [
                    'coverphoto' => $inputs['filepath']
                ]);

                return response()->json($return);
            }
        }
    }
    
    /**
     * Users Connections
     * 
     * @param Request $request
     * @param ProfileDefaultRepository $profileRepo
     * @return type
     */
    public function set_connections_users(Request $request, ProfileDefaultRepository $profileRepo) 
    {
        if($request->ajax()) {
            $type = $request->get('type');
            
            $inputs = [
              'user_id'         => $this->getUserID(),
              'client_id'       => $request->get('client_id'),
              'request_user_id' => $request->get('request_user_id'),
              'action'          => $request->get('action')
            ];
            
            if($inputs['action'] == "add") {
                $response = $profileRepo->set_user_connections($type, $inputs);

                /**
                 * Add the activitity and notifications
                 */
                if ($inputs['action'] == "add" && $type == "af")
                {
                  $this->notification->notify_friend_connection_status($inputs['user_id'] , $response['client_id'] , $response['id'] , $inputs['action']);
                  $this->activity->add_activity($inputs['user_id'], $response['client_id'] , 8 , $response['id'] , '');

                  \LaravelPusher::trigger('notifications', 'notify', array('success' => true));
                }

                if ($inputs['action'] == "add" && $type == "aa")
                {
                  $this->notification->notify_acquaintance_connection_status($inputs['user_id'] , $response['client_id'] , $response['id'] , $inputs['action']);
                  $this->activity->add_activity($inputs['user_id'], $response['client_id'] , 6 , $response['id'] , '');

                  \LaravelPusher::trigger('notifications', 'notify', array('success' => true));
                }
            } else if($inputs['action'] == "accept_friend_request") {
                $response = $profileRepo->set_user_connections($type, $inputs);
                if ($this->getMaskStatus() == 0) {
                    $this->notification->notify_acquaintance_connection_status($inputs['user_id'] , $response['client_id'] , $response['id'] , $inputs['action']);
                }
            } else if($inputs['action'] == "accept_follow_request") {
                $response = $profileRepo->set_user_connections($type, $inputs);
                if ($this->getMaskStatus() == 0) {
                    $this->activity->add_activity($inputs['user_id'], $response['client_id'] , 7 , $inputs['action'] , '');
                }
            } else if($inputs['action'] == "cancel" || $inputs['action'] == "delete") {
                $response = $profileRepo->remove_user_connections($inputs, $type);
            }
            
            return response()->json($response);
        }
    }
    
    /**
     * Get comment list
     * 
     * @param Request $request
     * @param ProfileDefaultRepository $profileRepo
     */
    public function get_comments_list(Request $request, ProfileDefaultRepository $profileRepo)
    {
        $user = $this->user->getUserID($request->get('profile_code'));
        
        $user_id = $user->id;
        
        $helpers  = new Helpers;
        $humanize = new HumanizeTime();
        
        $this->views['helpers']  = $helpers;
        $this->views['humanize'] = $humanize;
        $this->views['comments'] = [
            'user_comments'  => $profileRepo->get_user_comments([
                'profile_owner_id' => $user_id,
                'user_id'          => $this->getUserID(),
                'mask'             => $this->getMaskStatus(),
                'filter'  => $request->get('filter'),
                'limit'   => 20
            ])
        ];
        
        
        
        //echo '<pre>'; print_r($this->views); exit;
        return view("profile::new.ajaxpage.comments.comments")->with($this->views)->render();
    }
    
    /**
     * Get replies list
     * 
     * @param Request $request
     * @param ProfileDefaultRepository $profileRepo
     */
    public function get_replies_list(Request $request, ProfileDefaultRepository $profileRepo)
    {
        $user = $this->user->getUserID($request->get('profile_code'));
        
        $user_id = $user->id;
        
        $helpers  = new Helpers;
        $humanize = new HumanizeTime();
        
        $this->views['helpers']  = $helpers;
        $this->views['humanize'] = $humanize;
        $this->views['comments'] = [
            'user_replies'  => $profileRepo->get_user_replies([
                'profile_owner_id' => $user_id,
                'user_id'          => $this->getUserID(),
                'mask'             => $this->getMaskStatus(),
                'limit'            => 20
            ])
        ];
        
        return view("profile::new.ajaxpage.comments.replies")->with($this->views)->render();
    }
    
    /**
     * Recount connection list
     * 
     * @param Request $request
     * @param ProfileDefaultRepository $profileRepo
     */
    public function recount_connections_list(Request $request, ProfileDefaultRepository $profileRepo)
    {
        $user_id = $this->getUserID();
        
        $recount = $profileRepo->count_connections_tab($user_id);
        
        return response()->json([
            'friends'       => $recount[0]['friends'],
            'followers'     => $recount[0]['followers'],
            'following'     => $recount[0]['following'],
            'requests'      => $recount[0]['request'],
            'profileview'   => $recount[0]['profileview']
        ]);
    }
    
    /**
     * Load the list of friends/following/followers of a user
     * 
     * @param Request $request
     * @param ProfileDefaultRepository $profileRepo
     */
    public function load_connections_list(Request $request, ProfileDefaultRepository $profileRepo)
    {
        $user = $this->user->getUserID($request->get('profile_code'));
        
        $user_id = $user->id;
        $type    = $request->get('type');
        
        $helpers  = new Helpers;
        $humanize = new HumanizeTime();
        
        $this->views['helpers']  = $helpers;
        $this->views['humanize'] = $humanize;
        
        if($type == "friends") {
            
            $friends_list = [];
            
            $response = $profileRepo->get_user_friends([
                'active_login_userid'   => $this->getUserID(),
                'owner_profile_userid'  => $user_id,
                'filter'                => $request->get('filter')
            ]);
            
            if(count($response) > 0) {
                foreach($response as $index => $list) {
                    $fav_strings    = $profileRepo->get_user_connection_fav_strings($list['user_id']);
                    
                    $list['fav_strings']        = $fav_strings;
                    
                    $friends_list[] = $list;
                }
            }
            //echo '<pre>'; print_r($friends_list); exit;
            $this->views['friends_list'] = $friends_list;
        } else if ($type == "followers") {
            $followers_list = [];
            
            $response = $profileRepo->get_user_followers([
                'active_login_userid'   => $this->getUserID(),
                'owner_profile_userid'  => $user_id,
                'filter'                => $request->get('filter')
            ]);
            
            if(count($response) > 0) {
                foreach($response as $index => $list) {
                    $fav_strings    = $profileRepo->get_user_connection_fav_strings($list['user_id']);
                    
                    $list['fav_strings']        = $fav_strings;
                    
                    $followers_list[] = $list;
                }
            }
            //echo '<pre>'; print_r($followers_list); exit;
            $this->views['followers_list'] = $followers_list;
            
        } else if ($type == "following") {
            $following_list = [];
            
            $response = $profileRepo->get_user_following([
                'active_login_userid'   => $this->getUserID(),
                'owner_profile_userid'  => $user_id,
                'filter'                => $request->get('filter')
            ]);
            
            if(count($response) > 0) {
                foreach($response as $index => $list) {
                    $fav_strings    = $profileRepo->get_user_connection_fav_strings($list['user_id']);
                    
                    $list['fav_strings']        = $fav_strings;
                    
                    $following_list[] = $list;
                }
            }
            $this->views['following_list'] = $following_list;
            
        } else if ($type == "requests") {
            $request_list = [];
            
            $response = $profileRepo->get_user_request([
                'active_login_userid'   => $this->getUserID(),
                'owner_profile_userid'  => $user_id
            ]);
            
            if(count($response) > 0) {
                foreach($response as $index => $list) {
                    $counting       = $profileRepo->get_similiar_and_mutual($user_id, $list['user_id']);
                    $fav_strings    = $profileRepo->get_user_connection_fav_strings($list['user_id']);
                    
                    $list['mutual_friends']     = $counting[0]['friends'];
                    $list['similar_interest']   = $counting[0]['strings'];
                    $list['fav_strings']        = $fav_strings;
                    
                    $request_list[] = $list;
                }
            }
            
            $this->views['request_list'] = $request_list;
        } else if ($type == "views") {
            $response = $profileRepo->get_user_views([
                'active_login_userid'   => $this->getUserID(),
                'owner_profile_userid'  => $user_id
            ]);
            
            //echo '<pre>'; print_r($response); exit;
            $this->views['views_list'] = $response;
        }
        
        $this->views['active_login_userid'] =  $this->getUserID();
        
        
        return view("profile::new.ajaxpage.connections.{$type}")->with($this->views)->render();
    }
    
    /**
     * Load Images List
     * 
     * @param Request $request
     * @param ProfileDefaultRepository $profileRepo
     */
    public function load_images_list(Request $request, ProfileDefaultRepository $profileRepo)
    {
        $user = $this->user->getUserID($request->get('profile_code'));
        
        $user_id = $user->id;
        
        $this->views['images_list'] = $profileRepo->load_images_list($user_id, $this->getUserID());
        
        //echo '<pre>'; print_r($this->views['images_list']); exit;
        return view("profile::new.ajaxpage.images.index")->with($this->views)->render();
    }
    
    /**
     * Function to remove data in connections
     * 
     * @param Request $request
     * @param ProfileDefaultRepository $profileRepo
     */
    public function remove_connections_list(Request $request, ProfileDefaultRepository $profileRepo)
    {
        $user = $this->user->getUserID($request->get('profile_code'));
        
        $user_id = $user->id;
        $type    = $request->get('type');
        $id      = $request->get('id');
        
        if($type == "viewer") {
            $profileRepo->remove_profile_view($id);
        } else if ($type === "friend_request") {
            $profileRepo->remove_user_connections([
                'user_id'   => $this->getUserID(),
                'client_id' => $request->get('client_id')
            ], 'af');
        }
        
         return response()->json(['status' => true]);
    }
    
    /**
     * Save profile information
     * 
     * @param Request $request
     * @param ProfileDefaultRepository $profileRepo
     * @return array
     */
    public function save_profile_info(Request $request, ProfileDefaultRepository $profileRepo) 
    {
        if($request->ajax()) {
            
            $attributes = array_merge($request->except('_token'), [
                'user_id' => $this->getUserID()
            ]);
            
            $response = $profileRepo->save_profile_info($attributes);
            
            return response()->json($response);
        }
    }
    
    /**
     * Update profile information
     * 
     * @param Request $request
     * @param ProfileDefaultRepository $profileRepo
     * @return array
     */
    public function update_profile_info(Request $request, ProfileDefaultRepository $profileRepo) 
    {
        if($request->ajax()) {
            
            $attributes = array_merge($request->except('_token'), [
                'user_id' => $this->getUserID()
            ]);
            
            $response = $profileRepo->update_profile_info($attributes);
            
            return response()->json($response);
        }
    }
    
    /**
     * Get strings search
     * 
     * @param Request $request
     * @param StringRepository $stringRepo
     * @return type
     */
    public function search_favorite_strings(Request $request, StringRepository $stringRepo)
    {
        $key     = $request->get('q');
        
        $data = $stringRepo->search_strings($this->getUserID(), $this->getMaskStatus(), $key);
        
        return response()->json($data);
    }
    //Top 3 strings
        
        
    /**
     * Load top favorite strings via ajax
     * 
     * @param string $profile_code
     * @param ProfileDefaultRepository $profileRepo
     * @return type
     */
    public function load_favorite_strings_header($profile_code, ProfileDefaultRepository $profileRepo) 
    {
        $user = $this->user->getUserID($profile_code);
        $user_id = $user->id;
        $this->views['top_strings'] = $profileRepo->get_top_strings($user_id);
        
        return view('profile::new.ajaxpage.top-favorite-strings')->with($this->views)->render();
    }
    /**
     * Load favorite strings via ajax
     * 
     * @param string $profile_code
     * @param ProfileDefaultRepository $profileRepo
     * @return type
     */
    public function load_favorite_strings($profile_code, ProfileDefaultRepository $profileRepo) 
    {
        $user = $this->user->getUserID($profile_code);
        $user_id = $user->id;
        
        $this->views['myprofile']    = ($this->getUserID() == $user_id) ? true : false;
        $this->views['favorite_strings'] = $profileRepo->show_favorite_strings($user_id);
        
        return view('profile::new.ajaxpage.favorite-strings')->with($this->views)->render();
    }
    /**
     * Save strings to favorite
     * 
     * @param Request $request
     * @param StringRepository $stringRepo
     * @return type
     */
    public function strings_favorite(Request $request, StringRepository $stringRepo, ProfileDefaultRepository $profileRepo)
    {
        $action = $request->get('action');
        
        if($action == "add") {
            $inputs = [
                'user_id'   => $this->getUserID(),
                'string_id' => $request->get('string_id'),
                'rel'       => $request->get('rel')
            ];

            $stringRepo->save_favorite_strings($inputs);

            $user = $this->user->getUserID($request->get('profile_code'));
            $user_id = $user->id;
            $this->views['favorite_strings'] = $profileRepo->show_favorite_strings($user_id);

            return view('profile::new.ajaxpage.favorite-strings')->with($this->views)->render();
        } else if($action == "delete") {
            
            $id = $request->get('id');
            
            $stringRepo->remove_favorite_strings($id);
            
            $user = $this->user->getUserID($request->get('profile_code'));
            $user_id = $user->id;
            $this->views['favorite_strings'] = $profileRepo->show_favorite_strings($user_id);

            return view('profile::new.ajaxpage.favorite-strings')->with($this->views)->render();
        }
    }
}