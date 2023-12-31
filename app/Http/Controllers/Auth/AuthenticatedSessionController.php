<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $notification = array(
            'message' => 'تم تسجيل الدخول بنجاح',
            'alert-type' => 'success'
        );

        $url = '';

        // if($request->user()->role === 'admin')
        // {
        //     $url = "/admin/dashboard";
        // }
        // elseif($request->user()->role === 'subscriber' && $request->user()->status === 'active')
        // {
        //     $url = "/subscriber/dashboard";
        // }

        $user = $request->user();

        if ($user->role === 'admin')
        {
            if ($user->status === 'active') {
                return redirect('/admin/dashboard')->with([
                    'message' => 'تم تسجيل الدخول بنجاح',
                    'alert-type' => 'success'
                ]);
            }
            else
            {
                return redirect()->route('inactive-page')->with([
                    'message' => 'غير مسموح بالدخول',
                    'alert-type' => 'error'
                ]);
            }
        }
        elseif ($user->role === 'subscriber')
        {

            if ($user->status === 'active') {
                return redirect('/subscriber/dashboard')->with([
                    'message' => 'تم تسجيل الدخول بنجاح',
                    'alert-type' => 'success'
                ]);
            }
            else
            {
                return redirect()->route('inactive-page')->with([
                    'message' => 'حالة الاشتراك غير نشطة',
                    'alert-type' => 'error'
                ]);
            }
        }

    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
