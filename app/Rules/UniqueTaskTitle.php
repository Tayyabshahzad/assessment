<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Task;

class UniqueTaskTitle implements Rule
{
    public function passes($attribute, $value)
    {
        // Retrieve the category IDs from the request
        $categoryIds = request()->input('categories');

        // Check if any other task with the same title exists in the selected categories

        return !Task::where('name', $value)
            ->whereHas('categories', function ($query) use ($categoryIds) {
                $query->whereIn('categories.id', $categoryIds); // Specify the table name for the id column
            })
            ->exists();
    }

    public function message()
    {
        return "The task name is already taken within the selected categories. Please choose a unique name or unique category. ";
    }
}
