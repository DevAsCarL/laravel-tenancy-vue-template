<?php

namespace App\Models\Tenant;

use Hyn\Tenancy\Abstracts\TenantModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class User extends TenantModel implements Authenticatable
{
    use AuthenticatableTrait;

    protected $fillable = [
        'person_id',
        'username',
    ];

    protected $hidden = [
        'password',
        'remember_token',
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
            get: fn () => \trim($this->first_name . ' ' . $this->last_name),
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

    /*public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasRole(Role::ADMIN->value);
    }*/

    public function getFilamentName(): string
    {
        return $this->fullName;
    }

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }
}
