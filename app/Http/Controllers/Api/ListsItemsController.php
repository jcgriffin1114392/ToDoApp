<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Item;
use App\Lists;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ListsItemsController extends Controller
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
    public function store(Request $request,Lists $list)
    {
       $value_for_item=$request->item;
       //assume all newly created items are in PENDING status,must set to COMPLETE
       $status='PENDING';
       $item=Item::create([
	     'item'=>$value_for_item,
	     'status'=>$status,
	     'lists_id'=>$list->id
	]);
       if(!empty($item))
       {

		return response()->json(['list_id'=>$item->lists_id,'item_id'=>$item->id]);
       } 
	return abort(400,'bad parameters');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,Lists $list,Item $item)
    {
        
	/*
	if(is_string($request->status))
	{
		$paramaters=['lists_id'=>$list->id,'status'=>$request->status]
	}else{
		$paramaters=['lists_id'=>$list->id]
	}
        */
	return response()->json($list);
       	$items=Item::where('lists_id','=',$list->id)->get();
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
    public function update(Request $request,Lists $list,Item $item)
    {

	if(is_string($request->status))
	{
		$item->status=$request->status;
	}
	if( is_string($request->item))
	{
		$item->item=$request->item;
	}
	if($item->save())
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
    public function destroy(Lists $list,Item $item)
    {
	 $deletedRow=$item->delete();
	if(count($deletedRow)==1)
	{
		return response()->json(null,204);
	}
	return abort(400,'bad parameters'); 
    }
}
