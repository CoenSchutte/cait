<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\ImageOptimizer\Optimizers\Jpegoptim;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Highlight extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'category',
        'is_published',
        'event_date',
    ];

    protected $casts = [
        'event_date' => 'date',
    ];

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
        return $this->getFirstMediaUrl('default', 'preview');
    }

    public function get4by3Attribute(): ?string
    {
        return $this->getFirstMediaUrl('default', '4by3');
    }

    public function get16by9Attribute(): ?string
    {
        return $this->getFirstMediaUrl('default', '16by9');
    }
}
