<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class TenantScope implements Scope
{

    /**
     * @inheritDoc
     */
    public function apply(Builder $builder, Model $model): void
    {
        //only apply the scope if a gym has been resolved for this request
        if (app()->has('current_gym_id')){
            $builder->where(
                $model->getTable(). '.gym_id',
                app('current_gym_id')
            );
        }
    }
}
