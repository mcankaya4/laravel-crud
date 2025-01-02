@extends('layouts.app')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <h3>Customers</h3>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-2">
                            <a href="{{ route('customer.index') }}" class="btn" style="background-color: #4643d3; color: white; ">
                                <i class="fas fa-chevron-left"></i> Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if($errors)
                        @foreach($errors->all() as $err)
                            <div class="alert alert-danger">
                                {{ $err }}
                            </div>
                        @endforeach
                    @endif
                    <form action="{{ route('customer.update', $customer) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="profile mr-3 mt-5">
                                    <img
                                        src="{{ asset('storage') . '/' . $customer->image }}"
                                        alt="..." width="130" class="rounded mb-2 img-thumbnail">
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="">Image</label>
                                    <input type="file" class="form-control" name="image">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="">First Name</label>
                                    <input type="text" class="form-control" name="first_name" value="{{ $customer->first_name }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="">Last Name</label>
                                    <input type="text" class="form-control" name="last_name" value="{{ $customer->last_name }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" class="form-control" name="email" value="{{ $customer->email }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="">Phone</label>
                                    <input type="text" class="form-control" name="phone" value="{{ $customer->phone }}">
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="">Bank Account Number</label>
                                    <input type="text" class="form-control" name="bank_number" value="{{ $customer->bank_number
                                    }}">
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="">About</label>
                                    <textarea class="form-control" name="about" cols="30" rows="2">{{ $customer->about
                                    }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
