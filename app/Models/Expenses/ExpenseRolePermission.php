<?php

namespace App\Models\Expenses;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseRolePermission extends Model
{
    use HasFactory;

    protected $table = 'expense_role_permissions';

    protected $fillable = [
        'expense_role_id', 'canRead', 'canCreate', 'canUpdate', 'canDelete',
    ];

    public function belongsToExpenseRole()
    {
        return $this->belongsTo(ExpenseRole::class, 'expense_role_id', 'id');
    }
}
