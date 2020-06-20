<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model {
	protected $table = 'user_roles';
	protected $primaryKey = 'id';

	protected $fillable = [
		'role_id',
		'user_id',
	];

	public function role() {
        return $this->hasOne( Role::class, 'id', 'role_id');
    }
	
}
