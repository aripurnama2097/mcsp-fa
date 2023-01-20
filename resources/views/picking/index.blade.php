@extends('layouts.main')
@section('section')


    <div class="breadcomb-area ">
        <div class="container text-center">
            <div class="row text-center">
                <div class="col-lg-12">
                    <div class="breadcomb-list text-center rounded-3">
                        <div class="row justify-content-center">
                            <div class="breadcomb-wp mb-lg-3 responsive">
                                <div class="breadcomb-icon text-center">
                                    {{-- <i class="notika-icon notika-form"></i> --}}
                                    <h4 class="text-center ">PICKING PART</h4>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="col-12 mb-5 bg-danger"> --}}
        {{-- <div class="card bg-success"> --}}
            
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive bg-light  shadow rounded">
                            <table class="table table-hover  rounded align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-center text-white">NO</th>
                                        <th class="text-center text-white">ROG NUMBER</th>
                                        <th class="text-center text-white">PART NUMBER</th>
                                        <th class="text-center text-white">QTY REQUEST</th>
                                        <th class="text-center text-white">STATUS</th>
                                        <th class="text-center text-white">ACTION </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $value)
                                        <tr>
                                            <td class="text-black text-center">{{ ++$i }}
                                            </td>
                                            <td class="text-black text-center">
                                                {{ $value->rog_number }} </td>
                                            <td class="text-black text-center">
                                                {{ $value->part_number }} </td>
                                            <td class="text-black text-center">
                                                {{ $value->qty_request }} </td>
                                            <td class="text-black text-center">
                                                <?php if ($value->status == 'SELECT') {
                                                    echo '<span class= "badge text-bg-warning badge-font-size:20px;">BEFORE PICKING</span>';
                                                } ?>
                                                <?php if ($value->status == 'PICKING') {
                                                    echo '<span class= "badge text-bg-primary">SUCCESS</span>';
                                                } ?>
                                                <?php if ($value->status == 'SORTING') {
                                                    echo '<span class= "badge text-bg-success">DONE</span>';
                                                } ?>
                                            </td>
                                            <td class="text-black text-center">
                                                <div class="dialog-pro dialog">
                                                    <?php if ($value->status =='SELECT'){?>
                                                        <a href="{{ url('/picking/detail/' . $value->id . '') }}"
                                                        class="btn btn-success btn-sm">PICKING</a>

                                                        {{-- <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#compareModal"><i class="notika-icon notika-edit mb-3"></i>PICKING</i>		
                                                        </button> --}}
                                                    <?php }?>
                                                </div>
                                                <br>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                        </div>
                       
                        <br>
                        <div class="d-flex justify-content-center">
                            {{ $data->links() }}
                        </div>
                    </div>
                </div>
            </div>
        {{-- </div> --}}
    {{-- </div> --}}
@endsection
