@extends('layouts.app')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <h3>Customers</h3>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-2">
                            <a href="{{ route('customer.create') }}" class="btn" style="background-color: #4643d3; color: white;
                            "><i
                                    class="fas fa-plus"></i> Create Customer</a>
                        </div>
                        <div class="col-md-8">
                            <form action="{{ route('customer.index') }}" method="get">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Search anything..."
                                           aria-describedby="button-addon2" name="search" value="{{ request('search') }}">
                                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-2">
                            <form action="{{ route('customer.index') }}" method="get" id="form-order">
                                <div class="input-group mb-3">
                                    <select class="form-select" name="order" onchange="document.querySelector('#form-order')
                                    .submit()">
                                        <option @selected(request('order') == 'desc') value="desc">Newest to Oldest</option>
                                        <option @selected(request('order') == 'asc') value="asc">Old to Newest</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-bordered" style="border: 1px solid #dddddd">
                        <thead>
                        <tr>
                            <th scope="col">#Id</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Bank Number</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customers as $customer)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $customer->first_name }}</td>
                                <td>{{ $customer->last_name }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->bank_number }}</td>
                                <td>
                                    <a href="{{ route('customer.edit', $customer) }}" style="color: #2c2c2c;" class="ms-1
                                    me-1"><i class="far
                                    fa-edit"></i></a>
                                    <a href="{{ route('customer.show', $customer) }}" style="color: #2c2c2c;" class="ms-1 me-1"><i
                                            class="far fa-eye"></i></a>
                                    <a href="javascript:;" style="color: #2c2c2c;" class="ms-1 me-1"
                                       onclick="if(confirm('Kayıt silinsin mi?')) document.querySelector('#form-{{ $customer->id
                                       }}')
                                       .submit();">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                    <form id="form-{{ $customer->id }}" action="{{ route('customer.destroy', $customer) }}"
                                          method="post">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
