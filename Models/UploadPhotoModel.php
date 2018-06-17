<?php
namespace Modular\Forms\Profile\Models;

use Illuminate\Database\Eloquent\Model;

class UploadPhotoModel extends Model {

	protected $fillable = ['user_id' , 'filename' , 'filesize' , 'hits' , 'approved' , 'position' , 'created_at' , 'updated_at'];

	protected $table = 'uploadphoto';

	protected $guarded = ['id'];

	public $timestamps = false;

	public function user()
	{
		return $this->belongsTo('Modular\Forms\Authentication\Models\RegistrationModel' , 'user_id');
	}
}
