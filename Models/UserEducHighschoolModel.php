<?php
namespace Modular\Forms\Profile\Models;

use Illuminate\Database\Eloquent\Model;

class UserEducHighschoolModel extends Model {

	protected $fillable = ['user_id' , 'schoolname' , 'location' , 'yearstarted' , 'yearended' , 'graduated' , 'created_at' , 'updated_at'];

	protected $table = 'usereduchighschool';

	protected $guarded = ['id'];

	public $timestamps = false;

	public function user()
	{
		return $this->belongsTo('Modular\Forms\Authentication\Models\RegistrationModel' , 'user_id');
	}
}
