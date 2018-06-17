<?php
Route::group(['middleware' => ['web','authVerify' , 'cors'], 'namespace' => 'Modular\Forms\Settings\Controllers'] , function(){
    Route::group(['prefix' => 'user'] , function(){
        Route::get('/settings' , [
            'as'    => 'route.settings' ,
            'uses'  => 'SettingsController@index'
        ]);

        Route::post('/settings/save/{type}', 'SettingsController@save');
        Route::post('/settings/upload/mask', 'SettingsController@upload_mask');

        Route::get('/settings/mask/status' , 'SettingsController@get_mask_status');
        Route::get('/settings/mask/set' , 'SettingsController@set_mask_status');

        Route::get('/settings/mask/toggle' , 'SettingsController@set_mask_toggle');

        Route::post('/settings/save/crop/mask' , 'SettingsController@set_crop_mask_image');
        Route::post('/settings/profile' , 'SettingsController@profile_settings');
    });
});
/* ==================
New Profile Routes Namespace
================== */
Route::group(['middleware' => ['web','authVerify' , 'cors'], 'namespace' => 'Modular\Forms\Profile\Controllers'] , function(){
    Route::get('/user/{id}' , [
            'as'    => 'route.profile' ,
            'uses'  => 'ProfileDefaultController@index'
    ]);
//    Route::get('/user/{id}' , [
//            'as'    => 'route.profile' ,
//            'uses'  => 'ProfileController@index'
//    ]);
    
    Route::post('/profile/save-info' , [
            'as'    => 'route.save-info' ,
            'uses'  => 'ProfileDefaultController@save_profile_info'
    ]);
    
    Route::post('/profile/update-info' , [
            'as'    => 'route.update-info' ,
            'uses'  => 'ProfileDefaultController@update_profile_info'
    ]);
    
    Route::group(['prefix' => 'profile/upload/'] , function(){
        Route::post('primary' , [
            'as'    => 'route.profile-upload-primary' ,
            'uses'  => 'ProfileDefaultController@upload_primary_photo'
        ]);
        Route::post('primary-crop' , [
		'uses' => 'ProfileDefaultController@upload_crop_primary_photo'
	]);
        Route::post('cover-photo' , [
            'as'    => 'route.profile-upload-cover' ,
            'uses'  => 'ProfileDefaultController@upload_cover_photo'
        ]);
    });
    
    Route::group(['prefix' => 'profile/comments/'] , function(){
        Route::get('list', 'ProfileDefaultController@get_comments_list');
        Route::get('replies', 'ProfileDefaultController@get_replies_list');
    });
    
    Route::group(['prefix' => 'profile/connection/'] , function(){
        Route::post('users' , [
            'as'    => 'route.profile-connection-friend' ,
            'uses'  => 'ProfileDefaultController@set_connections_users'
        ]);
        Route::get('recount', 'ProfileDefaultController@recount_connections_list');
        Route::get('list', 'ProfileDefaultController@load_connections_list');
        Route::get('remove', 'ProfileDefaultController@remove_connections_list');
    });
    
    Route::group(['prefix' => 'profile/images/'] , function(){
        Route::get('list', 'ProfileDefaultController@load_images_list');
    });
    
    Route::group(['prefix' => 'profile/about/'] , function(){
        Route::get('personal/{profile_code}', 'ProfileDefaultController@load_about_personal');
        Route::get('credentials/{profile_code}', 'ProfileDefaultController@load_about_credentials');
        Route::get('credentials-selector/{profile_code}', 'ProfileDefaultController@load_about_credentials_selector');
        Route::get('links/{profile_code}', 'ProfileDefaultController@load_about_links');
        
        Route::get('option/{profile_code}', 'ProfileDefaultController@load_option');
    });
    
    Route::group(['prefix' => 'profile/strings/'] , function(){
        Route::get('load-favorites-header/{profile_code}', 'ProfileDefaultController@load_favorite_strings_header');
        Route::get('load-favorites/{profile_code}', 'ProfileDefaultController@load_favorite_strings');
        Route::get('strings-favorite', 'ProfileDefaultController@strings_favorite');
    });
    
    Route::group(['prefix' => 'profile/search/'] , function(){
        Route::get('favorite-strings', 'ProfileDefaultController@search_favorite_strings');
    });
});
/* ==================
END New Profile Routes Namespace
================== */


Route::group(['middleware' => ['web','authVerify' , 'cors'], 'namespace' => 'Modular\Forms\Badges\Controllers'] , function(){
	Route::group(['prefix' => 'user'] , function(){
		Route::get('/badge' , [
			'as'    => 'route.badges' ,
			'uses'  => 'BadgesController@index'
		]);
	});
});


Route::group(['middleware' => ['web','authVerify' , 'cors'], 'namespace' => 'Modular\Forms\Invitation\Controllers'] , function(){
	Route::group(['prefix' => 'user'] , function(){
		Route::get('/invitation' , [
			'as'    => 'route.invitation' ,
			'uses'  => 'InvitationController@index'
		]);
	});
});


/* ==================
Profile Routes Namespace
================== */
Route::group(['middleware' => ['web','authVerify' , 'cors'], 'namespace' => 'Modular\Forms\Profile\Controllers'] , function(){

	Route::post('/skip-modal' , 'ProfileController@skip_modal');
	
	Route::get('/user' , [
		'as'    => 'route.profilenew' ,
		'uses'  => 'ProfileController@profile'
	]);

	Route::post('/update/account/settings' , [
		'uses'	=> 'ProfileController@updateAccountSettings'
	]);

	Route::group(['prefix' => 'web/upload/'] , function()
	{
		Route::post('profile/photo' , [
			'as'	=> 'route.uploadProfilePhoto' ,
			'uses'	=> 'ProfileController@uploadProfilePhoto'
		]);

		Route::post('cover/photo' , [
			'as'	=> 'route.uploadCoverPhoto' ,
			'uses'	=> 'ProfileController@uploadCoverPhoto'
		]);

		Route::post('mask/photo' , [
			'as' => 'route.uploadMaskPhoto' ,
			'uses' => 'ProfileController@uploadMaskPhoto'
		]);

		Route::post('profile/photos' , [
			'as' 		=> 'route.uploadPhotos' ,
			'uses'	=> 'ProfileController@uploadPhotos'
		]);
	});

	Route::post('/revert_profile_photo' , [
		'as' => 'route.revert_profile_photo' ,
		'uses' => 'ProfileController@revert_profile_photo'
	]);

	Route::post('/revert_profile_cover' , [
		'as' => 'route.revert_profile_cover' ,
		'uses' => 'ProfileController@revert_profile_cover'
	]);

	Route::post('/save_photos' , [
		'uses' => 'ProfileController@save_photos'
	]);

//	Route::post('/save/crop/profile/image' , [
//		'uses' => 'ProfileController@save_crop_profile_image'
//	]);

	Route::post('/save/crop/profile/cover' , [
		'uses' => 'ProfileController@save_crop_profile_cover'
	]);

	Route::get('/get/photos/' , [
		'uses' => 'ProfileController@getPhotos'
	]);

	Route::get('/get/about/information' , [
		'uses'	=> 'ProfileController@get_about_information'
	]);

	Route::get('/layout/profile/private' , [
		'as'   => 'route.privateprofile' ,
		'uses' => 'ProfileController@private_profile'
	]);

	Route::get('/layout/user-profile' , [
		'as'   => 'route.userprofile' ,
		'uses' => 'ProfileController@user_profile'
	]);

	Route::get('/get/connections/lists' , [
		'uses' => 'ProfileController@get_connections_lists'
	]);

	Route::get('/profile/get/strings' , [
		'uses' => 'ProfileController@get_strings'
	]);

	Route::get('/layout/user_profile-private' , [
		'as'   => 'route.userprofileprivate' ,
		'uses' => 'ProfileController@user_profile_private'
	]);

	Route::get('/get/created/strings' , [
		'uses' => 'ProfileController@get_created_strings'
	]);

	Route::get('/get/tracked/strings' , [
		'uses' => 'ProfileController@get_tracked_strings'
	]);

	/**
	 * API
	 */
	Route::group(['prefix' => 'profile/connections/'] , function(){
		Route::get('/friend' , 'ProfileApiController@friend_user');
		Route::get('/acquaintances' , 'ProfileApiController@acquaintance_user');
		Route::get('/track' , 'ProfileApiController@track_user');
	});
        
        
});

Route::group(['middleware' => ['web','authVerify' , 'cors'], 'namespace' => 'Modular\Forms\Notifications\Controllers'] , function(){

	Route::get('/notifications' , [
		'uses'  => 'NotificationController@index'
	]);

	Route::get('/load/user/notifications' , [
		'uses' => 'NotificationController@load_user_notifications'
	]);

	Route::get('/check/notification/lists' , [
		'uses' => 'NotificationController@check_user_notification_lists'
	]);

	Route::get('/get/dedicated/notifications', [
		'uses' => 'NotificationController@get_dedicated_notifications'
	]);

	Route::group(['prefix' => 'notify'] , function()
	{
		Route::post('/comments/add' , [
			'uses' => 'NotificationController@notify_comments_add'
		]);
		Route::post('/comments/reply/add' , [
			'uses' => 'NotificationController@notify_comments_reply_add'
		]);
		Route::post('/posts/approval/rate' , [
			'uses' => 'NotificationController@notify_posts_approval_rate'
		]);
		Route::post('/posts/comment/approval/rate' , [
			'uses' => 'NotificationController@notify_posts_comment_approval_rate'
		]);

		Route::post('/opinion/add' , [
			'uses' => 'NotificationController@notify_opinion_add'
		]);
		Route::post('/opinion/reply/add' , [
			'uses' => 'NotificationController@notify_opinion_reply_add'
		]);

		Route::post('/topic/comment/approval/rate' , [
			'uses' => 'NotificationController@notify_topic_comment_approval_rate'
		]);
	});
	
	Route::post('/read/notification/lists' , [
		'uses' => 'NotificationController@read_notification_lists'
	]);

    Route::resource('notifications' , 'NotificationController');
});

