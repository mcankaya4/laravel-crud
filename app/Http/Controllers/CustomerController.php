<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $customers = Customer::when($request->has('search'), function ($query) use ($request) {
            $query->where('first_name', 'like', "%$request->search%")
                ->orWhere('last_name', 'like', "%$request->search%");
        })
            ->orderBy('id', $request->has('order') && $request->order == 'asc' ? 'asc' : 'desc')
            ->get();
        return view('customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request)
    {
        $image = $request->hasFile('image') ? $request->file('image')->store('customers', 'public') : 'customers/avatar.png';
        Customer::create([
            'image' => $image,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'bank_number' => $request->bank_number,
            'about' => $request->about,
        ]);

        return redirect()->route('customer.index')->with('status', 'Kayıt işlemi başarılı.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return view('customer.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, Customer $customer)
    {

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('customers', 'public');
            if ($customer->image !== 'customers/avatar.png') {
                Storage::disk('public')->delete($customer->image);
            }
        } else {
            $image = $customer->image;
        }

        $customer->update([
            'image' => $image,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'bank_number' => $request->bank_number,
            'about' => $request->about,
        ]);

        return redirect()->route('customer.index')->with('status', 'Güncelleme işlemi başarılı.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        if ($customer->image !== 'customers/avatar.png') {
            Storage::disk('public')->delete($customer->image);
        }
        $customer->delete();

        return redirect()->route('customer.index')->with('status', 'Silme işlemi başarılı.');
    }
}
