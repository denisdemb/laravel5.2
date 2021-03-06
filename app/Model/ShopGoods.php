<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

//use App\Model\ShopCategories;


class ShopGoods extends Model
{

    protected $table = 'items';

    protected $fillable = [
        'title',
        'categoriy_id',
        'image',
        'new',
        'sale',        
        'published',       
        
    ];

// метод объединения двух таблиц
    public function categories(){
//  обединение один к одному модели ShopCategories.id и ShopGoods.categoriy_id
        return $this->hasOne('App\Model\ShopCategories','id','categoriy_id');
    }

    public function shopimages(){
//  обединение один к одному модели ShopImages.id и ShopGoods.categoriy_id
        return $this->hasOne('App\Model\ShopImages','image_id','id');
    }

//  метод возвращает связанные данные товара с категорией товара по id товара
    public static function catsItems(){
        return DB::table('items')
            ->join('categories','items.categoriy_id','=','categories.id')
            ->join('shopimages','items.id','=','shopimages.image_id')
            ->select('items.*','categories.title','categories.url','shopimages.path' )->get();
    }   

//  метод возвращает связанные данные товара с категорией товара по id товара
    public static function catId($id){
        return DB::table('items')->where('items.categoriy_id','=',$id)
            ->join('categories','items.categoriy_id','=','categories.id')
            ->join('shopimages','items.id','=','shopimages.image_id')
            ->select('items.*','categories.title','categories.url','shopimages.path')->get();
    }

//  метод возвращает связанные данные товара с категорией товара по id товара
    public static function itemId($id){
        return DB::table('items')->where('items.id','=',$id)
            ->join('shopimages','items.id','=','shopimages.image_id')
            ->select('items.*','shopimages.path')->get();
    }
    
    
}