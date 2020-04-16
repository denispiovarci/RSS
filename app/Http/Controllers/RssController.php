<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use willvincent\Feeds\Facades\FeedsFacade as Feeds;

class RssController extends Controller
{
    public function load(Request $request){

        $feed = Feeds::make($request->url, true);
        $feed->enable_order_by_date(true);


        $data = array(
            'title' => $feed->get_title(),
            'permalink' => $feed->get_permalink(),
            'items' => $feed->get_items(),
        );

        $orderBy = $request->orderBy;




        return view('main')->with('data',$data)->with('orderBy', $orderBy);
    }


    public function show(){
        return back();
    }
}
