<?php

namespace App\Listeners;

use App\Events\UserSaved;
use App\Models\Detail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class SaveUserBackgroundInformation
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserSaved $event): bool
    {
        /**
         * Current route of user's action
         *
         * @var string $action = "App\Http\Controllers\UserController@store"
         */
        $action = Route::currentRouteAction();

        /**
         * Separate the method of the current route of user's action
         *
         * @var array $actionName = array:2 [▼
        0 => "App\Http\Controllers\UserController"
        1 => "store"
        ]
         */
        $actionName = explode("@", $action);

        // Current Date
        $currentTimestamp = Carbon::now()->toDateTimeString();

        Detail::create([
            'key' => $event->model->getTable() . '_' . $actionName[1],
            'value' => json_encode($event->model),
            'user_id' => auth()->user()->id,
            'type' => auth()->user()->type,
            'created_at' => $currentTimestamp,
        ]);

        return true;
    }
}
