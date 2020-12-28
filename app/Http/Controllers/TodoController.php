<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $user = User::findOrFail($id);
        $todo = Todo::where('user_id',$id)->get();

        return response()->json([
            'data_todo' => $todo,
            'data_user' => $user
            ]);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $user = User::findOrFail($id);

        return response()->Json([
            'data_user' => $user
        ],200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'          => ['required'],
            'start_date'    => ['required'],
            'end_date'      => ['required'],
            'proggress'     => ['required'],
        ]);

        if($validator->fails()){

            return response()->Json($validator->errors(),400);
        }

        $todo = Todo::Create([
            'name'       => $request['name'],
            'start_date' => $request['start_date'],
            'end_date'   => $request['end_date'],
            'proggress'  => $request['proggress'],
            'user_id'    => $request->input('user_id'),
            'create_by'  => $request->input('create_by'),
        ]);

        if($todo){

            return response()->Json([
                'success' => true,
                'message' => 'success',
                'data'    => $todo
            ],200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Post Failed to Save',
         ], 409);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_todos)
    {
        $data = Todo::findOrFail($id_todos);

        return response()->Json([
            'data_todo' => $data
        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_todos)
    {
        $data = Todo::findOrFail($id_todos);

        $data->name         = $request->name;
        $data->start_date   = $request->start_date;
        $data->end_date     = $request->end_date;
        $data->proggress    = $request->proggress;
        $data->update_by    = $request->update_by;
        $data->save();

        return response()->Json([

            'message'   => 'success',
            'data'      => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tongsampah($id)
    {
        $data = Todo::where('user_id',$id)->onlyTrashed()->get();

        return response()->Json([
            'data_todo' => $data
        ],200);

    }

    public function softdelete(Request $request, $id_todos)
    {
        $data = Todo::findOrFail($id_todos);

        $data->delete_by    = $request->delete_by;
        $data->save();
        
        $data->delete();

        return response()->Json('Data di delete',200);
    }

    public function restore($id_todos)
    {
        $todo = Todo::onlyTrashed()->where('id_todos',$id_todos);
        $todo->restore();
        return response()->json("berhasil",200);
    }

    public function restoreall()
    {
        $todo = Todo::onlyTrashed();
        $todo->restore();
        return response()->json("Berhasil restore !!",200);
    }

    public function deleteall()
    {
        $todo = Todo::onlyTrashed();
        $todo->forceDelete();
        return response()->json("Berhasil !",200);
    }

    public function deletepermanet($id_todos)
    {
        $todo = Todo::onlyTrashed()->where('id_todos',$id_todos);
        $todo->forceDelete();
        return response()->json("berhasil",200);
    }
    
}
