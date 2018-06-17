<?php
namespace Modular\Forms\Profile\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfileSettingsModel extends Model {

	protected $fillable = [
	    "user_id",
        "bio",
        "address",
        "gender",
        "birthdate",
        "religion",
        "political_view",
        "blood_type",
        "contacts",
        "credentials",
        "links",
        "favorite_strings",
        "created_strings",
        "followed_strings",
        "top_tags",
        "profile_feed",
        "comment_tab",
        "friends",
        "following",
        "followers",
        "image_tab",
        "created_at",
        "updated_at"
    ];

	protected $table = 'userprofilesettings';

	protected $guarded = ['id'];

	public function user()
	{
		return $this->belongsTo('Modular\Forms\Authentication\Models\RegistrationModel' , 'user_id');
	}
}
