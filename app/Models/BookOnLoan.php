<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookOnLoan extends Model
{
    protected $table = 'books_on_loans';
    use HasFactory;
}
