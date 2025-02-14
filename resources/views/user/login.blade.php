@extends('layouts.app')
@section('content')
    <div class="container ">
        <div class="header mx-auto mt-5">
            <h1 class="text-center mb-3" >Selamat Datang di <b>Catatanku</b> </h1>
            
            <div class="container d-flex justify-content-center align-items-center vh-80">
                <div class="col-md-4">
                    <div class="card shadow-lg p-4 rounded-4">
                        <h5 class="text-center mb-4">Silahkan Login</h5>
            
                        {{-- @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
            
                        @if ($errors->any())
                            <div class="alert alert-danger">{{ $errors->first() }}</div>
                        @endif --}}
            
                        <form action="{{ route('login.proses') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
            
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
            
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
            
                        <p class="text-center mt-3">Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection