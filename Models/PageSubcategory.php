<?php
namespace Modular\Forms\Profile\Models;

use Illuminate\Database\Eloquent\Model;

class PageSubcategoryModel extends Model {

	protected $fillable = ['maincategory_id' , 'name' , 'created_at' , 'updated_at'];

	protected $table = 'pagesubcategory';

	protected $guarded = ['id'];

	public $timestamps = false;

	public function user()
	{
		return $this->belongsTo('Modular\Forms\Authentication\Models\RegistrationModel' , 'user_id');
	}
}