<?php

namespace App\Http\Controllers\Admin;

use App\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::latest()->paginate(100);
        return view('Admin.Packages.index',compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Packages.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'length' => 'required|numeric',
            'icon' => 'required',
            'features.fee' => 'required|numeric',
            'features.max' => 'required',
            'features.portfolio' => 'required',
        ]);
        $price = 0;
        $default = 0;
        if($request->has('price') && intval($request->price) > 500){
            $price = $request->price;
        }else{
            $default = 1;
        }
        if($request->has('min') && intval($request->min) != 0){
            $min = intval($request->min);
        }else{
            $min = null;
        }
        $data = [
            'name' => $request->name,
            'price' => $price,
            'length' => $request->length,
            'icon' => $request->icon,
            'features' => [
                'max' => $request->input('features.max'),
                'fee' => $request->input('features.fee'),
                'portfolio' => $request->input('features.portfolio')
            ],
            'is_default' => $default,
            'min' => $min
        ];
        if($request->input('features.desc1')){
            $data['features']['desc1'] = $request->input('features.desc1');
        }
        if($request->input('features.desc2')){
            $data['features']['desc2'] = $request->input('features.desc2');
        }
        if($request->popular){
            $data['popular'] = true;
        }
        Package::create($data);
        alert()->success('عملیات موفق !','پکیج مورد نظر با موفقیت ایجاد شد !');
        return redirect()->route('packages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        return view('Admin.Packages.edit',compact('package'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Package $package
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Package $package)
    {
        $this->validate($request,[
            'name' => 'required',
            'length' => 'required|numeric',
            'icon' => 'required',
            'features.fee' => 'required|numeric',
            'features.max' => 'required',
            'features.portfolio' => 'required',
        ]);
        $price = 0;
        $default = 0;
        if($request->has('price') && intval($request->price) > 500){
            $price = $request->price;
        }else{
            $default = 1;
        }
        if($request->has('min') && intval($request->min) != 0){
            $min = intval($request->min);
        }else{
            $min = null;
        }
        $data = [
            'name' => $request->name,
            'price' => $price,
            'length' => $request->length,
            'icon' => $request->icon,
            'features' => [
                'max' => $request->input('features.max'),
                'fee' => $request->input('features.fee'),
                'portfolio' => $request->input('features.portfolio')
            ],
            'is_default' => $default,
            'min' => $min
        ];
        if($request->input('features.desc1')){
            $data['features']['desc1'] = $request->input('features.desc1');
        }
        if($request->input('features.desc2')){
            $data['features']['desc2'] = $request->input('features.desc2');
        }
        if($request->popular){
            $data['popular'] = true;
        }
        $package->update($data);
        alert()->success('عملیات موفق !','پکیج مورد نظر با موفقیت بروزرسانی شد !');
        return redirect()->route('packages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Package $package
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Package $package)
    {
        $package->delete();
        alert()->warning('عملیات موفق!','پکیج مورد نظر با موفقیت حذف شد !');
        return redirect()->route('packages.index');
    }
}
