<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public const GENDER_MALE = 'male';
    public const GENDER_FEMALE = 'female';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'name', 'gender', 'height', 'birthdate',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'birthdate'
    ];

    public function getAgeAttribute()
    {
        return Carbon::parse($this->birthdate)->diffInYears();
    }

    /**
     * Returns the current weight of the user
     *
     * @return mixed
     */
    public function getWeightAttribute(): float
    {
        return (float) $this->weights()->latest()->first()->weight;
    }

    /**
     * Sets the gender of an user
     *
     * @param string $gender
     *
     * @return void
     *
     * @throws \InvalidArgumentException
     */
    public function setGenderAttribute(string $gender): void
    {
        if (!in_array($gender, [self::GENDER_MALE, self::GENDER_FEMALE])) {
            throw new \InvalidArgumentException('Unknown gender');
        }

        $this->gender = $gender;
    }

    /**
     * Defines the weights relation of an user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function weights()
    {
        return $this->hasMany(Weight::class);
    }
}
