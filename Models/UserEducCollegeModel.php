<?php
namespace Modular\Forms\Profile\Models;

use Illuminate\Database\Eloquent\Model;

class UserEducCollegeModel extends Model {

	protected $fillable = ['user_id' , 'schoolname' , 'course' , 'location' , 'yearstarted' , 'yearended' , 'graduated' , 'created_at' , 'updated_at'];

	protected $table = 'usereduccollege';

	protected $guarded = ['id'];

	public $timestamps = false;

	public function user()
	{
		return $this->belongsTo('Modular\Forms\Authentication\Models\RegistrationModel' , 'user_id');
	}
}