<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Image\Manipulations;
use Spatie\ImageOptimizer\Optimizers\Jpegoptim;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'subtitle',
        'body',
        'category',
        'is_published',
        'is_featured',
        'event_held_at',
    ];

    protected $casts = [
        'event_held_at' => 'datetime',
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

    public function get16by9Attribute(): ?string
    {
        return $this->media->first()?->getTemporaryUrl(Carbon::now()->addMinutes(5), '16by9');
    }

    public function getReadingTimeAttribute(): int
    {
        return (int)ceil(str_word_count($this->body) / 200);
    }

    public function registration(): HasOne
    {
        return $this->hasOne(EventRegistration::class, 'post_id', 'id');
    }
}
