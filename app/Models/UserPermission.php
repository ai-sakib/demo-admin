<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model {
	protected $table = 'user_permissions';
	protected $primaryKey = 'id';

	protected $fillable = [
		'user_id',
		'permission_id',
	];

	public function category() {
		return $this->hasOne( ItemCategories::class, 'id', 'category_id');
	}
	public function creator() {
		return $this->hasOne( \App\User::class, 'id', 'created_by');
	}
	public function updator() {
		return $this->hasOne( \App\User::class, 'id', 'updated_by');
	}
	
}
