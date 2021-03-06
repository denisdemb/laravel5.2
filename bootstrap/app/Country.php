<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Traits\OrderableModel;

class Country extends Model
{
	use OrderableModel;

	protected $fillable = ['title', 'test'];

	protected $hidden = [
		'created_at',
		'updated_at'
	];

	public function contacts()
	{
		return $this->hasMany('\App\Contact');
	}

	public function getOrderField()
	{
		return 'order';
	}

}