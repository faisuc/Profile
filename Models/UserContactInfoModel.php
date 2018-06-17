<?php
namespace Modular\Forms\Profile\Models;

use Illuminate\Database\Eloquent\Model;

class UserContactInfoModel extends Model {

	protected $fillable = ['user_id' , 'phonenum1' , 'phonenum2' , 'phonenum3' , 'city' , 'country' , 'email1' , 'email2' , 'email3' , 'webtitle1' , 'weblink1' , 'webtitle2' , 'weblink2' , 'webtitle3' , 'weblink3' , 'created_at' , 'updated_at'];

	protected $table = 'usercontactinfo';

	protected $guarded = ['id'];

	public $timestamps = false;

	public function user()
	{
		return $this->belongsTo('Modular\Forms\Authentication\Models\RegistrationModel' , 'user_id');
	}
}
