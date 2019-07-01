@extends('layouts.ngo')
@section('title','Edit NGO | Socialink')
@section('content')
<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4 class="">NGO</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container  pull-up">
        <form method="post" action="{{ route('ngo.saveEditedProfile') }}" id="addEditNgoForm" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <!--widget card begin-->
                    <div class="card m-b-30">
                        <div class="card-header">
                            <h5 class="m-b-0">
                                NGO details
                            </h5>
                        </div>
                        
                        <input type="hidden" value="{{ $getNgoDetails->id }}" name="id">

                        <div class="card-body ">
                            <div class="form-group">
                                <label for="inputNgoName">Name</label>
                                <input type="text" class="form-control" name="name" id="inputNgoName" placeholder="Name" value="{{ $getNgoDetails->name }}" required>
                            </div>

                            <div class="form-group">
                                <label for="inputTagLine">Tag Line</label>
                                <input type="text" class="form-control" name="tag_line" placeholder="Tag Line" id="inputTagLine" value="{{ $getNgoDetails->tag_line }}" required>
                            </div>

                            <div class="form-group">
                                <label for="inputDescription">Description</label>
                                <textarea type="text" class="form-control" name="description" placeholder="Description" id="inputDescription" required>{{ $getNgoDetails->description }}</textarea>
                            </div>
                             

                            <div class="form-group ">
                                <label class="font-secondary">Category</label>
                                <select multiple class="form-control js-select2-category" name="category[]">
                                @if(count($getCategoryList) > 0)
                                    @foreach($getCategoryList as $ck => $cv)
                                        <option value="{{ $cv->id }}" @if(in_array($cv->id,$ngoCategory)) selected="selected" @endif>{{ $cv->name }}</option>
                                    @endforeach
                                @endif
                                </select>
                            </div>

                            <div class="form-group ">
                                <label class="font-secondary">City</label>
                                <select multiple class="form-control js-select2-city" name="city[]">
                                @if(count($getCityList) > 0)
                                    @foreach($getCityList as $lk => $lv)
                                        <option value="{{ $lv->id }}" @if(in_array($lv->id,$ngoCity)) selected="selected" @endif>{{ $lv->name }}</option>
                                    @endforeach
                                @endif
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="inputNgoImage">Logo</label>
                                <input type="file" class="form-control dropify" name="image" id="inputNgoImage" data-default-file="{{ asset('uploads/ngo') }}/{{ $getNgoDetails->logo }}" data-show-remove="false">
                            </div>

                            <div class="form-group">
                                <label for="inputTagLine">Donation Link</label>
                                <input type="text" class="form-control" name="donation_link" placeholder="Donation Link" id="inputTagLine" value="{{ $getNgoDetails->donation_link }}" required>
                            </div>

                            <div class="form-group">
                                <label for="inputTagLine">Mobile</label>
                                <input type="text" class="form-control number" name="mobile" maxlength="10" placeholder="Mobile" id="inputTagLine" value="{{ $getNgoDetails->mobile }}" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card m-b-30">
                        <div class="card-header">
                            <h5 class="m-b-0">
                                Contact No
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="contact_no">
                            @if(isset($getNgoDetails->contact) && !is_null($getNgoDetails->contact))
                                @foreach($getNgoDetails->contact as $con => $conv)
                                    <div class="form-group remove">
                                        <label for="inputContact">Contact Number</label>
                                        <input type="tel" class="form-control number" maxlength="10" name="conatct_no[]" id="inputContact" required="required" placeholder="Contact Number" value="{{ $conv->contact_no }}" style="width:90%" data-msg="Please enter contact number" required>
                                        @if($con != 0)
                                            <a href="javascript:void(0);" class="btn btn-danger removeInput" style="float:right;margin-top: -36px;"><i class="fe fe-trash"></i></a>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <div class="form-group">
                                    <label for="inputContact">Contact Number</label>
                                    <input type="tel" class="form-control number" name="conatct_no[]" id="inputContact" placeholder="Contact Number"  maxlength="10" required="required" data-msg="Please enter contact number" style="width:90%" required>
                                </div>
                            @endif
                            </div>
                            <a href="javascript:void(0);" class="btn btn-info addContactNo"><i class="fe fe-plus"></i></a>
                        </div>
                    </div>

                    <div class="card m-b-30">
                        <div class="card-header">
                            <h5 class="m-b-0">
                                NGO Credentials
                            </h5>
                        </div>
                        <div class="card-body ">
                            <div class="form-group">
                                <label for="inputTagLine">Email</label>
                                <input type="text" class="form-control" name="email" placeholder="Email" id="inputTagLine" value="{{ $getNgoDetails->email }}" readonly required>
                            </div>
                        </div>
                    </div>

                    <div class="card m-b-30">
                        <div class="card-body ">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('admin.ngoList') }}" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
</section>


@endsection
@section('js')
<script type="text/javascript">
    $(document).on('click','.addContactNo',function(){

        var html = '<div class="form-group remove"><label for="inputContact">Contact Number</label><input type="tel" class="form-control number" name="conatct_no[]" maxLength="10" id="inputContact" required="required" placeholder="Contact Number" style="width:90%" data-msg="Please enter contact number" required><a href="javascript:void(0);" class="btn btn-danger removeInput" style="float:right;margin-top: -36px;"><i class="fe fe-trash"></i></a></div>';

        $('.contact_no').append(html);
    });

    $(document).on('click','.removeInput',function(){
        $(this).closest('.remove').remove();
    });

    $(document).on('keyup paste','.number',function(){
        this.value = this.value.replace(/[^0-9]/g, '');
    });
</script>
@endsection