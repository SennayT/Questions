<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['title','body'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setTitleAttribute($value) {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getCreatedDateAttribute() {
        return $this->created_at->diffForHumans();
    }

    public function getUrlAttribute() {
        return route('questions.show', $this->slug);
    }

    public function getStatusAttribute() {
        if($this->answers_count > 0)  {
            if($this->best_answer_id) {
                return "answered-accepted";
            }
            return 'answered';
        }
        return 'unanswered';

    }

    public function getBodyHtmlAttribute(){

    }

    public function answers() {
       return $this->hasMany(Answer::class);
    }

    public function acceptBestAnswer(Answer $answer) {

        $this->best_answer_id = $answer->id;
        $this->save();

    }



}
