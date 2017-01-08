<?php


use Modules\MediaItem\Entities\Image;
use Modules\Product\Entities\Product;

Route::group(['middleware' => ['web'], 'prefix'=>'mediaitem', 'namespace' => 'Modules\MediaItem\Http\Controllers'], function (){

    Route::get('/testRoute',function (Product $product){
        /**
         * @var $item Product
        **/
        $item = $product->find(1);
//        dd(Product::class);
        $mediaItems = $item->mediaItems(Image::class);
        dd($mediaItems->get());
    });
});

Route::group(['middleware' => ['web','role:admin,access_backend','menu'], 'prefix' => 'admin', 'namespace' => 'Modules\MediaItem\Http\Controllers'], function()
{
    Route::resource('mediaitems', 'MediaItemController',['except'=> ['show']]);
});