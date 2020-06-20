<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model {
	protected $table = 'branches';
	protected $primaryKey = 'id';

	protected $fillable = [
		'user_id',
		'name',
	];

	public function user() {
		return $this->hasOne( User::class, 'id', 'user_id');
	}
	
}
