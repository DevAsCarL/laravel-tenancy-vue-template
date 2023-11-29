<?php

namespace App\Models\System;

use App\Enums\Role;
use Filament\Tables\Columns\Layout\Panel;
use Hyn\Tenancy\Abstracts\SystemModel;
use Hyn\Tenancy\Traits\UsesSystemConnection;
use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;

class User extends SystemModel implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, UsesSystemConnection, HasFactory, HasRoles;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $fillable = [
        'last_name',
        'email',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Hash::make($value),
        );
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => \trim($this->first_name.' '.$this->last_name),
        );
    }

    protected function allPermissions(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getAllPermissions()->pluck('name')
        );
    }

    public function organisations()
    {
        return $this->hasMany(Organisation::class);
    }

    public function currentOrganisation()
    {
        return $this->belongsTo(Organisation::class);
    }

    public function updatePassword(?string $new_password = '')
    {
        if ($new_password && $new_password != $this->password) {
            $this->password = $new_password;

            $this->save();
        }
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasRole(Role::ADMIN->value);
    }

    public function getFilamentName(): string
    {
        return $this->fullName;
    }
}
