<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Rules\UniqueTaskTitle;
use App\Http\Requests\TaskStoreRequest;
class TaskController extends Controller
{

    public function showCategories()
    {
        $categories = Category::get(); // Paginate categories
        return view('tasks.categories', compact('categories'));
    }


    public function index()
    {
        $categories = Category::get(); // Paginate categories
        $tasks = Task::with('categories')->orderBy('priority', 'asc')->paginate(20); // Paginate tasks ordered by priority
        return view('tasks.index', compact('categories', 'tasks'));
    }

    public function store(TaskStoreRequest $request)
    {

        $validatedData = $request->validated();



        $task = new Task();
        $task->name = $request->name;
        $task->description = $request->description;
        $task->priority = $request->priority;
        $task->save();
        $task->categories()->sync($request->categories);

        return redirect()->back()->with('success', 'New Task Created');
    }

}
