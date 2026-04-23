<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
#[Fillable(['start_date', 'end_date', 'start_time', 'end_time'])]
class Shift extends Model {
    use HasFactory;
    protected function casts(): array {
        return [
            //'start_time' => 'datetime:H:i:s', //For Carbon support
            //'end_time'   => 'datetime:H:i:s', //For Carbon support
            'start_date' => 'date',
            'end_date' => 'date'
        ];
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}