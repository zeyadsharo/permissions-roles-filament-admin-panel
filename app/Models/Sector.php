<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;
      protected $fillable = ['arabic_title', 'kurdish_title', 'description', 'display_order', 'display_state', 'icon', 'activation_state'];
}
