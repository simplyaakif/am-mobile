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
                'occupation',
                'guarantor_whatsapp_mobile'
            ];


        public const OCCUPATIONS = [
            'student'=>'Student',
            'doctor'=>'Doctor',
            'engineer'=>'Engineer',
            'teacher'=>'Teacher',
            'gov_officer'=>'Government Job',
            'businessman'=>'Business Man/Woman',

        ];

        public function purchases(): HasMany
        {
            return $this->hasMany(Purchase::class, 'customer_id');
        }

        public function recoveries(): HasMany
        {
            return $this->hasMany(Recovery::class, 'customer_id');
        }
    }
