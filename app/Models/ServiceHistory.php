<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

/**
 * Class ServiceHistory
 * 
 * @property string $id
 * @property string $vehicle_id
 * @property string $service_desc
 * @property Carbon $service_date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Vehicle $vehicle
 *
 * @package App\Models
 */
class ServiceHistory extends Model
{
	use HasUuids;
	protected $table = 'service_histories';
	public $incrementing = false;

	protected $casts = [
		'service_date' => 'datetime',
		'price' => 'int',
		'serviced_at_km' => 'int',
	];

	protected $fillable = [
		'vehicle_id',
		'service_desc',
		'service_date',
		'serviced_at_km',
		'price'
	];

	public function vehicle()
	{
		return $this->belongsTo(Vehicle::class, 'vehicle_id', 'id');
	}
}
