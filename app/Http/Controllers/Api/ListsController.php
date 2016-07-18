<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Lists;
use App\Item;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ListsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $lists=Lists::all(); 
	if(count($lists) >0 )
	{
       		return response()->json(['lists'=>$lists],200);
	}
	return abort(400,'bad parameters');
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
       	//get name from request
	$name=$request->name;
	$list=Lists::create([
		'name'=>$name
	]);
	if(!(empty($list)))
	{
		return response()->json(['list_id'=>$list->id]);
	} 
	return abort(400,'bad parameters');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,Lists $list)
    {
	
	if(is_string($request->status))
	{
		$parameters=['lists_id'=>$list->id,'status'=>$request->status];
	}else{
		$parameters=['lists_id'=>$list->id];
	}
        
       	$items=Item::where($parameters)->get();
	if(count($items)>0)
	{
		return response()->json(['list_name'=>$list->name,['items'=>$items]],200);
	}
	return abort(400,'bad parameters');
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
    public function update(Request $request, Lists $list)
    {
       $name=$request->name;
       $list->name=$name;
       if($list->save())
	{
		return response()->json(null,204);
	}
      return abort(400,'bad parameters'); 
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
