<?php

namespace App\Http\Controllers;

use Inertia\Response;
use Illuminate\Http\Request;


class NotificationController extends Controller
{
    public function index(Request $request): Response
    {
        return inertia(
            'Notification/NotificationIndex',
            [
                'notifications' => $request->user()
                    ->notifications()->paginate(10)
            ]
        );
    }
}

