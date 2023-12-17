<?php

namespace App\Models;

use App\Models\ListTable;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersTable extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'password', 'email', 'date_of_birth', 'age'];
    protected $table = 'users';
    public function list()
    {
        return $this->hasMany(ListTable::class, 'user_id', 'id');
    }

    public function register($userData)
    {
        $dob = Carbon::createFromFormat('m/d/Y', $userData->dob)->format('Y-m-d');
        $age = Carbon::parse($dob)->diff(\Carbon\Carbon::now())->format('%y years, %m months and %d days');
        try {
            $userObj = self::create([
                'name' => $userData->name,
                'password' => Hash::make($userData->password),
                'email' => $userData->email,
                'date_of_birth' => $dob,
                'age' => (int)$age
            ]);

            return true;
        } catch (\Exception $exp) {
            return false;
        }
    }
}
