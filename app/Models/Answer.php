<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = ['body','user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function question() {
        return $this->belongsTo(Question::class);
    }

    public static function boot() {
        parent::boot();

        static::created(function($answer){
            $answer->question->increment('answers_count');
            $answer->question->save();
        });

        static::deleted(function($answer){
            $question = $answer->question;
            $question->decrement('answers_count');
            if($question->best_answer_id === $answer->id) {
                $question->best_answer_id = NULL;
                $question->save();
            }
        });


    }

    public function getCreatedDateAttribute() {
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute() {
        return $this->id === $this->question->best_answer_id ? 'vote-accepted' : '';
    }

    public function getIsBestAttribute() {
        return $this->id === $this->question->best_answer_id ;
    }

}
