<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    
    public $timestamps = false;
    protected $attributes = array(
        'visible' => true
      );
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    public function getIdByEmail(String $email)
    {
        return $this->select('id')->where('email', $email)->first()->id;
    }

    public static function changeVisible($memberId, $visibleValue)
    {
        self::where('id', $memberId)->update(['visible' => $visibleValue]);
    }

}
