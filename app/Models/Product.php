<?php

namespace App\Models;

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
        'options' => 'json',
    ];

    protected $fillable = [
        'name',
        'description',
        'category',
        'options',
        'normal_price',
        'member_price',
        'is_available',
        'is_displayed',
        'stock',
    ];

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
        return $this->getFirstMediaUrl();
    }

    public function preview(): ?string
    {
        return $this->getFirstMediaUrl('images', 'preview');
    }

    public function get4by3Attribute(): ?string
    {
        return $this->getFirstMediaUrl('images', '4by3');
    }

    public function getUrlsAttribute(): array
    {
        return $this->getMedia('images')->map(fn($media) => $media->getUrl())->toArray();
    }
}
