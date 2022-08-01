<?php

namespace App\Models\Expenses;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $table = 'expenses';

    protected $fillable = [
        'service_name', 'service_cost', 'duration_amount', 'duration', 'start_from_date', 'slug',
    ];

    public function roles()
    {
        return $this->hasMany(ExpenseRole::class, 'foreign_key', 'local_key');
    }
}
