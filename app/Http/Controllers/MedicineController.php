<?php

namespace App\Http\Controllers;

use App\Medicine;
use App\Category;
use Illuminate\Http\Request;
use DB;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Query Raw
        // $queryRaw = DB::select(DB::raw("select * from products"));
        // dd($queryRaw);

        //Query Builder
        // $queryBuilder = DB::table('medicines')->get();

        //Eloquent
        $queryModel = Medicine::all();

        //Pada controller dan view
        // return view('product.index',compact('queryBuilder'));
        return view('medicine.index',compact('queryModel'));

        //Pada controller dan pada View diubah namanya menjadi data
        // return view('product.index',['data'=>$queryBuilder]);
        // $data = Medicine::select('generic_name','restriction_formula','price')->get();
        // dd($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Category::all();
        return view('medicine.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=new Medicine();
        $data->generic_name=$request->get('name');
        $data->form=$request->get('form');
        $data->restriction_formula=$request->get('restriction');
        $data->price=$request->get('price');
        $data->description=$request->get('description');
        $data->category_id=$request->get('categoryid');
        $data->faskes1=$request->get('faskes1');
        $data->faskes2=$request->get('faskes2');
        $data->faskes3=$request->get('faskes3');
        $data->save();
        return redirect()->route('obat.index')->with('status','Medicine is added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function show($medicine)
    {
        //select * from medicines where id = $medicine
        $res = Medicine::find($medicine);
        $message="";
        // $name = $res->generic_name;
        // $formula = $res->restriction_formula;
        // $price = $res->price;
        if ($res){
            //apabila ditemukan
            $message = $res;
        } 
        else {
            //apabila tidak ditemukan
            $message = NULL;
        }
        return view('medicine.show',compact('message'));
        // return view('medicine.show',['message'=> $message]);
        // dd($res)
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $medicine = Medicine::find($id);
        $data = Category::all();
        // dd($medicine);
        return view('medicine.edit',compact('medicine'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medicine $medicine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $medicine = Medicine::find($id);
        try{
            $medicine->delete();
            return redirect()->route('obat.index')->with('status','Category data is Deleted');
        } catch (\PDOException $e){
            $msg="Delete Failed to Delete. Please Check Data Child.";
            return redirect()->route('obat.index')->with('error',$msg);
        }
    }
    
    public function showaverage()
    {
        $data = Medicine::select(DB::raw('IFNULL(AVG(medicines.price),0) as average'))
                ->join('categories', 'categories.id', '=', 'medicines.category_id')
                ->groupBy('categories.id')
                ->get();
        return dd($data);
    }

    public function showcategories()
    {
        $data = Medicine::select(DB::raw('COUNT(categories.id) AS jumlah_kategori'))
                    ->join('categories','categories.id','=','medicines.category_id')
                    ->groupBy('categories.id')
                    ->get();
        return dd($data);
    }

    public function showoneonlymedicine()
    {
        $data = Medicine::select('categories.name')
            ->join('categories', 'categories.id', '=', 'medicines.category_id')
            ->groupBy('categories.name')
            ->having('COUNT(categories.id)','=',1)
            ->get();
        return dd($data);
    }

    public function showoneformmedicine()
    {
        $data = Medicine::select('generic_name as name')
                ->groupBy('generic_name')
                ->having('COUNT(form)','=',1)
                ->get();
        return dd($data);
    }

    public function showhighestprice()
    {
        $data = Medicine::select('categories.name','medicines.generic_name')
                ->join('categories','categories.id','=','medicines.category_id')
                ->orderByDesc('medicines.price')
                ->limit(1)
                ->get();
        return dd($data);
    }
}
