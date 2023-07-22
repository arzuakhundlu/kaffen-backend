<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = "menus";
    protected $fillable = [
        "title",
        "image",
    ];

    public $appends = ['image_full_url_menu'];
    public function getImageFullUrlMenuAttribute(){
        if($this->image){
            return asset("storage/{$this->image}");
        }
        else{
            return '';
        }
    } 

}
