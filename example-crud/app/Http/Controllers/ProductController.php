<?php
           
namespace App\Http\Controllers;
            
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Category; 
use App\Models\CartItem;
// use Illuminate\Support\Facades\Redirect;
// use Illuminate\Support\Facades\Storage;
use DataTables;
use Maatwebsite\Excel\Facades\Excel;

          
class ProductController extends Controller
{

    public function export()
    {
        // Retrieve the data to be exported, such as products
        $products = Product::all();
        
        // Define the file name for the exported file
        $fileName = 'products.xlsx';

        // Generate and return the Excel download response
        return Excel::download(function($excel) use ($products) {
            $excel->sheet('Products', function($sheet) use ($products) {
                $sheet->fromArray($products);
            });
        }, $fileName);
    }

    
    public function index(Request $request)
    {
        // Retrieve user and category information
        $users = null;
        $categories = null;
        $selectedUserId = null;
        $selectedCategoryId = $request->get('category_id', null);
    
        if (Auth::check() && Auth::user()->isAdmin()) {
            $users = User::where('role', 'user')->get();
            $categories = Category::all();
        }
    
        if ($request->ajax()) {
            $selectedUserId = $request->user_id;
            $query = Product::query();
    
            if ($selectedUserId) {
                $query->where('user_id', $selectedUserId);
            } else {
                $user = Auth::user();
                if ($user && !$user->isAdmin()) {
                    $query->where('user_id', $user->id);
                }
            }
            
            // Apply category filter if provided
            if ($selectedCategoryId) {
                $query->where('category_id', $selectedCategoryId);
            }
    
            // Price Filters
            if ($request->has('min_price') && $request->min_price !== null) {
                $query->where('price', '>=', $request->min_price);
            }
            if ($request->has('max_price') && $request->max_price !== null) {
                $query->where('price', '<=', $request->max_price);
            }
    
            // Retrieve filtered data
            $data = $query->latest()->get();
    
            // Return data in DataTables format
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($row) {
                    return '<input type="checkbox" class="select-row" name="selected_rows[]" value="' . $row->id . '">';
                })
                ->addColumn('username', function ($row) {
                    return $row->user->name;
                })
                ->addColumn('category_name', function ($row) {
                    return $row->category ? $row->category->name : '';
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('products.edit', $row->id);
                    $btn = "<a href='$editUrl' data-toggle='tooltip' data-id='$row->id' data-original-title='Edit' class='edit btn btn-primary btn-sm editProduct'>Edit</a>";
                    $btn .= " <a href='javascript:void(0)' data-toggle='tooltip' data-id='$row->id' data-original-title='Delete' class='btn btn-danger btn-sm deleteProduct'>Delete</a>";
                    return $btn;
                })
                ->rawColumns(['checkbox', 'action'])
                ->make(true);
        }
    
        // If not an AJAX request, return the view with user and category data
        return view('products.index', compact('users', 'selectedUserId', 'categories', 'selectedCategoryId'));
    }
    


    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact( 'categories'));
    }  
  

    public function store(Request $request)
    {
        
        // dd($request-> all());
    
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'quantity' => 'required|integer',
        ]);
  
     
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $destinationPath = public_path('assets/images');
            // dd($destinationPath);    
            $profileImage = date('YmdHis').".".$image->getClientOriginalName();
         
            // dd( $profileImage );
            $image->move($destinationPath, $profileImage);
            
        }
    
        $user = Auth::user();
    
        
        $create = new Product();
        $create->name = $request->name;
        $create->detail = $request->detail;
        $create->price = $request->price;
        $create->image = $profileImage;
        $create->quantity = $request->quantity;
        $create->user_id  = auth::user( )->id;
        $create->category_id = $request->category_id;
        $create->save();
        

        //$user->products()->create($request->all());

        return redirect()->route('products.index')->with('success', 'Product saved successfully.');
    }
    

    public function update(Request $request, $id)
    {
        
        $validatedData = $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'price' => 'required|numeric',
        ]);
        $product = Product::findOrFail($id);
        $product->update($validatedData);
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }
   
    public function edit($id)
    {
        $product = Product::find($id);
        return view('products.edit', compact('product'));
    }
    
    
    public function destroyAll(Request $request)
    {
        $selectedProducts = $request->selectedProducts;
        Product::whereIn('id', $selectedProducts)->delete();
        return response()->json(['success' => 'Selected products deleted successfully.']);
    }
    
    public function destroy($id)
    {
        Product::find($id)->delete();
        return response()->json(['success'=>'Product deleted successfully.']);
    }



    public function createCategory()
    {
        return view('products.createCategory');
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:category|max:255',
        ]);
      
        $category = new Category();
        $category->name = $request->name;
        $category->save();

        return redirect()->route('products.index')->with('success', 'Category created successfully.');
    }

    

}