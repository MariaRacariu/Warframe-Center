<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorites extends Model
{
    use HasFactory;
    public $fillable = ['user_id', 'name', 'type', 'mastery_rank'];
    public $timestamps = false; //This disables the automatic feature of laravel that adds two timestamp entries to the table as we do not need them
}


// FAVORITES: in users table have players Mastery rank, check against favorites mastery rank when favoriting it
// | FAVORITES_ID | UID | NAME | TYPE | MR_RANK |   
//     1             1   sword  Primary    0  
//     2             6    gun   Melee      4   
//     3             6  
//     4             8  
