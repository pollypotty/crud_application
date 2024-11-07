<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static paginate(int $int)
 * @method static findOrFail(string $id)
 * @property mixed $name
 * @property mixed $email
 * @property false|mixed|string|null $logo_image_path
 * @property mixed $website_url
 */
class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'logo_image_path',
        'website_url',
    ];

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
