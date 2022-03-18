<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookOnLoan extends Model
{
    protected $table = 'books_on_loans';
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'book_id',
        'user_id',
        'return_date',
    ];
    
    /**
     * Get the book that owns the book on loan.
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Get the user that owns the book on loan.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
