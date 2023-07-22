<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $fillable = [
        "title",
        "description",
        "menu_id",
        "image",
        "price",
    ];

    public $appends = ['image_full_url'];
    public function getImageFullUrlAttribute(){
        if($this->image){
            return asset("storage/{$this->image}");
        }
        else{
            return '';
        }
    } 

    public function menu(){
        return $this->belongsTo("App\Models\Menu", "menu_id");
    }
}
