<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

/**
 * Class Approvation
 * 
 * @property string $id
 * @property string $approver_id
 * @property string $transaction_id
 * @property bool $is_approved
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 * @property Transaction $transaction
 *
 * @package App\Models
 */
class Approvation extends Model
{
	use HasUuids;
	protected $table = 'approvations';
	public $incrementing = false;

	protected $casts = [
		'is_approved' => 'bool'
	];

	protected $fillable = [
		'approver_id',
		'transaction_id',
		'is_approved'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'approver_id', 'id');
	}

	public function transaction()
	{
		return $this->belongsTo(Transaction::class, 'transaction_id', 'id');
	}
}
