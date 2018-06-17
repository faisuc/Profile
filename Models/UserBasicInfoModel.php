<?php
namespace Modular\Forms\Profile\Models;

use Illuminate\Database\Eloquent\Model;

class UserBasicInfoModel extends Model {

	protected $fillable = ['user_id' , 'middlename' , 'nickname' , 'birthmonth' , 'birthday', 'bloodtype' , 'religion' , 'politics' , 'profilephoto' , 'coverphoto' , 'created_at' , 'updated_at'];

	protected $table = 'userbasicinfo';

	protected $guarded = ['id'];

	public $timestamps = false;

	public function user()
	{
		return $this->belongsTo('Modular\Forms\Authentication\Models\RegistrationModel' , 'user_id');
	}
}