<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Lists;
use App\Item;
use App\Image;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ListsItemsImagesController extends Controller
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
    public function store(Request $request,Lists $list,Item $item,Image $image)
    {
       $this->validate($request,[
		'image'=>'required|image|mimes:jpeg,png,jpg,gif',
	]); 
	$image=$request->file('image');
	$input['imagename']=time().'.'.$image->getClientOriginalExtension();
	$destinationPath=public_path('/images');
	$image->move($destinationPath,$input['imagename']);
	$fullImagePath=$destinationPath.'/'.$input['imagename'];
	$this->postImage->add($input);

	$im=Image::create([
		'items_id'=>$item->id,
		'path'=>$fullImagePath
	]);
	if(!empty($im))
	{
		return response()->json(null,200);
	}
	return abort(400,'bad parameters');
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
}
