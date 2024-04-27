<?php

namespace App\Models;

use App\Enums\LanguageFileNames;
use Illuminate\Contracts\Foundation\Application as ApplicationAlias;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Application;

class Exchange extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'symbol',
        'price',
        'code',
        'source',
        'created_at',
        'updated_at'
    ];

    protected $appends = ['translated_name'];

    /**
     * @return Application|array|string|Translator|ApplicationAlias|null
     */
    public function getTranslatedNameAttribute(): Application|array|string|Translator|ApplicationAlias|null
    {
        return trans(LanguageFileNames::CURRENCIES->value . '.' . $this->code);
    }
}
