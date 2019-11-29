<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Bicycle;

class BicycleController extends Controller
{
    //  /**
    //  * Instantiate a new BicycleController instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Add a new Bicycle.
     *
     * @return Response
     */
    public function addBicycle(Request $request)
    {
        //validate incoming request 
        $this->validate($request, [
            'brand' => 'required|string',
            'model' => 'required|string',
            'year' => 'required|integer',
        ]);

        try {

            $bicycle = new Bicycle;
            $bicycle->brand = $request->input('brand');
            $bicycle->model = $request->input('model');
            $bicycle->year = $request->input('year');

            $bicycle->save();

            //return successful response
            return response()->json(['bicycle' => $bicycle, 'message' => 'CREATED'], 201);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Bicycle Creation Failed!'], 409);
        }

    }

    /**
     * Get all Bicycles.
     *
     * @return Response
     */
    public function allBicycles()
    {
         return response()->json(['bicycles' =>  Bicycle::all()], 200);
    }

    /**
     * Get one bicycle.
     *
     * @return Response
     */
    public function singleBicycle($id)
    {
        try {
            $bicycle = Bicycle::findOrFail($id);

            return response()->json(['bicycle' => $bicycle], 200);

        } catch (\Exception $e) {

            return response()->json(['message' => 'bicycle not found!'], 404);
        }

    }

}