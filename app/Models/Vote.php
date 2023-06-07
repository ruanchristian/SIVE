<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model {
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['candidate_id', 'student_id', 'election_id'];

    public function candidate() {
        return $this->belongsTo(Candidate::class);
    }

    public function election() {
        return $this->belongsTo(Election::class);
    }
}
