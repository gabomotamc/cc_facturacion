<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Uuid
{
    protected static function bootUuid() {
        static::creating(function ($model) {
            $key = $model->getKeyName();
            $model->$key = (string) Str::uuid();
        });
    }

    public function getIncrementing() {
        return false;
    }

    public function getKeyType() {
        return "string";
    }

}