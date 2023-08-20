<?php

namespace App\Http\Controllers;

use App\Http\Resources\PlanResource;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = Plan::all();
        return response([
            'plans' => PlanResource::collection($plans),
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
        $plan = new Plan();
        $plan->name = $request->name;
        $plan->description = $request->description;
        $plan->mount = $request->mount;
        $plan->status = $request->status;
        $plan->link_mp = $request->link_mp;
        $plan->duration = $request->duration;
        $plan->save();

        return response([
            'plan' => new PlanResource($plan),
            'message' => 'Successful operation'
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //\Log::debug($request);
        $plan = Plan::where('id',$request->id)->first();
        $plan->name = $request->name;
        $plan->description = $request->description;
        $plan->mount = $request->mount;
        $plan->status = $request->status;
        $plan->link_mp = $request->link_mp;
        $plan->duration = $request->duration;
        $plan->save();

        return response([
            'plan' => new PlanResource($plan),
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

    public function getActivePlans()
    {
        $plans = Plan::where('status','activo')->get();
        return response([
            'plans' => PlanResource::collection($plans),
            'message' => 'Successful operation'
        ],201);

    }
}
