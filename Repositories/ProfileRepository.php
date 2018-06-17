<?php
namespace Modular\Forms\Profile\Repositories;

use Mockery\CountValidator\Exception;
use Modular\Repositories\EloquentRepository;
use Illuminate\Database\Eloquent\Model;

use Modular\Repositories\ValidatorInterface;

/**
 * Models
 */
use Modular\Forms\Profile\Models\UserBasicInfoModel;
use Modular\Forms\Profile\Models\UserContactInfoModel;
use Modular\Forms\Profile\Models\UserEducCollegeModel;
use Modular\Forms\Profile\Models\UserEducHighschoolModel;
use Modular\Forms\Profile\Models\UserWorkHistoryModel;
use Modular\Forms\Profile\Models\PageSubcategoryModel;
use Modular\Forms\Profile\Models\UploadPhotoModel;

use DB;

class ProfileRepository extends EloquentRepository implements ProfileInterface {

    protected $validator;

    public function __construct(Model $model , ValidatorInterface $validator)
    {
        parent::__construct($model);

        $this->validator = $validator;
    }

    /**
     * Store Post Content
     * @param array $data
     * @return data
     */
    public function store(array $data)
    {
        if($data) {

        }
    }

    public function storeMaskPhoto(array $data)
    {
        if ($data)
        {
            try {

                if ($this->model->find($data['user_id'])->first(['maskimage']))
                {
                    $user = $this->model->find($data['user_id']);
                    $user->maskimage = $data['maskimage'];
                    return ['status' => $user->save() , 'imagename' => $data['maskimage']];
                }

            } catch(Exception $e) {
                return ['status' => false];
            }
        }
    }

    public function getPhotos(array $inputs)
    {
        $data = [];

        $offset = $inputs['offset'];
        $limit = $inputs['limit'];
        $user_id = $inputs['user_id'];


        $nsfw_status = DB::table('usersettings')->where('user_id' , $user_id)->first(['view_nsfw'])->view_nsfw;

        if ($nsfw_status == 1 || $nsfw_status == 2)
        {
            $where_clause = 'WHERE pc.user_id = ' . $user_id . ' and pc.deleted_at IS NULL and pc.mask= 0';
        }
        else
        {
            $where_clause = 'WHERE pc.user_id = ' . $user_id . ' and pc.deleted_at IS NULL AND pc.mask= 0 AND pc.nsfw=0';
        }

        $photos = DB::select(DB::raw('SELECT pc.user_id,
                     u.profile_code,
                     pf.filepath as photo,
                   pc.created_at ,
                   pc.nsfw
              FROM postcontentfiles pf
              LEFT JOIN postcontent pc ON pc.id = pf.postcontent_id
              LEFT JOIN users u ON u.id = pc.user_id
              ' . $where_clause . ' ORDER BY created_at DESC LIMIT ' . $limit . ' OFFSET ' . $offset . ''));

      if ( count($photos) > 0 )
      {
          foreach ( $photos as $key => $photo )
          {
              $path = "";
              if (\File::exists(public_path("upload/user/photos/original/" . $photo->photo)))
              {
                  $path = "/upload/user/photos/original/". $photo->photo;
              }
              elseif (\File::exists(public_path("upload/posts/original/" . $photo->photo)))
              {
                  $path = "/upload/posts/original/" . $photo->photo;
              }
              if ($path != "")
              {
                $data[] = [
                    'photo' => $path ,
                    'nsfw' => $photo->nsfw
                ];
              }
          }
      }

      return ['data' => $data , 'status' => true];

    }

    public function updateAccountName(array $data)
    {
        $user_id    = $data['user_id'];
        $fname      = $data['fname'];
        $mname      = $data['mname'];
        $lname      = $data['lname'];


            $user = $this->find($user_id);
            $user->first_name   = $fname;
            $user->last_name    = $lname;
            $user->save();

            if ($this->find($user_id)->userbasicinfo)
            {
                $user = $this->model->find($user_id)->userbasicinfo;
                $user->middlename = $mname;
                $user->save();
            }
            else
            {
                $userbasicinfodata = new UserBasicInfoModel([
                    'user_id' => $user_id , 'middlename' => $mname
                ]);
                $user = $this->find($user_id);
                $user->userbasicinfo()->save($userbasicinfodata);
            }

            return array('success' => true , 'message' => 'Account Name Successfully Updated!' , 'fname' => $this->find($user_id)->first_name , 'mname' => $this->find($user_id)->userbasicinfo->middlename , 'lname' => $this->find($user_id)->last_name);


    }

    public function updateAccountEmail(array $data)
    {
        $user_id    = $data['user_id'];
        $email      = $data['email'];

            $user = $this->find($user_id);
            $user->email = $email;
            $user->save();

            return array('success' => true , 'message' => 'Email Successfully Updated!' , 'email' => $this->find($user_id)->email);

    }

    public function updatePersonalizedUrl(array $data)
    {
        $user_id  = $data['user_id'];
        $customid = str_replace(" " , "" , $data['customid']);
        $check = \DB::table('users')->where('url_id' , $customid)->where('id' , '<>' , $user_id)->get();
        if (count($check) == 0)
        {
            $user = $this->find($user_id);
            $user->url_id = $customid;
            $user->profile_code = $customid;
            $user->save();

            return array('success' => true , 'message' => 'Personalized URL Successfully Updated!' , 'url' => $this->find($user_id)->url_id);
        }
        else
        {
            return array('success' => false , 'message' => 'Personalized URL is not available' , 'url' => $this->find($user_id)->url_id);
        }

    }

    public function updateAccountPassword(array $data)
    {
        $user_id     = $data['user_id'];
        $password    = $data['password'];
        $oldpassword = $data['oldpassword'];

        $credentials = [
          'password' => $oldpassword
        ];
        $user = $this->find($user_id);

        if (\Sentinel::validateCredentials($user, $credentials))
        {
          $user = $this->find($user_id);
          $user->password = hashPassword($password);
          $user->save();

          return array('success' => true , 'message' => 'Password Successfully Updated!');
        }
        else
        {
          return array('success' => false , 'message' => 'Invalid Current Password');
        }

    }

    public function updateBasicInformation(array $data)
    {

        $user_id    = $data['user_id'];
        $month      = date('m' , strtotime($data['month']));
        $day        = $data['day'];
        $year       = $data['year'];
        $gender     = $data['gender'];
        $bloodType  = $data['bloodType'];
        $religion   = $data['religion'];
        $politics   = $data['politics'];

        $user = $this->find($user_id);

        $user->birthyear                    = $year;
        $user->gender                       = $gender;
        $user->save();

            if ($this->find($user_id)->userbasicinfo)
            {
                $user = $this->find($user_id)->userbasicinfo;
                $user->birthmonth   = $month;
                $user->birthday     = $day;
                $user->bloodtype    = $bloodType;
                $user->religion     = $religion;
                $user->politics     = $politics;
                $user->save();
            }
            else
            {
                $userbasicinfodata = new UserBasicInfoModel([
                    'birthmonth' => $month , 'birthday' => $day , 'bloodtype' => $bloodType , 'religion' => $religion , 'politics' => $politics
                ]);

                $user = $this->find($user_id);
                $user->userbasicinfo()->save($userbasicinfodata);
            }

            return array(
                    'success' => true ,
                    'message' => 'Account Information Successfully Updated!' ,
                    'birthmonth' => convertMonthNumToName($this->find($user_id)->userbasicinfo->birthmonth) ,
                    'birthday' => $this->find($user_id)->userbasicinfo->birthday ,
                    'birthyear' => $this->find($user_id)->birthyear ,
                    'gender' => getGenderPrefix($this->find($user_id)->gender) ,
                    'bloodtype' => $this->getBloodTypeName($user_id) ,
                    'religion' => $this->find($user_id)->userbasicinfo->religion ,
                    'politics' => $this->find($user_id)->userbasicinfo->politics
            );

    }

    public function updateContactInformation(array $data)
    {

        $user_id            = $data['user_id'];
        $mobilenumbers      = explode(',' , $data['mobilenumbers']);
        $city               = $data['city'];
        $country            = $data['country'];
        $email              = explode(',' , $data['emails']);


            $phonenum1 = isset($mobilenumbers[0]) ? $mobilenumbers[0] : "";
            $phonenum2 = isset($mobilenumbers[1]) ? $mobilenumbers[1] : "";
            $phonenum3 = isset($mobilenumbers[2]) ? $mobilenumbers[2] : "";

            $email1 = isset($email[0]) ? $email[0] : "";
            $email2 = isset($email[1]) ? $email[1] : "";
            $email3 = isset($email[2]) ? $email[2] : "";


            if ($this->find($user_id)->usercontactinfo)
            {
                $user = $this->find($user_id)->usercontactinfo;
                $user->phonenum1    = $phonenum1;
                $user->phonenum2    = $phonenum2;
                $user->phonenum3    = $phonenum3;
                $user->city         = $city;
                $user->country      = $country;
                $user->email1       = $email1;
                $user->email2       = $email2;
                $user->email3       = $email3;
                $user->save();
            }
            else
            {
                $usercontactinfodata = new UserContactInfoModel([
                    'user_id' => $user_id , 'phonenum1' => $phonenum1 , 'phonenum2' => $phonenum2 , 'phonenum3' => $phonenum3 , 'city' => $city , 'country' => $country , 'email1' => $email1, 'email2' => $email2 , 'email3' => $email3
                ]);
                $user = $this->find($user_id);
                $user->usercontactinfo()->save($usercontactinfodata);
            }

            return array(
              'success' => true , 'message' => 'Contact Information Successfully Updated' ,
              'phonenum' => array($this->find($user_id)->usercontactinfo->phonenum1 , $this->find($user_id)->usercontactinfo->phonenum2 , $this->find($user_id)->usercontactinfo->phonenum3) ,
              'email' => array($this->find($user_id)->usercontactinfo->email1 , $this->find($user_id)->usercontactinfo->email2 , $this->find($user_id)->usercontactinfo->email3) ,
              'country' => $this->getCountryName($user_id) ,
              'city' => $this->find($user_id)->usercontactinfo->city
            );

    }

    public function updateWorkHistory(array $data)
    {
        $user_id        = $data['user_id'];
        $companyname    = explode("," , $data['companyname']);
        $position       = explode("," , $data['position']);
        $yearstart      = explode("," , $data['yearstart']);
        $yearend        = explode("," , $data['yearend']);
        $location       = explode("," , $data['location']);
        $id             = explode("," , $data['id']);

        $insertid       = 0;
        $index          = 0;

        $this->find($user_id)->userworkhistory()->where('user_id' , $user_id)->delete();

        if ( !empty( $companyname ) )
        {

            foreach ( $companyname as $key => $value )
            {
                if (isset($companyname[$key]) && $companyname[$key] != "")
                {
                    
                    $userworkhistorydata = new UserWorkHistoryModel([
                       'user_id' => $user_id , 'companyname' => htmlentities($companyname[$key]) , 'position' => $position[$key] , 'yearstarted' => $yearstart[$key] , 'yearended' => $yearend[$key] , 'location' => $location[$key]
                    ]);
                    $user = $this->find($user_id);
                    $user->userworkhistory()->save($userworkhistorydata);

                    $insertid = $userworkhistorydata->id;
                    
                }
            }

        }

       

        return array('success' => true ,
                     'message' => 'Personal Information Successfully Updated!' ,
                     'insertid' => $insertid ,
                     'index' => $index ,
                     'workhistory' => $this->find($user_id)->userworkhistory
        );
    }

    public function updateEducCollege(array $data)
    {
        $user_id        = $data['user_id'];
        $schoolname     = explode("," , $data['schoolname']);
        
        $location       = explode("," , $data['location']);
        $yearstart      = explode("," , $data['yearstart']);
        $yearend        = explode("," , $data['yearend']);
        $course         = explode("," , $data['major']);
     
        $insertid       = 0;
        $index          = 0;

        $this->find($user_id)->usereduccollege()->where('user_id' , $user_id)->delete();


        if (!empty($schoolname))
        {
            foreach ($schoolname as $key => $value)
            {
                if (isset($schoolname[$key]) && $schoolname[$key] != "")
                {
                   
                            $usereduccollegedata = new UserEducCollegeModel([
                                'user_id' => $user_id , 'schoolname' => $schoolname[$key] , 'yearstarted' => $yearstart[$key] , 'yearended' => $yearend[$key] , 'location' => $location[$key] , 'course' => $course[$key]
                            ]);
                            $user = $this->find($user_id);
                            $user->usereduccollege()->save($usereduccollegedata);
                  
                }
            }
        }

      
     

        return array('success' => true , 'message' => 'Personal Information Successfully Updated!' , 'insertid' => $insertid , 'index' => $index , 'educcollegehistory' => $this->find($user_id)->usereduccollege);
    }

    public function updateEducHighschool(array $data)
    {
        $user_id        = $data['user_id'];
        $schoolname     = explode("," , $data['schoolname']);
        $yearstart      = explode("," , $data['yearstart']);
        $location       = explode("," , $data['location']);
        $yearend        = explode("," , $data['yearend']);
        $id             = explode("," , $data['id']);

        $insertid       = 0;
        $index          = 0;

        $this->find($user_id)->usereduchighschool()->where('user_id' , $user_id)->delete();
        
        if (!empty($schoolname))
        {
            foreach ($schoolname as $key => $value)
            {
                if (isset($schoolname[$key]) && $schoolname[$key] != "")
                {
                        
                            $usereduchighschooldata = new UserEducHighschoolModel([
                                'user_id' => $user_id , 'schoolname' => $schoolname[$key] , 'yearstarted' => $yearstart[$key] , 'yearended' => $yearend[$key] , 'location' => $location[$key]
                            ]);
                            $user = $this->find($user_id);
                            $user->usereduchighschool()->save($usereduchighschooldata);                        
                    
                }
            }
        }


        return array('success' => true , 'message' => 'Personal Information Successfully Updated!' , 'insertid' => $insertid , 'index' => $index , 'educhighschoolhistory' => $this->find($user_id)->usereduchighschool);
    }

    public function deleteWorkHistory(array $data)
    {

        $user_id    = $data['user_id'];
        $id         = $data['id'];

        if ($this->find($user_id)->userworkhistory()->where('id' , $id)->first())
        {
            $this->find($user_id)->userworkhistory()->where('id' , $id)->delete();

            return array('success' => true , 'message' => 'Work Successfully Deleted!');
        }
        else
        {
            return array('success' => false , 'message' => 'Work not deleted!');
        }

    }

    public function deleteEducCollege(array $data)
    {

        $user_id    = $data['user_id'];
        $id         = $data['id'];

        if ($this->find($user_id)->usereduccollege()->where('id' , $id)->first())
        {
            $this->find($user_id)->usereduccollege()->where('id' , $id)->delete();

            return array('success' => true , 'message' => 'College Successfully Deleted!');
        }
        else
        {
            return array('success' => false , 'message' => 'College not deleted!');
        }

    }


    public function deleteEducHighSchool(array $data)
    {

        $user_id    = $data['user_id'];
        $id         = $data['id'];

        if ($this->find($user_id)->usereduchighschool()->where('id' , $id)->first())
        {
            $this->find($user_id)->usereduchighschool()->where('id' , $id)->delete();

            return array('success' => true , 'message' => 'Highschool Successfully Deleted!');
        }
        else
        {
            return array('success' => false , 'message' => 'Highschool not deleted!');
        }

    }

    public function updateWebsiteInfo(array $data)
    {
        $user_id        = $data['user_id'];
        $websitetitle   = explode("," , $data['websitetitle']);
        $websitelink    = explode("," , $data['websitelink']);

        $websitetitle1 = isset($websitetitle[0]) ? $websitetitle[0] : "";
        $websitetitle2 = isset($websitetitle[1]) ? $websitetitle[1] : "";
        $websitetitle3 = isset($websitetitle[2]) ? $websitetitle[2] : "";

        $websitelink1 = isset($websitelink[0]) ? $websitelink[0] : "";
        $websitelink2 = isset($websitelink[1]) ? $websitelink[1] : "";
        $websitelink3 = isset($websitelink[2]) ? $websitelink[2] : "";

        if ($this->find($user_id)->usercontactinfo)
        {
            $user = $this->find($user_id)->usercontactinfo;
            $user->webtitle1 = $websitetitle1;
            $user->weblink1  = $websitelink1;
            $user->webtitle2 = $websitetitle2;
            $user->weblink2  = $websitelink2;
            $user->webtitle3 = $websitetitle3;
            $user->weblink3  = $websitelink3;
            $user->save();
        }
        else
        {
            $usercontactinfodata = new UserContactInfoModel([
                'user_id' => $user_id , 'webtitle1' => $websitetitle1 , 'weblink1' => $websitelink1 , 'webtitle2' => $websitetitle2 , 'weblink2' => $websitelink2 , 'webtitle3' => $websitetitle3 , 'weblink3' => $websitelink3
            ]);
            $user = $this->find($user_id);
            $user->usercontactinfo()->save($usercontactinfodata);
        }

        $websiteinfo = [];
        if ($this->find($user_id)->usercontactinfo)
        {
          $user = $this->find($user_id)->usercontactinfo;

          if (!empty($user->webtitle1) && !empty($user->weblink1))
          {
            $websiteinfo[] = array(
              'webtitle' => $user->webtitle1 , 'weblink' => $user->weblink1
            );
          }

          if (!empty($user->webtitle2) && !empty($user->weblink2))
          {
            $websiteinfo[] = array(
              'webtitle' => $user->webtitle2 , 'weblink' => $user->weblink2
            );
          }

          if (!empty($user->webtitle3) && !empty($user->weblink3))
          {
            $websiteinfo[] = array(
              'webtitle' => $user->webtitle3 , 'weblink' => $user->weblink3
            );
          }

        }

        return array('success' => true , 'message' => 'Website Info Successfully Updated' , 'websiteinfo' => $websiteinfo);
    }

    public function getCountries()
    {
      return DB::table('refcountry')->orderBy('name' , 'ASC')->get();
    }

    public function getCountryName($user_id)
    {
        if ($this->find($user_id)->usercontactinfo && $this->find($user_id)->usercontactinfo->country != '')
        {
            $country = DB::select(DB::raw('SELECT uc.country as country_id, rc.name as country_name FROM usercontactinfo uc JOIN refcountry rc ON rc.id = uc.country WHERE uc.country="' . $this->find($user_id)->usercontactinfo->country . '"'));
            return $country[0]->country_name;
        }
        else
        {
            return '';
        }
    }

    public function updateMaskName(array $data)
    {
        try {
            $mask    = $data['maskFormText'];
            $user_id = $data['user_id'];

            /**
             * First we need to check if Mask Name is exist
             */
            $object  = $this->model->where('maskname' , $mask);

            $user = $this->model->find($user_id);

            if (!empty($user->maskname)) {
                if($user->maskname == $mask) {
                    throw new Exception('');
                }
            }

            if($object->count() > 0) throw new Exception('Mask Name is already exist');

            $user->maskname = $mask;
            if ($user->save()) {
                return [
                    'status'   => true ,
                    'message'  => 'MaskName is Updated.'
                ];
            } else {
                throw new Exception('Unable to save maskname , please try again');
            }

        } catch (Exception $e) {
            return [
                'status'   => false ,
                'message'  => $e->getMessage()
            ];
        }
    }

    public function updateBioInfo(array $data)
    {
      try {
          $bio_info    = $data['bio_info'];
          $user_id = $data['user_id'];

          $user = $this->model->find($user_id);


          $user->bio_info = $bio_info;
          if ($user->save()) {
              return [
                  'status'   => true ,
                  'message'  => 'Bio info is Updated.'
              ];
          } else {
              throw new Exception('Unable to save bio info , please try again');
          }

      } catch (Exception $e) {
          return [
              'status'   => false ,
              'message'  => $e->getMessage()
          ];
      }
    }

    public function currentPassword()
    {
        $user = $this->find(\Sentinel::getUser()->id)->first(['password']);
        return $user->password;
    }

    public function getOwnedTopics($user_id)
    {
      try {

          $topics = DB::table('topic as t');
          $topics->select(DB::raw('t.id , t.title , t.coverphoto , t.created_at , t.updated_at'));
          $topics->where('user_id' , $user_id);
          $topics->orderBy('t.created_at' , 'DESC');
          $topics = $topics->get();

          return $topics;

      } catch(Exception $e) {
          return [
              'status' => false ,
              'error'  => true ,
              'msg'    => $e->getMessage()
          ];
      }
    }

    public function getTrackedTopics($user_id)
    {
      try {

          $topics = DB::table('topictrack as tr');
          $topics->select(DB::raw('tr.id as id , t.title as title , t.coverphoto as coverphoto , t.created_at as created_at , t.updated_at as updated_at'));
          $topics->leftJoin('topic as t' , 'tr.topic_id' , '=' , 't.id');
          $topics->where('tr.user_id' , $user_id);
          $topics->orderBy('tr.created_at' , 'DESC');
          $topics = $topics->get();

          return $topics;

      } catch(Exception $e) {
          return [
              'status' => false ,
              'error'  => true ,
              'msg'    => $e->getMessage()
          ];
      }
    }

    public function save_photos(array $inputs)
    {
      $user_id = $inputs['user_id'];
      $images = $inputs['images'];
      $this->model = new UploadPhotoModel;
      foreach ($images as $image)
      {
        $this->model->where('user_id' , $user_id)->where('filename' , $image)->update(['status' => 1]);
      }

      return true;
    }

    public function save_crop_profile_image(array $inputs)
    {
        $user_id = $inputs['user_id'];
        $filename = $inputs['filename'];
        $data = $inputs['toDataURL'];
        $path = 'upload/user/profile/thumbs/';

        $img = str_replace('data:image/png;base64,', '', $data);
    	$img = str_replace(' ', '+', $img);
    	$data = base64_decode($img);
    	$file = $path . $filename;
        file_put_contents($file, $data);

        $user = $this->find($user_id)->userbasicinfo;
        $user->profilephoto = $filename;
        $user->save();

        return $filename;
    }

    public function save_crop_profile_cover(array $inputs)
    {
        $user_id = $inputs['user_id'];
        $filename = $inputs['filename'];
        $data = $inputs['toDataURL'];
        $path = 'upload/user/cover/original/';

        $img = str_replace('data:image/png;base64,', '', $data);
    	$img = str_replace(' ', '+', $img);
    	$data = base64_decode($img);
    	$file = $path . $filename;
        file_put_contents($file, $data);

        $user = $this->find($user_id)->userbasicinfo;
        $user->coverphoto = $filename;
        $user->save();

        return $filename;
    }

    public function getBloodTypes()
    {
        return DB::table('refbloodtype')->orderBy('id' , 'ASC')->get();
    }

    public function getBloodTypeName($user_id)
    {
        if ($this->find($user_id)->userbasicinfo && $this->find($user_id)->userbasicinfo->bloodtype != '')
        {
            $bloodtype = DB::select(DB::raw('SELECT ub.bloodtype as bloodtype_id,
                                rb.name as bloodtype_name
                                FROM userbasicinfo ub
                                JOIN refbloodtype rb ON rb.id = ub.bloodtype
                                WHERE ub.bloodtype="' . $this->find($user_id)->userbasicinfo->bloodtype . '"'));
            
            if(count($bloodtype) == 0) {
                return "";
            }
            
            return $bloodtype[0]->bloodtype_name;
        }
        else
        {
            return '';
        }
    }

    public function getBirthMonth($user_id)
    {
        return $this->find($user_id)->userbasicinfo ? $this->find($user_id)->userbasicinfo->birthmonth : '0';
    }

    public function getBirthDay($user_id)
    {
        return $this->find($user_id)->userbasicinfo ? $this->find($user_id)->userbasicinfo->birthday : '';
    }

    public function getBirthYear($user_id)
    {
        return $this->find($user_id)->birthyear;
    }

    public function getGender($user_id)
    {
        return $this->find($user_id)->gender;
    }

    public function getReligion($user_id)
    {
        return $this->find($user_id)->userbasicinfo ? $this->find($user_id)->userbasicinfo->religion : '';
    }

    public function getPolitics($user_id)
    {
        return $this->find($user_id)->userbasicinfo ? $this->find($user_id)->userbasicinfo->politics : '';
    }

    public function getCity($user_id)
    {
        return $this->find($user_id)->usercontactinfo ? $this->find($user_id)->usercontactinfo->city : '';
    }

    public function getEducCollege($user_id)
    {
        return $this->find($user_id)->usereduccollege ? $this->find($user_id)->usereduccollege : '';
    }

    public function getEducHighschool($user_id)
    {
        return $this->find($user_id)->usereduchighschool ? $this->find($user_id)->usereduchighschool : '';
    }

    public function getWorkHistory($user_id)
    {
        return $this->find($user_id)->userworkhistory ? $this->find($user_id)->userworkhistory : '';
    }

    public function revert_profile_photo( $photo , $user_id )
    {
        if ($this->find($user_id)->userbasicinfo)
        {
            $user = $this->model->find($user_id)->userbasicinfo;
            $user->profilephoto = $photo;
            $user->save();

            return true;
        }
    }

    public function revert_profile_cover( $photo , $user_id )
    {
        if ($this->find($user_id)->userbasicinfo)
        {
            $user = $this->model->find($user_id)->userbasicinfo;
            $user->coverphoto = $photo;
            $user->save();

            return true;
        }
    }

    public function get_user_birthdetails($user_id)
    {
        try{
            $data = array();
            $basic_info = $this->find($user_id)->userbasicinfo;
            $birthYear = $this->find($user_id)->birthyear;
            if($basic_info && $birthYear){
                $data['birthmonth'] = $basic_info->birthmonth;
                $data['birthday'] = $basic_info->birthday;
                $data['birthyear'] = $birthYear;
                $from = new \DateTime($data['birthyear'].'-'.$data['birthmonth'].'-'.$data['birthday']);
                $to   = new \DateTime('today');
                $data['age'] = $from->diff($to)->y;
            }else if($birthYear && !$basic_info){
                $from = new \DateTime($birthYear.'-00-00');
                $to   = new \DateTime('today');
                $data['age'] = $from->diff($to)->y;
            }
            return $data;
        }catch(Exception $e){
            return [
                'status' => false ,
                'error'  => true ,
                'msg'    => $e->getMessage()
            ];
        }
    }

    public function get_activity_tab_content( $user_id )
    {
        $content = DB::select(DB::raw("SELECT u.id as user_id,
               coalesce(a.total,0) as total_content_viewed,
               coalesce(b.total,0) as total_posts_made,
               (coalesce(c.yaycontent,0) + coalesce(d.yaycomment,0) + coalesce(e.yaytopic,0) + coalesce(f.yaydiscussion,0)) as totalyaysent,
               (coalesce(c.naycontent,0) + coalesce(d.naycomment,0) + coalesce(e.naytopic,0) + coalesce(f.naydiscussion,0)) as totalnaysent,
               coalesce(c.yaycontent,0) as yaycontentsent,
               coalesce(c.naycontent,0) as naycontentsent,
               coalesce(d.yaycomment,0) as yaycommentsent,
               coalesce(d.naycomment,0) as naycommentsent,
               coalesce(e.yaytopic,0) as yaytopicsent,
               coalesce(e.naytopic,0) as naytopicsent,
               coalesce(f.yaydiscussion,0) as yaydiscussionsent,
               coalesce(f.naydiscussion,0) as naydiscussionsent,
               (coalesce(g.yaycontent,0) + coalesce(h.yaycomment,0) + coalesce(i.yaytopic,0) + coalesce(j.yaydiscussion,0)) as totalyayreceived,
               (coalesce(g.naycontent,0) + coalesce(h.naycomment,0) + coalesce(i.naytopic,0) + coalesce(j.naydiscussion,0)) as totalnayreceived,
               coalesce(g.yaycontent,0) as yaycontentreceived,
               coalesce(g.naycontent,0) as naycontentreceived,
               coalesce(h.yaycomment,0) as yaycommentreceived,
               coalesce(h.naycomment,0) as naycommentreceived,
               coalesce(i.yaytopic,0) as yaytopicreceived,
               coalesce(i.naytopic,0) as naytopicreceived,
               coalesce(j.yaydiscussion,0) as yaydiscussionreceived,
               coalesce(j.naydiscussion,0) as naydiscussionreceived
        FROM users u
        LEFT OUTER JOIN (select postcontentview.user_id,
            COUNT(*) total
        FROM postcontentview
        GROUP BY postcontentview.user_id) as a ON a.user_id = u.id
        LEFT OUTER JOIN (select postcontent.user_id,
            COUNT(*) total
        FROM postcontent
        WHERE postcontent.deleted_at IS NULL
        GROUP BY postcontent.user_id) as b ON b.user_id = u.id
        LEFT OUTER JOIN (select pca.postcontent_id, pca.user_id,
            sum(Case when approvalrate = 'Y' then 1 else 0 end) yaycontent,
            sum(Case when approvalrate = 'N' then 1 else 0 end) naycontent
        FROM postcontentapprovalrate pca
        LEFT JOIN postcontent pc ON pc.id=pca.postcontent_id
        WHERE pc.deleted_at IS NULL
        GROUP BY pca.user_id) as c ON c.user_id = u.id
        LEFT OUTER JOIN (select poa.postopinion_id, poa.user_id,
            sum(Case when approvalrate = 'Y' then 1 else 0 end) yaycomment,
            sum(Case when approvalrate = 'N' then 1 else 0 end) naycomment
        FROM postopinionapprovalrate poa
        LEFT JOIN postopinion po ON po.id = poa.postopinion_id
        LEFT JOIN postcontent pc ON pc.id=po.postcontent_id
        WHERE pc.deleted_at IS NULL AND po.deleted_at IS NULL
        GROUP BY poa.user_id) as d ON d.user_id = u.id
        LEFT OUTER JOIN (select ta.string_id, ta.user_id,
            sum(Case when approvalrate = 'Y' then 1 else 0 end) yaytopic,
            sum(Case when approvalrate = 'N' then 1 else 0 end) naytopic
        FROM topicapprovalrate ta
        LEFT JOIN topic t ON t.id=ta.string_id
        WHERE t.deleted_at IS NULL
        GROUP BY ta.user_id) as e ON e.user_id = u.id
        LEFT OUTER JOIN (select toa.topicopinion_id, toa.user_id,
            sum(Case when approvalrate = 'Y' then 1 else 0 end) yaydiscussion,
            sum(Case when approvalrate = 'N' then 1 else 0 end) naydiscussion
        FROM topicopinionapprovalrate toa
        LEFT JOIN topicopinion ton ON ton.id = toa.topicopinion_id
        LEFT JOIN topic t ON t.id=ton.topic_id
        WHERE t.deleted_at IS NULL AND ton.deleted_at IS NULL
        GROUP BY toa.user_id) as f ON f.user_id = u.id
        LEFT OUTER JOIN (select pca.postcontent_id, pc.user_id,
            sum(Case when approvalrate = 'Y' then 1 else 0 end) yaycontent,
            sum(Case when approvalrate = 'N' then 1 else 0 end) naycontent
        FROM postcontentapprovalrate pca
        LEFT JOIN postcontent pc ON pc.id=pca.postcontent_id
        WHERE pc.deleted_at IS NULL
        GROUP BY pc.user_id) as g ON g.user_id = u.id
        LEFT OUTER JOIN (select poa.postopinion_id, po.user_id,
            sum(Case when approvalrate = 'Y' then 1 else 0 end) yaycomment,
            sum(Case when approvalrate = 'N' then 1 else 0 end) naycomment
        FROM postopinionapprovalrate poa
        LEFT JOIN postopinion po ON po.id = poa.postopinion_id
        LEFT JOIN postcontent pc ON pc.id=po.postcontent_id
        WHERE pc.deleted_at IS NULL AND po.deleted_at IS NULL
        GROUP BY po.user_id) as h ON h.user_id = u.id
        LEFT OUTER JOIN (select ta.string_id, t.user_id,
            sum(Case when approvalrate = 'Y' then 1 else 0 end) yaytopic,
            sum(Case when approvalrate = 'N' then 1 else 0 end) naytopic
        FROM topicapprovalrate ta
        LEFT JOIN topic t ON t.id=ta.string_id
        WHERE t.deleted_at IS NULL
        GROUP BY t.user_id) as i ON i.user_id = u.id
        LEFT OUTER JOIN (select toa.topicopinion_id, ton.user_id,
            sum(Case when approvalrate = 'Y' then 1 else 0 end) yaydiscussion,
            sum(Case when approvalrate = 'N' then 1 else 0 end) naydiscussion
        FROM topicopinionapprovalrate toa
        LEFT JOIN topicopinion ton ON ton.id = toa.topicopinion_id
        LEFT JOIN topic t ON t.id=ton.topic_id
        WHERE t.deleted_at IS NULL AND ton.deleted_at IS NULL
        GROUP BY ton.user_id) as j ON j.user_id = u.id
        WHERE u.id=" . $user_id));

        return $content;
    }

    public function get_comments_tab_content( $user_id ) {
        $content = DB::select(DB::raw("SELECT u.id as user_id,
                   coalesce(d.totalanswer,0) as countanswers,
                   coalesce(d.totalcomment,0) as countcomments,
                   coalesce(d.total,0) as totalopinion,
                   coalesce(e.total,0) as totalbestanswer
            FROM users u
            LEFT OUTER JOIN(SELECT po.user_id,
                   sum(Case when pc.type = 'Q' then 1 else 0 end) totalanswer,
                   sum(Case when pc.type <> 'Q' then 1 else 0 end)totalcomment,
                   count(*) total
            FROM postopinion po
            LEFT JOIN postcontent pc ON pc.id = po.postcontent_id
            WHERE po.deleted_at IS NULL
            GROUP BY po.user_id) as d ON d.user_id = u.id
            LEFT OUTER JOIN(SELECT pb.postopinion_id, po1.user_id,
                   count(*) total
            FROM postopinionbestanswer pb
            LEFT JOIN postopinion po1 ON po1.id = pb.postopinion_id
            WHERE po1.deleted_at IS NULL
            GROUP BY po1.user_id) as e ON e.user_id = u.id
            WHERE u.id=" . $user_id));

        return $content;
    }

    public function get_comments_and_answers( $user_id ) {
        $content = DB::select(DB::raw('SELECT a.postcontent_id as contenttopic_id , 
                           a.id as commentid, 
                           a.content as comment,  
                           a.created_at,
                           pc.mask as owner_mask,
                           case pc.mask
                                when 1 then pc.maskname
                                else CONCAT(u.first_name, " ", u.last_name)
                           end "owner_name",
                           pc.user_id as owner_userid,
                           u.profile_code as owner_profilecode,
                           case pc.type
                                when "T" then "text"
                                when "F" then "image"
                                when "K" then "link"
                                when "Q" then "question"
                                when "A" then "article"
                                when "L" then "list"
                                when "N" then "list"
                                when "P" then "list"
                           end "contenttype",
                           "" as slug,
                           "content" as commenttype,
                           "" as title,
                           case 
                                when uf2.status=1 then "1"
                                when uf2.status=0 then "2"
                                when uf3.status=0 then "3"    
                                else "4"
                           end "friend_status",
                           case
                                when ua.status=1 then 
                                    case ua2.status
                                      when 1 then "6"
                                      else "1"
                                    end
                                when ua.status=0 then "2"
                                when ua2.status=1 then "3"
                                when ua2.status=0 then "4"    
                                else "5"
                           end "following_status"
                    FROM postopinion as a
                    LEFT JOIN postcontent pc ON pc.id = a.postcontent_id 
                    LEFT JOIN users as u ON u.id = pc.user_id
                    LEFT JOIN userbasicinfo as ub ON ub.user_id = u.id
                    LEFT JOIN useracquiantances ua on ua.user_one_id = pc.user_id
                    AND ua.user_two_id = ' . $user_id . '
                    LEFT JOIN useracquiantances ua2 on ua2.user_one_id = ' . $user_id . ' 
                    AND ua2.user_two_id = pc.user_id
                    LEFT JOIN userfriends uf2 on uf2.user_one_id = pc.user_id 
                    AND uf2.user_two_id = ' . $user_id . '
                    LEFT JOIN userfriends uf3 ON uf3.user_one_id=' . $user_id . ' 
                    AND uf3.user_two_id=pc.user_id
                    WHERE a.user_id = ' . $user_id . ' AND a.deleted_at IS NULL AND a.mask=0
                    UNION
                    SELECT b.topic_id as contenttopic_id , 
                           b.id as commentid, 
                           b.content as comment,  
                           b.created_at,
                           t.mask as owner_mask,
                           case t.mask
                                when 1 then u2.maskname
                                else CONCAT(u2.first_name, " ", u2.last_name)
                           end "owner_name",
                           t.user_id as owner_userid,
                           u2.profile_code as owner_profilecode,
                           "" as contenttype,
                           t.slug as slug,
                           "string" as commenttype,
                           t.title as title,
                           case 
                                when uf2.status=1 then "1"
                                when uf2.status=0 then "2"
                                when uf3.status=0 then "3"    
                                else "4"
                           end "friend_status",
                           case
                                when ua.status=1 then 
                                    case ua2.status
                                      when 1 then "6"
                                      else "1"
                                    end
                                when ua.status=0 then "2"
                                when ua2.status=1 then "3"
                                when ua2.status=0 then "4"    
                                else "5"
                           end "following_status"
                    FROM topicopinion as b
                    LEFT JOIN topic t ON t.id = b.topic_id 
                    LEFT JOIN users as u2 ON u2.id = t.user_id
                    LEFT JOIN userbasicinfo as ub2 ON ub2.user_id = u2.id
                    LEFT JOIN useracquiantances ua on ua.user_one_id = t.user_id
                    AND ua.user_two_id = ' . $user_id . '
                    LEFT JOIN useracquiantances ua2 on ua2.user_one_id = ' . $user_id . ' 
                    AND ua2.user_two_id = t.user_id
                    LEFT JOIN userfriends uf2 on uf2.user_one_id = t.user_id
                    AND uf2.user_two_id = ' . $user_id . '
                    LEFT JOIN userfriends uf3 ON uf3.user_one_id=' . $user_id . ' 
                    AND uf3.user_two_id=t.user_id
                    WHERE b.user_id = ' . $user_id . ' AND b.deleted_at IS NULL AND b.mask=0
                    ORDER BY created_at DESC
                    LIMIT 50'));

        return $content;
    }

    public function get_count_profile_views( $user_id ) {
        $content = DB::select(DB::raw("SELECT count(*) as totalview 
                FROM userprofileview
                WHERE profile_userid=" . $user_id));

        return $content;
    }

    public function get_profile_viewers( $activelogin_userid , $owner_profile_userid ) {
        $content = DB::select(DB::raw('SELECT upv.viewer_userid,
                   u.profile_code,
                   u.first_name,
                   u.last_name,
                   ub.profilephoto,
                   upv.date,
                   case 
                        when uf2.status=1 then "1"
                        when uf2.status=0 then "2"
                        when uf3.status=0 then "3"    
                        else "4"
                   end "friend_status",
                   case
                        when ua.status=1 then "1"
                        when ua.status=0 then "2"
                        when ua2.status=1 then "3"
                        when ua2.status=0 then "4"    
                        else "5"
                   end "following_status"
            FROM userprofileview upv
            LEFT JOIN users u ON u.id = upv.viewer_userid
            LEFT JOIN userbasicinfo ub ON ub.user_id = upv.viewer_userid
            LEFT JOIN useracquiantances ua on ua.user_one_id = upv.viewer_userid 
            AND ua.user_two_id = ' . $activelogin_userid . '
            LEFT JOIN useracquiantances ua2 on ua2.user_one_id = ' . $activelogin_userid . ' 
            AND ua2.user_two_id = upv.viewer_userid
            LEFT JOIN userfriends uf2 on uf2.user_one_id = upv.viewer_userid 
            AND uf2.user_two_id = ' . $activelogin_userid . '
            LEFT JOIN userfriends uf3 ON uf3.user_one_id=' . $activelogin_userid . ' 
            AND uf3.user_two_id=upv.viewer_userid
            WHERE upv.profile_userid=' . $owner_profile_userid . '
            ORDER BY date DESC'));

        return $content;
    }

    public function save_profile_views($user_id)
    {
        if ($user_id != \Sentinel::getUser()->id)
        {
            $profile_userid = \Sentinel::getUser()->id;

            $result = DB::table('userprofileview')->where('viewer_userid' , $profile_userid)->where('profile_userid' , $user_id)->orderBy('id' , 'DESC')->first();

            if (empty($result))
            {
                DB::table('userprofileview')->insert(
                    ['viewer_userid' => $profile_userid , 'profile_userid' => $user_id , 'date' => date('Y-m-d H:i:s')]
                );
            }
            else
            {
                $last_view_date = strtotime($result->date);

                if ($last_view_date <= strtotime('-1 hours')) {
                    DB::table('userprofileview')->insert(
                        ['viewer_userid' => $profile_userid , 'profile_userid' => $user_id , 'date' => date('Y-m-d H:i:s')]
                    );
                }
            }

            return $result;
        }
    }

    public function skip_modal($user_id) {

   
        $_user = $this->model->where("id" , $user_id)->first();
        $_user->new = 0;
        $_user->save();

        return ['status' => true, 'user_id' => $user_id];

    }

}
