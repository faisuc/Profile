<?php
namespace Modular\Forms\Profile\Models;

use Illuminate\Database\Eloquent\Model;

class UserWorkHistoryModel extends Model {

	protected $fillable = ['user_id' , 'companyname' , 'position' , 'location' , 'yearstarted' , 'yearended' , 'city' , 'currentwork' , 'created_at' , 'updated_at'];

	protected $table = 'userworkhistory';

	protected $guarded = ['id'];

	public $timestamps = false;

	public function user()
	{
		return $this->belongsTo('Modular\Forms\Authentication\Models\RegistrationModel' , 'user_id');
	}
}
