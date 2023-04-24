<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'height',
        'chest_size',
        'waist_size',
        'hips_size',
        'english',
        'german',
        'french',
        'another_lang',
        'catering_exp',
        'modelling_exp',
        'cashier_exp',
        'entrance_exp',
        'infodesk_exp',
        'birthdate',
        'state',
        'city',
        'street',
        'cis_pop',
        'psc'
    ];

    public function user(){
        return $this -> belongsTo(User::class);
    }
}
