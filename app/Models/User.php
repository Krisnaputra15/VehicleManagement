<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * 
 * @property string $id
 * @property string $fullname
 * @property string $email
 * @property string $password
 * @property string $level
 * @property string $position
 * @property Carbon|null $email_verified_at
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Approvation[] $approvations
 * @property Collection|Transaction[] $transactions
 *
 * @package App\Models
 */
class User extends Authenticatable
{
	use HasUuids;
	protected $table = 'users';
	public $incrementing = false;

	protected $casts = [
		'email_verified_at' => 'datetime'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'fullname',
		'email',
		'password',
		'level',
		'position',
		'email_verified_at',
		'remember_token'
	];

	public function approvations()
	{
		return $this->hasMany(Approvation::class, 'approver_id', 'id');
	}

	public function transactions()
	{
		return $this->hasMany(Transaction::class, 'driver_id', 'id');
	}
}
