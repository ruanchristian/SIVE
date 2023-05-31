<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model {
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['name', 'image'];

    public function votes() {
        return $this->hasMany(Vote::class);
    }
}