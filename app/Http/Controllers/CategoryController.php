<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\AddCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        try{
            $categories = Category::orderBy('name', 'ASC')->get();//where did you get this from????
            
            if($categories){
                return response()->json([
                    'data'=> $categories
                ],200);
            }
            return response()->json([
                'category'=>"empty"

            ],404);
        }
        catch(\Exception $e){
            return response()->json([
                'category'=>'internal error'
            ],500);
        }
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
    public function store(AddCategoryRequest $request)
    {
        //
        $category = new Category();
        $category->fill($request->all());//because we used fillable
        if($category->save()){ //returns a boolean
            return response()->json([
                'data'=> $category
            ],200);
        }
        else
        {
            return response()->json([
                'category'=>'category could not be added' 
            ],500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        //
        $category = Category::find($id);
        if($category)
        {
            return response()->json([
                'data'=> $category
            ],200);
        }
        return response()->json([
            'category'=>'category could not be found' 
        ],500);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $category = Category::find($id);
        //what is the best way to validate the update request
        if($category){
            $category->update($request->all());//because we used fillable
            if($category->save()){ //returns a boolean
                return response()->json([
                    'data'=> $category
                ],200);
            }
            else
            {
                return response()->json([
                    'category'=>'category could not be updated' 
                ],500);
            }
        }
        return response()->json([
            'category'=>'category could not be found' 
        ],500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $category = Category::find($id);
        if($category->delete()){ //returns a boolean
            return response()->json([
                'category'=> "good for you"
            ],200);
        }
        else
        {
            return response()->json([
                'category'=>'category could not be deleted' 
            ],500);
        }

    }
}
