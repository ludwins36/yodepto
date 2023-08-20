<?php

namespace App\Http\Controllers;

use App\Http\Resources\RentalOfferResource;
use App\Models\Image;
use App\Models\RentalOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RentalOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rentalOffers = RentalOffer::orderBy('id', 'desc')->with('images','user','favorites')->get();
        return response([
            'rentalOffers' => RentalOfferResource::collection($rentalOffers),
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
        //\Log::debug($request);
        $rentalOfferData = $request->validate([
            'description' => 'required',
            'type' => 'required',
            'status' => 'required',
            'title' => 'required',
            'moving_date' => 'required',
            'rent_amount' => 'required',
            'address' => 'required',
            'city_id' => 'required',
            'availability_date' => 'required',
            'user_id' => 'required',
            'roommate' => 'sometimes'
        ]);

        $rentalOffer = RentalOffer::create($rentalOfferData);

        /*if ($request->file('files')){
            foreach($request->file('files') as $key => $file)
            {
                $path = $file->store('public/web-luquin/images');
                $file = new WebFile();
                $file->name = $jobOffer->id.'_'.preg_replace('/\s+/', '_', $jobOffer->title).'_'.
                    app('App\Http\Controllers\Process\Api\ProcessController')->getDateMysql();
                $file->path = $path;
                $file->fileable()->associate($jobOffer);
                $file->save();
            }
        }*/

        if($request->file('files')){
            foreach ($request->file('files') as $file){
                $photo = $file->store('public/images/rental_offers');
                $path = Storage::url($photo);

                $image = new Image();
                $image->url_photo = $path;
                $image->rental_offer_id = $rentalOffer->id;
                $image->save();
                //\Log::debug('$rentalOffer->id');
                //\Log::debug($rentalOffer->id);
            }
        }
        //\Log::debug('aviso guardado');

        return response([
            'rentalOffer' => new RentalOfferResource($rentalOffer),
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
        $rentalOffer = RentalOffer::where('id',$id)->with('images')->latest()->first();
        return response([
            'rentalOffer' => new RentalOfferResource($rentalOffer),
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
        //
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

    public function updateDescription(Request $request){
        //\Log::debug($request);
        $rentalOffer = RentalOffer::where('id',$request->id)->first();
        $rentalOffer->title = $request->title;
        $rentalOffer->description = $request->description;
        $rentalOffer->status = $request->status;
        $rentalOffer->save();

        return response([
            'rentalOffer' => new RentalOfferResource($rentalOffer),
            'message' => 'Successful operation'
        ],201);

    }

    public function changeStatus(Request $request){
        \Log::debug($request);
        $rentalOffer = RentalOffer::where('id',$request->rentalOffer_id)->first();
        $rentalOffer->status = $request->rentalOffer_status;
        $rentalOffer->save();
    }

    public function getUserRentalOffers($id)
    {
        //\Log::debug($id);
        $rentalOffers = RentalOffer::where('user_id',$id)->orderBy('id', 'desc')->with('images')->get();

        return response([
            'rentalOffers' => RentalOfferResource::collection($rentalOffers),
            'message' => 'Successful operation'
        ],201);
    }

    public function getRoomieRentalOffersForHomeWeb(){
        $rentalOffers = RentalOffer::orderBy('id', 'desc')
            ->where('type','inquilino')
            ->limit(6)
            ->with('images')
            ->get();
        return response([
            'rentalOffers' => RentalOfferResource::collection($rentalOffers),
            'message' => 'Successful operation'
        ],201);
    }

    public function getOwnerRentalOffersForHomeWeb(){
        $rentalOffers = RentalOffer::orderBy('id', 'desc')
            ->where('type','propiedad')
            ->limit(6)
            ->with('images')
            ->get();
        return response([
            'rentalOffers' => RentalOfferResource::collection($rentalOffers),
            'message' => 'Successful operation'
        ],201);

    }
}
