<?php

namespace App\Models;

use App\Http\Controllers\BooksController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categories extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = ['category'];

    public function books(): HasMany
    {
        return $this->hasMany(BooksController::class, 'category_id'); 
    }
}
