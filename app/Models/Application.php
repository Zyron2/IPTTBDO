<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Application extends Model
{
    use HasFactory;

    public const BRANCH_IP = 'ip';
    public const BRANCH_TECH_TRANSFER = 'tech_transfer';
    public const BRANCH_BUSINESS_DEVELOPMENT = 'business_development';
    public const BRANCH_INCUBATION = 'incubation';
    public const BRANCH_CONSULTATION = 'consultation';

    public const STATUS_FOR_EVALUATION = 'for_evaluation';
    public const STATUS_REVIEWED = 'reviewed';
    public const STATUS_DRAFTING = 'drafting';
    public const STATUS_REGISTERED = 'registered';
    public const STATUS_FOR_REVISION = 'for_revision';
    public const STATUS_COMPLETED = 'completed';

    protected $fillable = [
        'submitted_by',
        'tracking_no',
        'branch',
        'application_type',
        'title',
        'description',
        'proponent_name',
        'inventor_name',
        'startup_name',
        'status',
        'date_filed',
        'remarks',
        'viewed_details',
        'payload',
        'reviewed_at',
    ];

    protected function casts(): array
    {
        return [
            'date_filed' => 'date',
            'payload' => 'array',
            'reviewed_at' => 'datetime',
        ];
    }

    public static function branches(): array
    {
        return [
            self::BRANCH_IP => 'IP',
            self::BRANCH_TECH_TRANSFER => 'Tech Transfer / Commercialization',
            self::BRANCH_BUSINESS_DEVELOPMENT => 'Business Development',
            self::BRANCH_INCUBATION => 'Incubation',
            self::BRANCH_CONSULTATION => 'Consultation',
        ];
    }

    public static function statusOptions(): array
    {
        return [
            self::STATUS_FOR_EVALUATION => 'For Evaluation',
            self::STATUS_REVIEWED => 'Reviewed',
            self::STATUS_DRAFTING => 'Drafting',
            self::STATUS_REGISTERED => 'Registered',
            self::STATUS_FOR_REVISION => 'For Revision',
            self::STATUS_COMPLETED => 'Completed',
        ];
    }

    public static function formTypes(): array
    {
        return [
            'patent_form' => 'Patent Form',
            'um_form' => 'UM Form',
            'id_form' => 'ID Form',
            'trademark_form' => 'Trademark Form',
            'copyright_form' => 'Copyright Form',
            'startup_form' => 'Startup / Incubation Form',
        ];
    }

    public static function generateTrackingNo(string $branch): string
    {
        return sprintf(
            '%s-%s-%s',
            Str::upper(substr(str_replace('_', '', $branch), 0, 3)),
            now()->format('Ymd'),
            Str::upper(Str::random(6))
        );
    }

    public function submittedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    public function branchLabel(): string
    {
        return self::branches()[$this->branch] ?? Str::headline($this->branch);
    }

    public function statusLabel(): string
    {
        return self::statusOptions()[$this->status] ?? Str::headline($this->status);
    }

    public function formTypeLabel(): string
    {
        return self::formTypes()[$this->application_type] ?? Str::headline($this->application_type);
    }
}
