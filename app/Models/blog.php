<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class blog extends Model
{
    protected $appends = ['image','username','encript'];
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

    public function getEncriptAttribute()
    {
        $encriptid=Crypt::encrypt($this->id);
        return $encriptid;
    }
}
