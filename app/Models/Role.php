<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {
	protected $table = 'roles';
	protected $primaryKey = 'id';

	protected $fillable = [
		'slug',
		'name',
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
