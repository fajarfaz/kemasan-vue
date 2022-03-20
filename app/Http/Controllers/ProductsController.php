<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\validator;
use Symfony\Component\HttpFoundation\Response; //call method response for validator

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products =  Products::orderBy('time', 'DESC')->get();
        $response = [
            'message' => 'List products order by time',
            'data' => $products
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
     $validator = Validator::make($request->all(), [
        'title' => ['required'],
        'description' => ['required'],
    ]);

     if ($validator->fails()){
         return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
     }

     try{
        $products = Products::create($request->all());
        $response = [
            'message' => 'Product Created',
            'data' => $products
        ];

        return response()->json($response, Response::HTTP_CREATED);
    } 
    catch(QueryException $e){
        return response()->json(['message' => "Failed". $e->errorInfo]);
    }
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
     $products = Products::findOrFail($id);
     $response = [
        'message' => 'Detail Products '. $products->title,
        'data' => $products
    ];
    return response()->json($response, Response::HTTP_OK);
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
       $products = Products::findOrFail($id);

       $validator = Validator::make($request->all(), [
        'title' => ['required'],
        'description' => ['required'],
    ]);

       if ($validator->fails()){
         return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
     }

     try{
        $products->update($request->all());
        $response = [
            'message' => 'Product Updated',
            'data' => $products
        ];

        return response()->json($response, Response::HTTP_OK);
    } 
    catch(QueryException $e){
        return response()->json(['message' => "Failed". $e->errorInfo]);
    }

}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = Products::findOrFail($id);

     try{
        $products->delete();
        $response = [
            'message' => 'Product Deleted',          
        ];

        return response()->json($response, Response::HTTP_OK);
    } 
    catch(QueryException $e){
        return response()->json([
            'message' => "Failed". $e->errorInfo
        ]);
    }
}
}
