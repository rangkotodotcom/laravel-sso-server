<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\SoftDeletes;

trait Blameable
{
    public static function bootBlameable()
    {
        static::creating(function ($model) {
            if (empty($model->created_by)) {
                $model->created_by = self::getBlameableUsername();
            }
        });

        static::updating(function ($model) {
            $model->updated_by = self::getBlameableUsername();
        });

        static::deleting(function ($model) {
            if (method_exists($model, 'isForceDeleting') && !$model->isForceDeleting()) {
                // Soft delete
                $model->deleted_by = self::getBlameableUsername();
                $model->save();
            } else {
                // Force delete, no deleted_by needed
            }
        });

        // Register restoring only if SoftDeletes is used
        if (in_array(SoftDeletes::class, class_uses_recursive(static::class))) {
            static::restoring(function ($model) {
                $model->deleted_by = null;
            });
        }
    }


    protected static function getBlameableUsername(): string
    {
        $user = null;

        if (auth('web')->check()) {
            $user = auth('web')->user();
        } elseif (auth('api')->check()) {
            $user = auth('api')->user();
        }

        return $user->email ?? 'system';
    }
}
