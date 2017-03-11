<?php

namespace App\Http\Controllers\Portfolio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'ASC')->paginate(12);

        return view('vadmin.portfolio.categories.index')->with('categories', $categories);
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vadmin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function ajax_create(Request $request)
    {

        // if ($request->ajax())
        // {
        //     $result = Category::create($request->all());

        //     if ($result)
        //     {
        //         return response()->json(['success'=>'true']);
        //     } else {
        //         return response()->json(['success'=>'false']);
        //     }

        // }

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
    public function edit($id)
    {
        $category = Category::find($id);
        return view('vadmin.categories.edit')->with('category', $category);

    }

   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        echo 1;
        // return redirect()->route('categories.index')->with('message', 'La categoría '. $category->name.' ha sido eliminada');
    }

    
////////////////////////////////////////
//                                    //
//               AJAX                 //
//                                    //
////////////////////////////////////////

    // ---------- List -------------- //
    public function ajax_list()
    {
        $categories = Category::orderBy('id', 'DESC')->paginate(12);
        return view('vadmin/portfolio/categories/list')->with('categories', $categories);
    }



    // ---------- Store --------------- //
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'max:120|required|unique:categories'
        ],[
            'name.unique'         => 'La categoría ya existe'
        ]);

        if ($request->ajax())
        {            
            $result = Category::create($request->all());
            if ($result)
            {
                return response()->json(['success'=>'true', 'message'=>'Categoria creada']);
            } else {
                return response()->json(['success'=>'false', 'error'=>'Error']);        
            }
        }
    }



    // ---------- Edit --------------- //
    public function ajax_edit($id)
    {
        $category = Category::find($id);
        return response()->json($category);
    }



    // ---------- Update -------------- //
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'     => 'max:120|required|unique:categories'
        ],[
            'name.unique'         => 'La categoría ya existe'
        ]);
        
        $category = Category::find($id);
        $category->fill($request->all());

        // // O se puede hacer individualmente
        // // $user->name  = $request->name;
        // // $user->email = $request->email;
        // // $user->type  = $request->type;
        
        $result = $category->save();
        if ($result) {
            return response()->json(['success'=>'true']);
        } else {
            return response()->json(['success'=>'false']);
        }
    }

    // ---------- Delete -------------- //
    public function deleteCategory(Request $request, $id)
    {
        $category  = Category::find($id);
        $category->delete();
        echo 1;
    }

    // ---------- Ajax Bach Delete -------------- //
    public function ajax_batch_delete(Request $request, $id)
    {
        foreach ($request->id as $id) {
        
            $categories  = Category::find($id);
            Category::destroy($id);
        }
        echo 1;
    }

} // End
