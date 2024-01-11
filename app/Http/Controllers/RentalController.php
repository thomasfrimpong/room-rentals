<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RentalController extends Controller
{
    //
    public function  addPayment(Request $request)
    {
        $user = session('user');
        $motel_id = $user->data->user->motel_id;
        $token = $user->data->token;
        $user_id = $user->data->user->id;



        $amount = $request->amount_involved;
        $service =  explode('-', $request->service);
        $service_id = $service[0];
        $guest_id = $service[1];
        $room_id = $service[2];

        //return [$service_id, $guest_id, $room_id];

        try {
            $response = Http::withToken($token)->post(config('api.url') . "api/add/new/payment", [
                'amount' => $amount,
                'added_by' => $user_id,
                'service_id' => $service_id,
                'room_id' => $room_id,
                'motel_id' => $motel_id,
                'guest_id' => $guest_id,
                'payment_mode' => $request->payment_mode

            ]);
            Log::debug($response);
            if (json_decode($response)->success) {

                return redirect('/payment-list?success=true');
            } else {
                return redirect('/payment-list?error=true');
            }
        } catch (Exception $ex) {
            return redirect('/payment-list?error=true');
        }
    }


    public function  addRefund(Request $request)
    {
        $user = session('user');
        $motel_id = $user->data->user->motel_id;
        $token = $user->data->token;
        $user_id = $user->data->user->id;
        //$role = $user->data->user->role;


        $amount = $request->amount_involved;
        $service =  explode('-', $request->service);
        $service_id = $service[0];
        $guest_id = $service[1];
        $room_id = $service[2];



        try {
            $response = Http::withToken($token)->post(config('api.url') . "api/add/new/refund", [
                'amount' => $amount,
                'added_by' => $user_id,
                'service_id' => $service_id,
                'room_id' => $room_id,
                'motel_id' => $motel_id,
                'guest_id' => $guest_id,
                'reason_for_refund' => $request->reason

            ]);
            Log::debug($response);
            if (json_decode($response)->success) {

                return redirect('/refund-list?success=true');
            } else {
                return redirect('/refund-list?error=true');
            }
        } catch (Exception $ex) {
            return redirect('/refund-list?error=true');
        }
    }

    public function logOut(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }

    public function changePassword()
    {
        $user = session('user');
        $motel_id = $user->data->user->motel_id;
        $token = $user->data->token;
        $user_id = $user->data->user->id;
        $role = $user->data->user->role;

        return view('change-password', compact('role'));
    }

    public function updatePassword(Request $request)
    {

        $user = session('user');
        $motel_id = $user->data->user->motel_id;
        $token = $user->data->token;
        $user_id = $user->data->user->id;


        try {
            $response = Http::withToken($token)->post(config('api.url') . "api/change/password", [

                'user_id' => $user_id,
                'password' => $request->old_password,
                'new_password' => $request->new_password,


            ]);
            Log::debug($response);
            if (json_decode($response)->success) {

                return redirect('/change-password?success=true');
            } else {
                return redirect('/change-password?error=true');
            }
        } catch (Exception $ex) {
            return redirect('/change-password?error=true');
        }
    }

    public function addAdminPage()
    {
        $user = session('user');
        $token = $user->data->token;
        $user_id = $user->data->user->id;



        $motels =  Http::withToken($token)->get(config('api.url') . 'api/get/motels');

        return view('add-admin', compact('motels'));
    }

    public function motelBookings()
    {
        $user = session('user');
        $token = $user->data->token;
        $user_id = $user->data->user->id;
        $role = $user->data->user->role;
        $motel_id = $user->data->user->motel_id;



        if ($role == 'admin') {
            $bookings =  Http::withToken($token)->get(config('api.url') . "api/fetch/booking/$motel_id");

            $guests = Http::withToken($token)->get(config('api.url') . "api/get/all/guests/$motel_id?active=1");
        } else {

            $bookings =  Http::withToken($token)->get(config('api.url') . "api/fetch/user/booking/$user_id");

            $guests = Http::withToken($token)->get(config('api.url') . "api/filter/guests/by/user?user=$user_id&active=1");
        }

        $rooms = Http::withToken($token)->get(config('api.url') . "api/get/all/rooms/$motel_id");

        //return  $bookings;

        return view('motel-bookings', compact('bookings', 'role', 'rooms', 'guests'));
    }

    public function addBookings(Request $request)
    {
        $user = session('user');
        $token = $user->data->token;
        $user_id = $user->data->user->id;
        $role = $user->data->user->role;
        $motel_id = $user->data->user->motel_id;



        $time = explode('-', $request->rent_period);
        $time_1 =  Carbon::parse($time[0])->format(' d-m-Y H:i:s');
        $time_2 =  Carbon::parse($time[1])->format(' d-m-Y H:i:s');



        try {
            $response =    Http::withToken($token)->post(config('api.url') . "api/add/booking", [
                "room_id" => $request->room_id,
                'start_of_residence' =>  $time_1,
                'end_of_residence' => $time_2,
                "motel_id" => $motel_id,
                "guest_id" => $request->guest_id,
                "cost_of_service" => $request->cost_of_service,
                'user_id' => $user_id
            ]);

            Log::debug($response);

            if (json_decode($response)->success) {

                return redirect('/motel-bookings?success=true');
            } else {
                return redirect('/motel-bookings?error=true');
            }
        } catch (Exception $ex) {
            return redirect('/motel-bookings?error=true');
        }
    }

    public function checkInGuest(Request $request)
    {

        try {
            $response = Http::post(config('api.url') . "api/check/in/guest/$request->id");
            Log::debug($response);
            return $response;
        } catch (Exception $ex) {
            Log::debug($ex->getMessage());
            return $ex->getMessage();
        }
    }

    public function editBooking()
    {
        //return view('');
    }

    public function RecieptPage($payment_id)
    {

        $user = session('user');
        $token = $user->data->token;
        $user_id = $user->data->user->id;
        $role = $user->data->user->role;



        $response = Http::withToken($token)->get(config('api.url') . "api/get/payment/$payment_id");

        $payment = json_decode($response);

        return view('reciept', compact('payment', 'role'));
    }

    public function reportsPage()
    {
        $user = session('user');
        $token = $user->data->token;

        $role = $user->data->user->role;

        return view('reports', compact('role'));
    }

    public function getSummaries(Request $request)
    {
        $user = session('user');
        $token = $user->data->token;
        $motel_id = $user->data->user->motel_id;
        $role = $user->data->user->role;


        $dates = explode('-', $request->date_range);
        $start_date =  Carbon::parse($dates[0])->format('Y-m-d');
        $end_date = Carbon::parse($dates[0])->format('Y-m-d');

        try {
            $payment_summary =  Http::withToken($token)->post(config('api.url') . "api/sum/of/payments", [
                'start_date' => $start_date,
                'end_date' => $end_date,
                "motel_id" => $motel_id
            ]);
        } catch (Exception $ex) {
            Log::debug($ex->getMessage());
            return $ex->getMessage();
        }

        try {
            $refund_summary =  Http::withToken($token)->post(config('api.url') . "api/sum/of/refunds", [
                'start_date' => $start_date,
                'end_date' => $end_date,
                "motel_id" => $motel_id
            ]);
        } catch (Exception $ex) {
            Log::debug($ex->getMessage());
            return $ex->getMessage();
        }

        try {
            $expense_summary =  Http::withToken($token)->post(config('api.url') . "api/sum/of/expenses", [
                'start_date' => $start_date,
                'end_date' => $end_date,
                "motel_id" => $motel_id
            ]);
        } catch (Exception $ex) {
            Log::debug($ex->getMessage());
            return $ex->getMessage();
        }



        return  view('reports', compact('payment_summary', 'expense_summary', 'refund_summary', 'role', 'start_date', 'end_date'));
    }
}
