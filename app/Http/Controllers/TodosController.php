<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Validator;
use App\Models\Todo;
use Illuminate\Support\Facades\Validator;


class TodosController extends Controller
{
    public $validationTodo;
    public function todoValidator($request)
    {
        $rules = array(
            "name" => "required",
            "description" => "required",
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $this->validationTodo = $validator->errors();
            return 1;
        }
    }
    public function index()
    {

        return response()->json(["data" => Todo::all()],200);
    }
    public function show($todoId)
    {
        $todo = Todo::find($todoId);
        if(!$todo){
            return response('task is not found'); 
        }
        return response()->json(["message" => $todo]);
    }
    public function create()
    {


        if ($this->todoValidator(request())) {
            return $this->validationTodo;
        }
  $data=request();
        $todo = new Todo();
        $todo->name = $data['name'];
        $todo->description = $data['description'];
        $todo->completed = $data['completed'] || 0;
        $todo->save();
        return response($todo,201);
    }
    public function edit($todoId)
    {
        if ($this->todoValidator(request())) {
            return $this->validationTodo;
        }
        $todo = Todo::find($todoId);
        if(!$todo){
            return response("could not finde todo",404); 
        }
        $todo->name = request()['name'];
        $todo->description = request()['description'];
        $todo->save();
        return response("updated",200); 

    }
    public function destroy($todoId)
    {
$todo=Todo::find($todoId);
if(!$todo){
    return response("could not finde todo",404);
}
$todo->delete();
        
}
public function finish($todoId)
    {
$todo=Todo::find($todoId);
if(!$todo){
    return response("could not finde todo",404);
}
$todo->completed=true;
return response($content='done',$status=200);
        
}

}