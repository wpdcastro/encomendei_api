<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Product;

class SellController extends BaseController
{
    private $sell; 

    public function __construct (Sell $sell) {

        $this->sell = $sell; 
    }

    public function index () {

        return $this->sell->paginate(10);
    }

    public function show ($product) {
        
        return $this->sell->findOrFail($product);
    }

    public function store (Request $request) {

        $this->sell->create($request->all());

        return response()
            ->json(['data' => [ 
                'message' => 'Success in create Product']
            ]); 
    }

    public function update ($sell) {

        $productInfo = $this->sell->find($sell);
        $productInfo->update($request->all());

        return response()->json(
            [
                'data' => [ 
                    'message' => 'Success in update Product'
                ]
            ]
        );
    }

    public function destroy ($sell) {

        $productInfo = $this->sell->find($sell);
        $productInfo->delete();

        return response()
            ->json(['data' => [ 
                    'message' => 'Success in remove Product']
                ]);
    }
}