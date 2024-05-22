<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blog extends Model
{
    protected $appends = ['image','username'];
    use HasFactory;
    
    public function getImageAttribute(){
        $id=$this->id;
        $query=blogImage::where('user_id',$id)->first();
        return $query->blog_image; 
    }

    
    public function getusernameAttribute(){
        $id=$this->user_id;
        $query=User::where('id',$id)->first();
        return $query->name; 
    }
}
