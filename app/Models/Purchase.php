<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class Purchase extends Model {

        use SoftDeletes;

        protected $fillable
            = [
                'customer_id',
                'title',
                'model',
                'imei',
                'is_pta',
                'user_id',
                'total_amount',
            ];

        public function customer(): BelongsTo
        {
            return $this->belongsTo(Customer::class);
        }
    }
