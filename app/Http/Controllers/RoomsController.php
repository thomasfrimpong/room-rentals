<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RoomsController extends Controller
{
    //
    public function signInPage()
    {
        return view('login');
    }

    public function superAdminDashboardPage()
    {
        $user = session('user');
        $token = $user->data->token;
        $motel_id = $user->data->user->motel_id;
        $token = $user->data->token;
        $user_id = $user->data->user->id;
        $role = $user->data->user->role;

        $motels =  Http::withToken($token)->get(config('api.url') . 'api/get/motels');


        return view('super-admin-dashboard', compact('role', 'motels'));
    }

    public function loginUser(Request $request)
    {

        $user =  Http::post(config('api.url') . 'api/login/user', [
            "email" => $request->email,
            'password' => $request->password
        ]);


        if (isset($user['data']['user']['role'])) {
            session(['user' => json_decode($user)]);
            Log::debug($user);

            $last_name = json_decode($user)->data->user->other_names;
            $first_name = json_decode($user)->data->user->first_name;
            $motel_name = json_decode($user)->data->user->motel_name;
            $location = json_decode($user)->data->user->location;

            session(['last_name' => $last_name]);
            session(['first_name' => $first_name]);
            session(['location' => $location]);
            session(['motel_name' => $motel_name]);

            if ($user['data']['user']['role'] == 'superadmin') {


                return redirect('/super/admin/dashboard');
            } else if (isset($user['data']['user']['role'])) {

                return redirect('/admin-dashboard');
            }
        } else {
            return redirect('/?error=true');
        }
    }

    public function addMotelPage()
    {
        return view('add-motel');
    }

    public function addNewMotel(Request $request)
    {
        $user = session('user');

        $token = $user->data->token;


        try {
            $response =  Http::withToken($token)->post(config('api.url') . 'api/add/new/motel', [
                "motel_name" => $request->motel_name,
                'location' => $request->location
            ]);
            //Log::debug($response);

            return redirect('/add-motel-page?success=true');
        } catch (Exception $ex) {
            return redirect('/add-motel-page?error=true');
        }
    }

    public function listOfMotels()
    {
        $user = session('user');

        $motel_id = $user->data->user->motel_id;
        $token = $user->data->token;
        $user_id = $user->data->user->id;
        $role = $user->data->user->role;

        $motels =  Http::withToken($token)->get(config('api.url') . 'api/get/motels');
        return view('list-of-motels', compact('motels', 'role'));
    }

    public function dashboardPage()
    {
        $user = session('user');
        $token = $user->data->token;
        $motel_id = $user->data->user->motel_id;
        $token = $user->data->token;
        $user_id = $user->data->user->id;
        $role = $user->data->user->role;

        $rentals =  Http::withToken($token)->get(config('api.url') . "api/count/rentals/$motel_id");

        $total_payments =  Http::withToken($token)->get(config('api.url') . "api/sum/payments/$motel_id");

        $bookings =  Http::withToken($token)->get(config('api.url') . "api/count/bookings/$motel_id");

        $guests_count =  Http::withToken($token)->get(config('api.url') . "api/count/of/guests/$motel_id");



        return view('dashboard', compact('role', 'guests_count', 'bookings', 'total_payments', 'rentals'));
    }



    public function motelRentals()
    {
        $page = $_GET['page'];

        $user = session('user');

        $motel_id = $user->data->user->motel_id;
        $token = $user->data->token;
        $user_id = $user->data->user->id;
        $role = $user->data->user->role;

        if ($role == 'admin') {
            $rentals =  Http::withToken($token)->get(config('api.url') . "api/get/room/rentals/$motel_id?page[number]=$page&page[size]=10");
            //return $rentals;
            $guests = Http::withToken($token)->get(config('api.url') . "api/get/all/guests/$motel_id?active=1");
        } else {

            $rentals =  Http::withToken($token)->get(config('api.url') . "api/filter/rent/by/user?user=$user_id?page[number]=$page&page[size]=10");

            $guests = Http::withToken($token)->get(config('api.url') . "api/filter/guests/by/user?user=$user_id&active=1");
        }
        $rooms = Http::withToken($token)->get(config('api.url') . "api/get/all/rooms/$motel_id");


        //return json_decode($rentals)->links;

        return view('motel-rentals', compact('rentals', 'rooms', 'guests', 'role'));
    }

    public function motelGuests()
    {
        $user = session('user');
        $motel_id = $user->data->user->motel_id;
        $token = $user->data->token;
        $user_id = $user->data->user->id;
        $role = $user->data->user->role;

        // Log::debug(json_encode($user));
        if ($role == 'admin') {
            $guests = Http::withToken($token)->get(config('api.url') . "api/get/all/guests/$motel_id");
        } else {
            $guests = Http::withToken($token)->get(config('api.url') . "api/filter/guests/by/user?user=$user_id");
        }


        return view('motel-guests', compact('guests', 'role'));
    }

    public function listOfRooms()
    {
        $user = session('user');
        $motel_id = $user->data->user->motel_id;
        $token = $user->data->token;
        $user_id = $user->data->user->id;
        $role = $user->data->user->role;

        // Log::debug(json_encode($user));
        $rooms = Http::withToken($token)->get(config('api.url') . "api/get/all/rooms/$motel_id");

        return view('motel-rooms', compact('rooms', 'role'));
    }

    public function paymentList()
    {

        $user = session('user');
        $motel_id = $user->data->user->motel_id;
        $token = $user->data->token;
        $user_id = $user->data->user->id;
        $role = $user->data->user->role;

        if ($role == 'admin') {
            $payments = Http::withToken($token)->get(config('api.url') . "api/get/all/payments/$motel_id");

            $services = Http::withToken($token)->get(config('api.url') . "api/get/room/rentals/$motel_id&active=1");
        } else {

            $services = Http::withToken($token)->get(config('api.url') . "api/filter/rent/by/user?user=$user_id&active=1");
            $payments = Http::withToken($token)->get(config('api.url') . "api/get/user/payments/$user_id");
        }

        return view('payments', compact('payments', 'role', 'services'));
    }
}
