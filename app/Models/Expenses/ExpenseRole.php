<?php

namespace App\Models\Expenses;

use App\Models\FinancialRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseRole extends Model
{
    use HasFactory;

    protected $table = 'expense_roles';

    protected $fillable = [
        'financial_id', 'expense_id',
    ];

    public function belongsToFinancialRole()
    {
        return $this->belongsTo(FinancialRole::class, 'financial_id', 'id');
    }

    public function belongsToExpense()
    {
        return $this->belongsTo(Expense::class, 'expense_id', 'id');
    }

    public function permission()
    {
        return $this->hasOne(ExpenseRolePermission::class, 'expense_role_id', 'id');
    }
}
