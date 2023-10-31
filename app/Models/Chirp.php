<?php

namespace App\Models;

use App\Events\ChirpCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chirp extends Model
{
    use HasFactory;

    const STATUS_CHIRPED = 'chirped';
    const STATUS_EDITED = 'edited';
    const STATUS_DELETED = 'deleted';

    const VALID_STATUSES = [
        self::STATUS_CHIRPED,
        self::STATUS_EDITED,
        self::STATUS_DELETED,
    ];

    protected $fillable = [
        'message',
        'status'
    ];

    protected $rules = [
        'status' => 'required|in:' . self::STATUS_CHIRPED . ',' . self::STATUS_EDITED . ','. self::STATUS_DELETED,
    ];

    protected $dispatchesEvents = [
        'created'=> ChirpCreated::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


}
