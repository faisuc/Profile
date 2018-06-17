<?php
namespace Modular\Forms\Profile\Repositories;

use Mockery\CountValidator\Exception;
use Modular\Repositories\EloquentRepository;
use Illuminate\Database\Eloquent\Model;

use Modular\Repositories\ValidatorInterface;

/**
 * Models
 */
use Modular\Forms\Users\Models\UserModel;
use Modular\Forms\Users\Models\StringModel;
use Modular\Forms\Connections\Models\UserAcquiantancesModel;
use Modular\Forms\Notifications\Models\NotificationModel;

use Illuminate\Support\Facades\DB;
use Modular\Libraries\Helpers\Helpers;

class ProfileDefaultRepository extends EloquentRepository {

    private $_helper;

    private $user;
    
    public function __construct()
    {
        $this->_helper  = new Helpers;
        $this->user     = new UserModel;
    }
    
    /**
     * Save user profile info
     * 
     * @param array $attributes
     */
    public function save_profile_info($attributes) 
    {
        $user_data = $this->user->get_user_by_id($attributes['user_id']);
        $message   = "";
        try {
            
            $action = $attributes['action'];
            
            if($action == "basic-info") {
                $first_name     = $this->_helper->nohtml($attributes['first_name']);
                $middle_name    = $this->_helper->nohtml($attributes['middle_name']);
                $last_name      = $this->_helper->nohtml($attributes['last_name']);
                
                $this->user->update_user_info('users', ['id' => $attributes['user_id']], [
                   'first_name' => $first_name, 
                   'last_name'  => $middle_name
                ]);
                
                $this->user->update_user_info('userbasicinfo', ['user_id' => $attributes['user_id']], [
                   'middlename' => $last_name
                ]);
                
                $message = $first_name.' '.$middle_name.' '.$last_name;
            } else if($action == "save-location") {
                $this->user->update_user_info('usercontactinfo', ['user_id' => $attributes['user_id']], [
                   'address' => $attributes['location']
                ]);
                
            } else if($action == "save-religion") {
                $this->user->update_user_info('userbasicinfo', ['user_id' => $attributes['user_id']], [
                   'religion' => $attributes['my-religion']
                ]);
                
            } else if($action == "save-political") {
                $this->user->update_user_info('userbasicinfo', ['user_id' => $attributes['user_id']], [
                   'politics' => $attributes['my-politics']
                ]);
                
            } else if($action == "save-blood-type") {
                $this->user->update_user_info('userbasicinfo', ['user_id' => $attributes['user_id']], [
                   'bloodtype' => $attributes['my-bloodtype']
                ]);
                
            } else if($action == "save-contact") {
                $this->user->save_user_contacts(['user_id' => $attributes['user_id']], [
                    'contact' => $attributes['contact']
                ]);
                
            } else if($action == "save-links") {
                $this->user->save_user_links(['user_id' => $attributes['user_id']], [
                    'linktitle' => $attributes['linktitle'],
                    'linkurl'   => $attributes['linkurl']
                ]);
                
            } else if($action == "save-work-history") {
                $current = isset($attributes['is_current']) ? 0 : $attributes['yearended'];
                
                $this->user->insert_user_info('userworkhistory', [
                    'user_id'       => $attributes['user_id'],
                    'companyname'   => $attributes['companyname'],
                    'position'      => $attributes['position'],
                    'location'      => $attributes['location'],
                    'yearstarted'   => $attributes['yearstarted'],
                    'yearended'     => $current
                ]);
            } else if($action == "save-education-history") {
                $current = isset($attributes['is_graduated']) ? 0 : $attributes['yearended'];
                
                $this->user->insert_user_info('usereduccollege', [
                    'user_id'       => $attributes['user_id'],
                    'schoolname'    => $attributes['schoolname'],
                    'course'        => $attributes['course'],
                    'location'      => "",
                    'yearstarted'   => $attributes['yearstarted'],
                    'yearended'     => $current
                ]);
            } else if($action == "save-general-history") {
                $this->user->insert_user_info('usergeneralinfo', [
                    'user_id'       => $attributes['user_id'],
                    'general_info'  => $attributes['general_info']
                ]);
            }
            
            return [
                'status'  => true,
                'message' => $message
            ];
        } catch (Exception $ex) {
            return [
                'status'  => false,
                'message' => $ex->getMessage()
            ];
        }
    }
    
    /**
     * Update user profile info
     * 
     * @param array $attributes
     */
    public function update_profile_info($attributes) 
    {
        $user_data = $this->user->get_user_by_id($attributes['user_id']);
        $message   = "";
        try {
            
            $action = $attributes['action'];
            
            if($action == "basic-info") {
                $first_name     = $this->_helper->nohtml($attributes['first_name']);
                $middle_name    = $this->_helper->nohtml($attributes['middle_name']);
                $last_name      = $this->_helper->nohtml($attributes['last_name']);
                
                $this->user->update_user_info('users', ['id' => $attributes['user_id']], [
                   'first_name' => $first_name, 
                   'last_name'  => $middle_name
                ]);
                
                $this->user->update_user_info('userbasicinfo', ['user_id' => $attributes['user_id']], [
                   'middlename' => $last_name
                ]);
                
                $message = $first_name.' '.$middle_name.' '.$last_name;
            } else if($action == "update-bio") {
                $this->user->update_user_info('users', ['id' => $attributes['user_id']], [
                   'bio_info' => $this->_helper->breaklines_checkpoint($attributes['bio'], "addbreaks"), 
                ]);
                
                $message = $this->_helper->breaklines_checkpoint($attributes['bio'], "striped");
                
            } else if($action == "birthdate") {
                $this->user->update_user_info('users', ['id' => $attributes['user_id']], [
                   'birthyear' => $attributes['year'] 
                ]);
                
                $this->user->update_user_info('userbasicinfo', ['user_id' => $attributes['user_id']], [
                   'birthmonth' => $attributes['month'],
                   'birthday'   => $attributes['day']
                ]);
                
                $message = config('helper.months')[$attributes['month']].' '.$attributes['day'].', '.$attributes['year'];
                
            } else if($action == "location-info") {
                $this->user->update_user_info('usercontactinfo', ['user_id' => $attributes['user_id']], [
                    'address'   => $attributes['location'],
                ]);
                
                $message = $attributes['location'];
                
            } else if($action == "gender-info") {
                $this->user->update_user_info('users', ['id' => $attributes['user_id']], [
                    'gender'        => $attributes['gender'],
                    'gender_custom' => isset($attributes['custom-gender']) ? $attributes['custom-gender'] : "",
                ]);
                
                $message = $attributes['gender'] == "N" ? "Others, {$attributes['custom-gender']}" : ($attributes['gender'] == "M" ? "Male" : "Female");
                
            } else if($action == "religion") {
                $this->user->update_user_info('userbasicinfo', ['user_id' => $attributes['user_id']], [
                   'religion' => $attributes['my-religion']
                ]);
                $message = $attributes['my-religion'];
                
            } else if($action == "politics") {
                $this->user->update_user_info('userbasicinfo', ['user_id' => $attributes['user_id']], [
                   'politics' => $attributes['politics-view']
                ]);
                
                $message = $attributes['politics-view'];
            } else if($action == "contact") {
                $this->user->update_user_info('usercontactinfo', ['user_id' => $attributes['user_id']], [
                   'contact1' => $attributes['contact1']
                ]);
                
                $message = $attributes['contact1'];
            } else if($action == "bloodtype") {
                $this->user->update_user_info('userbasicinfo', ['user_id' => $attributes['user_id']], [
                   'bloodtype' => $attributes['my-bloodtype']
                ]);
                
                $message = "Bloodtype ".$attributes['my-bloodtype'];
            } else if($action == "links") {
                if($attributes['type'] == "link1") {
                    $update = [
                        'webtitle1' => $attributes['linktitle'],
                        'weblink1'  => $attributes['linkurl'],
                    ];
                } else if($attributes['type'] == "link2") {
                    $update = [
                        'webtitle2' => $attributes['linktitle'],
                        'weblink2'  => $attributes['linkurl'],
                    ];
                } else {
                    $update = [
                        'webtitle3' => $attributes['linktitle'],
                        'weblink3'  => $attributes['linkurl'],
                    ];
                }
                
                $this->user->update_user_info('usercontactinfo', ['user_id' => $attributes['user_id']], $update);
                
            } else if($action == "credentials") {
                if($attributes['status'] == "delete") {
                    if($attributes['type'] == "work") {
                        $this->user->delete_user_info('userworkhistory', ['id' => $attributes['id']]);
                    } else if($attributes['type'] == "education") {
                        $this->user->delete_user_info('usereduccollege', ['id' => $attributes['id']]);
                    } else {
                        $this->user->delete_user_info('usergeneralinfo', ['id' => $attributes['id']]);
                    }
                } else {
                    if($attributes['type'] == "work") {
                        $current = isset($attributes['is_current']) ? 0 : $attributes['yearended'];
                        $this->user->update_user_info('userworkhistory', [
                                'user_id' => $attributes['user_id'],
                                'id' => $attributes['id']
                            ],[
                                'user_id'       => $attributes['user_id'],
                                'companyname'   => $attributes['companyname'],
                                'position'      => $attributes['position'],
                                'location'      => $attributes['location'],
                                'yearstarted'   => $attributes['yearstarted'],
                                'yearended'     => $current
                            ]);
                        
                        $message = !empty($attributes['position']) ? $attributes['position'] . ", " : "";         
                        $message .= $attributes['companyname'];
                        $message .= !empty($attributes['position']) ? ", ".$attributes['location'] : "";
                        
                    } else if($attributes['type'] == "education") {
                        $current = isset($attributes['is_graduated']) ? 0 : $attributes['yearended'];
                        $this->user->update_user_info('usereduccollege', [
                                'user_id'   => $attributes['user_id'],
                                'id'        => $attributes['id']
                            ],[
                                'user_id'       => $attributes['user_id'],
                                'schoolname'    => $attributes['schoolname'],
                                'course'        => $attributes['course'],
                                'location'      => "",
                                'yearstarted'   => $attributes['yearstarted'],
                                'yearended'     => $current
                            ]);
                        
                        $message = !empty($attributes['course']) ? $attributes['course'] . ", " : "";         
                        $message .= $attributes['schoolname'];
                    } else {
                        $this->user->update_user_info('usergeneralinfo', [
                                'user_id'   => $attributes['user_id'],
                                'id'        => $attributes['id']
                            ],[
                                'user_id'       => $attributes['user_id'],
                                'general_info'  => $attributes['general_info']
                            ]);
                               
                        $message = $attributes['general_info'];
                    }
                }
            } else if($action == "contacts") {
                if($attributes['status'] == "delete") {
                    if($attributes['type'] == "contact2") {
                        $this->user->update_user_info('usercontactinfo', ['user_id' => $attributes['user_id']], ['contact2' => '']);
                    } else if($attributes['type'] == "contact3") {
                        $this->user->update_user_info('usercontactinfo', ['user_id' => $attributes['user_id']], ['contact3' => '']);
                    }
                } else {
                    $contacts['contact1'] = $attributes['contact1'];
                    if(isset($attributes['contact2']) && !empty($attributes['contact2'])) {
                        $contacts['contact2'] = $attributes['contact2'];
                    }
                    if(isset($attributes['contact3']) && !empty($attributes['contact3'])) {
                        $contacts['contact3'] = $attributes['contact3'];
                    }
                    
                    $this->user->update_user_info('usercontactinfo', ['user_id' => $attributes['user_id']], $contacts);
                }
                
                $set = $this->user->get_user_by_where('usercontactinfo', ['user_id' => $attributes['user_id']]);
                if($set->count() > 0) {
                    $_data = $set->first();
                    $message = !empty($_data->contact1) ? $_data->contact1 ." <br>" : "";
                    $message .= !empty($_data->contact2) ? $_data->contact2 ." <br>" : "";
                    $message .= !empty($_data->contact3) ? $_data->contact3 ." <br>" : "";
                }
            } else if($action == "set-credential-active") {
                $this->user->update_user_info('usersettings', [
                    'user_id'   => $attributes['user_id']
                ],[
                    'credential_type'  => $attributes['type'],
                    'credential_refid' => $attributes['id']
                ]);
            }
            
            
            return [
                'status'  => true,
                'message' => $message
            ];
        } catch (Exception $ex) {
            return [
                'status'  => false,
                'message' => $ex->getMessage()
            ];
        }
    }
    
    /**
     * Set connections for the user
     * 
     * @param string $type
     * @param array $inputs
     */
    public function set_user_connections($type, $inputs)
    {
        $this->follow = new UserAcquiantancesModel;
        
        $request_user_id = $inputs['request_user_id'];
        /**
         * First we need to check if the client id is exist
         */
        $client_data = $this->user->get_user_by_profile_code($inputs['client_id']);
        $request_set_id  = $client_data->id;
        
        if(!empty($request_user_id)
            && $request_user_id > 0) {
            $request_set_id = $request_user_id;
        }
        try {
            if(count($client_data) == 0) {
                throw new Exception('user not found.');
            }
            
            $id = 0;
            
            if($type == "af") {
                //af is for add friends
                //This is for friend request
                if($inputs['action'] == "add") {
                    $id = $this->user->insert_user_friends([
                        'user_one_id' => $inputs['user_id'],
                        'user_two_id' => $request_set_id,
                        'status' => 0
                    ]);
                } else {
                    $this->user->delete_user_friends_by_filter([
                        'user_one_id' => $inputs['user_id'],
                        'user_two_id' => $request_set_id
                    ]);
                }
                
                return [
                    'status'  => true,
                    'message' => '',
                    'id'      => $id,
                    'client_id' => $request_set_id
                ];
                
            } else if($type == "aa") {
                //aa is for acquaintances
                //This is for friend request
                if($inputs['action'] == "add") {
                    $id = $this->user->insert_user_acquaintances([
                        'user_one_id' => $inputs['user_id'],
                        'user_two_id' => $request_set_id,
                        'status' => 0
                    ]);
                } else {
                    $this->user->delete_user_acquaintances_by_filter([
                        'user_one_id' => $inputs['user_id'],
                        'user_two_id' => $request_set_id
                    ]);
                }
                
                return [
                    'status'  => true,
                    'message' => '',
                    'id'      => $id,
                    'client_id' => $client_data->id
                ];
            } else if($type == "accept_friend_request") {
                if ($this->follow->where('user_one_id' , $request_set_id)->where('user_two_id' , $inputs['user_id'])->where('status' , 0)->first() === null)
                {
                    if ($this->follow->where('user_one_id' , $request_set_id)->where('user_two_id' , $inputs['user_id'])->where('status' , 1)->first() === null)
                    {
                        $this->follow->create([
                            'user_one_id'   => $request_set_id,
                            'user_two_id'   => $inputs['user_id'] ,
                            'status'        => 1
                        ]);
                    }
                }
                else
                {
                    $this->follow->where('user_one_id' , $request_set_id)->where('user_two_id' , $inputs['user_id'])->where('status' , 0)->update(
                        array('status' => 1)
                    );
                }

                if ($this->follow->where('user_one_id' , $inputs['user_id'])->where('user_two_id' , $request_set_id)->where('status' , 0)->first() === null)
                {
                    if ($this->follow->where('user_one_id' , $inputs['user_id'])->where('user_two_id' , $request_set_id)->where('status' , 1)->first() === null)
                    {
                        $this->follow->create([
                            'user_one_id'   => $inputs['user_id'],
                            'user_two_id'   => $request_set_id,
                            'status'        => 1
                        ]);
                    }
                }
                else
                {
                    $this->follow->where('user_one_id' , $inputs['user_id'])->where('user_two_id' , $request_set_id)->where('status' , 0)->update(
                        array('status' => 1)
                    );
                }

                $this->user->update_user_friends([
                    'user_one_id'  => $request_set_id,
                    'user_two_id'  => $inputs['user_id'],
                    'status'       => 0
                ],[
                    'status' => 1
                ]);
                
                $res = $this->user->get_user_friends_by_filter([
                    'user_one_id' => $request_set_id,
                    'user_two_id' => $inputs['user_id'],
                    'status'      => 1
                ]);
                
                $this->user->insert_user_friends([
                    'user_one_id' => $inputs['user_id'],
                    'user_two_id' => $request_set_id,
                    'status' => 1
                ]);
                
                return [
                    'status'    => true,
                    'message'   => '',
                    'id'        => $res->id,
                    'client_id' => $request_set_id
                ];
            } else if($type == "accept_follow_request") {
                $this->user->update_useracquiantances([
                    'user_one_id' => $request_set_id,
                    'user_two_id' => $inputs['user_id'],
                    'status'      => 0
                ], [
                    "status" => 1
                ]);

                $res = $this->user->get_user_acquaintances_by_filter([
                    'user_one_id' => $request_set_id,
                    'user_two_id' => $inputs['user_id'],
                    'status'      => 1
                ]);
                
                return [
                    'status'    => true,
                    'message'   => '',
                    'id'        => $res->id,
                    'client_id' => $request_set_id
                ];
            }
            
        } catch (Exception $ex) {
            return [
                'status'  => false,
                'message' => $ex->getMessage()
            ];
        }
    }
    
    /**
     * Remove the data in user conenctions
     * 
     * @param array $inputs
     * @param string $type
     */
    public function remove_user_connections($inputs, $type)
    {
        /**
         * First we need to check if the client id is exist
         */
        $client_data = $this->user->get_user_by_profile_code($inputs['client_id']);
        try {
            if(count($client_data) == 0) {
                throw new Exception('user not found.');
            }
            
            $id = 0;
            
            if($type == "af") {
                
                $this->user->delete_user_friends_by_filter([
                    'user_one_id' => $inputs['user_id'],
                    'user_two_id' => $client_data->id
                ]);
                
                $this->user->delete_user_friends_by_filter([
                    'user_one_id' => $client_data->id,
                    'user_two_id' => $inputs['user_id']
                ]);
                
                return [
                    'status'  => true
                ];
                
            } else if($type == "aa") {
                $this->user->delete_user_acquaintances_by_filter([
                    'user_one_id' => $inputs['user_id'],
                    'user_two_id' => $client_data->id
                ]);
                
//                $this->user->delete_user_acquaintances_by_filter([
//                    'user_one_id' => $client_data->id,
//                    'user_two_id' => $inputs['user_id']
//                ]);
                
                return [
                    'status'  => true
                ];
            }
            
        } catch (Exception $ex) {
            return [
                'status'  => false,
                'message' => $ex->getMessage()
            ];
        }
    }
    
    /**
     * Get the top 3 strings for the user
     * 
     * @param int $user_id
     */
    public function get_top_strings($user_id)
    {
        $sql = "SELECT ufav.id,
                        ufav.user_id,
                        ufav.topic_id,
                        ufav.created_at,
                        t.color,
                        t.coverphoto,
                        t.string_alias,
                        t.slug
             FROM userfavoritestrings ufav
             INNER JOIN topic t ON t.id = ufav.topic_id
             WHERE t.deleted_at IS NULL AND ufav.user_id={$user_id}
             ORDER BY ufav.created_at DESC
             LIMIT 3";
       
        return collect($this->_helper->convert_sql_to_array( DB::select(DB::raw($sql)) ));     
    }
    
    /**
     * Count the total numbers for the user(profile views, total friends, total followers, total following, and total request)
     * 
     * @param int $user_id
     * @return array
     */
    public function user_numbers($user_id)
    {   
        $sql = "SELECT 	   
                coalesce(a.total,0) as profileview,
                coalesce(b.total,0) as friends,
                coalesce(c.total,0) as followers,
                coalesce(d.total,0) as following,
                (coalesce(e.total,0) + coalesce(f.total,0)) as request,
                round((coalesce(g.yaycount,0) + coalesce(h.yaycount,0) + (coalesce(i.yaycount,0) / 10)) / 3) as avg_rating
             FROM users u
             LEFT OUTER JOIN (select userprofileview.profile_userid,
                 COUNT(*) total
             FROM userprofileview
             GROUP BY userprofileview.profile_userid) as a ON a.profile_userid = u.id
             LEFT OUTER JOIN (select userfriends.user_one_id,
                 COUNT(*) total
             FROM userfriends
             WHERE userfriends.status = 1
             GROUP BY userfriends.user_one_id) as b ON b.user_one_id = u.id
             LEFT OUTER JOIN (select useracquiantances.user_two_id,
                 COUNT(*) total
             FROM useracquiantances
             WHERE useracquiantances.status = 1
             GROUP BY useracquiantances.user_two_id) as c ON c.user_two_id = u.id
             LEFT OUTER JOIN (select useracquiantances.user_one_id,
                 COUNT(*) total
             FROM useracquiantances
             WHERE useracquiantances.status = 1
             GROUP BY useracquiantances.user_one_id) as d ON d.user_one_id = u.id
             LEFT OUTER JOIN (select uf.user_two_id,
                 COUNT(*) total
             FROM userfriends uf
             WHERE (uf.user_two_id={$user_id} AND uf.status=0)
             GROUP BY uf.user_two_id) as e ON e.user_two_id = u.id
             LEFT OUTER JOIN (select ua.user_two_id,
                 COUNT(*) total
             FROM useracquiantances ua
             WHERE (ua.user_two_id={$user_id} AND ua.status=0)
             GROUP BY ua.user_two_id) as f ON f.user_two_id = u.id
             LEFT OUTER JOIN (select postcontentapprovalrate.user_id,
                 sum(Case when approvalrate = 'Y' then 1 else 0 end) yaycount
             FROM postcontentapprovalrate
             LEFT JOIN postcontent ON postcontent.id = postcontentapprovalrate.postcontent_id
             WHERE postcontent.deleted_at IS NULL AND postcontentapprovalrate.mask = 0
             GROUP BY postcontentapprovalrate.user_id) as g ON g.user_id = u.id
             LEFT OUTER JOIN (select topicapprovalrate.user_id,
                 sum(Case when approvalrate = 'Y' then 1 else 0 end) yaycount
             FROM topicapprovalrate
             LEFT JOIN topic ON topic.id = topicapprovalrate.string_id
             WHERE topic.deleted_at IS NULL AND topicapprovalrate.mask=0
             GROUP BY topicapprovalrate.user_id) as h ON h.user_id = u.id
             LEFT OUTER JOIN (select postopinionapprovalrate.user_id,
                 sum(Case when approvalrate = 'Y' then 1 else 0 end) yaycount
             FROM postopinionapprovalrate
             LEFT JOIN postopinion ON postopinion.id = postopinionapprovalrate.postopinion_id
             LEFT JOIN postcontent ON postcontent.id = postopinion.postcontent_id
             WHERE postcontent.deleted_at IS NULL AND postopinion.deleted_at IS NULL
             AND postopinionapprovalrate.mask=0
             GROUP BY postopinionapprovalrate.user_id) as i ON i.user_id = u.id
             WHERE u.id={$user_id}";

        return DB::select(DB::raw($sql));
    }
    
    /**
     * Get user profile details
     * 
     * @param int $user_id
     */
    public function get_profile_details($user_id)
    {
        $sql = "SELECT u.id as user_id, 
                    u.profile_code,
                    u.bio_info,
                    u.created_at as register_date,
                    u.email,
                    u.last_name,
                    u.first_name,
                    ub.middlename,
                    u.fullname_last_edited,
                    uc.address,
                    rc.name as country,
                    (case u.gender
                            when 'N' then CONCAT('Others','',u.gender_custom)
                            when 'F' then 'Female'
                            when 'M' then 'Male'
                            else ''
                    end) 'gender',
                    u.gender_num_times_edited,
                    ub.birthday,
                    u.birthyear,
                    u.birthdate_num_times_edited,
                    ub.politics as political_view,
                    ub.religion,
                    rb.name as bloodtype,
                    uc.contact1,
                    uc.contact2,
                    uc.contact3,
                    uc.webtitle1, 
                    uc.weblink1, 
                    uc.webtitle2, 
                    uc.weblink2,
                    uc.webtitle3, 
                    uc.weblink3,
                    coalesce(a.comments,0) + coalesce(b.discussion,0)as total_comments,
                    coalesce(m.friends,0) as total_friends,
                    coalesce(n.followers,0) as total_followers,
                    coalesce(o.following,0) as total_following,
                    coalesce(c.post,0) as total_post,
                    coalesce(c.image,0) as total_images,
                    coalesce(c.poll,0) as total_poll,
                    coalesce(c.question,0) as total_question,
                    coalesce(c.article,0) as total_article,
                    (coalesce(d.yaycontent,0) + coalesce(e.yaycomment,0) + coalesce(f.yayreply,0) + coalesce(g.yayreplyl2,0) + coalesce(h.yayreplyl3,0) + coalesce(i.yaydiscussion,0) + coalesce(j.yaytopicreply,0) + coalesce(k.yaytopicreplyl2,0) + coalesce(l.yaytopicreplyl3,0)) as totalyayreceived,
                    (coalesce(d.naycontent,0) + coalesce(e.naycomment,0) + coalesce(f.nayreply,0) + coalesce(g.nayreplyl2,0) + coalesce(h.nayreplyl3,0) + coalesce(i.naydiscussion,0) + coalesce(j.naytopicreply,0) + coalesce(k.naytopicreplyl2,0) + coalesce(l.naytopicreplyl3,0)) as totalnayreceived,
                    us.credential_type,
                    us.credential_refid,
                    (case us.credential_type
                    when 1 then ugen.general_info
                    when 2 then CONCAT(ucol.course, ', ', ucol.schoolname)
                    when 3 then CONCAT(uwork.position, ', ', uwork.companyname,', ',uwork.location)
                    end) 'credential',
	    (coalesce(ugen2.total,0)  +  coalesce(ucol2.total,0) + coalesce(uwork2.total,0)) as total_credentials
                FROM users u
                LEFT JOIN userbasicinfo ub ON u.id = ub.user_id
                LEFT JOIN usercontactinfo uc ON  uc.user_id = u.id
                LEFT JOIN refcountry rc ON rc.id = uc.country 
                LEFT JOIN refbloodtype rb ON rb.id = ub.bloodtype
                LEFT OUTER JOIN(SELECT po.user_id, 
                          count(*) comments
                FROM postopinion po
                WHERE po.deleted_at IS NULL AND po.mask= 0
                GROUP BY po.user_id) as a ON a.user_id = u.id	
                LEFT OUTER JOIN(SELECT top_o.user_id,
                       count(*) discussion
                FROM topicopinion top_o
                WHERE top_o.deleted_at IS NULL AND top_o.mask=0
                GROUP BY top_o.user_id) as b ON b.user_id = u.id 
                LEFT OUTER JOIN (select pc.user_id,
                    sum(Case when type = 'F' then 1 else 0 end) image,
                        sum(Case when type = 'Q' then 1 else 0 end) question,
                        sum(Case when type = 'A' then 1 else 0 end) article,
                        sum(Case when type = 'P' then 1 else 0 end) poll,
                        count(*) post
                FROM postcontent pc
                WHERE pc.deleted_at IS NULL and pc.mask=0
                GROUP BY pc.user_id) as c ON c.user_id = u.id  
                LEFT OUTER JOIN (select pca.postcontent_id, pc.user_id,
                    sum(Case when approvalrate = 'Y' then 1 else 0 end) yaycontent,
                        sum(Case when approvalrate = 'N' then 1 else 0 end) naycontent
                FROM postcontentapprovalrate pca
                LEFT JOIN postcontent pc ON pc.id=pca.postcontent_id
                WHERE pc.deleted_at IS NULL AND pc.mask=0
                GROUP BY pc.user_id) as d ON d.user_id = u.id
                LEFT OUTER JOIN (select poa.postopinion_id, po.user_id,
                    sum(Case when approvalrate = 'Y' then 1 else 0 end) yaycomment,
                        sum(Case when approvalrate = 'N' then 1 else 0 end) naycomment
                FROM postopinionapprovalrate poa
                LEFT JOIN postopinion po ON po.id = poa.postopinion_id
                LEFT JOIN postcontent pc ON pc.id=po.postcontent_id
                WHERE pc.deleted_at IS NULL AND po.deleted_at IS NULL AND po.mask=0
                GROUP BY po.user_id) as e ON e.user_id = u.id
                LEFT OUTER JOIN (select pra.postreply_id, pra.user_id,
                    sum(Case when approvalrate = 'Y' then 1 else 0 end) yayreply,
                        sum(Case when approvalrate = 'N' then 1 else 0 end) nayreply
                FROM postreplyapprovalrate pra
                LEFT JOIN postreply pr ON pr.id = pra.postreply_id
                LEFT JOIN postopinion po ON po.id = pr.postopinion_id
                LEFT JOIN postcontent pc ON pc.id=po.postcontent_id
                WHERE pc.deleted_at IS NULL AND po.deleted_at IS NULL  
                AND pr.deleted_at IS NULL AND pr.mask=0
                GROUP BY pr.user_id) as f ON f.user_id = u.id
                LEFT OUTER JOIN (select pral2.postreplyL2_id, pral2.user_id,
                    sum(Case when approvalrate = 'Y' then 1 else 0 end) yayreplyl2,
                        sum(Case when approvalrate = 'N' then 1 else 0 end) nayreplyl2
                FROM postreplyL2approvalrate pral2
                LEFT JOIN postreplyL2 pr2 ON pr2.id = pral2.postreplyL2_id
                LEFT JOIN postreply pr ON pr.id = pr2.postreply_id
                LEFT JOIN postopinion po ON po.id = pr.postopinion_id
                LEFT JOIN postcontent pc ON pc.id=po.postcontent_id
                WHERE pc.deleted_at IS NULL AND po.deleted_at IS NULL 
                AND pr.deleted_at IS NULL AND pr2.deleted_at AND pr2.mask=0
                GROUP BY pr2.user_id) as g ON g.user_id = u.id
                LEFT OUTER JOIN (select pral3.postreplyL3_id, pral3.user_id,
                    sum(Case when approvalrate = 'Y' then 1 else 0 end) yayreplyl3,
                        sum(Case when approvalrate = 'N' then 1 else 0 end) nayreplyl3
                FROM postreplyL3approvalrate pral3
                LEFT JOIN postreplyL3 pr3 ON pr3.id = pral3.postreplyL3_id
                LEFT JOIN postreplyL2 pr2 ON pr2.id = pr3.postreplyL2_id
                LEFT JOIN postreply pr ON pr.id = pr2.postreply_id
                LEFT JOIN postopinion po ON po.id = pr.postopinion_id
                LEFT JOIN postcontent pc ON pc.id=po.postcontent_id
                WHERE pc.deleted_at IS NULL AND po.deleted_at IS NULL 
                AND pr.deleted_at IS NULL AND pr2.deleted_at 
                AND pr3.deleted_at IS NULL AND pr3.mask=0
                GROUP BY pr3.user_id) as h ON h.user_id = u.id
                LEFT OUTER JOIN (select toa.topicopinion_id, ton.user_id,
                    sum(Case when approvalrate = 'Y' then 1 else 0 end) yaydiscussion,
                        sum(Case when approvalrate = 'N' then 1 else 0 end) naydiscussion
                FROM topicopinionapprovalrate toa
                LEFT JOIN topicopinion ton ON ton.id = toa.topicopinion_id
                LEFT JOIN topic t ON t.id=ton.topic_id
                WHERE t.deleted_at IS NULL AND ton.deleted_at IS NULL AND ton.mask=0
                GROUP BY ton.user_id) as i ON i.user_id = u.id
                LEFT OUTER JOIN (select tra.topicreply_id, tra.user_id,
                    sum(Case when approvalrate = 'Y' then 1 else 0 end) yaytopicreply,
                        sum(Case when approvalrate = 'N' then 1 else 0 end) naytopicreply
                FROM topicreplyapprovalrate tra
                LEFT JOIN topicreply tr ON tr.id = tra.topicreply_id
                LEFT JOIN topicopinion ton ON ton.id = tr.topicopinion_id
                LEFT JOIN topic t ON t.id=ton.topic_id
                WHERE t.deleted_at IS NULL AND ton.deleted_at IS NULL 
                AND tr.deleted_at IS NULL AND tr.mask=0
                GROUP BY tr.user_id) as j ON j.user_id = u.id
                LEFT OUTER JOIN (select tral2.topicreplyl2_id, tral2.user_id,
                    sum(Case when approvalrate = 'Y' then 1 else 0 end) yaytopicreplyl2,
                        sum(Case when approvalrate = 'N' then 1 else 0 end) naytopicreplyl2
                FROM topicreplyl2approvalrate tral2
                LEFT JOIN topicreplyl2 tr2 ON tr2.id = tral2.topicreplyl2_id
                LEFT JOIN topicreply tr ON tr.id = tr2.topicreply_id
                LEFT JOIN topicopinion ton ON ton.id = tr.topicopinion_id
                LEFT JOIN topic t ON t.id=ton.topic_id
                WHERE t.deleted_at IS NULL AND ton.deleted_at IS NULL 
                AND tr.deleted_at IS NULL AND tr2.deleted_at IS NULL AND tr2.mask=0
                GROUP BY tr2.user_id) as k ON k.user_id = u.id
                LEFT OUTER JOIN (select tral3.topicreplyl3_id, tral3.user_id,
                    sum(Case when approvalrate = 'Y' then 1 else 0 end) yaytopicreplyl3,
                        sum(Case when approvalrate = 'N' then 1 else 0 end) naytopicreplyl3
                FROM topicreplyl3approvalrate tral3
                LEFT JOIN topicreplyl3 tr3 ON tr3.id = tral3.topicreplyl3_id
                LEFT JOIN topicreplyl2 tr2 ON tr2.id = tr3.topicreplyl2_id
                LEFT JOIN topicreply tr ON tr.id = tr2.topicreply_id
                LEFT JOIN topicopinion ton ON ton.id = tr.topicopinion_id
                LEFT JOIN topic t ON t.id=ton.topic_id
                WHERE t.deleted_at IS NULL AND ton.deleted_at IS NULL 
                AND tr.deleted_at IS NULL AND tr2.deleted_at IS NULL 
                AND tr3.deleted_at IS NULL AND tr3.mask=0
                GROUP BY tr3.user_id) as l ON l.user_id = u.id
                LEFT OUTER JOIN(SELECT uf.user_one_id, 
                          count(*) friends
                FROM userfriends uf
                WHERE uf.status=1
                GROUP BY uf.user_one_id) as m ON m.user_one_id = u.id	
                LEFT OUTER JOIN(SELECT ua.user_two_id, 
                          count(*) followers
                FROM useracquiantances ua
                WHERE ua.status=1
                GROUP BY ua.user_two_id) as n ON n.user_two_id = u.id
                LEFT OUTER JOIN(SELECT ua2.user_one_id, 
                          count(*) following
                FROM useracquiantances ua2
                WHERE ua2.status=1
                GROUP BY ua2.user_one_id) as o ON o.user_one_id = u.id
                LEFT JOIN usersettings us on us.user_id = u.id
                LEFT JOIN usergeneralinfo ugen ON ugen.user_id = us.user_id AND ugen.id = us.credential_refid
                LEFT JOIN usereduccollege ucol ON ucol.user_id = us.user_id AND ucol.id = us.credential_refid
                LEFT JOIN userworkhistory uwork ON uwork.user_id = us.user_id AND uwork.id = us.credential_refid
                LEFT OUTER JOIN (SELECT usergeneralinfo.user_id,
                    COUNT(*) total
                FROM usergeneralinfo
                GROUP BY usergeneralinfo.user_id) as ugen2 ON ugen2.user_id = u.id
                LEFT OUTER JOIN (SELECT usereduccollege.user_id,
                    COUNT(*) total
                FROM usereduccollege
                GROUP BY usereduccollege.user_id) as ucol2 ON ucol2.user_id = u.id
                LEFT OUTER JOIN (SELECT userworkhistory.user_id,
                    COUNT(*) total
                FROM userworkhistory
                GROUP BY userworkhistory.user_id) as uwork2 ON uwork2.user_id = u.id
                WHERE u.id = {$user_id}";
                
        return DB::select(DB::raw($sql));
    }
    
    /**
     * Get user credentials
     * 
     * @param int $user_id
     * @return type
     */
    public function get_user_credentials($user_id)
    {
        $sql  = "SELECT u.id,
                    '' as column_1,
                    '' as column_2,
                    '' as column_3,
                    '' as column_4,
                    '' as column_5, 
		   u.general_info as credential,
		   u.created_at as date,
		   u.id as user_id,
		   '1' as credential_type,
		   us.credential_refid as priority
                FROM usergeneralinfo u
                LEFT JOIN usersettings us ON us.user_id = u.id AND 
                us.credential_refid = u.id AND us.credential_type='1'
                WHERE u.user_id={$user_id}
                UNION
                SELECT ucol.id,
                        ucol.schoolname as column_1,
                        ucol.course as column_2,
                        '' as column_3,
                        ucol.yearstarted as column_4,
                        ucol.yearended as column_5,
                        CONCAT(ucol.course, ', ', ucol.schoolname) as credential,
                        ucol.created_at as date,
                        ucol.user_id,
                        '2' as credential_type,
                        us.credential_refid as priority
                FROM usereduccollege ucol
                LEFT JOIN usersettings us ON us.user_id = ucol.user_id AND 
                us.credential_refid = ucol.id AND us.credential_type='2'
                WHERE ucol.user_id={$user_id} 
                UNION
                SELECT uwork.id,
                        uwork.companyname as column_1,
                        uwork.position as column_2,
                        uwork.location as column_3,
                        uwork.yearstarted as column_4,
                        uwork.yearended as column_5,
                        CONCAT(uwork.position, ', ', uwork.companyname,', ',uwork.location) as credential,
                        uwork.created_at as date,
                        uwork.user_id,
                        '3' as credential_type,
                        us.credential_refid as priority
                FROM userworkhistory uwork
                LEFT JOIN usersettings us ON us.user_id = uwork.user_id AND 
                us.credential_refid = uwork.id AND us.credential_type='4'
                WHERE uwork.user_id={$user_id}
                ORDER BY priority DESC, date DESC";
        
        return DB::select(DB::raw($sql));
    }
    
    /**
     * Get show_favorite_strings
     * 
     * @param int $user_id
     */
    public function show_favorite_strings($user_id)
    {
        $get_list  =  "SELECT ufs.id, 
                                    ufs.topic_id,
                                    ufs.user_id,
                                    ufs.created_at,
                                    t.title,
                                    t.slug,
                                    t.string_alias,
                                    t.coverphoto,
                                    t.nsfw,
                                    t.color
                             FROM userfavoritestrings ufs
                             LEFT JOIN topic t ON t.id = ufs.topic_id
                             WHERE ufs.user_id={$user_id} AND t.deleted_at IS NULL
                             AND t.mask = 0
                             ORDER BY title"; 
                             
        return DB::select(DB::raw($get_list));              
    }
    
    /**
     * Get count and the list of created strings
     * 
     * @param int $user_id
     */
    public function show_created_strings($user_id)
    {
        $count_created_sql = "SELECT count(*) totalstrings
                            FROM topic t 
                            WHERE t.user_id={$user_id} AND t.deleted_at IS NULL
                            AND t.mask = 0";
        
        $get_created_list  =  "SELECT t.id as string_id,
                                    t.user_id,
                                    t.created_at,
                                    t.title,
                                    t.slug,
                                    t.string_alias,
                                    t.coverphoto,
                                    t.nsfw,
                                    t.color
                             FROM topic t
                             WHERE t.user_id={$user_id} AND t.deleted_at IS NULL
                             AND t.mask = 0
                             ORDER BY title
                             LIMIT 20"; 
        return [
            'count' => DB::select(DB::raw($count_created_sql)),
            'list'  => DB::select(DB::raw($get_created_list))
        ];                     
    }
    
    /**
     * Get count and the list of followed strings
     * 
     * @param int $user_id
     */
    public function show_followed_strings($user_id)
    {
        $count_followed_sql = "SELECT count(*) totaltracked
                        FROM topictrack tr
                        LEFT JOIN topic t ON t.id=tr.topic_id
                        WHERE tr.user_id={$user_id} AND t.deleted_at IS NULL";
        
        $get_followed_list  =  "SELECT tr.topic_id,
                                t.user_id,
                                tr.created_at,
                                t.title,
                                t.slug,
                                t.string_alias,
                                t.coverphoto,
                                t.nsfw,
                                t.color
                         FROM topictrack tr
                         LEFT JOIN topic t ON tr.topic_id = t.id
                         WHERE tr.user_id={$user_id} AND t.deleted_at IS NULL
                         ORDER BY title
                         LIMIT 20"; 
        return [
            'count' => DB::select(DB::raw($count_followed_sql)),
            'list'  => DB::select(DB::raw($get_followed_list))
        ];                     
    }
    
    /**
     * Get top tags of the user
     * 
     * @param int $user_id
     */
    public function show_top_tags($user_id)
    {
        $top_tags  =  "SELECT 
                        rf.id,
                        rf.title as tagname,
                        rf.color,
                        coalesce(a.totalposttags,0) + coalesce(b.totalstringtags,0)as total_used_tag
                FROM reftags rf
                LEFT OUTER JOIN (select pcon.user_id, ptags.ref_id,
                        count(*) totalposttags
                FROM postcontenttags ptags
                LEFT JOIN postcontent pcon ON pcon.id = ptags.postcontent_id
                WHERE pcon.deleted_at IS NULL and ptags.ref_from=0
                GROUP BY ptags.ref_id, pcon.user_id) as a ON a.ref_id=rf.id AND a.user_id = {$user_id}
                LEFT OUTER JOIN (select t.user_id, ttags.ref_id,
                        count(*) totalstringtags
                FROM topictags ttags
                LEFT JOIN topic t ON t.id = ttags.topic_id
                WHERE t.deleted_at IS NULL and ttags.ref_from=0
                GROUP BY ttags.ref_id, t.user_id) as b ON b.ref_id=rf.id AND b.user_id = {$user_id}
                WHERE coalesce(a.totalposttags,0) > 0 OR coalesce(b.totalstringtags,0)>0
                ORDER BY total_used_tag DESC, tagname
                LIMIT 10"; 
                
        return DB::select(DB::raw($top_tags));                 
    }
    
    /**
     * Comments Part Tab
     */
    
    /**
     * Get total comments
     * 
     * @param int $user_id
     * @return type
     */
    public function count_total_comments($user_id)
    {
        $sql = "SELECT u.id as user_id,
                u.profile_code,
                        coalesce(a.total,0) + coalesce(b.total,0) as comments
                 FROM users u
                 LEFT OUTER JOIN(SELECT po.user_id,
                        count(*) total
                 FROM postopinion po
                 LEFT JOIN postcontent pc ON pc.id = po.postcontent_id
                 WHERE po.deleted_at IS NULL AND pc.deleted_at IS NULL
                    AND po.mask= 0 AND po.hidden=0 
                 GROUP BY po.user_id) as a ON a.user_id = u.id
                 LEFT OUTER JOIN(SELECT t_op.user_id,
                        count(*) total
                 FROM topicopinion t_op
                 LEFT JOIN topic t ON t.id = t_op.topic_id
                 WHERE t_op.deleted_at IS NULL AND t.deleted_at IS NULL
                   AND t_op.mask=0 AND t_op.hidden=0 
                 GROUP BY t_op.user_id) as b ON b.user_id = u.id
                 WHERE u.id={$user_id}";
                 
        return DB::select(DB::raw($sql));        
    }
    
    /**
     * Get user comments
     * 
     * @param array $filters
     */
    public function get_user_comments($filters)
    {
        $profile_owner_id = $filters['profile_owner_id'];
        $user_id = $filters['user_id'];
        $mask    = $filters['mask'];
        $limit   = $filters['limit'];
        
        $filter_query = "a.content_type <> 'Z'";
        if(isset($filters["filter"]) && !empty($filters["filter"]) && $filters["filter"] != "Z") {
            $filter_query = "a.content_type = '{$filters["filter"]}'";
        }
        $sql = "SELECT a.id,
                        a.contenttopic_id,
                        a.type,
                        a.comment,
                        a.created_at,
                        a.creator_userid as creator_contenttopic,
                        a.title as title_contenttopic,
                        a.mask_status as mask_status_of_contenttopic,
                        (case a.mask_status
                                     when 1 then  a.maskname
                             else CONCAT(u.first_name, ' ', u.last_name)
                        end) 'user_name',
                        (case a.mask_status
                            when 1 then a.maskimage 
                                else ub.profilephoto
                       end) 'profilephoto',
                       u.profile_code,
                       a.total_yay,
                       a.total_nay,
                       a.stringtag_id,
                       a.stringtag_title,
                       a.color as string_color,
                       a.coverphoto as string_coverphoto,
                       a.slug as string_slug,
                       a.content_type,
                       a.hidden,
                       a.thread_name,
                       a.approvalrate as active_login_user_vote
                 FROM 
                 (SELECT po.id, 
                         pc.id as contenttopic_id, 
                            'C' as type,
                            po.content as comment,  
                            po.created_at,
                            pc.user_id as creator_userid,
                            pc.text as title,
                            pc.mask as mask_status,
                            pc.maskname,
                            pc.maskimage,
                            pc.type as content_type,
                            coalesce(b.YayCount,0) as total_yay,
                            coalesce(b.NayCount,0) as total_nay,
                            ptagsfin.ref_id as stringtag_id,
                            t.string_alias as stringtag_title,
                            t.color,
                            t.coverphoto,
                            t.slug,
                            po.mask,
                            po.user_id,
                            po.hidden,
                            '' as thread_name,
                            prate2.approvalrate
                 FROM postopinion po
                 LEFT JOIN postcontent pc ON pc.id = po.postcontent_id 
                 LEFT OUTER JOIN (select postopinionapprovalrate.postopinion_id,
                     COUNT(*) total,
                     sum(Case when approvalrate = 'Y' then 1 else 0 end) YayCount,
                     sum(Case when approvalrate = 'N' then 1 else 0 end) NayCount
                 FROM postopinionapprovalrate
                 GROUP BY postopinionapprovalrate.postopinion_id) as b ON b.postopinion_id = po.id
                 LEFT JOIN
                         (SELECT ptags.id, ptags.postcontent_id, ptags.ref_from,ptags.ref_id
                 from postcontenttags ptags
                 INNER JOIN (
                     SELECT postcontent_id, min(id) as firsttag, ref_from  
                     FROM postcontenttags
                     WHERE ref_from='1'	
                     GROUP BY postcontent_id
                     ORDER BY id) ptags2 on ptags.postcontent_id = ptags2.postcontent_id and ptags.id = ptags2.firsttag) ptagsfin 
                 ON ptagsfin.postcontent_id = pc.id 
                 LEFT JOIN topic t ON t.id = ptagsfin.ref_id
                 LEFT JOIN postopinionapprovalrate prate2 ON prate2.postopinion_id = po.id AND prate2.user_id={$user_id}
                  AND prate2.mask = {$mask}
                 WHERE pc.deleted_at IS NULL AND po.deleted_at IS NULL 
                 UNION
                 SELECT t_op.id, 
                            t_op.topic_id as contenttopic_id,
                            'D' as type,
                            t_op.content as comment,  
                            t_op.created_at,
                            t.user_id as creator_userid,
                            t.title,
                            t.mask as mask_status,
                            t.maskname,
                            t.maskimage,
                            'SD' as content_type,
                            coalesce(b.YayCount,0) as total_yay,
                            coalesce(b.NayCount,0) as total_nay,
                            ttagsfin.ref_id as stringtag_id,
                            t2.string_alias as stringtag_title,
                            t.color,
                            t.coverphoto,
                            t.slug,
                            t_op.mask,
                            t_op.user_id,
                            t_op.hidden,
                            (case t_op.topicthreadname_id
                                 when 0 then 'General'
                                     else th.thread_name
                            end) 'thread_name',
                            trate2.approvalrate
                 FROM topicopinion t_op
                 LEFT JOIN topic t ON t.id = t_op.topic_id 
                 LEFT OUTER JOIN (select topicopinionapprovalrate.topicopinion_id,
                     COUNT(*) total,
                     sum(Case when approvalrate = 'Y' then 1 else 0 end) YayCount,
                     sum(Case when approvalrate = 'N' then 1 else 0 end) NayCount
                 FROM topicopinionapprovalrate
                 GROUP BY topicopinionapprovalrate.topicopinion_id) as b ON b.topicopinion_id = t_op.id
                 LEFT JOIN
                         (SELECT ttags.id, ttags.topic_id, ttags.ref_from,ttags.ref_id
                 from topictags ttags
                 INNER JOIN (
                     SELECT topic_id, min(id) as firsttag, ref_from  
                     FROM topictags
                     WHERE ref_from='1'	
                     GROUP BY topic_id
                     ORDER BY id) ttags2 on ttags.topic_id = ttags2.topic_id and ttags.id = ttags2.firsttag) ttagsfin 
                 ON ttagsfin.topic_id = t.id 
                 LEFT JOIN topic t2 ON t2.id = ttagsfin.ref_id
                 LEFT JOIN topicthreadname th ON th.id = t_op.topicthreadname_id
                 LEFT JOIN topicopinionapprovalrate trate2 ON trate2.topicopinion_id = t_op.id AND trate2.user_id={$user_id}
                  AND trate2.mask = {$mask}
                 WHERE t.deleted_at IS NULL AND t_op.deleted_at IS NULL) as a
                 LEFT JOIN users u ON u.id = a.creator_userid
                 LEFT JOIN userbasicinfo ub ON ub.user_id = a.creator_userid
                 WHERE a.user_id = {$profile_owner_id} AND a.mask=0  
                AND a.hidden=0 AND {$filter_query}
                ORDER BY created_at DESC
                LIMIT {$limit}";
        
        return collect($this->_helper->convert_sql_to_array( DB::select(DB::raw($sql)) ));         
    }
    
    /**
     * Count total replies
     * 
     * @param int $user_id
     */
    public function count_total_replies($user_id)
    {
        $sql = "SELECT u.id as user_id,
                       u.profile_code,
                       coalesce(b1.total,0) + coalesce(b2.total,0) + coalesce(b3.total,0) + coalesce(d1.total,0) + coalesce(d2.total,0) + coalesce(d3.total,0) as replies
                FROM users u
                LEFT OUTER JOIN(SELECT pr1.user_id,
                       count(*) total
                FROM postreply pr1
                LEFT JOIN postopinion po ON po.id = pr1.postopinion_id
                LEFT JOIN postcontent pc ON pc.id = po.postcontent_id
                WHERE po.deleted_at IS NULL AND pc.deleted_at IS NULL
                   AND pr1.mask= 0 AND pr1.deleted_at IS NULL
                GROUP BY pr1.user_id) as b1 ON b1.user_id = u.id
                LEFT OUTER JOIN(SELECT pr2.user_id,
                       count(*) total
                FROM postreplyL2 pr2
                LEFT JOIN postreply pr1 ON pr1.id = pr2.postreply_id
                LEFT JOIN postopinion po ON po.id = pr1.postopinion_id
                LEFT JOIN postcontent pc ON pc.id = po.postcontent_id
                WHERE po.deleted_at IS NULL AND pc.deleted_at IS NULL
                   AND pr2.mask= 0 AND pr1.deleted_at IS NULL
                   AND pr2.deleted_at IS NULL
                GROUP BY pr2.user_id) as b2 ON b2.user_id = u.id
                LEFT OUTER JOIN(SELECT pr3.user_id,
                       count(*) total
                FROM postreplyL3 pr3
                LEFT JOIN postreplyL2 pr2 ON pr2.id = pr3.postreplyL2_id
                LEFT JOIN postreply pr1 ON pr1.id = pr2.postreply_id
                LEFT JOIN postopinion po ON po.id = pr1.postopinion_id
                LEFT JOIN postcontent pc ON pc.id = po.postcontent_id
                WHERE po.deleted_at IS NULL AND pc.deleted_at IS NULL
                   AND pr3.mask= 0 AND pr1.deleted_at IS NULL
                   AND pr2.deleted_at IS NULL AND pr3.deleted_at IS NULL
                GROUP BY pr3.user_id) as b3 ON b3.user_id = u.id
                LEFT OUTER JOIN(SELECT tr1.user_id,
                       count(*) total
                FROM topicreply tr1
                LEFT JOIN topicopinion t_op ON t_op.id = tr1.topicopinion_id
                LEFT JOIN topic t ON t.id = t_op.topic_id
                WHERE t_op.deleted_at IS NULL AND t.deleted_at IS NULL
                  AND tr1.mask=0 AND tr1.deleted_at IS NULL
                GROUP BY tr1.user_id) as d1 ON d1.user_id = u.id
                LEFT OUTER JOIN(SELECT tr2.user_id,
                       count(*) total
                FROM topicreplyl2 tr2
                LEFT JOIN topicreply tr1 ON tr1.id = tr2.topicreply_id
                LEFT JOIN topicopinion t_op ON t_op.id = tr1.topicopinion_id
                LEFT JOIN topic t ON t.id = t_op.topic_id
                WHERE t_op.deleted_at IS NULL AND t.deleted_at IS NULL
                  AND tr2.mask=0 AND tr1.deleted_at IS NULL
                  AND tr2.deleted_at IS NULL
                GROUP BY tr2.user_id) as d2 ON d2.user_id = u.id
                LEFT OUTER JOIN(SELECT tr3.user_id,
                       count(*) total
                FROM topicreplyl3 tr3
                LEFT JOIN topicreplyl2 tr2 ON tr2.id = tr3.topicreplyl2_id
                LEFT JOIN topicreply tr1 ON tr1.id = tr2.topicreply_id
                LEFT JOIN topicopinion t_op ON t_op.id = tr1.topicopinion_id
                LEFT JOIN topic t ON t.id = t_op.topic_id
                WHERE t_op.deleted_at IS NULL AND t.deleted_at IS NULL
                  AND tr3.mask=0 AND tr1.deleted_at IS NULL
                  AND tr2.deleted_at IS NULL AND tr3.deleted_at IS NULL
                GROUP BY tr3.user_id) as d3 ON d3.user_id = u.id
                WHERE u.id={$user_id}";
        
        return DB::select(DB::raw($sql)); 
    }
    
    /**
     * Get user replies
     * 
     * @param array $filters
     */
    public function get_user_replies($filters)
    {
        $profile_owner_id = $filters['profile_owner_id'];
        $user_id = $filters['user_id'];
        $mask    = $filters['mask'];
        $limit   = $filters['limit'];
        
        $sql = "SELECT a.id,
                        a.contenttopic_id, 
                        a.comment_id,
                            a.replyl1_id,
                            a.replyl2_id,
                            a.reply_type,
                            a.reply_level,
                            a.reply,  
                            a.created_at,
                            a.creator_userid as userid_parent_transaction,
                            a.title as title_parent_transaction,
                            a.mask_status as mask_status_parent_transaction,
                            (case a.mask_status
                                         when 1 then  a.maskname
                                 else CONCAT(u.first_name, ' ', u.last_name)
                            end) 'user_name',
                            (case a.mask_status
                                 when 1 then a.maskimage 
                                     else ub.profilephoto
                            end) 'profilephoto',
                            u.profile_code,
                            a.total_yay,
                            a.total_nay,
                            a.approvalrate as active_login_user_vote
                 FROM 
                 (SELECT pr1.id,
                        pc.id as contenttopic_id, 
                        pr1.postopinion_id as comment_id,
                            pr1.id as replyl1_id,
                            '' as replyl2_id,
                            'comment' as reply_type,
                            '1' as reply_level,
                            pr1.content as reply,  
                            pr1.created_at,
                            po.user_id as creator_userid,
                            po.content as title,
                            po.mask as mask_status,
                            po.maskname,
                            po.maskimage,
                            coalesce(b.YayCount,0) as total_yay,
                            coalesce(b.NayCount,0) as total_nay,
                            pr1.mask,
                            pr1.user_id,
                            prate1.approvalrate
                 FROM postreply pr1
                 LEFT JOIN postopinion po ON po.id = pr1.postopinion_id
                 LEFT JOIN postcontent pc ON pc.id = po.postcontent_id  
                 LEFT OUTER JOIN (select postreplyapprovalrate.postreply_id,
                     COUNT(*) total,
                     sum(Case when approvalrate = 'Y' then 1 else 0 end) YayCount,
                     sum(Case when approvalrate = 'N' then 1 else 0 end) NayCount
                 FROM postreplyapprovalrate
                 GROUP BY postreplyapprovalrate.postreply_id) as b ON b.postreply_id = pr1.id
                 LEFT JOIN postreplyapprovalrate prate1 ON prate1.postreply_id = pr1.id AND prate1.user_id={$user_id}
                  AND prate1.mask = {$mask}
                 WHERE pc.deleted_at IS NULL AND po.deleted_at IS NULL AND pr1.deleted_at IS NULL
                 UNION
                 SELECT pr2.id, 
                            pc.id as contenttopic_id, 
                        pr1.postopinion_id as comment_id,
                            pr1.id as replyl1_id,
                            pr2.id as replyl2_id,
                            'comment' as reply_type,
                            '2' as reply_level,
                            pr2.content as reply,  
                            pr2.created_at,
                            pr1.user_id as creator_userid,
                            pr1.content as title,
                            pr1.mask as mask_status,
                            pr1.maskname,
                            pr1.maskimage,
                            coalesce(b.YayCount,0) as total_yay,
                            coalesce(b.NayCount,0) as total_nay,
                            pr2.mask,
                            pr2.user_id,
                            prate2.approvalrate
                 FROM postreplyL2 pr2
                 LEFT JOIN postreply pr1 ON pr1.id = pr2.postreply_id
                 LEFT JOIN postopinion po ON po.id = pr1.postopinion_id 
                 LEFT JOIN postcontent pc ON pc.id = po.postcontent_id
                 LEFT OUTER JOIN (select postreplyL2approvalrate.postreplyL2_id,
                     COUNT(*) total,
                     sum(Case when approvalrate = 'Y' then 1 else 0 end) YayCount,
                     sum(Case when approvalrate = 'N' then 1 else 0 end) NayCount
                 FROM postreplyL2approvalrate
                 GROUP BY postreplyL2approvalrate.postreplyL2_id) as b ON b.postreplyL2_id = pr2.id
                 LEFT JOIN postreplyL2approvalrate prate2 ON prate2.postreplyL2_id = pr2.id AND prate2.user_id={$user_id}
                  AND prate2.mask = {$mask}
                 WHERE pc.deleted_at IS NULL AND po.deleted_at IS NULL AND pr1.deleted_at IS NULL
                 AND pr2.deleted_at IS NULL
                 UNION
                 SELECT pr3.id, 
                        pc.id as contenttopic_id, 
                        pr1.postopinion_id as comment_id,
                            pr1.id as replyl1_id,
                            pr2.id as replyl2_id,
                            'comment' as reply_type,
                            '3' as reply_level,
                            pr3.content as reply,  
                            pr3.created_at,
                            pr2.user_id as creator_userid,
                            pr2.content as title,
                            pr2.mask as mask_status,
                            pr2.maskname,
                            pr2.maskimage,
                            coalesce(b.YayCount,0) as total_yay,
                            coalesce(b.NayCount,0) as total_nay,
                            pr3.mask,
                            pr3.user_id,
                            prate3.approvalrate
                 FROM postreplyL3 pr3
                 LEFT JOIN postreplyL2 pr2 ON pr2.id = pr3.postreplyL2_id
                 LEFT JOIN postreply pr1 ON pr1.id = pr2.postreply_id
                 LEFT JOIN postopinion po ON po.id = pr1.postopinion_id 
                 LEFT JOIN postcontent pc ON pc.id = po.postcontent_id
                 LEFT OUTER JOIN (select postreplyL3approvalrate.postreplyL3_id,
                     COUNT(*) total,
                     sum(Case when approvalrate = 'Y' then 1 else 0 end) YayCount,
                     sum(Case when approvalrate = 'N' then 1 else 0 end) NayCount
                 FROM postreplyL3approvalrate
                 GROUP BY postreplyL3approvalrate.postreplyL3_id) as b ON b.postreplyL3_id = pr3.id
                 LEFT JOIN postreplyL3approvalrate prate3 ON prate3.postreplyL3_id = pr3.id AND prate3.user_id={$user_id}
                  AND prate3.mask = {$mask}
                 WHERE pc.deleted_at IS NULL AND po.deleted_at IS NULL AND pr1.deleted_at IS NULL
                 AND pr2.deleted_at IS NULL AND pr3.deleted_at IS NULL
                 UNION
                 SELECT tr1.id, 
                            t.id as contenttopic_id, 
                        tr1.topicopinion_id as comment_id,
                            tr1.id as replyl1_id,
                            '' as replyl2_id,
                            'discussion' as reply_type,
                            '1' as reply_level,
                            tr1.content as reply,  
                            tr1.created_at,
                            t_op.user_id as creator_userid,
                            t_op.content as title,
                            t_op.mask as mask_status,
                            t_op.maskname,
                            t_op.maskimage,
                            coalesce(b.YayCount,0) as total_yay,
                            coalesce(b.NayCount,0) as total_nay,
                            tr1.mask,
                            tr1.user_id,
                            trate1.approvalrate
                 FROM topicreply tr1
                 LEFT JOIN topicopinion t_op ON t_op.id = tr1.topicopinion_id
                 LEFT JOIN topic t ON t.id = t_op.topic_id 
                 LEFT OUTER JOIN (select topicreplyapprovalrate.topicreply_id,
                     COUNT(*) total,
                     sum(Case when approvalrate = 'Y' then 1 else 0 end) YayCount,
                     sum(Case when approvalrate = 'N' then 1 else 0 end) NayCount
                 FROM topicreplyapprovalrate
                 GROUP BY topicreplyapprovalrate.topicreply_id) as b ON b.topicreply_id = tr1.id
                 LEFT JOIN topicreplyapprovalrate trate1 ON trate1.topicreply_id = tr1.id AND trate1.user_id={$user_id}
                  AND trate1.mask = {$mask}
                 WHERE t.deleted_at IS NULL AND t_op.deleted_at IS NULL 
                   AND tr1.deleted_at IS NULL 
                 UNION
                 SELECT tr2.id,
                            t.id as contenttopic_id, 
                        tr1.topicopinion_id as comment_id,
                            tr1.id as replyl1_id,
                            tr2.id as replyl2_id,
                            'discussion' as reply_type,
                            '2' as reply_level,
                            tr2.content as reply,  
                            tr2.created_at,
                            tr1.user_id as creator_userid,
                            tr1.content as title,
                            tr1.mask as mask_status,
                            tr1.maskname,
                            tr1.maskimage,
                            coalesce(b.YayCount,0) as total_yay,
                            coalesce(b.NayCount,0) as total_nay,
                            tr2.mask,
                            tr2.user_id,
                            trate2.approvalrate
                 FROM topicreplyl2 tr2
                 LEFT JOIN topicreply tr1 ON tr1.id = tr2.topicreply_id
                 LEFT JOIN topicopinion t_op ON t_op.id = tr1.topicopinion_id
                 LEFT JOIN topic t ON t.id = t_op.topic_id 
                 LEFT OUTER JOIN (select topicreplyl2approvalrate.topicreplyl2_id,
                     COUNT(*) total,
                     sum(Case when approvalrate = 'Y' then 1 else 0 end) YayCount,
                     sum(Case when approvalrate = 'N' then 1 else 0 end) NayCount
                 FROM topicreplyl2approvalrate
                 GROUP BY topicreplyl2approvalrate.topicreplyl2_id) as b ON b.topicreplyl2_id = tr2.id
                 LEFT JOIN topicreplyl2approvalrate trate2 ON trate2.topicreplyl2_id = tr2.id AND trate2.user_id={$user_id}
                  AND trate2.mask = {$mask}
                 WHERE t.deleted_at IS NULL AND t_op.deleted_at IS NULL 
                   AND tr1.deleted_at IS NULL AND tr2.deleted_at IS NULL 
                 UNION
                 SELECT tr3.id, 
                            t.id as contenttopic_id, 
                        tr1.topicopinion_id as comment_id,
                            tr1.id as replyl1_id,
                            tr2.id as replyl2_id,
                            'discussion' as reply_type,
                            '3' as reply_level,
                            tr3.content as reply,  
                            tr3.created_at,
                            tr2.user_id as creator_userid,
                            tr2.content as title,
                            tr2.mask as mask_status,
                            tr2.maskname,
                            tr2.maskimage,
                            coalesce(b.YayCount,0) as total_yay,
                            coalesce(b.NayCount,0) as total_nay,
                            tr3.mask,
                            tr3.user_id,
                            trate3.approvalrate
                 FROM topicreplyl3 tr3
                 LEFT JOIN topicreplyl2 tr2 ON tr2.id = tr3.topicreplyl2_id
                 LEFT JOIN topicreply tr1 ON tr1.id = tr2.topicreply_id
                 LEFT JOIN topicopinion t_op ON t_op.id = tr1.topicopinion_id
                 LEFT JOIN topic t ON t.id = t_op.topic_id 
                 LEFT OUTER JOIN (select topicreplyl3approvalrate.topicreplyl3_id,
                     COUNT(*) total,
                     sum(Case when approvalrate = 'Y' then 1 else 0 end) YayCount,
                     sum(Case when approvalrate = 'N' then 1 else 0 end) NayCount
                 FROM topicreplyl3approvalrate
                 GROUP BY topicreplyl3approvalrate.topicreplyl3_id) as b ON b.topicreplyl3_id = tr2.id
                 LEFT JOIN topicreplyl3approvalrate trate3 ON trate3.topicreplyl3_id = tr3.id AND trate3.user_id={$user_id}
                  AND trate3.mask = {$mask}
                 WHERE t.deleted_at IS NULL AND t_op.deleted_at IS NULL 
                   AND tr1.deleted_at IS NULL AND tr2.deleted_at IS NULL
                   AND tr3.deleted_at IS NULL) as a
                 LEFT JOIN users u ON u.id = a.creator_userid
                 LEFT JOIN userbasicinfo ub ON ub.user_id = a.creator_userid
                 WHERE a.user_id = {$profile_owner_id} AND a.mask=0
                 ORDER BY created_at DESC
                 LIMIT {$limit}";
                 
        return collect($this->_helper->convert_sql_to_array( DB::select(DB::raw($sql)) ));         
    }
    
    /**
     * Count all totals in connection tab
     * 
     * @param int $owner_profile_userid
     * @return array
     */
    public function count_connections_tab($owner_profile_userid)
    {
        $sql = "SELECT 	   
                coalesce(a.total,0) as profileview,
                coalesce(b.total,0) as friends,
                coalesce(c.total,0) as followers,
                coalesce(d.total,0) as following,
                (coalesce(e.total,0) + coalesce(f.total,0)) as request,
                round((coalesce(g.yaycount,0) + coalesce(h.yaycount,0) + (coalesce(i.yaycount,0) / 10)) / 3) as avg_rating
             FROM users u
             LEFT OUTER JOIN (select userprofileview.profile_userid,
                 COUNT(*) total
             FROM userprofileview
             GROUP BY userprofileview.profile_userid) as a ON a.profile_userid = u.id
             LEFT OUTER JOIN (select userfriends.user_one_id,
                 COUNT(*) total
             FROM userfriends
             WHERE userfriends.status = 1
             GROUP BY userfriends.user_one_id) as b ON b.user_one_id = u.id
             LEFT OUTER JOIN (select useracquiantances.user_two_id,
                 COUNT(*) total
             FROM useracquiantances
             WHERE useracquiantances.status = 1
             GROUP BY useracquiantances.user_two_id) as c ON c.user_two_id = u.id
             LEFT OUTER JOIN (select useracquiantances.user_one_id,
                 COUNT(*) total
             FROM useracquiantances
             WHERE useracquiantances.status = 1
             GROUP BY useracquiantances.user_one_id) as d ON d.user_one_id = u.id
             LEFT OUTER JOIN (select uf.user_two_id,
                 COUNT(*) total
             FROM userfriends uf
             WHERE (uf.user_two_id={$owner_profile_userid} AND uf.status=0)
             GROUP BY uf.user_two_id) as e ON e.user_two_id = u.id
             LEFT OUTER JOIN (select ua.user_two_id,
                 COUNT(*) total
             FROM useracquiantances ua
             WHERE (ua.user_two_id={$owner_profile_userid} AND ua.status=0)
             GROUP BY ua.user_two_id) as f ON f.user_two_id = u.id
             LEFT OUTER JOIN (select postcontentapprovalrate.user_id,
                 sum(Case when approvalrate = 'Y' then 1 else 0 end) yaycount
             FROM postcontentapprovalrate
             LEFT JOIN postcontent ON postcontent.id = postcontentapprovalrate.postcontent_id
             WHERE postcontent.deleted_at IS NULL AND postcontentapprovalrate.mask = 0
             GROUP BY postcontentapprovalrate.user_id) as g ON g.user_id = u.id
             LEFT OUTER JOIN (select topicapprovalrate.user_id,
                 sum(Case when approvalrate = 'Y' then 1 else 0 end) yaycount
             FROM topicapprovalrate
             LEFT JOIN topic ON topic.id = topicapprovalrate.string_id
             WHERE topic.deleted_at IS NULL AND topicapprovalrate.mask=0
             GROUP BY topicapprovalrate.user_id) as h ON h.user_id = u.id
             LEFT OUTER JOIN (select postopinionapprovalrate.user_id,
                 sum(Case when approvalrate = 'Y' then 1 else 0 end) yaycount
             FROM postopinionapprovalrate
             LEFT JOIN postopinion ON postopinion.id = postopinionapprovalrate.postopinion_id
             LEFT JOIN postcontent ON postcontent.id = postopinion.postcontent_id
             WHERE postcontent.deleted_at IS NULL AND postopinion.deleted_at IS NULL
             AND postopinionapprovalrate.mask=0
             GROUP BY postopinionapprovalrate.user_id) as i ON i.user_id = u.id
             WHERE u.id={$owner_profile_userid}";
       
        return collect($this->_helper->convert_sql_to_array( DB::select(DB::raw($sql)) ));
    }
    
    /**
     * Get the list of user friends
     * 
     * @param array $filters
     */
    public function get_user_friends($filters)
    {
        $active_login_userid    = $filters['active_login_userid'];
        $owner_profile_userid   = $filters['owner_profile_userid'];
        $filter                 = $filters['filter'];
        
        //Most Recent
        $active_filter = " ORDER BY created_at DESC, u.first_name, u.last_name";
        if($filter == 1) {
            //Alphabetical
            $active_filter = " ORDER BY u.first_name, u.last_name";
        } else if($filter == 2) {
            //By number of followers
            $active_filter = " ORDER BY followers DESC, u.first_name, u.last_name";
        } else if($filter == 3) {
            //By number of mutual friends
            $active_filter = " ORDER BY mutual_friends DESC, u.first_name, u.last_name";
        } else if($filter == 4) {
            //By number of similar interests
            $active_filter = " ORDER BY similar_interest DESC, u.first_name, u.last_name";
        }
        
        $limit = 20;
        
        $sql = "SELECT u.id as user_id,
                        u.profile_code,
                        u.first_name,
                        u.last_name,
                        ub.profilephoto,
                        ub.coverphoto,
                        coalesce(a.total,0) as followers,
                        coalesce(b.total,0) as following,
                        round((coalesce(c.yaycount,0) + coalesce(d.yaycount,0) + (coalesce(e.yaycount,0) / 10)) / 3) as avg_rating,
                        us.credential_type,
                        us.credential_refid,
                        (case us.credential_type
                                     when 1 then ugen.general_info
                                     when 2 then 
                                             (case WHEN ucol.course IS NOT NULL THEN
                                                 CONCAT(ucol.course, ', ', ucol.schoolname)
                                                     ELSE ucol.schoolname
                                             end)
                                     when 3 then CONCAT(uwork.position, ', ', uwork.companyname,', ',uwork.location)
                             end) 'credential',
                        (case 
                                     when uf2.status=1 then '1'
                                     when uf2.status=0 then '2'
                                     when uf3.status=0 then '3'    
                                     else '4'
                        end) 'friend_status',
                        (case
                         when ua.status=1 then 
                                         case ua2.status
                                               when 1 then '6'
                                               else '1'
                                             end
                                     when ua.status=0 then '2'
                                     when ua2.status=1 then '3'
                                     when ua2.status=0 then '4'    
                                     else '5'
                        end) 'following_status',
                        coalesce(mf.mutualfriends,0) as mutual_friends,
                        coalesce(ms.mutualstrings,0) as similar_interest,
                        uf.created_at	   
                 FROM userfriends uf
                 JOIN users u ON u.id = uf.user_two_id
                 LEFT JOIN userbasicinfo ub on u.id = ub.user_id
                 LEFT JOIN usersettings us on u.id = us.user_id
                 LEFT JOIN usergeneralinfo ugen ON ugen.user_id = us.user_id AND ugen.id = us.credential_refid
                 LEFT JOIN usereduccollege ucol ON ucol.user_id = us.user_id AND ucol.id = us.credential_refid
                 LEFT JOIN userworkhistory uwork ON uwork.user_id = us.user_id AND uwork.id = us.credential_refid
                 LEFT OUTER JOIN (select useracquiantances.user_two_id,
                     COUNT(*) total
                 FROM useracquiantances
                 WHERE status=1
                 GROUP BY useracquiantances.user_two_id) as a ON a.user_two_id = u.id
                 LEFT OUTER JOIN (select useracquiantances.user_one_id,
                     COUNT(*) total
                 FROM useracquiantances
                 WHERE status=1
                 GROUP BY useracquiantances.user_one_id) as b ON b.user_one_id = u.id
                 LEFT OUTER JOIN (select postcontentapprovalrate.user_id,
                     sum(Case when approvalrate = 'Y' then 1 else 0 end) yaycount
                 FROM postcontentapprovalrate
                 LEFT JOIN postcontent ON postcontent.id = postcontentapprovalrate.postcontent_id
                 WHERE postcontent.deleted_at IS NULL AND postcontentapprovalrate.mask = 0
                 GROUP BY postcontentapprovalrate.user_id) as c ON c.user_id = u.id
                 LEFT OUTER JOIN (select topicapprovalrate.user_id,
                     sum(Case when approvalrate = 'Y' then 1 else 0 end) yaycount
                 FROM topicapprovalrate
                 LEFT JOIN topic ON topic.id = topicapprovalrate.string_id
                 WHERE topic.deleted_at IS NULL AND topicapprovalrate.mask=0
                 GROUP BY topicapprovalrate.user_id) as d ON d.user_id = u.id
                 LEFT OUTER JOIN (select postopinionapprovalrate.user_id,
                     sum(Case when approvalrate = 'Y' then 1 else 0 end) yaycount
                 FROM postopinionapprovalrate
                 LEFT JOIN postopinion ON postopinion.id = postopinionapprovalrate.postopinion_id
                 LEFT JOIN postcontent ON postcontent.id = postopinion.postcontent_id
                 WHERE postcontent.deleted_at IS NULL AND postopinion.deleted_at IS NULL
                 AND postopinionapprovalrate.mask=0
                 GROUP BY postopinionapprovalrate.user_id) as e ON e.user_id = u.id
                 LEFT JOIN useracquiantances ua on ua.user_one_id = uf.user_two_id 
                 AND ua.user_two_id = {$active_login_userid}
                 LEFT JOIN useracquiantances ua2 on ua2.user_one_id = {$active_login_userid} 
                 AND ua2.user_two_id = uf.user_two_id
                 LEFT JOIN userfriends uf2 on uf2.user_one_id = uf.user_two_id 
                 AND uf2.user_two_id = {$active_login_userid}
                 LEFT JOIN userfriends uf3 ON uf3.user_one_id={$active_login_userid} 
                 AND uf3.user_two_id=uf.user_two_id
                 LEFT OUTER JOIN (select uf5.user_one_id,
                     COUNT(*) mutualfriends
                 FROM userfriends uf5
                 WHERE uf5.status=1 AND
                       uf5.user_two_id IN (SELECT uf6.user_two_id
                                              FROM userfriends uf6
                                                                  WHERE uf6.user_one_id={$active_login_userid} AND status=1)
                 GROUP BY uf5.user_one_id) as mf ON mf.user_one_id = u.id
                 LEFT OUTER JOIN (select tr.user_id,
                     COUNT(*) mutualstrings
                 FROM topictrack tr
                 LEFT JOIN topic t ON t.id = tr.topic_id
                 WHERE t.deleted_at IS NULL AND tr.mask=0 AND
                       tr.topic_id IN (SELECT tr2.topic_id 
                                           FROM topictrack tr2
                                                           LEFT JOIN topic t2 ON tr2.topic_id = t2.id
                                                           WHERE tr2.user_id={$active_login_userid} 
                                                           AND t.deleted_at IS NULL 
                                                           AND tr.mask=0)
                 GROUP BY tr.user_id) as ms ON ms.user_id = u.id
                 WHERE (uf.user_one_id={$owner_profile_userid} AND uf.status=1)
                 {$active_filter}
                 LIMIT {$limit}";

        return collect($this->_helper->convert_sql_to_array( DB::select(DB::raw($sql)) ));         
    }
    
    /**
     * Get the list of user followers
     * 
     * @param array $filters
     */
    public function get_user_followers($filters)
    {
        $active_login_userid    = $filters['active_login_userid'];
        $owner_profile_userid   = $filters['owner_profile_userid'];
        $filter                 = $filters['filter'];
        
        //Most Recent
        $active_filter = " ORDER BY created_at DESC, u.first_name, u.last_name";
        if($filter == 1) {
            //Alphabetical
            $active_filter = " ORDER BY u.first_name, u.last_name";
        } else if($filter == 2) {
            //By number of followers
            $active_filter = " ORDER BY followers DESC, u.first_name, u.last_name";
        } else if($filter == 3) {
            //By number of mutual friends
            $active_filter = " ORDER BY mutual_friends DESC, u.first_name, u.last_name";
        } else if($filter == 4) {
            //By number of similar interests
            $active_filter = " ORDER BY similar_interest DESC, u.first_name, u.last_name";
        }
        
        $limit = 20;
        
        $sql = "SELECT u.id as user_id,
                    u.profile_code,
                    u.first_name,
                        u.last_name,
                        ub.profilephoto,
                        ub.coverphoto,
                        coalesce(a.total,0) as followers,
                        coalesce(b.total,0) as following,
                        round((coalesce(c.yaycount,0) + coalesce(d.yaycount,0) + (coalesce(e.yaycount,0) / 10)) / 3) as avg_rating,
                        us.credential_type,
                        us.credential_refid,
                        (case us.credential_type
                                     when 1 then ugen.general_info
                                     when 2 then 
                                             (case WHEN ucol.course IS NOT NULL THEN
                                                 CONCAT(ucol.course, ', ', ucol.schoolname)
                                                     ELSE ucol.schoolname
                                             end)
                                     when 3 then CONCAT(uwork.position, ', ', uwork.companyname,', ',uwork.location)
                             end) 'credential',
                        (case 
                                     when uf2.status=1 then '1'
                                     when uf2.status=0 then '2'
                                     when uf3.status=0 then '3'    
                                     else '4'
                        end) 'friend_status',
                        (case
                         when ua.status=1 then 
                                         case ua2.status
                                               when 1 then '6'
                                               else '1'
                                             end
                                     when ua.status=0 then '2'
                                     when ua2.status=1 then '3'
                                     when ua2.status=0 then '4'    
                                     else '5'
                        end) 'following_status',
                    coalesce(mf.mutualfriends,0) as mutual_friends,
                        coalesce(ms.mutualstrings,0) as similar_interest,
                        uq.created_at
             FROM useracquiantances uq
             JOIN users u ON u.id = uq.user_one_id
             LEFT JOIN userbasicinfo ub on u.id = ub.user_id
             LEFT JOIN usersettings us on u.id = us.user_id
             LEFT JOIN usergeneralinfo ugen ON ugen.user_id = us.user_id AND ugen.id = us.credential_refid
             LEFT JOIN usereduccollege ucol ON ucol.user_id = us.user_id AND ucol.id = us.credential_refid
             LEFT JOIN userworkhistory uwork ON uwork.user_id = us.user_id AND uwork.id = us.credential_refid
             LEFT OUTER JOIN (select useracquiantances.user_two_id,
                 COUNT(*) total
             FROM useracquiantances
             WHERE status=1
             GROUP BY useracquiantances.user_two_id) as a ON a.user_two_id = u.id
             LEFT OUTER JOIN (select useracquiantances.user_one_id,
                 COUNT(*) total
             FROM useracquiantances
             WHERE status=1
             GROUP BY useracquiantances.user_one_id) as b ON b.user_one_id = u.id
             LEFT OUTER JOIN (select postcontentapprovalrate.user_id,
                 sum(Case when approvalrate = 'Y' then 1 else 0 end) yaycount
             FROM postcontentapprovalrate
             LEFT JOIN postcontent ON postcontent.id = postcontentapprovalrate.postcontent_id
             WHERE postcontent.deleted_at IS NULL AND postcontentapprovalrate.mask = 0
             GROUP BY postcontentapprovalrate.user_id) as c ON c.user_id = u.id
             LEFT OUTER JOIN (select topicapprovalrate.user_id,
                 sum(Case when approvalrate = 'Y' then 1 else 0 end) yaycount
             FROM topicapprovalrate
             LEFT JOIN topic ON topic.id = topicapprovalrate.string_id
             WHERE topic.deleted_at IS NULL AND topicapprovalrate.mask=0
             GROUP BY topicapprovalrate.user_id) as d ON d.user_id = u.id
             LEFT OUTER JOIN (select postopinionapprovalrate.user_id,
                 sum(Case when approvalrate = 'Y' then 1 else 0 end) yaycount
             FROM postopinionapprovalrate
             LEFT JOIN postopinion ON postopinion.id = postopinionapprovalrate.postopinion_id
             LEFT JOIN postcontent ON postcontent.id = postopinion.postcontent_id
             WHERE postcontent.deleted_at IS NULL AND postopinion.deleted_at IS NULL
             AND postopinionapprovalrate.mask=0
             GROUP BY postopinionapprovalrate.user_id) as e ON e.user_id = u.id
             LEFT JOIN useracquiantances ua on ua.user_one_id = uq.user_two_id 
             AND ua.user_two_id = {$active_login_userid}
             LEFT JOIN useracquiantances ua2 on ua2.user_one_id = {$active_login_userid} 
             AND ua2.user_two_id = uq.user_two_id
             LEFT JOIN userfriends uf2 on uf2.user_one_id = uq.user_two_id 
             AND uf2.user_two_id = {$active_login_userid}
             LEFT JOIN userfriends uf3 ON uf3.user_one_id={$active_login_userid} 
             AND uf3.user_two_id=uq.user_two_id
             LEFT OUTER JOIN (select uf5.user_one_id,
                 COUNT(*) mutualfriends
             FROM userfriends uf5
             WHERE uf5.status=1 AND
                   uf5.user_two_id IN (SELECT uf6.user_two_id
                                          FROM userfriends uf6
                                                              WHERE uf6.user_one_id={$active_login_userid} AND status=1)
             GROUP BY uf5.user_one_id) as mf ON mf.user_one_id = u.id
             LEFT OUTER JOIN (select tr.user_id,
                 COUNT(*) mutualstrings
             FROM topictrack tr
             LEFT JOIN topic t ON t.id = tr.topic_id
             WHERE t.deleted_at IS NULL AND tr.mask=0 AND
                   tr.topic_id IN (SELECT tr2.topic_id 
                                       FROM topictrack tr2
                                                       LEFT JOIN topic t2 ON tr2.topic_id = t2.id
                                                       WHERE tr2.user_id={$active_login_userid} 
                                                       AND t.deleted_at IS NULL 
                                                       AND tr.mask=0)
             GROUP BY tr.user_id) as ms ON ms.user_id = u.id
             WHERE (uq.user_two_id={$owner_profile_userid} AND uq.status=1)
             {$active_filter}
             LIMIT {$limit}";
                 
        return collect($this->_helper->convert_sql_to_array( DB::select(DB::raw($sql)) ));         
    }
    
    /**
     * Get the list of user following
     * 
     * @param array $filters
     */
    public function get_user_following($filters)
    {
        $active_login_userid    = $filters['active_login_userid'];
        $owner_profile_userid   = $filters['owner_profile_userid'];
        $filter                 = $filters['filter'];
        
        //Most Recent
        $active_filter = " ORDER BY created_at DESC, u.first_name, u.last_name";
        if($filter == 1) {
            //Alphabetical
            $active_filter = " ORDER BY u.first_name, u.last_name";
        } else if($filter == 2) {
            //By number of followers
            $active_filter = " ORDER BY followers DESC, u.first_name, u.last_name";
        } else if($filter == 3) {
            //By number of mutual friends
            $active_filter = " ORDER BY mutual_friends DESC, u.first_name, u.last_name";
        } else if($filter == 4) {
            //By number of similar interests
            $active_filter = " ORDER BY similar_interest DESC, u.first_name, u.last_name";
        }
        
        $limit = 20;
        
        $sql = "SELECT u.id as user_id,
                            u.profile_code,
                            u.first_name,
                            u.last_name,
                            ub.profilephoto,
                            ub.coverphoto,
                            coalesce(a.total,0) as followers,
                            coalesce(b.total,0) as following,
                            round((coalesce(c.yaycount,0) + coalesce(d.yaycount,0) + (coalesce(e.yaycount,0) / 10)) / 3) as avg_rating,
                            us.credential_type,
                            us.credential_refid,
                            (case us.credential_type
                                         when 1 then ugen.general_info
                                         when 2 then 
                                                 (case WHEN ucol.course IS NOT NULL THEN
                                                     CONCAT(ucol.course, ', ', ucol.schoolname)
                                                         ELSE ucol.schoolname
                                                 end)
                                         when 3 then CONCAT(uwork.position, ', ', uwork.companyname,', ',uwork.location)
                                 end) 'credential',
                            (case 
                                         when uf2.status=1 then '1'
                                         when uf2.status=0 then '2'
                                         when uf3.status=0 then '3'    
                                         else '4'
                            end) 'friend_status',
                            (case
                             when ua.status=1 then 
                                             case ua2.status
                                                   when 1 then '6'
                                                   else '1'
                                                 end
                                         when ua.status=0 then '2'
                                         when ua2.status=1 then '3'
                                         when ua2.status=0 then '4'    
                                         else '5'
                            end) 'following_status',
                            coalesce(mf.mutualfriends,0) as mutual_friends,
                            coalesce(ms.mutualstrings,0) as similar_interest,
                            uq.created_at
                 FROM useracquiantances uq
                 JOIN users u ON u.id = uq.user_two_id
                 LEFT JOIN userbasicinfo ub on u.id = ub.user_id
                 LEFT JOIN usersettings us on u.id = us.user_id
                 LEFT JOIN usergeneralinfo ugen ON ugen.user_id = us.user_id AND ugen.id = us.credential_refid
                 LEFT JOIN usereduccollege ucol ON ucol.user_id = us.user_id AND ucol.id = us.credential_refid
                 LEFT JOIN userworkhistory uwork ON uwork.user_id = us.user_id AND uwork.id = us.credential_refid
                 LEFT OUTER JOIN (select useracquiantances.user_two_id,
                     COUNT(*) total
                 FROM useracquiantances
                 WHERE status=1
                 GROUP BY useracquiantances.user_two_id) as a ON a.user_two_id = u.id
                 LEFT OUTER JOIN (select useracquiantances.user_one_id,
                     COUNT(*) total
                 FROM useracquiantances
                 WHERE status=1
                 GROUP BY useracquiantances.user_one_id) as b ON b.user_one_id = u.id
                 LEFT OUTER JOIN (select postcontentapprovalrate.user_id,
                     sum(Case when approvalrate = 'Y' then 1 else 0 end) yaycount
                 FROM postcontentapprovalrate
                 LEFT JOIN postcontent ON postcontent.id = postcontentapprovalrate.postcontent_id
                 WHERE postcontent.deleted_at IS NULL AND postcontentapprovalrate.mask = 0
                 GROUP BY postcontentapprovalrate.user_id) as c ON c.user_id = u.id
                 LEFT OUTER JOIN (select topicapprovalrate.user_id,
                     sum(Case when approvalrate = 'Y' then 1 else 0 end) yaycount
                 FROM topicapprovalrate
                 LEFT JOIN topic ON topic.id = topicapprovalrate.string_id
                 WHERE topic.deleted_at IS NULL AND topicapprovalrate.mask=0
                 GROUP BY topicapprovalrate.user_id) as d ON d.user_id = u.id
                 LEFT OUTER JOIN (select postopinionapprovalrate.user_id,
                     sum(Case when approvalrate = 'Y' then 1 else 0 end) yaycount
                 FROM postopinionapprovalrate
                 LEFT JOIN postopinion ON postopinion.id = postopinionapprovalrate.postopinion_id
                 LEFT JOIN postcontent ON postcontent.id = postopinion.postcontent_id
                 WHERE postcontent.deleted_at IS NULL AND postopinion.deleted_at IS NULL
                 AND postopinionapprovalrate.mask=0
                 GROUP BY postopinionapprovalrate.user_id) as e ON e.user_id = u.id
                 LEFT JOIN useracquiantances ua on ua.user_one_id = uq.user_two_id 
                 AND ua.user_two_id = {$active_login_userid}
                 LEFT JOIN useracquiantances ua2 on ua2.user_one_id = {$active_login_userid} 
                 AND ua2.user_two_id = uq.user_two_id
                 LEFT JOIN userfriends uf2 on uf2.user_one_id = uq.user_two_id 
                 AND uf2.user_two_id = {$active_login_userid}
                 LEFT JOIN userfriends uf3 ON uf3.user_one_id={$active_login_userid} 
                 AND uf3.user_two_id=uq.user_two_id
                 LEFT OUTER JOIN (select uf5.user_one_id,
                     COUNT(*) mutualfriends
                 FROM userfriends uf5
                 WHERE uf5.status=1 AND
                       uf5.user_two_id IN (SELECT uf6.user_two_id
                                              FROM userfriends uf6
                                                                  WHERE uf6.user_one_id={$active_login_userid} AND status=1)
                 GROUP BY uf5.user_one_id) as mf ON mf.user_one_id = u.id
                 LEFT OUTER JOIN (select tr.user_id,
                     COUNT(*) mutualstrings
                 FROM topictrack tr
                 LEFT JOIN topic t ON t.id = tr.topic_id
                 WHERE t.deleted_at IS NULL AND tr.mask=0 AND
                       tr.topic_id IN (SELECT tr2.topic_id 
                                           FROM topictrack tr2
                                                           LEFT JOIN topic t2 ON tr2.topic_id = t2.id
                                                           WHERE tr2.user_id={$active_login_userid} 
                                                           AND t.deleted_at IS NULL 
                                                           AND tr.mask=0)
                 GROUP BY tr.user_id) as ms ON ms.user_id = u.id
                 WHERE (uq.user_one_id={$owner_profile_userid} AND uq.status=1)
                 {$active_filter}
                 LIMIT {$limit}";
                 
        return collect($this->_helper->convert_sql_to_array( DB::select(DB::raw($sql)) ));         
    }
    
    /**
     * Get the list of user request
     * 
     * @param array $filters
     */
    public function get_user_request($filters)
    {
        $active_login_userid    = $filters['active_login_userid'];
        $owner_profile_userid   = $filters['owner_profile_userid'];
        
        $limit = 20;
        
        $sql = "SELECT u.id as user_id,
                        u.profile_code,
                    u.first_name,
                        u.last_name,
                        ub.profilephoto,
                        ub.coverphoto,
                        coalesce(a.total,0) as followers,
                        coalesce(b.total,0) as following,
                        round((coalesce(c.yaycount,0) + coalesce(d.yaycount,0) + (coalesce(e.yaycount,0) / 10)) / 3) as avg_rating,
                        us.credential_type,
                        us.credential_refid,
                        (case us.credential_type
                                     when 1 then ugen.general_info
                                     when 2 then 
                                             (case WHEN ucol.course IS NULL THEN
                                                 CONCAT(ucol.course, ', ', ucol.schoolname)
                                                     ELSE ucol.schoolname
                                             end)
                                     when 3 then CONCAT(uwork.position, ', ', uwork.companyname,', ',uwork.location)
                             end) 'credential',
                        (case 
                                     when uf2.status=1 then '1'
                                     when uf2.status=0 then '2'
                                     when uf3.status=0 then '3'    
                                     else '4'
                        end) 'friend_status',
                        (case
                         when ua.status=1 then 
                                         case ua2.status
                                               when 1 then '6'
                                               else '1'
                                             end
                                     when ua.status=0 then '2'
                                     when ua2.status=1 then '3'
                                     when ua2.status=0 then '4'    
                                     else '5'
                        end) 'following_status', 
                    'friends' as requesttype
             FROM userfriends uf
             JOIN users u ON u.id = uf.user_one_id
             LEFT JOIN userbasicinfo ub on u.id = ub.user_id
             LEFT JOIN usersettings us on u.id = us.user_id
             LEFT JOIN usergeneralinfo ugen ON ugen.user_id = us.user_id AND ugen.id = us.credential_refid
             LEFT JOIN usereduccollege ucol ON ucol.user_id = us.user_id AND ucol.id = us.credential_refid
             LEFT JOIN userworkhistory uwork ON uwork.user_id = us.user_id AND uwork.id = us.credential_refid
             LEFT OUTER JOIN (select useracquiantances.user_two_id,
                 COUNT(*) total
             FROM useracquiantances
             WHERE status=1
             GROUP BY useracquiantances.user_two_id) as a ON a.user_two_id = u.id
             LEFT OUTER JOIN (select useracquiantances.user_one_id,
                 COUNT(*) total
             FROM useracquiantances
             WHERE status=1
             GROUP BY useracquiantances.user_one_id) as b ON b.user_one_id = u.id
             LEFT OUTER JOIN (select postcontentapprovalrate.user_id,
                 sum(Case when approvalrate = 'Y' then 1 else 0 end) yaycount
             FROM postcontentapprovalrate
             LEFT JOIN postcontent ON postcontent.id = postcontentapprovalrate.postcontent_id
             WHERE postcontent.deleted_at IS NULL AND postcontentapprovalrate.mask = 0
             GROUP BY postcontentapprovalrate.user_id) as c ON c.user_id = u.id
             LEFT OUTER JOIN (select topicapprovalrate.user_id,
                 sum(Case when approvalrate = 'Y' then 1 else 0 end) yaycount
             FROM topicapprovalrate
             LEFT JOIN topic ON topic.id = topicapprovalrate.string_id
             WHERE topic.deleted_at IS NULL AND topicapprovalrate.mask=0
             GROUP BY topicapprovalrate.user_id) as d ON d.user_id = u.id
             LEFT OUTER JOIN (select postopinionapprovalrate.user_id,
                 sum(Case when approvalrate = 'Y' then 1 else 0 end) yaycount
             FROM postopinionapprovalrate
             LEFT JOIN postopinion ON postopinion.id = postopinionapprovalrate.postopinion_id
             LEFT JOIN postcontent ON postcontent.id = postopinion.postcontent_id
             WHERE postcontent.deleted_at IS NULL AND postopinion.deleted_at IS NULL
             AND postopinionapprovalrate.mask=0
             GROUP BY postopinionapprovalrate.user_id) as e ON e.user_id = u.id
             LEFT JOIN useracquiantances ua on ua.user_one_id = uf.user_two_id 
             AND ua.user_two_id = {$active_login_userid}
             LEFT JOIN useracquiantances ua2 on ua2.user_one_id = {$active_login_userid} 
             AND ua2.user_two_id = uf.user_two_id
             LEFT JOIN userfriends uf2 on uf2.user_one_id = uf.user_two_id 
             AND uf2.user_two_id = {$active_login_userid}
             LEFT JOIN userfriends uf3 ON uf3.user_one_id={$active_login_userid} 
             AND uf3.user_two_id=uf.user_two_id
             WHERE (uf.user_two_id={$owner_profile_userid} AND uf.status=0)
             UNION
             SELECT u.id as user_id,
                        u.profile_code,
                    u.first_name,
                        u.last_name,
                        ub.profilephoto,
                        ub.coverphoto,
                        coalesce(a.total,0) as followers,
                        coalesce(b.total,0) as following,
                        round((coalesce(c.yaycount,0) + coalesce(d.yaycount,0) + (coalesce(e.yaycount,0) / 10)) / 3) as avg_rating,
                        us.credential_type,
                        us.credential_refid,
                        (case us.credential_type
                                     when 1 then ugen.general_info
                                     when 2 then CONCAT(ucol.course, ', ', ucol.schoolname)
                                     when 3 then uhigh.schoolname
                                     when 4 then CONCAT(uwork.position, ', ', uwork.companyname,', ',uwork.location)
                             end) 'credential',
                        (case 
                                     when uf2.status=1 then '1'
                                     when uf2.status=0 then '2'
                                     when uf3.status=0 then '3'    
                                     else '4'
                        end) 'friend_status',
                        (case
                         when ua.status=1 then 
                                         case ua2.status
                                               when 1 then '6'
                                               else '1'
                                             end
                                     when ua.status=0 then '2'
                                     when ua2.status=1 then '3'
                                     when ua2.status=0 then '4'    
                                     else '5'
                        end) 'following_status',
                        'follow' as requesttype
             FROM useracquiantances uq
             JOIN users u ON u.id = uq.user_one_id
             LEFT JOIN userbasicinfo ub on u.id = ub.user_id
             LEFT JOIN usersettings us on u.id = us.user_id
             LEFT JOIN usergeneralinfo ugen ON ugen.user_id = us.user_id AND ugen.id = us.credential_refid
             LEFT JOIN usereduccollege ucol ON ucol.user_id = us.user_id AND ucol.id = us.credential_refid
             LEFT JOIN usereduchighschool uhigh ON uhigh.user_id = us.user_id AND uhigh.id = us.credential_refid
             LEFT JOIN userworkhistory uwork ON uwork.user_id = us.user_id AND uwork.id = us.credential_refid
             LEFT OUTER JOIN (select useracquiantances.user_two_id,
                 COUNT(*) total
             FROM useracquiantances
             WHERE status=1
             GROUP BY useracquiantances.user_two_id) as a ON a.user_two_id = u.id
             LEFT OUTER JOIN (select useracquiantances.user_one_id,
                 COUNT(*) total
             FROM useracquiantances
             WHERE status=1
             GROUP BY useracquiantances.user_one_id) as b ON b.user_one_id = u.id
             LEFT OUTER JOIN (select postcontentapprovalrate.user_id,
                 sum(Case when approvalrate = 'Y' then 1 else 0 end) yaycount
             FROM postcontentapprovalrate
             LEFT JOIN postcontent ON postcontent.id = postcontentapprovalrate.postcontent_id
             WHERE postcontent.deleted_at IS NULL AND postcontentapprovalrate.mask = 0
             GROUP BY postcontentapprovalrate.user_id) as c ON c.user_id = u.id
             LEFT OUTER JOIN (select topicapprovalrate.user_id,
                 sum(Case when approvalrate = 'Y' then 1 else 0 end) yaycount
             FROM topicapprovalrate
             LEFT JOIN topic ON topic.id = topicapprovalrate.string_id
             WHERE topic.deleted_at IS NULL AND topicapprovalrate.mask=0
             GROUP BY topicapprovalrate.user_id) as d ON d.user_id = u.id
             LEFT OUTER JOIN (select postopinionapprovalrate.user_id,
                 sum(Case when approvalrate = 'Y' then 1 else 0 end) yaycount
             FROM postopinionapprovalrate
             LEFT JOIN postopinion ON postopinion.id = postopinionapprovalrate.postopinion_id
             LEFT JOIN postcontent ON postcontent.id = postopinion.postcontent_id
             WHERE postcontent.deleted_at IS NULL AND postopinion.deleted_at IS NULL
             AND postopinionapprovalrate.mask=0
             GROUP BY postopinionapprovalrate.user_id) as e ON e.user_id = u.id
             LEFT JOIN useracquiantances ua on ua.user_one_id = uq.user_two_id 
             AND ua.user_two_id = {$active_login_userid}
             LEFT JOIN useracquiantances ua2 on ua2.user_one_id = {$active_login_userid} 
             AND ua2.user_two_id = uq.user_two_id
             LEFT JOIN userfriends uf2 on uf2.user_one_id = uq.user_two_id 
             AND uf2.user_two_id = {$active_login_userid}
             LEFT JOIN userfriends uf3 ON uf3.user_one_id={$active_login_userid} 
             AND uf3.user_two_id=uq.user_two_id
             WHERE (uq.user_two_id={$owner_profile_userid} AND uq.status=0)
             ORDER BY first_name, last_name
             LIMIT {$limit}";
                 
        return collect($this->_helper->convert_sql_to_array( DB::select(DB::raw($sql)) ));         
    }
    
    /**
     * Get the list of user who view the active user
     * 
     * @param array $filters
     */
    public function get_user_views($filters)
    {
        $active_login_userid    = $filters['active_login_userid'];
        $owner_profile_userid   = $filters['owner_profile_userid'];
        
        $limit = 20;
        
        $sql = "SELECT upv.id,
                        upv.viewer_userid,
                        u.profile_code,
                        u.first_name,
                            u.last_name,
                            ub.profilephoto,
                            upv.date,
                            ucol.course,
                            u.education as schoolname,
                            uwork.position as occupation,
                            case 
                                         when uf2.status=1 then '1'
                                         when uf2.status=0 then '2'
                                         when uf3.status=0 then '3'    
                                         else '4'
                            end 'friend_status',
                            case
                             when ua.status=1 then 
                                             case ua2.status
                                                   when 1 then '6'
                                                   else '1'
                                                 end
                                         when ua.status=0 then '2'
                                         when ua2.status=1 then '3'
                                         when ua2.status=0 then '4'    
                                         else '5'
                            end 'following_status'  
                 FROM userprofileview upv
                 LEFT JOIN users u ON u.id = upv.viewer_userid
                 LEFT JOIN userbasicinfo ub ON ub.user_id = upv.viewer_userid
                 LEFT JOIN useracquiantances ua on ua.user_one_id = upv.viewer_userid 
                 AND ua.user_two_id = {$active_login_userid}
                 LEFT JOIN useracquiantances ua2 on ua2.user_one_id = {$active_login_userid} 
                 AND ua2.user_two_id = upv.viewer_userid
                 LEFT JOIN userfriends uf2 on uf2.user_one_id = upv.viewer_userid 
                 AND uf2.user_two_id = {$active_login_userid}
                 LEFT JOIN userfriends uf3 ON uf3.user_one_id={$active_login_userid} 
                 AND uf3.user_two_id=upv.viewer_userid
                 LEFT JOIN 
                 (SELECT uc1.user_id, uc1.yearstarted,uc1.schoolname,uc1.course, uc1.id
                 FROM usereduccollege uc1
                 INNER JOIN(
                     SELECT user_id, max(yearstarted) as yearstarted, max(id) as id 
                     FROM usereduccollege 
                     GROUP BY user_id
                     ORDER BY id DESC)  uc2 ON uc1.user_id = uc2.user_id AND uc1.yearstarted = uc2.yearstarted AND uc1.id=uc2.id) ucol ON ucol.user_id = u.id
                 LEFT JOIN
                 (SELECT uw1.user_id, uw1.yearstarted,uw1.position, uw1.id
                 FROM userworkhistory uw1
                 INNER JOIN (
                     SELECT user_id, max(yearstarted) as yearstarted, max(id) as id 
                     FROM userworkhistory 
                     GROUP BY user_id
                     ORDER BY id DESC)  uw2 ON uw1.user_id = uw2.user_id AND uw1.yearstarted = uw2.yearstarted AND uw1.id=uw2.id) uwork ON uwork.user_id = u.id
                 WHERE upv.profile_userid={$owner_profile_userid}
                 ORDER BY date DESC
                 LIMIT {$limit}";
                 
        return collect($this->_helper->convert_sql_to_array( DB::select(DB::raw($sql)) ));         
    }
    
    /**
     * Get the count for similar and mutual friends
     * 
     * @param int $active_user
     * @param int $user_id
     * @return array
     */
    public function get_similiar_and_mutual($active_user, $user_id)
    {
        $sql = "SELECT u.id,
                    u.profile_code,
                    coalesce(a.mutualfriends,0) as friends,
                    coalesce(b.mutualstrings,0) as strings
                 FROM users u
                 LEFT OUTER JOIN (select uf.user_one_id,
                     COUNT(*) mutualfriends
                 FROM userfriends uf
                 WHERE uf.status=1 AND
                       uf.user_two_id IN (SELECT uf2.user_two_id
                                              FROM userfriends uf2
                                                                  WHERE uf2.user_one_id={$active_user} AND status=1)
                 GROUP BY uf.user_one_id) as a ON a.user_one_id = u.id
                 LEFT OUTER JOIN (select tr.user_id,
                     COUNT(*) mutualstrings
                 FROM topictrack tr
                 LEFT JOIN topic t ON t.id = tr.topic_id
                 WHERE t.deleted_at IS NULL AND tr.mask=0 AND
                       tr.topic_id IN (SELECT tr2.topic_id 
                        FROM topictrack tr2
                                        LEFT JOIN topic t2 ON tr2.topic_id = t2.id
                                        WHERE tr2.user_id={$active_user} 
                                        AND t.deleted_at IS NULL 
                                        AND tr.mask=0)
                 GROUP BY tr.user_id) as b ON b.user_id = u.id
                 WHERE u.id = {$user_id}";
                 
        return collect($this->_helper->convert_sql_to_array( DB::select(DB::raw($sql)) ));         
    }
    
    /**
     * Get the user fav strings in connections
     * 
     * @param int $user_id
     * @return array
     */
    public function get_user_connection_fav_strings($user_id)
    {
        $sql = "SELECT ufav.id,
		   ufav.user_id,
		   ufav.topic_id,
		   ufav.created_at,
		   t.color,
		   t.coverphoto,
		   t.string_alias,
		   t.slug
                FROM userfavoritestrings ufav
                INNER JOIN topic t ON t.id = ufav.topic_id
                WHERE t.deleted_at IS NULL AND ufav.user_id={$user_id}
                ORDER BY ufav.created_at DESC
                LIMIT 3";
                
        $data = DB::select(DB::raw($sql));    
        return count($data) > 0 ?  collect($this->_helper->convert_sql_to_array( $data )) : [];
    }
    
    
    /**
     * Save the the visitor or viewer of the profile
     * 
     * @param int $viewer_id
     * @param int $owner_id
     * 
     * @return object
     */
    public function save_profile_views($viewer_id, $owner_id)
    {
        if ($owner_id != $viewer_id)
        {
            $result = DB::table('userprofileview')
                            ->where([
                                'viewer_userid'     => $viewer_id,
                                'profile_userid'    => $owner_id
                            ])
                            ->orderBy('id' , 'DESC')
                            ->first();
            
            if (empty($result))
            {
                DB::table('userprofileview')->insert([
                    'viewer_userid'  => $viewer_id,
                    'profile_userid' => $owner_id,
                    'date' => date('Y-m-d H:i:s')
                ]);
            }
            else
            {
                $last_view_date = strtotime($result->date);
                if ($last_view_date <= strtotime('-1 hours')) {
                    DB::table('userprofileview')->insert([
                        'viewer_userid'  => $viewer_id,
                        'profile_userid' => $owner_id,
                        'date' => date('Y-m-d H:i:s')
                    ]);
                }
            }

            return $result;
        }
    }
    
    /**
     * Count total images
     * 
     * @param int $user_id
     * @param int $active_user_id
     * @return array
     */
    public function count_images($user_id, $active_user_id)
    {
        $sql = "SELECT 
                coalesce(count(*),0) as total_image
                FROM postcontentfiles pf
                LEFT JOIN postcontent pcon ON pcon.id = pf.postcontent_id
                LEFT JOIN postcontenthide phide ON phide.postcontent_id = pcon.id AND phide.user_id={$user_id}
                WHERE pcon.deleted_at IS NULL AND phide.postcontent_id IS NULL
                AND pcon.user_id = {$active_user_id} AND pcon.mask=0";
        
        return collect($this->_helper->convert_sql_to_array( DB::select(DB::raw($sql)) ));
    }
    /**
     * Load images list
     * 
     * @param int $user_id
     * @param int $active_user_id
     * @return array
     */
    public function load_images_list($user_id, $active_user_id)
    {
        $sql = "SELECT DISTINCT
                    pcon.user_id,
                        pf.filename as photo,
                        pf.reference,
                        pcon.created_at,
                        pf.id as image_id,
                        pcon.id as content_id,
                        coalesce(b.YayCount,0) as yay,
                        coalesce(b.NayCount,0) as nay,
                        coalesce(c.total,0) as view,
                        coalesce(d.total,0) as comment,
                        case prate.approvalrate
                                when 'Y' then 'Yae'
                                when 'N' then 'Nay'
                                else 'None'
                        end 'approval_rate',
                        pcon.nsfw
                FROM postcontentfiles pf
                LEFT JOIN postcontent pcon ON pcon.id = pf.postcontent_id
                LEFT OUTER JOIN (select postcontentapprovalrate.postcontent_id,
                        sum(case when approvalrate = 'Y' then 1 else 0 end) YayCount,
                        sum(case when approvalrate = 'N' then 1 else 0 end) NayCount
                FROM postcontentapprovalrate
                GROUP BY postcontentapprovalrate.postcontent_id) as b ON b.postcontent_id = pcon.id
                LEFT OUTER JOIN (select postcontentview.postcontent_id,
                        COUNT(*) total
                FROM postcontentview
                GROUP BY postcontentview.postcontent_id) as c ON c.postcontent_id = pcon.id
                LEFT OUTER JOIN (select postopinion.postcontent_id,postopinion.deleted_at,
                        COUNT(*) total
                FROM postopinion
                WHERE postopinion.deleted_at IS NULL
                GROUP BY postopinion.postcontent_id) as d ON d.postcontent_id = pcon.id
                LEFT JOIN postcontentapprovalrate as prate ON prate.postcontent_id =pcon.id AND prate.user_id = {$active_user_id}
                LEFT JOIN postcontenthide phide ON phide.postcontent_id = pcon.id AND phide.user_id={$active_user_id}
                WHERE pcon.deleted_at IS NULL AND phide.postcontent_id IS NULL
                AND pcon.user_id = {$user_id} AND pcon.mask=0";
        
        return collect($this->_helper->convert_sql_to_array( DB::select(DB::raw($sql)) ));
    }
    
    /**
     * Remove data in profile view
     * 
     * @param int $id
     */
    public function remove_profile_view($id)
    {
        DB::table('userprofileview')
        ->where([
            'id' => $id
        ])
        ->delete();
    }
}