<?php

namespace App\Http\Controllers;

use App\Http\Resources\FavoriteResource;
use App\Http\Resources\RentalOfferResource;
use App\Models\Favorite;
use App\Models\RentalOffer;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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

    public function getFavoritesForUser($id){
        //\Log::debug($id);
        $favorites = Favorite::where('user_id',$id)->get();
        $favoritesId = [];

        foreach ($favorites as $favorite){
            array_push($favoritesId,$favorite->rental_offer_id);
        }

        //\Log::debug($favoritesId);

        $rentalOffers = RentalOffer::whereIn('id',$favoritesId)->orderBy('id', 'desc')->with('images','favorites')->get();

        return response([
            'rentalOffers' => RentalOfferResource::collection($rentalOffers),
            'message' => 'Successful operation'
        ],201);
    }

    public function setFavoritesForUser(Request $request){
        $favorite = new Favorite();
        $favorite->user_id = $request->user_id;
        $favorite->rental_offer_id = $request->rental_offer_id;
        $favorite->save();

        return response([
            'rentalOffers' => new FavoriteResource($favorite),
            'message' => 'Successful operation'
        ],201);
    }

    public function removeFavoritesForUser(Request $request){
        $favorite = Favorite::where('user_id',$request->user_id)
            ->where('rental_offer_id',$request->rental_offer_id)
            ->first();
        $favorite->delete();

        return response([
            'rentalOffers' => new FavoriteResource($favorite),
            'message' => 'Successful operation'
        ],201);
    }
}
