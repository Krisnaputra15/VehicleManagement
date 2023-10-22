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
 * Class Vehicle
 * 
 * @property string $id
 * @property string $type
 * @property string $serie
 * @property string $license_number
 * @property int $fuel_capacity
 * @property int $service_cycle
 * @property bool $need_service
 * @property bool $is_booked
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|ServiceHistory[] $service_histories
 * @property Collection|Transaction[] $transactions
 *
 * @package App\Models
 */
class Vehicle extends Model
{
	use HasUuids;
	protected $table = 'vehicles';
	public $incrementing = false;

	protected $casts = [
		'year' => 'int',
		'fuel_capacity' => 'int',
		'service_cycle' => 'int',
		'need_service' => 'bool',
		'is_booked' => 'bool'
	];

	protected $fillable = [
		'type',
		'serie',
		'year',
		'license_number',
		'fuel_capacity',
		'service_cycle',
		'need_service',
		'is_booked'
	];

	public function service_histories()
	{
		return $this->hasMany(ServiceHistory::class, 'service_id', 'id');
	}

	public function transactions()
	{
		return $this->hasMany(Transaction::class, 'transaction_id', 'id');
	}
}
