<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    //
    public function refundList()
    {



        $user = session('user');

        $motel_id = $user->data->user->motel_id;
        $token = $user->data->token;
        $user_id = $user->data->user->id;
        $role = $user->data->user->role;


        if ($role == 'admin') {

            $refunds = Http::withToken($token)->get(config('api.url') . "api/get/all/refunds/$motel_id");
            $services = Http::withToken($token)->get(config('api.url') . "api/get/room/rentals/$motel_id&active=1");
        } else {

            $refunds = Http::withToken($token)->get(config('api.url') . "api/filter/refund/by/user?user=$user_id");
            $services = Http::withToken($token)->get(config('api.url') . "api/filter/rent/by/user?user=$user_id&active=1");
        }




        return view('refunds', compact('refunds', 'role', 'services'));
    }

    public function getMotelExpenses()
    {
        $user = session('user');

        $motel_id = $user->data->user->motel_id;
        $token = $user->data->token;
        $user_id = $user->data->user->id;
        $role = $user->data->user->role;

        if ($role == 'admin') {
            $expenses = Http::withToken($token)->get(config('api.url') . "api/get/motel/expenses/$motel_id");
        } else {
            $expenses = Http::withToken($token)->get(config('api.url') . "api/get/user/expenses/$user_id");
        }
        //Log::debug(json_decode($expenses));

        return view('expenses', compact('expenses', 'role'));
    }

    public function getAllUsers()
    {
        $user = session('user');

        $motel_id = $user->data->user->motel_id;
        $token = $user->data->token;
        $user_id = $user->data->user->id;
        $role = $user->data->user->role;;

        $users = Http::withToken($token)->get(config('api.url') . "api/get/all/users/$motel_id");

        // Log::debug(json_decode($users));
        //return $users;
        return view('users-list', compact('users', 'role'));
    }

    public function addUser(Request $request)
    {

        $user = session('user');
        // $motel_id = $user->data->user->motel_id;
        $token = $user->data->token;
        $role = $user->data->user->role;
        $motel_id = $user->data->user->motel_id;



        try {
            $response =  Http::withToken($token)->post(config('api.url') . "api/add/user", [
                "first_name" => $request->first_name,
                "other_names" => $request->other_names,
                "phone_number" => $request->phone_number,
                "email" => $request->email,
                "role" => $request->role,
                "employee_id" => $request->employee_id,
                "motel_id" => $motel_id
            ]);

            Log::debug($response);
            if ($role == 'superadmin') {
                if (json_decode($response)->success) {
                    return redirect('/add-admin?success=true');
                } else {
                    return redirect('/add-admin?error=true');
                }
            }

            if (json_decode($response)->success) {

                return redirect('/users-list?success=true');
            } else {
                return redirect('/users-list?error=true');
            }
        } catch (Exception $ex) {
            return redirect('/users-list?error=true');
        }
    }

    public function addExpense(Request $request)
    {
        $user = session('user');
        $motel_id = $user->data->user->motel_id;
        $token = $user->data->token;
        $user_id = $user->data->user->id;



        try {
            $response =  Http::withToken($token)->post(config('api.url') . "api/add/new/expense", [
                "purpose_of_expense" => $request->purpose_of_expense,
                "amount_involved" => $request->amount_involved,
                "added_by" => $user_id,
                "motel_id" => $motel_id
            ]);

            Log::debug($response);
            if (json_decode($response)->success) {

                return redirect('/expenses-list?success=true');
            } else {
                return redirect('/expenses-list?error=true');
            }
        } catch (Exception $ex) {
            return redirect('/expenses-list?error=true');
        }
    }


    public function addRoom(Request $request)
    {
        $user = session('user');
        $motel_id = $user->data->user->motel_id;
        $token = $user->data->token;
        $user_id = $user->data->user->id;


        try {
            $response =  Http::withToken($token)->post(config('api.url') . "api/add/new/room", [
                "cost_of_room" => $request->cost_of_room,
                'room_number' => $request->room_number,
                "is_reserved" => 0,
                'added_by' => $user_id,
                "motel_id" => $motel_id,
                'percentage_discount' => 0
            ]);

            Log::debug($response);
            if (json_decode($response)->success) {

                return redirect('/list-of-rooms?success=create');
            } else {
                return redirect('/list-of-rooms?error=create');
            }
        } catch (Exception $ex) {
            return redirect('/list-of-rooms?error=create');
        }
    }

    public function addGuest(Request $request)
    {
        $user = session('user');
        $motel_id = $user->data->user->motel_id;
        $token = $user->data->token;
        $user_id = $user->data->user->id;



        try {
            $response =  Http::withToken($token)->post(config('api.url') . "api/add/new/guest", [
                "first_name" => $request->first_name,
                'other_names' => $request->other_names,
                "phone_number" => $request->phone_number,
                'email' => $request->email,
                'added_by' => $user_id,
                "motel_id" => $motel_id,


            ]);

            Log::debug($response);
            if (json_decode($response)->success) {

                return redirect('/motel-guests?success=create');
            } else {
                return redirect('/motel-guests?error=create');
            }
        } catch (Exception $ex) {
            return redirect('/motel-guests?error=create');
        }
    }

    public function addRent(Request $request)
    {

        $user = session('user');
        $motel_id = $user->data->user->motel_id;

        $token = $user->data->token;
        $user_id = $user->data->user->id;

        $time = explode('-', $request->rent_period);
        $time_1 =  Carbon::parse($time[0])->format(' d-m-Y H:i:s');
        $time_2 =  Carbon::parse($time[1])->format(' d-m-Y H:i:s');

        // $time_3 = Carbon::parse($time[1])->format('Y-m-d H:i:s');
        $room = explode('-', $request->room_id);




        try {
            $response =  Http::withToken($token)->post(config('api.url') . "api/add/new/service", [


                "room_id" => $room[0],
                "start_of_residence" => $time_1,
                "end_of_residence" => $time_2,
                "added_by" => $user_id,
                "guest_id" => $request->guest_id,
                "is_reservation" => 0,
                "motel_id" => $motel_id,
                "cost_of_service" => $request->cost_of_rent,
                "duration_extended" => 0,
                "duration_reduced" => 0

            ]);

            if (json_decode($response)->success) {

                return redirect('/motel-rentals?success=true');
            } else {
                return redirect('/motel-rentals?error=true');
            }
        } catch (Exception $ex) {
            return redirect('/motel-rentals?error=true');
        }
    }

    public function editGuest($id)
    {
        $user = session('user');


        $token = $user->data->token;
        $guest =  Http::withToken($token)->get(config('api.url') . "api/get/guest/details?guest_id=$id");

        return view('/updates/update-guest')->with('guest', json_decode($guest));
    }

    public function updateGuest(Request $request)
    {

        $user = session('user');
        $token = $user->data->token;

        try {
            $response =    Http::withToken($token)->post(
                config('api.url') . "api/update/guest/info",
                [
                    'id' => $request->id,
                    "first_name" => $request->first_name,
                    "other_names" => $request->other_names,
                    'email' => $request->email,
                    'phone_number' => $request->phone_number

                ]
            );

            if (json_decode($response)->success) {

                return redirect('/motel-guests?success=update');
            } else {
                return redirect('/motel-guests?error=update');
            }
        } catch (Exception $ex) {
            return redirect('/motel-guests?error=update');
        }
    }

    public function editRoom($id)
    {

        $user = session('user');
        $token = $user->data->token;

        $room = Http::withToken($token)->get(config('api.url') . "api/get/room/details?room_id=$id");

        //return $room;
        return view('updates/update-room')->with('room', json_decode($room));
    }

    public function updateRoom(Request $request)
    {
        $user = session('user');
        $token = $user->data->token;

        try {
            $response = Http::withToken($token)->post(config('api.url') . "api/update/room/info", [
                'room_number' => $request->room_number,
                'cost_of_room' => $request->cost_of_room,
                'id' => $request->id
            ]);


            if (json_decode($response)->success) {

                return redirect('/list-of-rooms?success=update');
            } else {
                return redirect('/list-of-rooms?error=update');
            }
        } catch (Exception $ex) {
            return redirect('/list-of-rooms?error=update');
        }
    }

    public function editRent($id)
    {


        $user = session('user');
        $token = $user->data->token;

        $rent = Http::withToken($token)->get(config('api.url') . "api/get/rent/record/$id");
        return view('updates/update-rent')->with('rent', $rent);
    }

    public function checkOutGuest(Request $request)
    {

        try {
            $response = Http::get(config('api.url') . "api/check/out/guest/$request->id");
            return $response;
        } catch (Exception $ex) {
            Log::debug($ex->getMessage());
            return $ex->getMessage();
        }
    }
}
