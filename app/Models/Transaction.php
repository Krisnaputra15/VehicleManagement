<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

/**
 * Class Transaction
 * 
 * @property string $id
 * @property string $driver_id
 * @property string $vehicle_id
 * @property int $booking_duration
 * @property Carbon $booking_start
 * @property Carbon|null $pickup_date
 * @property Carbon|null $return_date
 * @property int|null $distance_traveled
 * @property int|null $fuel_consumed
 * @property bool $is_approved
 * @property bool $is_returned
 * @property string $return_status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 * @property Vehicle $vehicle
 * @property Collection|Approvation[] $approvations
 *
 * @package App\Models
 */
class Transaction extends Model
{
	use HasUuids;
	protected $table = 'transactions';
	public $incrementing = false;

	protected $casts = [
		'booking_duration' => 'int',
		'booking_start' => 'datetime',
		'pickup_date' => 'datetime',
		'return_date' => 'datetime',
		'distance_traveled' => 'int',
		'fuel_consumed' => 'int',
		'is_approved' => 'bool',
		'is_returned' => 'bool'
	];

	protected $fillable = [
		'driver_id',
		'vehicle_id',
		'booking_duration',
		'booking_start',
		'pickup_date',
		'return_date',
		'distance_traveled',
		'fuel_consumed',
		'is_approved',
		'is_returned',
		'return_status'
	];

	
	public function user()
	{
		return $this->belongsTo(User::class, 'driver_id', 'id');
	}

	public function vehicle()
	{
		return $this->belongsTo(Vehicle::class, 'vehicle_id', 'id');
	}

	public function approvations()
	{
		return $this->hasMany(Approvation::class, 'approver_id', 'id');
	}
}
