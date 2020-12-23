<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Todo extends Model
{
    use HasFactory;
    use SoftDeletes;
	protected $table = 'todos';
	protected $dates =['deleted_at'];
    protected $primaryKey = "id_todos";
    protected $fillable = [
    	'name',
    	'start_date',
    	'end_date',
    	'proggress',
    	'create_by',
    	'update_by',
    	'delete_by',
    	'user_id',
    	
    ];
}
