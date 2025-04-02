<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Todo;       

class TodoController extends Controller
{
    private $todo;
    public function __construct(Todo $todo)
    {
        $this->todo = $todo; 
    }
    public function index()
    {
        $todos = $this->todo->all();

        return view('todo.index', ['todos' => $todos]);
    }

    public function create()
    {
        return view('todo.create');
    }
    public function store(TodoRequest $request)
    {
        $inputs = $request->all();

        $this->todo->fill($inputs);
        $this->todo->save();

        return redirect()->route('todo.index');
    }
    public function show($id)
    {
        $todo = $this->todo->find($id);
        return view('todo.show', ['todo' => $todo]);
        // $model = new Todo();
        // $todo = $model->find($id);
        // return view('todo.show', ['todo' => $todo]);
    }
    public function edit($id)
    {
        $todo =  $this->todo->find($id);
        return view('todo.edit', ['todo' => $todo]);
    }
    public function update(TodoRequest $request, $id)
    {
        $inputs = $request->all();
        // TODO: 更新対象のデータを取得
        $todo = $this->todo->find($id);
        // TODO: 更新したい値の代入とUPDATE文の実行
        $todo-> fill($inputs)->save(); 
        return redirect()->route('todo.show', $todo->id);
    }   
}