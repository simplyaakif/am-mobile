<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

        public function customer(): BelongsTo
        {
            return $this->belongsTo(Customer::class);
        }

        public function purchase(): BelongsTo
        {
            return $this->belongsTo(Purchase::class);
        }
    }
