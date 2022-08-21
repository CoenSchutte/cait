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

class Ad extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'company_name',
        'expiration_date',
    ];
    protected $casts = [
        'expiration_date' => 'date',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->optimize([Jpegoptim::class => ['--all-progressive']])
            ->nonQueued();

        $this
            ->addMediaConversion('sidebar')
            ->fit(Manipulations::FIT_STRETCH, 770, 926)
            ->optimize([Jpegoptim::class => ['--all-progressive']])
            ->nonQueued();

        $this
            ->addMediaConversion('mainbar')
            ->fit(Manipulations::FIT_STRETCH, 1200, 233)
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

    public function getSidebarAttribute(): ?string
    {
        return $this->media->first()?->getTemporaryUrl(Carbon::now()->addMinutes(5), 'sidebar');
    }

    public function getMainbarAttribute(): ?string
    {
        return $this->getMedia('mainbar')->first()?->getTemporaryUrl(Carbon::now()->addMinutes(5), 'mainbar');
    }
}
