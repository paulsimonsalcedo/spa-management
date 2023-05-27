<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, UsesUuid, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'spa_id',
        'firstname',
        'middlename',
        'lastname',
        'email',
        'username',
        'mobile_number',
        'date_of_birth',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function adminlte_image()
    {
        return asset('vendor/adminlte/dist/img/user2-160x160.jpg');
    }

    public function adminlte_desc()
    {
        return auth()->user()->fullname;
    }

    public function adminlte_profile_url()
    {
        return 'profile/username';
    }

    public function getFullNameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }

    public function owner()
    {
        return $this->hasOne(Owner::class);
    }

    public function therapist()
    {
        return $this->hasOne(Therapist::class);
    }

    public function spa()
    {
        return $this->belongsTo(Spa::class);
    }
    public function employee()
    {
        return $this->hasMany(EmployeeTable::class);
    }
    public function shift()
    {
        return $this->hasMany(Shift::class);
    }
    
}
