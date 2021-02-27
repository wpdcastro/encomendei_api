<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Models\Product;

class ProductController extends BaseController
{
    private $product; 

    public function __construct (Product $product) {

        $this->product = $product; 
    }

    public function index () {

        // return $this->product->paginate(10);
        
        $productList = DB::table('products')
            ->select('products.*', DB::raw('SUM(stock.quantity) As stock'))
            ->leftJoin('stock', 'stock.product_id', '=', 'products.id') 
            ->groupBy('products.id')
            ->paginate(10);
        
        $response = [
            'data' => $productList,
            'total' => count($productList),
            'status' => 200    
        ];

        return $response;
    }

    public function show ($product) {
        
        return $this->product->findOrFail($product);
    }

    public function store (Request $request) {

            $this->product->create($request->all());

            return response()
                ->json(['data' => [ 
                    'message' => 'Success in create Product']
                ]);
        
    }

    public function update ($product) {

        $productInfo = $this->product->find($product);
        $productInfo->update($request->all());

        return response()->json(
            [
                'data' => [ 
                    'message' => 'Success in update Product'
                ]
            ]
        );
    }

    public function destroy ($product) {

        $productInfo = $this->product->find($product);
        $productInfo->delete();

        return response()
            ->json(['data' => [ 
                    'message' => 'Success in remove Product']
                ]);
    }
}