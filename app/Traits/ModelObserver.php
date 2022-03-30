<?php

namespace App\Traits;

use App\Models\Log;

trait ModelObserver
{
    public static function bootModelObserver()
    {
        self::saving(function ($model) {
            $modelClass = $model::class;
            $currentModel = $modelClass::find($model->id);
            $request = request();

            $log = new Log();
            $log->model = $modelClass;
            $log->data = collect($currentModel->getAttributes())->toJson();
            $log->changed_data = collect($request->all())->toJson();

            if (auth()->check()) {
                $log->user_id = auth()->id();
            }

            $log->save();
        });
    }
}
