<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $guarded = [];

    const ID_PREFIX = 'EVM-';

    const STATUS_NEW = 1;
    const STATUS_RECEIVED = 2;
    const STATUS_PROCESSING = 3;
    const STATUS_FINISHED = 4;

    const STATUSES = [
        self::STATUS_NEW => 'Yangi',
        self::STATUS_RECEIVED => 'Qabul qinilgan',
        self::STATUS_PROCESSING => 'Amaliy jarayonda',
        self::STATUS_FINISHED => 'Yakunlangan'
    ];

    public static function getForList($perPage = 15)
    {
        return self::select(['id','fullname','email', 'phone', 'status', 'subject'])
            ->orderBy('status')
            ->orderBy('id', 'desc')
            ->paginate($perPage);
    }

    public function getStatus($status = null) : string
    {
        $status = !empty($status) ? $status : $this->status;
        if (!empty(self::STATUSES[$status])) {
            return self::STATUSES[$status];
        }
        return 'Noma\'lum';
    }

    public function getId()
    {
        return self::ID_PREFIX. $this->id;
    }

}
