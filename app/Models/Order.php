<?php

namespace App\Models;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    use DefaultDatetimeFormat;

    const REFUND_STATUS_PENDING = 'pending';
    const REFUND_STATUS_APPLIED = 'applied';
    const REFUND_STATUS_PROCESSING = 'processing';
    const REFUND_STATUS_SUCCESS = 'success';
    const REFUND_STATUS_FAILED = 'failed';

    const SHIP_STATUS_PENDING = 'pending';
    const SHIP_STATUS_DELIVERED = 'delivered';
    const SHIP_STATUS_RECEIVED = 'received';

    public static $refundStatusMap = [
        self::REFUND_STATUS_PENDING    => '未退货',
        self::REFUND_STATUS_APPLIED    => '已申请退货',
        self::REFUND_STATUS_PROCESSING => '退货中',
        self::REFUND_STATUS_SUCCESS    => '退货成功',
        self::REFUND_STATUS_FAILED     => '退货失败',
    ];

    public static $shipStatusMap = [
        self::SHIP_STATUS_PENDING   => '未发货',
        self::SHIP_STATUS_DELIVERED => '已发货',
        self::SHIP_STATUS_RECEIVED  => '已收货',
    ];

    protected $fillable = [
        'no',
        'address',
        'remark',
        'confirmed_at',
        'refund_status',
        'refund_no',
        'closed',
        'ship_status',
        'ship_data',
        'extra',
    ];

    protected $casts = [
        'closed'    => 'boolean',
        'address'   => 'json',
        'ship_data' => 'json',
        'extra'     => 'json',
    ];

    protected $dates = [
        'confirmed_at',
    ];

    protected static function boot()
    {
        parent::boot();
        // 监听模型创建事件，在写入数据库之前触发
        static::creating(function ($model) {
            if (!$model->no) {
                $model->no = static::findAvailableNo();
                if (!$model->no) {
                    return false;
                }
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public static function findAvailableNo()
    {
        // 订单流水号前缀
        $prefix = date('YmdHis');
        for ($i = 0; $i < 10; $i++) {
            // 随机生成 6 位的数字
            $no = $prefix.str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            if (!static::query()->where('no', $no)->exists()) {
                return $no;
            }
        }
        \Log::warning('find order no failed');

        return false;
    }
}
