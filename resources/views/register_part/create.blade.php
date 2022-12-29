@extends('layouts.main')
@section('section')
    

    <form action="{{ url('register_part') }}" method="post">
        @csrf
        <div class="breadcomb-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10">
                        <div class="breadcomb-list mg-t-30">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="breadcomb-wp">
                                        <div class="breadcomb-icon">
                                            <i class="notika-icon notika-form"></i>
                                        </div>
                                        <div class="breadcomb-ctn">
                                            <h2>Register Part</h2>
                                            {{-- <p>Welcome to Register Part Process <span class="bread-ntd"> `</span></p> --}}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-element-area mg-t-30">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-element-list">
                                                    <div class="basic-tb-hd">

                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                            <div class="form-group ic-cmp-int">
                                                                <div class="form-ic-cmp">
                                                                    <i class="notika-icon notika"></i>
                                                                </div>
                                                                <div class="nk-int-st">
                                                                    <input type="text" class="form-control mb-3" name="rog_number" placeholder="ROG NUMBER" required>
                                                                        @foreach ($errors->get('rog_number') as $msg)
                                                                            <p class="text-danger">{{$msg}} </p>
                                                                        @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                            <div class="form-group ic-cmp-int">
                                                                <div class="form-ic-cmp">
                                                                    <i class="notika-icon notika"></i>
                                                                </div>
                                                                <div class="nk-int-st">
                                                                    <input type="text" class="form-control mb-3"
                                                                        name="part_number" placeholder="PART NUMBER" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

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
                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                            <div class="form-group ic-cmp-int">
                                                                <div class="form-ic-cmp">
                                                                    <i class="notika-icon notika-part"></i>
                                                                </div>
                                                                <div class="nk-int-st">
                                                                    <input type="text" class="form-control mb-3"
                                                                        name="qty_request" placeholder="QTY"required >
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                            <div class="form-group ic-cmp-int">
                                                                <div class="form-ic-cmp">
                                                                    <i class="notika-icon notika-part"></i>
                                                                </div>
                                                                <div class="nk-int-st">
                                                                    <input type="text" class="form-control mb-3"
                                                                        name="register_by" placeholder="REGISTER BY" required
                                                                        >
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <br>
                                                    <button type="submit"
                                                        class="btn btn-primary btn-sm float-right">Submit</button>
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
