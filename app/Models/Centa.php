<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Centa extends Model {
	protected $table = 'centa';
	protected $primaryKey = 'id';

	protected $fillable = [
		'user_id',
		'name',
		'branch_id',
	];

	public function user() {
		return $this->hasOne( User::class, 'id', 'user_id');
	}
	public function branch() {
		return $this->hasOne( Branch::class, 'id', 'branch_id');
	}
	
}
