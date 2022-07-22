<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class followController extends Controller
{
    function accept_req(Request $res)
    {
        $user_data = DB::table('registeruser')->where('id',$res->id)->first();
        $follow_id = $user_data->follow_id;

        if($follow_id==0)
        {
            $follow_id = $res->session()->get('user_id');
        }
        else
        {
            $follow_id = $follow_id.','.$res->session()->get('user_id');
        }

        $update_follow_id = array('follow_id' =>$follow_id);
        DB::table('registeruser')->where('id',$res->id)->update($update_follow_id);

        $user_data = DB::table('registeruser')->whereNotIn('id',[$res->session()->get('user_id')])->get();
        $arry['user_data']=$user_data;

        echo view('new_req_data',$arry);
    }

    function unfollow_req(Request $res)
    {
        $user_data = DB::table('registeruser')->where('id',$res->id)->first();
        $follow_id = explode(',', $user_data->follow_id);

        if(($key = array_search($res->session()->get('user_id'), $follow_id)) !== false) {
            unset($follow_id[$key]);
        }

        $follow_id = implode(',', $follow_id);

        if($follow_id=="")
        {
            $follow_id=0;
        }

        
        $update_follow_id = array('follow_id' =>$follow_id);
        DB::table('registeruser')->where('id',$res->id)->update($update_follow_id);

        $user_data = DB::table('registeruser')->whereNotIn('id',[$res->session()->get('user_id')])->get();
        $arry['user_data']=$user_data;

        echo view('new_req_data',$arry);

    }

    function chat()
    {
        return view('chat');
    }
}
