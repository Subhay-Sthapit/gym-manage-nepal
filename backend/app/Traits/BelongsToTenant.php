<?php

namespace App\Traits;

use App\Models\Gym;
use App\Scopes\TenantScope;

trait BelongsToTenant
{
    public static function bootBelongsToTenant(): void
    {
        // Automatically apply the tenant scope to all queries
        static::addGlobalScope(new TenantScope());

        // Automatically fill gym_id when creating a new record
        static::creating(function ($model) {
            if(app()->has('current_gym_id') && empty($model->gym_id)) {
                $model->gym_id = app('current_gym_id');
            }
        });
    }

    public function gym()
    {
        return $this->belongsTo(Gym::class);
    }

}
