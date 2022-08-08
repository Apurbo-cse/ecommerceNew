<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [

        'title', 
        'slug',
        'product_id',
                'short_desc', 
                'details', 
                'image', 
                'image_two',
                'image_three',
                'regular_price',
                'offer_price', 
                'size',
                'stock',
                'status',
                'regular_price',
                'offer_price',
                'avg_review',
                'total_sell',
                'is_featured',
                'tag_id',
                'category_id',
                'subcategory_id',
                
        
        'logo', 'phone', 'email', 'address', 'facebook_link', 'twitter_link', 'pintorest_link', 'messenger_link', 'about', 'terms_condition', 'privacy_policy', 'refund_policy', 'google_map_link', 'whatsapp', 'whatsapp_link'];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function subCategory()
    {
        return $this->belongsTo('App\SubCategory', 'subcategory_id');
    }

    public function tag()
    {
        return $this->belongsTo('App\Tag');
    }
}
