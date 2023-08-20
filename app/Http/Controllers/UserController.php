<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentResource;
use App\Http\Resources\UserResource;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->with('payments.plan')->get();

        return response([
            'users' => UserResource::collection($users),
            'message' => 'Successful operation'
        ],201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id',$id)->with('payments.plan')->latest()->first();
        //$payment = Payment::where('user_id',$id)->latest()->with('plan')->first();
        return response([
            'user' => new UserResource($user),
            //'lastPayments' => new PaymentResource($payment),
            'message' => 'Successful operation'
        ],201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id)->get();
        $user->update($request->all());

        return response([
            'user' => new UserResource($user),
            'message' => 'Successful operation'
        ],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function changeRol(Request $request){
        //\Log::debug($request);
        $user = User::where('id',$request->user_id)->first();
        $user->rol_id = $request->user_rol;
        $user->save();

        return response([
            'user' => new UserResource($user),
            'message' => 'Successful operation'
        ],201);
    }

    public function changeStatus(Request $request){
        //\Log::debug($request);
        $user = User::where('id',$request->user_id)->first();
        $user->status = $request->user_status;
        $user->save();

        return response([
            'user' => new UserResource($user),
            'message' => 'Successful operation'
        ],201);
    }

    public function updateUser(Request $request)
    {
        //\Log::debug($request);
        $user = User::where('id',$request->user_id)->first();
        //$user->update($request->all());
        $user->first_name = $request->user_first_name;
        $user->last_name = $request->user_last_name;
        $user->email = $request->user_email;
        $user->phone = $request->user_phone;
        $user->profession = $request->user_profession;
        $user->save();

        if($request->file != null){
            $image = $request->file('file')->store('public/images/user_profile');
            $path = Storage::url($image);
            $user->url_photo = $path;
            $user->save();
        }

        return response([
            'user' => new UserResource($user),
            'message' => 'Successful operation'
        ],201);
    }
}
