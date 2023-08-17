<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Spatie\MediaLibrary\HasMedia;
    use Spatie\MediaLibrary\InteractsWithMedia;

    class Customer extends Model implements HasMedia {

        use InteractsWithMedia;
        protected $fillable
            = [
                'name',
                'whatsapp_mobile',
                'mobile',
                'reference',
                'address',
                'occupation_id',
            ];

        public function purchases(): HasMany
        {
            return $this->hasMany(Purchase::class, 'customer_id');
        }
    }
