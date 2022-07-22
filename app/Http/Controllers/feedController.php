<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class feedController extends Controller
{
    function feed(Request $res)
    {
            $user_data = DB::table('registeruser')->whereNotIn('id',[$res->session()->get('user_id')])->get();
            $arry['user_data'] = $user_data;


            /* count follow users */

                    $user_follow = DB::table('registeruser')->where('follow_id', 'LIKE', '%'.$res->session()->get('user_id').'%');
                    $followers = $user_follow->count();
                    session(['follow_count'=>$followers]);

           /* count following users */

                $user_following = DB::table('registeruser')->where('id',$res->session()->get('user_id'))->first();

                $following_ids = explode(',',$user_following->follow_id);

                $total_following = count($following_ids);

                session(['follow_count'=>$followers]);
                session(['following_count'=>$total_following]);



            if($res->upload)
            {

                    $img_string="";
                 
                        $image =$res->file('image');
                        $des =$res->des;

                            foreach ($image as $Image_data) {
                                
                                $image_name = $Image_data->getClientOriginalName($Image_data);
                                $Image_data->move('upload',$image_name);

                                $img_string = $img_string.','.$image_name;
                            }

                            $image_string = substr($img_string, 1);

                    $upload_feed = array('user_id' => $res->session()->get('user_id'),'image'=>$image_string,'des'=>$des);
            
                DB::table('feed')->insert($upload_feed);
            }


            $user_feed = DB::table('feed')->orderBy('feed.id', 'DESC')->join('registeruser','feed.user_id', '=' ,'registeruser.id')->get(['feed.*','registeruser.name']);
  
            $arry['user_feed'] = $user_feed;



            return view('feed',$arry);
            
     }
}
