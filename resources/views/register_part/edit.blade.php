@extends('layouts.main')
@section('section')
   
 
    <form action="{{ url('register_part/' . $model->id) }}" method="POST">
        @csrf
        <div class="breadcomb-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="breadcomb-list">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="breadcomb-wp">
                                        <div class="breadcomb-icon">
                                            <i class="notika-icon notika-form"></i>
                                        </div>
                                        <div class="breadcomb-ctn">
                                            <h2>UPDATE PART</h2>
                                          
                                        </div>
                                    </div>
                                </div>
                                <div class="form-element-area">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-element-list">
                                                    <div class="basic-tb-hd">
                                                    </div>

                                                    <input type="hidden" name="_method" value="PATCH">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group ic-cmp-int">
                                                                <div class="form-ic-cmp">
                                                                    <i class="notika-icon notika"></i>
                                                                </div>
                                                                <div class="nk-int-st">
                                                                    <input type="text" class="form-control"
                                                                        name="rog_number" value="{{$model->rog_number}}" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>

                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group ic-cmp-int">
                                                                <div class="form-ic-cmp">
                                                                    <i class="notika-icon notika"></i>
                                                                </div>
                                                                <div class="nk-int-st">
                                                                    <input type="text" class="form-control"
                                                                        name="part_number" placeholder="PART NUMBER" value="{{$model->part_number}}" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>

                                                    {{-- <div class="row">
                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                            <div class="form-group ic-cmp-int">
                                                                <div class="form-ic-cmp">
                                                                    <i class="notika-icon notika"></i>
                                                                </div>
                                                                <div class="bootstrap-select fm-cmp-mg">
                                                                    <select class="selectpicker" data-live-search="true" name="part_number">
                                                                        <option value="">PART NUMBER</option>
                                                                        @foreach($data_part as $dd)
                                                                        <option value="{{$dd}}">{{$dd}}</option>
                                                                        @endforeach
                                                                        </select>
                                                                </div>

                                                            </div>
                                                        </div>
                                                
                                                    </div> --}}

                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group ic-cmp-int">
                                                                <div class="form-ic-cmp">
                                                                    <i class="notika-icon notika-part"></i>
                                                                </div>
                                                                <div class="nk-int-st">
                                                                    <input type="text" class="form-control"
                                                                        name="qty_request" placeholder="QTY" value="{{$model->qty_request}}"required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>

                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group ic-cmp-int">
                                                                <div class="form-ic-cmp">
                                                                    <i class="notika-icon notika-part"></i>
                                                                </div>
                                                                <div class="nk-int-st">
                                                                    <input type="text" class="form-control"
                                                                        name="register_by" placeholder="REGISTER BY" value="{{$model->register_by}}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <br>
                                                    <button type="submit"
                                                        class="btn btn-primary btn-sm float-right">SAVE CHANGES</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
