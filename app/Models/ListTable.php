<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class ListTable extends Model
{
    use HasFactory;
    protected $table = 'list';
    protected $fillable = ['user_id', 'title', 'description', 'task_date'];
    public function user()
    {
        return $this->hasOne(UsersTable::class, 'user_id', 'id');
    }

    public function store($requestData)
    {
        try {
            self::create([
                'user_id' => 1,
                'title' => $requestData['title'],
                'description' => $requestData['description'],
                'task_date' => Carbon::createFromFormat('m/d/Y', $requestData['task_date'])->format('Y-m-d')
            ]);
        } catch (\Exception $exp) {
            echo $exp->getMessage();
            Log::error('Failed to add the user task data.');

            return false;
        }

        return true;
    }
}
