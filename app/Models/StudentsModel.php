<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentsModel extends Model
{
    protected $table            = 'student';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'student_id',
        'student_name',
        'degree_program',
        'year_level',
        'section',
        'semester',
        'email',
        'mobile_number',
        'amount_paid',
        'membership_paid',
        'transaction_date',
        'status'
    ];

    // New method to calculate monthly revenue
    public function getMonthlyRevenue()
    {
        // Get the current year and month
        $currentMonth = date('m');
        $currentYear = date('Y');

        // Perform the query to sum the 'amount_paid' where the 'paid_date' is in the current month
        return $this->selectSum('amount_paid')
                    ->where('YEAR(transaction_date)', $currentYear)
                    ->where('MONTH(transaction_date)', $currentMonth)
                    ->first();  // Using first() to get a single result
    }


    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
