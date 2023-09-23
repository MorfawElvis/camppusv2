<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\GeneralSetting
 *
 * @property int $id
 * @property string|null $school_name
 * @property string|null $school_address
 * @property string|null $school_po_box
 * @property string|null $school_email
 * @property string|null $school_website
 * @property string|null $school_phone_number
 * @property string|null $school_logo
 * @property bool|null $collapsed_sidebar
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read mixed $school_logo_path
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting query()
 * @mixin \Eloquent
 * @mixin IdeHelperGeneralSetting
 */
class GeneralSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_name',
        'school_address',
        'school_po_box',
        'school_email',
        'school_website',
        'school_phone_number',
        'school_logo',
        'principal_signature',
        'collapsed_sidebar',
        'fixed_header',
    ];

    //    protected $dateFormat = 'd/m/Y';
    protected $casts = [
        'collapsed_sidebar' => 'boolean',
        'fixed_header' => 'boolean',
    ];

    public function getCreatedAtAttribute($timestamp)
    {
        return Carbon::parse($timestamp)->format('d M, Y');
    }

    public function getUpdatedAtAttribute($timestamp)
    {
        return Carbon::parse($timestamp)->format('d M, Y');
    }

    public function setBoardingFeeAttribute($value)
    {
        $this->attributes['boarding_fee'] = str_replace(',', '', $value);
    }
}
