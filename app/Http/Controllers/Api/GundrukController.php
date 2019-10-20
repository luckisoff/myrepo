<?php

namespace App\Http\Controllers\Api;

use App\Faq;
use App\Stories;
use App\Category;
use App\Helpers\Helper;
use App\Policy;
use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
class GundrukController extends Controller
{
    public function getPolicy(){
        $policy = Policy::all();

        if(count($policy) == 0){
            $responseData = Helper::setResponse('fail','Policy  not found | Empty','','');
            return response()->json($responseData);
        }

        $responseData = Helper::setResponse('success','Policy Listing Successfull',$policy,'');
        return response()->json($responseData);
    }

    public function getFaq(){
        $faq= Faq::all();

        if(count($faq) == 0){
            $responseData = Helper::setResponse('fail','FAQ  not found | Empty','','');
            return response()->json($responseData);
        }

        $responseData = Helper::setResponse('success','Policy Listing Successfull',$faq,'');
        return response()->json($responseData);
    }
    
    public function getStoriesList(){
        
        //respond the categories with story created today
        $categories=Category::with(['story'=>function($query){
            $query->whereDate('created_at','=',Carbon::today());
        }])->get();
    
        return response()->json($categories);
        
        // $stories= Stories::with('category')->where('created_at', '>=', Carbon::now()->subDay())->get();
        
        
        
        // if(count($stories) == 0){
        //     $responseData = Helper::setResponse('fail','Stories  not found | Empty','','');
        // }
        
        // $newstories = array();
        // foreach ($stories as $key => $story) {
            
           
            
        //     if (isset($newstories[$story->name])) {
        //         $newstories[$story->name]['profile_picture'] = $story->category->picture;
                
        //         $newstories[$story->category->name]['stories'][$key]['picture'] = $story->picture;
        //         $newstories[$story->category->name]['stories'][$key]['id'] = $story->id;
                
            
        //         $newstories[$story->category->name]['stories'][$key]['created_at'] = $story->created_at;
                
                
                
        //         $newstories[$story->name]['stories'][$key]['updated_at'] = $story->updated_at;
        //     } else {
        //         $newstories[$story->category->name]['profile_picture'] = $story->category->picture;
        //         $newstories[$story->category->name]['stories'][$key]['picture'] = $story->picture;
        //         $newstories[$story->category->name]['stories'][$key]['id'] = $story->id;
        //         $newstories[$story->category->name]['stories'][$key]['created_at'] = $story->created_at;
                
                
                
        //         $newstories[$story->category->name]['stories'][$key]['updated_at'] = $story->updated_at;
        //     }
        // }

        // $responseData = Helper::setResponse('success','Stories Listing Successfull',$newstories,'');
        
        
        // return response()->json($responseData);
        
    }
    
    
    public function getVideosList(){
        $videos=\App\AdminVideo::select('admin_videos.default_image','admin_videos.video')->get();
        return response()->json($videos);
    }

}
