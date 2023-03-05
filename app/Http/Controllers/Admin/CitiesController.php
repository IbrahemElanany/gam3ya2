<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CityRequest;
use App\Http\Requests\Dashboard\ScreenRequest;
use App\Http\Requests\Dashboard\SliderRequest;
use App\Models\City;
use App\Models\Screen;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class CitiesController extends Controller
{
    protected $viewPath = 'Admin.cities.';
    private $route = 'cities';

    public function __construct(City $model)
    {
        $this->objectName = $model;
    }

    public function table_buttons()
    {
        return view($this->viewPath . '.button');
    }

    public function index()
    {
        return view('Admin.cities.index');
    }
    public function datatable(Request $request)
    {
        $data = City::orderBy('id', 'desc');

        return DataTables::of($data)
            ->addColumn('checkbox', function ($row) {
                $checkbox = '';
                $checkbox .= '<div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input selector" type="checkbox" value="' . $row->id . '" />
                                </div>';
                return $checkbox;
            })
            ->editColumn('name', function ($row) {
                $name = '';
                if(Session::get('lang')=='en'){
                $name .= ' <span class="text-gray-800 text-hover-primary mb-1">' . $row->getNameEnAttribute() . '</span>';
                return $name;
            }else{
                $name .= ' <span class="text-gray-800 text-hover-primary mb-1">' . $row->getNameArAttribute() . '</span>';
                return $name;
            }
            })


            ->addColumn('actions', function ($row) {
                $actions = ' <a href="' . url("/cities/edit/" . $row->id) . '" class="btn btn-active-light-info">' . trans('lang.edit') . ' <i class="bi bi-pencil-fill"></i>  </a>';
                return $actions;

            })
            ->rawColumns(['actions', 'checkbox', 'name'])
            ->make();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate(request(), [
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
        ]);
        $city = new City;
        $city->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
        $city->save();
        return redirect()->back()->with('message', 'تم الاضافة بنجاح ');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = City::findOrFail($id);
        return view('admin.cities.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $this->validate(request(), [
            'name_en' => 'required|string',
            'name_ar' => 'required|string',

        ]);



        $city = City::whereId($request->id)->first();
        $city->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
        $city->save();





        return redirect(url('cities'))->with('message', 'تم التعديل بنجاح ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            City::whereIn('id', $request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed']);
        }
        return response()->json(['message' => 'Success']);
    }
}
