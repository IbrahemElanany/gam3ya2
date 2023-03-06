<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Car;
use App\Models\Category;
use App\Models\City;
use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class OrdersController extends Controller
{
    // protected $viewPath = 'Admin.orders.';
    // private $route = 'orders';

    // public function __construct(Order $model)
    // {
    //     $this->objectName = $model;
    // }

    public function table_buttons()
    {
        return view('Admin.orders.button');
    }

    public function index()
    {
        return view('Admin.orders.index');
    }

    public function datatable(Request $request)
    {

        $data = Order::when($request->has('type') && !empty($request->type), function ($query) use ($request) {
            $query->where('type', $request->type);
        })
            ->when($request->has('day') && !empty($request->day), function ($query) use ($request) {
                $query->where('day', $request->day);
            })
            ->orderBy('id', 'desc');

        return DataTables::of($data)
            ->addColumn('checkbox', function ($row) {
                $checkbox = '';
                $checkbox .= '<div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input selector" type="checkbox" value="' . $row->id . '" />
                                </div>';
                return $checkbox;
            })
            ->editColumn('category_id', function ($row) {
                $car = '';
                if (Session::get('lang') == 'en') {
                    $car .= ' <span class="text-gray-800 text-hover-primary mb-1">' . $row->category->name_en . '</span>';
                    return $car;
                } else {
                    $car .= ' <span class="text-gray-800 text-hover-primary mb-1">' . $row->category->name_ar . '</span>';
                    return $car;
                }
            })
            ->editColumn('client_id', function ($row) {
                $car = '';
                $car .= ' <span class="text-gray-800 text-hover-primary mb-1">' . $row->client->name . '</span>';
                return $car;

            })
            ->editColumn('admin_id', function ($row) {
                $user = '';
                $user .= ' <span class="text-gray-800 text-hover-primary mb-1">' . $row->admin->name . '</span>';
                return $user;
            })
            ->editColumn('type', function ($row) {
                $type = '';
                $type .= ' <span class="text-gray-800 text-hover-primary mb-1">' . trans('lang.' . $row->type) . '</span>';
                return $type;
            })
            ->addColumn('actions', function ($row) {
                $actions = ' <a href="' . url("/orders/edit/" . $row->id) . '" class="btn btn-active-light-info">' . trans('lang.edit') . ' <i class="bi bi-pencil-fill"></i>  </a>';
                return $actions;
            })
            ->rawColumns(['actions', 'checkbox', 'admin_id', 'category_id', 'type', 'client_id'])
            ->make();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::whereNull('parent_id')->get();
        $subcategories = Category::whereNotNull('parent_id')->get();
        $clients = User::all();

        return view('Admin.orders.create', compact('categories', 'subcategories', 'clients'));
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
            'type' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'client_id' => 'required|exists:users,id',
            'details' => 'required|array|min:1',

        ]);
        $data['admin_id'] = Auth::guard('admin')->user()->id;
        $order = Order::create($data);
        if (count($request->details) > 0) {
            foreach ($request->details as $row) {
                OrderDetail::create(
                    array(
                        'order_id' => $order->id,
                        'subcategory_id' => $row['subcategory_id'],
                        'number' => $row['number'],
                    )
                );
            }
        }
        return redirect(url('orders'))->with('message', 'تم الاضافة بنجاح ');

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
        $data = Order::findOrFail($id);
        $categories = Category::whereNull('parent_id')->get();
        $subcategories = Category::where('parent_id', $data->category_id)->get();
        $clients = User::get();
        return view('admin.orders.edit', compact('data', 'categories', 'clients', 'subcategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->validate(request(), [
            'type' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'client_id' => 'required|exists:users,id',
            'details' => 'required|array|min:1',

        ]);
        unset($data['details']);
        Order::whereId($id)->update($data);
        if (count($request->details) > 0) {
            OrderDetail::where('order_id', $id)->delete();
            foreach ($request->details as $row) {
                OrderDetail::create(
                    array(
                        'order_id' => $id,
                        'subcategory_id' => $row['subcategory_id'],
                        'number' => $row['number'],
                    )
                );
            }
        }
        return redirect(url('orders'))->with('message', 'تم التعديل بنجاح ');
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
            Order::whereIn('id', $request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed']);
        }
        return response()->json(['message' => 'Success']);
    }

    public function getSubcategories($category_id)
    {
        $allsubcategories = Category::where('parent_id', $category_id)->get();
        $subcategories = array();
        $i = 0;
        foreach ($allsubcategories as $subcategory) {
            $subcategories[$i]['id'] = $subcategory->id;
            $subcategories[$i]['name'] = $subcategory->name_en;
            $i++;
        }
        return response()->json($subcategories);
    }

    public function addNewRow($count_value, $category_id)
    {
        $data = Category::where('parent_id', $category_id)->get();
        return view('Admin.orders.parts.new_row', compact('data', 'count_value'));
    }

    public function filter(Request $request)
    {
        $orders = Order::where('car_id', $request->car_id)
            ->orWhere('admin_id', $request->admin_id)
            ->orWhere('city_id', $request->city_id)
            ->orWhere('type', $request->type)
            ->orWhere('day', $request->day)->get();
        return view('Admin.orders.filter', compact('orders'));

    }
}
