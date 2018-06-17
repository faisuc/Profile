<?php
namespace Modular\Forms\Profile\Repositories;

use Modular\Repositories\EloquentInterface;

interface ProfileInterface extends EloquentInterface {
	/**
     * Store Post Content
     * @param array $data
	 * @return data
     */
    public function store(array $data);
    
	
}