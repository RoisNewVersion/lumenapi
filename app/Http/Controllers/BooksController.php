<?php 

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Book;
use Validator;
/**
 * books controller
 */
class BooksController
{
    /**
     * summary
     */
    public function index()
    {
        return Book::paginate(10);
    }

    public function show($id)
    {
        try {
            return Book::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'msg'=>'Book not found',
                'err'=>true,
                'res'=>false,
                'data'=>''
                ], 404);
        } 
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'=> 'required',
            'description'=>'required',
            'author'=>'required',
            ]);

        if($validator->fails()){
            return response()->json([
                'msg'=>'Failed create book', 
                'err'=>true, 
                'res'=>['input_error'=>$validator->errors()]
                ]);
        }

        if ($book = Book::create($this->input($request))) {
            return response()->json([
                'msg'=>'Book Created succesfully', 
                'err'=>false, 
                'res'=>$book
                ]);
        }else{
            return response()->json([
                'msg'=>'Failed create book', 
                'err'=>true, 
                'res'=>false
                ]);
        }
        
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title'=> 'required',
            'description'=>'required',
            'author'=>'required',
            ]);

        if($validator->fails()){
            return response()->json([
                'msg'=>'Failed create book', 
                'err'=>true, 
                'res'=>['input_error'=>$validator->errors()]
                ]);
        }

        $data = Book::findOrFail($id);

        if ($data->update($this->input($request))) {
            return response()->json([
                'msg'=>'Book Updated succesfully', 
                'err'=>false,
                'res'=>$data
            ]);
        }else{
            return response()->json([
                'msg'=>'Failed update book', 
                'err'=>true, 
                'res'=>false
            ]);
        }
    }

    public function delete(Request $request, $id)
    {
        $data = Book::findOrFail($id);

        if ($data->destroy($id)) {
            return response()->json([
                'msg'=>'Book deleted succesfully', 
                'err'=>false,
                'res'=>$data
            ]);
        }else{
            return response()->json([
                'msg'=>'Failed delete book', 
                'err'=>true, 
                'res'=>false
            ]);
        }
    }

    public function input($request)
    {
        return $data = [
            'title'=> ucwords($request->input('title')),
            'description'=>ucwords($request->input('description')),
            'author'=>ucwords($request->input('author'))
        ];
    }
    // not working
    public function validInput($request)
    {
        $validator = Validator::make($request->all(), [
            'title'=> 'required',
            'description'=>'required',
            'author'=>'required',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }else{
            return false;
        }
    }
}