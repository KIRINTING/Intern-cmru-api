<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;

class CustomerController extends Controller
{
    // GET: api/customers
    public function index(Request $request)
    {
        // GET: api/customers?search=xxxx
        $search = $request->query('search');

        if ($search) {
            $customers = Customers::where('name', 'LIKE', "%{$search}%")
                ->orWhere('namecompany', 'LIKE', "%{$search}%")
                ->orWhere('tax_id', 'LIKE', "%{$search}%")
                ->orWhere('phone', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $customers = Customers::orderBy('created_at', 'desc')->get();
        }

        return response()->json($customers);
    }

    // POST: api/customers
    public function store(Request $request)
    {

        $customers = new Customers();
        
        $customers->namecompany = $request->input('namecompany');
        $customers->name        = $request->input('name');
        $customers->address     = $request->input('address');
        $customers->tax_id      = $request->input('tax_id');
        $customers->phone       = $request->input('phone');
        $customers->email       = $request->input('email');


        $customers->save();

        return response()->json([
            'message' => 'Created successfully',
            'data' => $customers
        ], 201);
    }

    // GET: api/customers/{id}
    public function show($id)
    {
        $customers = Customers::find($id);
        
        if (!$customers) {
            return response()->json(['message' => 'Not found'], 404);
        }
        
        return response()->json($customers);
    }

    // PUT: api/customers/{id}
    public function update(Request $request, $id)
    {
        $customers = Customers::find($id);

        if (!$customers) {
            return response()->json(['message' => 'Not found'], 404);
        }

        if ($request->has('namecompany')) {
            $customers->namecompany = $request->input('namecompany');
        }
        if ($request->has('name')) {
            $customers->name = $request->input('name');
        }
        if ($request->has('address')) {
            $customers->address = $request->input('address');
        }
        if ($request->has('tax_id')) {
            $customers->tax_id = $request->input('tax_id');
        }
        if ($request->has('phone')) {
            $customers->phone = $request->input('phone');
        }
        if ($request->has('email')) {
            $customers->email = $request->input('email');
        }

        $customers->save();

        return response()->json([
            'success' => true,
            'message' => 'Customers updated successfully',
            'data' => $customers
        ]);
    }

    // DELETE: api/customers/{id}
    public function destroy($id) // ปกติ Laravel ใช้ชื่อ destroy แทน delete ใน Route Resource
    {
        $customers = Customers::find($id);

        if (!$customers) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $customers->delete();

        return response()->json([
            'success' => true,
            'message' => 'Deleted successfully'
        ]);
    }
}