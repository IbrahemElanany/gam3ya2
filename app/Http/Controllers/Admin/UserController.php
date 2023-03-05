<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Rate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{

    protected $viewPath = 'Admin.users.';
    private $route = 'users';

    public function __construct(User $model)
    {
        $this->objectName = $model;
    }

    public function table_buttons()
    {
        return view($this->viewPath . '.button');
    }
    public function index()
    {
        return view('Admin.users.index');
    }
    public function datatable(Request $request)
    {
        $data = User::orderBy('id', 'desc');

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
                $name .= ' <span class="text-gray-800 text-hover-primary mb-1">' . $row->name . '</span>';
                return $name;

            })
            ->editColumn('email', function ($row) {
                $email = '';
                $email .= ' <span class="text-gray-800 text-hover-primary mb-1">' . $row->email . '</span>';
                return $email;
            })
            ->editColumn('phone', function ($row) {
                $phone = '';
                $phone .= ' <span class="text-gray-800 text-hover-primary mb-1">' . $row->phone . '</span>';
                return $phone;
            })
            ->editColumn('address', function ($row) {
                $address = '';
                $address .= ' <span class="text-gray-800 text-hover-primary mb-1">' . $row->address . '</span>';
                return $address;
            })

            ->addColumn('actions', function ($row) {
                $actions = ' <a href="' . url("/users/edit/" . $row->id) . '" class="btn btn-active-light-info">' . trans('lang.edit') . ' <i class="bi bi-pencil-fill"></i>  </a>';
                return $actions;

            })
            ->rawColumns(['actions', 'checkbox', 'name','email','phone','address'])
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
            'name' => 'required|string',
            'email' => 'required|email|unique:admins',
            'phone' => 'required|unique:admins|min:8',
            'address' => 'required|string',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();
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
        $data = User::findOrFail($id);
        return view('admin.users.edit', compact('data'));
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
        // $data = $this->validate(request(), [
        //     'name_en' => 'required|string',
        //     'name_ar' => 'required|string',

        // ]);



        // $car = Car::whereId($request->id)->first();
        // $car->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
        // $car->save();





        // return redirect(url('cars'))->with('message', 'تم التعديل بنجاح ');
            $data = $this->validate(request(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $request->id,
            'phone' => 'required|min:8|unique:users,phone,' . $request->id,
            'address' => 'required|string',
        ]);


        $user = User::whereId($request->id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();


        return redirect(url('users'))->with('message', 'تم التعديل بنجاح ');
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
            User::whereIn('id', $request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed']);
        }
        return response()->json(['message' => 'Success']);
    }
  }

