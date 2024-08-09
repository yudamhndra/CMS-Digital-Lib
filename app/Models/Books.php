<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Books extends Model
{
    use HasFactory;

    protected $table = 'books';

    protected $fillable = [
        'categories_id',
        'user_id',
        'title',
        'description',
        'books_amount',
        'books_file',
        'books_cover'
        
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Categories::class, 'categories_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getBookFileUrlAttribute(): string
    {
        return asset('storage/' . $this->books_file);
    }

    public function getCoverImageUrlAttribute(): string
    {
        return asset('storage/' . $this->books_cover);
    }

}
