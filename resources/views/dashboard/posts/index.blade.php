@extends('dashboard.layouts.main')
    @section('container')
             <div id="content">
                <!-- Topbar -->
                 @include('dashboard.layouts.topbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                {{-- <h1 class="h3 mb-4 text-gray-800">Data CRUD</h1> --}}
                 <div class="content-wrapper">

<!-- Button trigger modal -->
  <a href="{{('/dashboard/posts')}}" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#createNew">
        <i class="fas fa-file-alt"></i>
        Create New
 </a>

@if(session()->has('success'));
<div class="alert alert-success" role="alert">
  {{session('success')}} 
</div>
@endif

{{-- {{var_dump($request)}} --}}
<br>
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-1">
             </div>
         </div>
     </section>
    <section class="content">
         <div class="row mt-4">
             <div class="col-12">
                 <div class="card card-navy">
                    <div class="card-header">
                        {{-- <h3 class="card-title" class="text-lg-center">Data CRUD</h3> --}}
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                     <div id="filter" class="card-body">
                         <table id="filter" class="table table-striped" width="20%">
                             <thead class="table table-bordered">
                                 <tr>
                                     <th class="text-center" rowspan="1" width="3%">No </th>
                                     <th class="text-center" rowspan="1">Part No</th>
                                      <th class="text-center" rowspan="1">Part Name</th>
                                     <th class="text-center" rowspan="1">Category</th>
                                     <th class="text-left" rowspan="1">Action</th>
                                 </tr>
                             </thead>                
                         </table>
                     </div>                    
                 </div>
             </div>
         </div>
    </section>
         </div>
                <!-- /.container-fluid -->
         </div>
        </div>
        <!-- Modal -->
       

<div class="modal fade" id="createNew">
     <div class="modal-dialog  modal-dialog-centered-xl ">
         <div class="modal-content">
             <!-- Modal Header -->
             <div class="modal-header">
                 <h4 class="modal-title">Create Data</h4>
                 <button type="button" class="close" data-dismiss="modal" aria-label="close">
                     <span aria-hidden="true">&times; </span>
                 </button>
             </div>
             <!-- Modal body -->
             <div class="modal-body">
                 <div class="col-8">
                    {{-- // method put ke update --}}
                 <form action="/dashboard/posts" method="post" enctype="multipart/form-data"> 
                    @csrf
                  <div class="row">
                         <div class="col-12">
                             <div class="form-group">
                                 <label>Part No</label>           
                                 <input type="text" name="part_number"  id="part_number"class="form-control" required autofocus>
                             </div>
                        </div>
                  </div>

                 <div class="row">
                         <div class="col-12">
                             <div class="form-group">
                                 <label>Part Number</label>           
                                 <input type="text" name="part_name" id="part_name" class="form-control" required autofocus>
                             </div>
                        </div>
                 </div>
                <div>
                {{-- <label for="category" class="form-label">Category</label>
                <select class="form-select" name="category_id"> --}}
                    {{-- {{var_dump($categories)}} --}}
                    {{-- @foreach($categories as $category)
                    @if(old('category_id') == $category->id)
                    <option value ="{{$category->id}}"selected > {{$category->name}}</option> 
                    @else
                       <option value ="{{$category->id}}"> {{$category->name}}</option>
                    @endif       
                    @endforeach --}}
                </select>
                </div>              
                 <div>
                 <button type="submit" class="button btn btn-primary btn-sm">
                    Submit
                 </button>
                  <button type="cancel" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                 </div>
                 </form>
                 </div>
             </div>
         </div>
     </div>
</div>
    @endsection