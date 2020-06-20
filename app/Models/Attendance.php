<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model {
	protected $table = 'attendance';
	protected $primaryKey = 'id';

	protected $fillable = [
		'centa_id',
		'watch_party',
		'total_attendance',
		'first_timers',
		'new_believers',
		'testimonies',
		'date',
	];

	public function centa() {
		return $this->hasOne( Centa::class, 'id', 'centa_id');
	}
	
}
