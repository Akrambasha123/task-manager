<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory, Prunable, SoftDeletes;
    protected $table = 'tasks';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'description', 'is_completed', 'order'];
}
