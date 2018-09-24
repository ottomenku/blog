<?php

namespace App\Handler\trt;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Input;
//use Illuminate\Support\Facades\Image;
Trait Image{

public function image_upload(){ 
        if(Input::file())
        {
        $imageinputmezo=$this->BASE['image']['inputmezo'] ?? 'image' ;
        $image = Input::file($imageinputmezo);
        $imagedatamezo=$this->BASE['image']['datamezo'] ?? 'foto' ;
        $filename=$this->BASE['image']['name'] ?? time() . '.' . $image->getClientOriginalExtension();
        $path= $this->BASE['image']['savepath'] ?? 'images';
        $widt=$this->BASE['image']['widt'] ?? 600;
        $height=$this->BASE['image']['height'] ?? 600;
        $thumb= $this->BASE['image']['thumb'] ?? true;   

    
        $imagepath = public_path($path.'/' . $filename);
        if(!is_dir ( public_path($path) )){
            mkdir(public_path($path), 777);
            mkdir(public_path($path.'/thumb'), 777);
        }
        \Image::make($image->getRealPath())->resize($widt, $height)->save($imagepath);
        //thumb ----------------------------
        if($thumb) {         
        $th_path= $this->BASE['image']['thumb_savepath'] ?? $path.'/thumb';
        $thumb_widt=$this->BASE['image']['thumb_widt'] ?? 100;
        $thumb_height=$this->BASE['image']['thumb_height'] ?? 100;
        $thumb_path = public_path($th_path.'/' . $filename);
            \Image::make($image->getRealPath())->resize($thumb_widt, $thumb_height)->save($thumb_path);
        }   
//echo  $th_path.'/'.$filename;
//die;
         $this->BASE['data'][$imagedatamezo]=  $th_path.'/'.$filename;
        
         //$this->BASE['data'][$imagedatamezo]= $thumb_path;
        }
           
    }

}
