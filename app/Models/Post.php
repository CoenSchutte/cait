<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;



    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
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

    public function getReadingTimeAttribute(): int
    {
        return (int)ceil(str_word_count($this->body) / 200);
    }




}
