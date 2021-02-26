<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Product;
use Illuminate\Support\Facades\DB;

class SellController extends BaseController
{
    private $sell; 

    public function __construct (Sell $sell) {

        $this->sell = $sell; 
    }

    public function index () {

        return $this->sell->paginate(10);
    }

    public function show ($sellId) {
        
        return $this->sell->findOrFail($sellId);
    }

    public function store (Request $request) {

        $this->sell->create($request->all());

        return response()
            ->json(['data' => [ 
                'message' => 'Success in create Sell']
            ]); 
    }

    public function update ($sellId) {

        $sell = $this->sell->find($sellId);
        $sell->update($request->all());

        return response()->json(
            [
                'data' => [ 
                    'message' => 'Success in update Sell'
                ]
            ]
        );
    }

    public function destroy ($sellId) {

        $sell = $this->sell->find($sellId);
        $sell->delete();

        return response()
            ->json(['data' => [
                'message' => 'Success in remove Sell']
            ]);
    }
}