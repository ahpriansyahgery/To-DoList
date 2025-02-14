@extends('layouts.app')
@section('content')
<div class="container mt-4">
  <div class="container mt-4">
    <!-- Header Container -->
    <div class="header-container d-flex flex-wrap justify-content-between align-items-center p-3 bg-white shadow-sm rounded">
      <!-- Judul dengan Ikon -->
      <div class="sub-header d-flex align-items-center">
          <h5 class="mb-0 d-flex align-items-center">
              <i data-feather="calendar" class="me-2 text-primary"></i> <strong>TO-DO List</strong>
          </h5>
      </div>
  
      <!-- Container untuk Search dan Filter -->
      <div class="search-filter-container w-100 mt-4">
          <div class="row g-2">
              <!-- Form Pencarian -->
              <div class="col-md-6 ">
                <label for="date" class="form-label fw-bold">Cari Catatan</label>
                  <form action="{{ route('task.index') }}" method="GET" class="d-flex">
                      <input class="form-control me-2" type="search" placeholder="Cari task..." aria-label="Search" name="search" value="{{ request('search') }}">
                      <button class="btn btn-outline-success d-flex align-items-center" type="submit">
                          <i class="fas fa-search me-1"></i> Cari
                      </button>
                  </form>
              </div>
  
              <!-- Form Filter Tanggal -->
              <div class="col-md-6">
                  <form action="{{ route('task.index') }}" method="GET">
                      <div class="row g-2">
                          <div class="col-md-8">
                              <label for="date" class="form-label fw-bold">Filter Tanggal</label>
                              <input type="date" name="date" id="date" class="form-control" value="{{ request('date') }}">
                          </div>
                          <div class="col-md-4 d-flex align-items-end gap-2">
                              <button type="submit" class="btn btn-primary w-100">
                                  <i class="fas fa-filter"></i> Filter
                              </button>
                              <a href="{{ route('task.index') }}" class="btn btn-secondary w-100">
                                  <i class="fas fa-sync-alt"></i> Reset
                              </a>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  
      <!-- Tombol Tambah dan Dropdown User -->
      <div class="d-flex align-items-center gap-3 mt-3">
          <!-- Tombol Tambah dengan Ikon -->
          <button class="btn btn-outline-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#exampleModal">
              <i data-feather="plus"></i> Tambah Task
          </button>
  
          <!-- Dropdown User dengan Ikon -->
          <div class="dropdown">
              <a href="#" class="text-dark fw-bold text-decoration-none dropdown-toggle" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                  <i data-feather="user" class="me-1"></i> Halo, {{ Auth::user()->name }}!
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                  <li>
                      <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                          <i data-feather="log-out" class="me-2"></i> Logout
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                          @csrf
                      </form>
                  </li>
              </ul>
          </div>
      </div>
  </div>
  
</div>
    
       <!-- Button trigger modal -->

  



        <table class="table table-bordered table-striped text-center" id="tableCatatan" >
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Nama</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
              @forelse ($tasks as $task)
                  
       
                <tr >
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $task->date }}</td>
                    <td>{{ $task->time }}</td>
                    <td>{{ $task->name }}</td>
                    <td>{{ $task->description }}</td>
                    <td class="d-flex justify-content-center" >
                       <form action="{{ route('task.destroy',$task->id) }}" method="POST" >
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger me-3" type="submit" > <i data-feather="trash-2" ></i></button>
                       </form>
                       <button class="btn btn-warning  " type="button"  data-bs-toggle="modal" data-bs-target="#edit" >  <i data-feather="edit"></i> </button>
                    </td>
                    @empty
                      <td colspan="6" class="text-center" ><b>Catatan Kosong</b></td>
                    @endforelse
                  </tr>
            </tbody>
        </table>
     


    </div>
  {{-- Modal edit --}}
  <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Catatan Baru</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('task.update',$task->id) }}" method="POST" id="form-edit"  >
            @csrf
            @method('PUT')
            <div class="mb-3">
              <label for="name" class="col-form-label">Nama Kegiatan:</label>
              <input type="text" class="form-control" id="name" name="name" value="{{ $task->name }}" required>
            </div>
            <div class="mb-3">
              <label for="date" class="col-form-label">Tanggal:</label>
                <input type="date" class="form-control" id="date" name="date" value="{{ $task->date }}" required>
            </div>
            <div class="mb-3">
              <label for="time" class="col-form-label">Waktu:</label>
                <input type="time" class="form-control" id="time" name="time" value="{{ $task->time }}" required>
            </div>
            <div class="mb-3">
              <label for="description" class="col-form-label">Keterangan:</label>
              <textarea class="form-control" id="description" name="description"  id="description"  required> {{ $task->description }} </textarea>
            </div>
            <button type="submit" class="btn btn-primary btnSubmit">Update</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
       
        </div>
      </div>
    </div>
  </div>
    
       {{-- Modal kegiatan Baru --}}
       <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Catatan Baru</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{ route('task.store') }}" method="POST" id="form-add"  >
                @csrf
                <div class="mb-3">
                  <label for="name" class="col-form-label">Nama Kegiatan:</label>
                  <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                  <label for="date" class="col-form-label">Tanggal:</label>
                    <input type="date" class="form-control" id="date" name="date" required>
                </div>
                <div class="mb-3">
                  <label for="time" class="col-form-label">Waktu:</label>
                    <input type="time" class="form-control" id="time" name="time" required>
                </div>
                <div class="mb-3">
                  <label for="description" class="col-form-label">Keterangan:</label>
                  <textarea class="form-control" id="description" name="description" id="description" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary btnSubmit">Create</button>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
           
            </div>
          </div>
        </div>
      </div>

@endsection