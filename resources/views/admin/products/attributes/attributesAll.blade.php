@extends(general()->adminTheme.'.layouts.app')
@section('title')
<title>{{websiteTitle('Attributes List')}}</title>
@endsection
@push('css')
<style type="text/css">

</style>
@endpush
@section('contents')

<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
     <h3 class="content-header-title mb-0">Attributes List</h3>
     <div class="row breadcrumbs-top">
       <div class="breadcrumb-wrapper col-12">
         <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard </a>
           </li>
           <li class="breadcrumb-item active">Attributes List</li>
         </ol>
       </div>
     </div>
   </div>
   <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
     <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
       	<a class="btn btn-outline-primary reloadPage1" href="{{route('admin.productsAttributes')}}">
       		<i class="fa-solid fa-rotate"></i>
       	</a>
     </div>
   </div>
</div>
 
	

	         		@include('admin.alerts')
	         		

	             <div class="card">
	             	<div class="card-header " style="border-bottom: 1px solid #e3ebf3;">
					 	<h4 class="card-title">Attributes List</h4>
				 	</div>
	                 <div class="card-content">
	                     <div class="card-body">
		                     <div class="table-responsive">

		                     	<table class="table table-striped table-bordered table-hover" >
								    <thead>
								        <tr>
								            <th style="min-width: 60px;">SL</th>
								            <th>Attributes Name</th>
								            <th>Type</th>
								            <th width="25%">Action</th>
								        </tr>
								    </thead>
								    <tbody>
								        @foreach($attributes as $i=>$attribute)
								        <tr>
								            <td>
								            {{$i+1}}
								            </td>
								            <td>
								            <span>
								                <a href="" target="_blank">{{$attribute->name}}</a></span><br>
								                @if($attribute->status=='active')
								               <span><i class="fa fa-check" style="color: #1ab394;"></i></span>
								               @else
								               <span><i class="fa fa-times" style="color: #ed5565;"></i></span>
								               @endif

								                <span style="font-size: 10px;"><i class="fa fa-user" style="color: #1ab394;"></i>
								                {{$attribute->user?$attribute->user->name:'No Author'}}
								              </span>
								            </td>
								            <td>
								            	@if($attribute->view==2)
								            	<span>Color</span>
								            	@elseif($attribute->view==3)
								            	<span>Image</span>
								            	@else
								            	<span>Text</span>
								            	@endif 
								            	({{$attribute->subAttributes->count()}} items)
								            </td>
								            <td class="center">
								                <a href="{{route('admin.productsAttributesAction',['edit',$attribute->id])}}" class="btn btn-sm btn-info">Config</a>
								            </td>
								        </tr>
								        @endforeach
								    </tbody>
								</table>
								{{$attributes->links('pagination')}}
		                        
		                     </div>

	                     </div>
	                 </div>
	             </div>



@endsection
@push('js')

@endpush