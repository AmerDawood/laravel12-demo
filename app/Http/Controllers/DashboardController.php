<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
      public function index($role)
    {
        $user = auth()->user();

        if (!$user->hasRole($role)) {

            abort(403, 'غير مصرح لك بالدخول إلى هذه الصفحة');

        }

        return view('dashboard.index', ['role' => $role]);
    }
}
