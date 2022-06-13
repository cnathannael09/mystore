<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = Category::select('medicines.generic_name','medicines.restriction_formula','categories.name')
        //         ->join('medicines','categories.id','=','medicines.category_id')
        //         ->get();
        $data = Category::all();
        // dd($data);
        return view('category.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=new Category();

        $file=$request->file('logo');
        $imgFolder='images';
        $imgFile=time()."_".$file->getClientOriginalName();
        $file->move($imgFolder,$imgFile);
        $data->logo=$imgFile;

        $data->name=$request->get('name');
        $data->description=$request->get('description');
        $data->save();
        return redirect()->route('kategori.index')->with('status','Category is added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($category)
    {
        $res = Category::find($category);
        $message="";
        if ($res){
            $message = $res;
        } 
        else {
            $message = NULL;
        }
        return view('category.show',compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->name=$request->get('name');
        $category->description=$request->get('description');
        $category->save();
        return redirect()->route('kategori.index')->with('status','Category data is Changed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        try{
            $category->delete();
            return redirect()->route('kategori.index')->with('status','Category data is Deleted');
        } catch (\PDOException $e){
            $msg="Delete Failed to Delete. Please Check Data Child.";
            return redirect()->route('kategori.index')->with('error',$msg);
        }
    }

    public function showlist($id_category)
    {
        //Method#1: Query Builder
        // $data = DB::table('categories')
        //         ->join('medicines','categories.id','=','medicines.category_id')
        //         ->where('categories.id','=',$id_category)
        //         ->get();
        // $getTotalData = $data->count();

        //Method#2: Eloquent
        $data = Category::find($id_category);
        $namecategory = $data->name;
        $result = $data->medicines;
        //->medicines is Relationship Eloquement model and will return ArrayList/Collection
        if ($result)
            $getTotalData = $result->count();
        else $getTotalData = 0;

        return view('report.list_medicines_by_category',compact('id_category','namecategory','result','getTotalData'));
    }

    public function showzeromedicine()
    {
        $data = Category::select('categories.name')
            ->join('medicines', 'medicines.category_id', '=', 'categories.id')
            ->where(DB::raw('medicines.category_id = 0'))
            ->get();
        return dd($data);
    }

    public function getEditForm(Request $request)
    {
        $id=$request->get('id');
        $data=Category::find($id);
        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('category.getEditForm',compact('data'))->render()
        ),200);
    }

    public function getEditForm2(Request $request)
    {
        $id=$request->get('id');
        $data=Category::find($id);
        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('category.getEditForm2',compact('data'))->render()
        ),200);
    }

    public function saveData(Request $request)
    {
        $id=$request->get('id');
        $category=Category::find($id);
        $category->name=$request->get('name');
        $category->description=$request->get('description');
        $category->save();
        return response()->json(array(
            'status'=>'ok',
            'msg'=>'category data updated'
        ),200);
    }

    public function deleteData(Request $request)
    {
        try{
            $id=$request->get('id');
            $category=Category::find($id);
            $category->delete();
            return response()->json(array(
                'status'=>'ok',
                'msg'=>'category data deleted'
            ),200);
        }
        catch(\PDOException $e)
        {
            return response()->json(array(
                'status'=>'error',
                'msg'=>'category is not deleted. It maybe used in the product'
            ),200);
        }
    }

    public function saveDataField(Request $request)
    {
        $id=$request->get('id');
        $fname=$request->get('fname');
        $value=$request->get('value');

        $Kategori=Category::find($id);
        $Kategori->$fname=$value;
        $Kategori->save();
        return response()->json(array(
            'status'=>'ok',
            'msg'=>'category data updated'
        ),200);
    }

    public function changeLogo(Request $request)
    {
        $id=$request->get('id');
        $file=$request->file('logo');
        $imgFolder='images';
        $imgFile=time()."_".$file->getClientOriginalName();
        $file->move($imgFolder,$imgFile);
        
        $Kategori=Category::find($id);
        $Kategori->logo=$imgFile;
        $Kategori->save();

        return redirect()->route('kategori.index')->with('status','Kategori logo is changed');
    }
}
