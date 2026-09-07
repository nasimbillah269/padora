@extends('admin.layouts.app')
@section('title')
<title>Theme Setting - {{general()->title}} | {{general()->subtitle}}</title>
@endsection

@push('css')

<style type="text/css">
	.ProductGridSection {
    border: 1px solid gray;
    padding: 5px;
    text-align: center;
    }
	
	.ProductGrid {
    min-height: 120px;
    }
    
    .ProductGrid img {
    max-width: 100%;
    max-height: 115px;
    }
</style>

@endpush
@section('contents')


<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
     <h3 class="content-header-title mb-0">Theme Setting</h3>
     <div class="row breadcrumbs-top">
       <div class="breadcrumb-wrapper col-12">
         <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard </a>
           </li>
           <li class="breadcrumb-item active">Theme Setting</li>
         </ol>
       </div>
     </div>
   </div>
   <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
     <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
       	<a class="btn btn-outline-primary reloadPage1" href="{{route('admin.themeSetting')}}">
       		<i class="fa-solid fa-rotate"></i>
       	</a>
     </div>
   </div>
</div>
 
	

 <div class="content-body"><!-- Basic Elements start -->
	 <section class="basic-elements">
	     <div class="row">
	         <div class="col-md-12">
	         	 @include('admin.alerts')
	             <div class="card">
	             	<div class="card-header " style="border-bottom: 1px solid #e3ebf3;">
						<h4 class="card-title">theme Setting</h4>
					</div>
	                <div class="card-content">
	                     <div class="card-body">
	                         <h2>Home Page Banner</h2>
	                         <br>
	                         <div class="row">
	                             @foreach($offerBanners as $offerBanner)
	                             <div class="col-md-6">
	                                 <img src="{{asset($offerBanner->image())}}" style="max-width:100%;">
	                                 <a class="btn btn-sm btn-info" href="javascript:void(0)" data-toggle="modal" data-target="#updateBanner_{{$offerBanner->id}}"><i class="fa fa-edit"></i> Edit</a>
	                             </div>
	                             @endforeach
	                         </div>
	                         <hr>

	                         {{--<h2>Home Page Product Manage <a class="btn btn-sm btn-info" href="{{route('admin.themeSettingAction','create')}}" onclick="return confirm('Are You Want to Add?')"><i class="fa fa-plus"></i> Add</a></h2>
	                         <div class="table-responsive">
		                        <table class="table table-bordered">
		                            <tr>
		                                <th style="min-width: 150px;width: 150px;">Date</th>
		                                <th>Title</th>
		                                <th>Type</th>
		                                <th style="width:120px;min-width:120px;">Action</th>
		                            </tr>
		                            @foreach($homeDatas as $homedata)
		                            <tr>
		                                <td>{{$homedata->created_at->format('d-m-Y')}}</td>
		                                <td>{{$homedata->name}}</td>
		                                <td>1</td>
		                                <td>
		                                    <a href="{{route('admin.themeSettingAction',['edit',$homedata->id])}}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> Edit</a>
		                                    <a href="{{route('admin.themeSettingAction',['delete',$homedata->id])}}" class="btn btn-sm btn-danger" onclick="return confirm('Are You Want to Delete?')"><i class="fa fa-trash"></i></a>
		                                </td>
		                            </tr>
		                            @endforeach
		                        </table>
		                     <hr>
	                     </div>--}}
	                     
	                 </div>
	             </div>

	         </div>
	     </div>
	 </section>
	 <!-- Basic Inputs end -->
</div>

@foreach($offerBanners as $offerBanner)
<!-- Modal -->
<div class="modal fade text-left" id="updateBanner_{{$offerBanner->id}}" tabindex="-1" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{route('admin.themeSettingAction',['banner-update',$offerBanner->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">Update Banner</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times; </span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Banner One</label>
                        <input type="file" accept="image/*" class="form-control {{$errors->has('banner_img')?'error':''}}" name="banner_img" />
                    </div>
                    <div class="form-group">
                        <label>Banner Title</label>
                        <input type="text" class="form-control" placeholder="Banner Title" name="banner_title" value="{{$offerBanner->name}}" />
                    </div>
                    <div class="form-group">
                        <label>Banner Short Description</label>
                        <input type="text" class="form-control" placeholder="Banner Description" name="banner_shortDes" value="{{$offerBanner->content}}" />
                    </div>
                    <div class="form-group">
                        <label>Banner Link</label>
                        <input type="text" class="form-control {{$errors->has('banner_link')?'error':''}}" name="banner_link" placeholder="Enter Banner Link" value="{{$offerBanner->banner_link}}" />
                    </div>
                    
                    <div class="form-group">
                        <label for="bannerStatus">User Status</label>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="status" id="bannerStatus" {{$offerBanner->status=='active'?'checked':''}} />
                            <label class="custom-control-label" for="bannerStatus">User Active</label>
                        </div>
                        @if ($errors->has('status'))
                        <p style="color: red; margin: 0;">{{ $errors->first('status') }}</p>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"> Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection
@push('js')

@endpush