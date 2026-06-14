<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Election extends Model {
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['year', 'title', 'active'];

    public function candidates() {
        return $this->hasMany(Candidate::class);
    }

    public function votes() {
        return $this->hasMany(Vote::class);
    }
}