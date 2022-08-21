<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\ImageOptimizer\Optimizers\Jpegoptim;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $casts = [
        'options' => 'array',
    ];

//    protected $attributes = [
////        'options' => [
////            'colors' => [
////                'Rood' => 'Rood',
////                'Blauw'=> 'Blauw',
////                'Geel' => 'Geel',
////                'Zwart' => 'Zwart',
////                'Wit' => 'Wit',
////                'Groen' => 'Groen',
////            ],
////            'sizes' => [
////                'XS' => 'XS',
////                'S' => 'S',
////                'M' => 'M',
////                'L' => 'L',
////                'XL' => 'XL',
////                'XXL' => 'XXL',
////            ],
////        ],
//    ];

    public function getPrice()
    {
        if (auth()->user() && auth()->user()->hasSubscription()) {
            return $this->member_price;
        }
        return $this->normal_price;
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->optimize([Jpegoptim::class => ['--all-progressive']])
            ->nonQueued();

        $this
            ->addMediaConversion('16by9')
            ->fit(Manipulations::FIT_STRETCH, 1920, 1080)
            ->optimize([Jpegoptim::class => ['--all-progressive']])
            ->nonQueued();

        $this
            ->addMediaConversion('4by3')
            ->fit(Manipulations::FIT_STRETCH, 1000, 750)
            ->optimize([Jpegoptim::class => ['--all-progressive']])
            ->nonQueued();
    }

    public function fileUrl(): ?string
    {
        return $this->media->first()?->getTemporaryUrl(Carbon::now()->addMinutes(5));
    }

    public function preview(): ?string
    {
        return $this->media->first()?->getTemporaryUrl(Carbon::now()->addMinutes(5), 'preview');
    }

    public function get4by3Attribute(): ?string
    {
        return $this->media->first()?->getTemporaryUrl(Carbon::now()->addMinutes(5), '4by3');
    }

    public function getUrlsAttribute()
    {
        $urls = [];
        foreach ($this->media()->get() as $media) {
            $urls[] = $media->getTemporaryUrl(Carbon::now()->addHour());
        }
        return $urls;
    }


}
