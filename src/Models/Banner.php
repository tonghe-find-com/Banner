<?php

namespace TypiCMS\Modules\Banners\Models;

use App\HasImage;
use App\HasList;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laracasts\Presenter\PresentableTrait;
use Spatie\Translatable\HasTranslations;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\Files\Models\File;
use TypiCMS\Modules\Files\Traits\HasFiles;
use TypiCMS\Modules\History\Traits\Historable;
use TypiCMS\Modules\Banners\Presenters\ModulePresenter;
use Illuminate\Support\Facades\Storage;

class Banner extends Base
{
    use HasFiles;
    use HasTranslations;
    use Historable;
    use PresentableTrait;
    use HasList;
    use HasImage;

    protected $presenter = ModulePresenter::class;

    protected $guarded = [];

    public $translatable = [
        'title',
        'status',
        'link',
        'summary'
    ];

    public function getThumbAttribute(): string
    {
        return $this->present()->image(null, 54);
    }

    public function getProductThumbAttribute(): string
    {
        return Storage::url($this->mobileImage->path ?? '');
    }

    public function getProductImage()
    {
        if($this->product_image_id > 0){
            return Storage::url($this->product_image->path ?? '');
        }
        return asset('project/images/logo.png');
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(File::class, 'image_id');
    }

    public function product_image(): BelongsTo
    {
        return $this->belongsTo(File::class, 'product_image_id');
    }

    public function getVideoAttribute()
    {
        return Storage::url($this->image->path ?? '');
    }

    public function getIsVideoAttribute()
    {
        if($this->image_id > 0 && $this->image && $this->image->type=='a'){
            return true;
        }else{
            return false;
        }
    }
}
