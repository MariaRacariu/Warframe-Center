<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Components extends Model
{
    use HasFactory;

    public $fillable = ['favorites_id', 'name', 'amount', 'filename', 'acquired'];
    public $timestamps = false; //This disables the automatic feature of laravel that adds two timestamp entries to the table as we do not need them

    protected $attributes = [ //define default value
        'acquired' => 0,
    ];
}

// COMPONENTS: when adding to this database, loop over components amount from php and set to false, true once clicked, this will be null by default

// | COMPONENTS_ID | FAVORITES_ID | COMPONENT_1 | COMPONENT_2 | COMPONENT_3 | COMPONENT_4 | COMPONENT_5 | COMPONENT_6
//     1               3               true         false         false          null          null          null
//     2               4               true         true          true           true          true          false
//     3               1               null         null          null           null          null          null
//     4
//     5
// found this idea did not make sense as it required referencing the API arrays which would have bloated the dashboard page and reworked table below, see migrations for changes



//REWORKED COMPONENTS TABLE
// | COMPONENTS_ID | FAVORITES_ID | NAME | AMOUNT | FILENAME | ACQUIRED     
//        1               3         cloth    4      cloth.png    true
//        1               3         dirt     64     dirt.png     false
//        1               6         cloth    77     cloth.png    false
//        1               7         cloth    343    cloth.png  false