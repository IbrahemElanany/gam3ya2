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

    // public function table_buttons()
    // {
    //     return view($this->viewPath . '.button');
    // }
    public function index()
    {
        return view('Admin.orders.index');
    }
    public function datatable(Request $request)
    {

        $data = Order::when($request->has('type') && !empty($request->type),function ($query) use ($request){
            $query->where('type',$request->type);
        })
            ->when($request->has('day') && !empty($request->day),function ($query) use ($request){
                $query->where('day',$request->day);
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
            ->editColumn('car_id', function ($row) {
                $car = '';
                if(Session::get('lang')=='en'){
                $car .= ' <span class="text-gray-800 text-hover-primary mb-1">' . $row->car->getNameEnAttribute() . '</span>';
                return $car;
            }else{
                $car .= ' <span class="text-gray-800 text-hover-primary mb-1">' . $row->car->getNameArAttribute() . '</span>';
                return $car;
            }
            })

            ->editColumn('admin_id', function ($row) {
                $user = '';
                $user .= ' <span class="text-gray-800 text-hover-primary mb-1">' . $row->admin->name . '</span>';
                return $user;
            })

            ->editColumn('city_id', function ($row) {
                $city = '';
                if(Session::get('lang')=='en'){
                $city .= ' <span class="text-gray-800 text-hover-primary mb-1">' . $row->city->getNameEnAttribute() . '</span>';
                return $city;
            }else{
                $city .= ' <span class="text-gray-800 text-hover-primary mb-1">' . $row->city->getNameArAttribute() . '</span>';
                return $city;
            }
            })

            ->editColumn('day', function ($row) {
                $day = '';
                $day .= ' <span class="text-gray-800 text-hover-primary mb-1">' . $row->day . '</span>';
                return $day;
            })

            ->editColumn('type', function ($row) {
                $type = '';
                if($row->type=='export'){
                    $type .= ' <span class="text-gray-800 text-hover-primary mb-1">' . "export" . '</span>';
                    return $type;
                }else{
                    $type .= ' <span class="text-gray-800 text-hover-primary mb-1">' . "import" . '</span>';
                    return $type;
                }
            })

            ->addColumn('actions', function ($row) {
                $actions = ' <a href="' . url("/orders/edit/" . $row->id) . '" class="btn btn-active-light-info">' . trans('lang.edit') . ' <i class="bi bi-pencil-fill"></i>  </a>';
                return $actions;
            })
            ->rawColumns(['actions', 'checkbox', 'car_id', 'admin_id', 'city_id', 'day','type'])
            ->make();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cars=Car::get();
        $cities=City::get();
        $categories=Category::whereNull('parent_id')->get();
        $subcategories = Category::whereNotNull('parent_id')->get();
        $clients=User::all();
        return view('Admin.orders.form',compact('cars','cities','categories','subcategories','clients'));
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
            'car_id' => 'required|exists:cars,id',
            'city_id' => 'required|exists:cities,id',
            'first_amenities' => 'nullable|string',
            'second_amenities' => 'nullable|string',
            'third_amenities' => 'nullable|string',
            'day' => 'required|string',
            'type' => 'required|string',
            'period' => 'required|string',
            // 'address' => 'required|string',
            // 'phone' => 'required|string',
            'client_id' => 'required|exists:users,id',
            'category_id' => 'required|array',
            'category_id.*' => 'required|numeric',
            'subcategory_id' => 'required|array',
            'subcategory_id.*' => 'required|numeric',
            'number' => 'required|array',
            'number.*' => 'required|numeric',
        ]);
        $order = new Order();
        $order->car_id = $request->car_id ;
        $order->city_id = $request->city_id ;
        $order->first_amenities = $request->first_amenities ;
        $order->second_amenities = $request->second_amenities ;
        $order->third_amenities = $request->third_amenities ;
        $order->day = $request->day ;
        $order->type = $request->type ;
        $order->period = $request->period ;
        $order->client_id = $request->client_id ;

        // $order->address = $request->address ;
        // $order->phone = $request->phone ;
        $order->admin_id=Auth::guard('admin')->user()->id;
        $order->save();
        $categories=$request->category_id;
        $subcategories=$request->subcategory_id;
        $numbers=$request->number;
        for($i=0; $i<count($categories);$i++){
            OrderDetail::create(
                array(
                    'order_id'=>$order->id,
                    'category_id'=>$categories[$i],
                    'subcategory_id'=>$subcategories[$i],
                    'number'=>$numbers[$i],
                )
            );
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
        $cars=Car::get();
        $cities=City::get();
        $categories=Category::whereNull('parent_id')->get();
        $subcategories = Category::whereNotNull('parent_id')->get();
        $clients=User::get();
        return view('admin.orders.edit', compact('data','cars',
        'cities','categories','subcategories','clients'));
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
            'car_id' => 'required|exists:cars,id',
            'city_id' => 'required|exists:cities,id',
            'client_id' => 'required|exists:users,id',
            'first_amenities' => 'nullable|string',
            'second_amenities' => 'nullable|string',
            'third_amenities' => 'nullable|string',
            'day' => 'required|string',
            'type' => 'required|string',
            'period' => 'required|string',
            // 'address' => 'required|string',
            // 'phone' => 'required|string',
            'category_id' => 'required|array',
            'category_id.*' => 'required|numeric',
            'subcategory_id' => 'required|array',
            'subcategory_id.*' => 'required|numeric',
            'number' => 'required|array',
            'number.*' => 'required|numeric',
        ]);



        $order = Order::whereId($request->id)->first();
        $order->car_id = $request->car_id ;
        $order->city_id = $request->city_id ;
        $order->client_id = $request->client_id ;
        $order->first_amenities = $request->first_amenities ;
        $order->second_amenities = $request->second_amenities ;
        $order->third_amenities = $request->third_amenities ;
        $order->day = $request->day ;
        $order->period = $request->period ;
        // $order->address = $request->address ;
        // $order->phone = $request->phone ;
        $order->type = $request->type ;
        $order->admin_id=Auth::guard('admin')->user()->id;
        $order->save();
        $categories=$request->category_id;
        $subcategories=$request->subcategory_id;
        $numbers=$request->number;
        if(isset($categories)){
        OrderDetail::where('order_id',$order->id)->delete();
        for($i=0; $i<count($categories);$i++){
            OrderDetail::create(
                array(
                    'order_id'=>$order->id,
                    'category_id'=>$categories[$i],
                    'subcategory_id'=>$subcategories[$i],
                    'number'=>$numbers[$i],
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
        $allsubcategories = Category::where('parent_id',$category_id)->get();
        $subcategories = array();
        $i = 0;
        foreach ($allsubcategories as $subcategory) {
            $subcategories[$i]['id'] = $subcategory->id;
            $subcategories[$i]['name'] = $subcategory->name_en;
            $i++;
        }
        return response()->json($subcategories);
    }

    public function filter(Request $request)
    {
        $orders=Order::where('car_id',$request->car_id)
        ->orWhere('admin_id', $request->admin_id)
        ->orWhere('city_id', $request->city_id)
        ->orWhere('type', $request->type)
        ->orWhere('day', $request->day)->get();
        return view('Admin.orders.filter',compact('orders'));

    }
}
