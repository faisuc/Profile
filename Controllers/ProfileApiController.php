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
use Redirect, Input;
use Response, File;

use Illuminate\Http\Request;

class ProfileApiController extends BaseController {

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
        ProfileRepository $profile ,
        NotificationInterface $notification ,
        ActivityInterface $activity) {

        parent::__construct($user);

        $this->user   = $user;
        $this->profile = $profile;
        $this->notification = $notification;
        $this->activity = $activity;
    }

    /**
     * Add Friend
     *
     * @param $user_one_id - the one who requested
     * @param @user_two_id - requested user
     * @param $action
     */
    public function friend_user(Request $request)
    {
        if($request->ajax()) {
            //the user sender
            $user_one_id = $this->getUserID();
            //the user which sent the request 
            $user_two_id = $request->get('user_two');
            $action      = $request->get('action');

            $response = $this->user->friend_user($user_one_id , $user_two_id, $action);

            $this->notification->notify_friend_connection_status($user_one_id , $user_two_id , $response['reference'] , $action);

            if ($action == "add")
            {
              $this->activity->add_activity($user_one_id, $user_two_id , 8 , $response['reference'] , '');
            }
            else if ($action == "accept_friend_request")
            {
              $this->activity->add_activity($user_one_id, $user_two_id , 9 , $response['reference'] , '');
            }

            \LaravelPusher::trigger('notifications', 'notify', array('success' => true));
            
            return Response::json(['status' => $response['status']]);
        }
    }

    /**
     * Acquaintances User
     *
     * @param $user_one_id - the one who requested
     * @param @user_two_id - requested user
     * @param $action - Request or Cancel
     */
    public function acquaintance_user(array $inputs = [])
    {
        if(\Request::ajax() && empty($inputs)) {
            $user_one_id = Input::get('user_one');
            $user_two_id = Input::get('user_two');
            $action      = Input::get('action');
        }
        else {
            $user_one_id = $inputs['user_one'];
            $user_two_id = $inputs['user_two'];
            $action      = $inputs['action'];
        }

            $response = $this->user->acquaintance_user($user_one_id , $user_two_id, $action);

            $this->notification->notify_acquaintance_connection_status($user_one_id , $user_two_id , $response['reference'] , $action);
            if ($action == "request")
            {
                if ($this->getMaskStatus() == 0)
                {
                    $this->activity->add_activity($user_one_id, $user_two_id , 6 , $response['reference'] , '');
                }
            }
            else if ($action == "accept_acquaintance_request")
            {
                if ($this->getMaskStatus() == 0)
                {
                    $this->activity->add_activity($user_one_id, $user_two_id , 7 , $response['reference'] , '');
                }
            }

            \LaravelPusher::trigger('notifications', 'notify', array('success' => true));

            return Response::json(['status' => $response['status'] , 'ref_id' => 1]);
        
    }

    /**
     * Track User
     *
     * $tracking = the one who tracking
     * $tracker  = the one who tracker
     * $action   = tracked or untracked
     */
    public function track_user()
    {
        if(Request::ajax()) {
            $tracking_id = Input::get('tracking');
            $tracker     = Input::get('tracker');
            $action      = Input::get('action');

            $response = $this->user->tracked_user($tracking_id , $tracker , $action);
            if ($action == "tracked")
            {
              $this->notification->add_notification($tracking_id , $tracker , 1 , $response['ref_id']);
              if ($this->getMaskStatus() == 0)
              {
                  $this->activity->add_activity($tracker, $tracking_id , 5 , $response['ref_id'] , '');
              }
            }

            \LaravelPusher::trigger('notifications', 'notify', array('success' => true));
            
            return Response::json(['status' => $response['status']]);
        }
    }

}
