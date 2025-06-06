<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model {
    use HasFactory;
    protected $table = 'logs';
    protected $fillable = ['action', 'description', 'user_id', 'entity_type', 'entity_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
