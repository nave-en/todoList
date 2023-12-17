<?php

namespace App\Http\Controllers;

use App\Models\ListTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ListController extends Controller
{
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'task_date' => 'required|date',
        ]);

        if ($validated->fails()) {
            return "failed";
        }

        $status = (new ListTable())->store($request->all());
        if (!$status) {
            return "failed";
        }

        return "success";

    }
}
