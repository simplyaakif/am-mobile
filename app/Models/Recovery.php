<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Recovery extends Model {

        protected $fillable
            = [
                'customer_id',
                'purchase_id',
                'amount',
                'due_date',
                'is_paid',
                'paid_on',
                'account_id',
            ];

        protected $casts
            = [
                'due_date' => 'datetime',
                'paid_on'  => 'datetime',
            ];
    }
