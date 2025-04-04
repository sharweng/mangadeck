<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BadWord extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        // Filipino Slurs
        'word'
    ];
     /**
     * Get default bad words list if none exist in database
     */
    public static function getDefaultBadWords()
    {
        return [
            // Filipino Slurs
            'gago', 'bobo', 'tanga', 'leche', 'punyeta', 'hayop', 'buang', 'lintik', 'ulol', 'tarantado',
            'hindot', 'yawa', 'pakshet', 'bwisit', 'sira_ulo', 'kupal', 'tangina', 'putangina',
            // English Slurs (Racial/Ethnic)
            'nigger', 'kike', 'spic', 'chink', 'gook', 'wetback', 'redskin', 'sambo',
            // Homophobic/Transphobic Slurs
            'faggot', 'dyke', 'tranny', 'shemale',
            // Mental Health/Disability Slurs
            'retard', 'moron', 'spaz', 'cripple',
            // General Insults/Profanity
            'cunt', 'bitch', 'asshole', 'dick', 'pussy', 'whore', 'slut', 'bastard', 'sonofabitch'
        ];
    }
}