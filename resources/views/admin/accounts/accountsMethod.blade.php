@extends('admin.layouts.app') @section('title')
<title>Account Methods - {{general()->title}}{{general()->title && general()->subtitle?' | ':''}}{{general()->subtitle}}</title>
@endsection @push('css')
<style type="text/css"></style>
@endpush @section('contents')

<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title mb-0">Account Methods</h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard </a></li>
                    <li class="breadcrumb-item active">Account Methods</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
        <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
        
            <button class="btn btn-outline-primary" type="button" data-toggle="modal" data-target="#addTransfer">
                New Method
            </button>
            
            <a class="btn btn-outline-primary" href="{{route('admin.accountsTransfer')}}">
                <i class="fa-solid fa-rotate"></i>
            </a>
        </div>
    </div>
</div>

<div class="content-body">
    <!-- Basic Elements start -->
    <section class="basic-elements">
        <div class="row">
            <div class="col-md-12">
                @include('admin.alerts')

                <div class="card">
                    <div class="card-header" style="border-bottom: 1px solid #e3ebf3;">
                        <h4 class="card-title">Account Methods</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th style="min-width: 170px;width: 170px;">Date</th>
                                            <th style="min-width: 150px;width: 150px;">From</th>
                                            <th style="min-width: 150px;width: 150px;">To</th>
                                            <th style="min-width: 120px;width: 120px;">Amount</th>
                                            <th style="min-width: 100px;">Note</th>
                                            <th style="min-width: 120px;width: 120px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($payments as $i=>$transfer)
                                        <tr>
                                            <td>
                                                <span>{{$transfer->created_at->format('d-m-Y h:i A')}}</span>
                                            </td>
                                            <td>
                                                {{$transfer->formmethod?$transfer->formmethod->name:''}}
                                            </td>
                                            <td>
                                                {{$transfer->method?$transfer->method->name:''}}
                                            </td>
                                            <td>
                                                <span>{{priceFullFormat($transfer->amount)}}</span>
                                            </td>
                                            
                                            <td style="padding: 5px;">
                                                {!!$transfer->billing_note!!}
                                            </td>
                                            <td class="center">

                                                <button class="btn btn-sm btn-info" type="button" data-toggle="modal" data-target="#updateType{{$transfer->id}}">
                                                   Edit
                                                </button>

                                                <!-- Modal -->
                                                 <div class="modal fade text-left" id="updateType{{$transfer->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                   <div class="modal-dialog" role="document">
                                                     <div class="modal-content">
                                                        <form action="{{route('admin.accountsTransfer',['update',$transfer->id])}}" method="post">
                                                            @csrf
                                                           <div class="modal-header">
                                                             <h4 class="modal-title" id="myModalLabel1">Update Type</h4>
                                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                               <span aria-hidden="true">&times; </span>
                                                             </button>
                                                           </div>
                                                           <div class="modal-body">
                                                            <div class="form-group">
                                                                    <label>Date*</label>
                                                                    <input type="date" name="date" value="{{$transfer->created_at->format('Y-m-d')}}" class="form-control"required="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Amount*</label>
                                                                <input type="number" value="{{$transfer->amount}}" name="amount" class="form-control" placeholder="0" required="">
                                                            </div>

                                                            <div class="form-group">
                                                                <label>From Method*</label>
                                                                <select class="form-control" name="frommethod" disabled="">
                                                                    <option>{{$transfer->formmethod?$transfer->formmethod->name:''}}</option>
                                                                </select>
                                                            </div>
                                            
                                                            <div class="form-group">
                                                                <label>To Method Type*</label>
                                                                <select class="form-control" name="tomethod" disabled="">
                                                                    <option>{{$transfer->method?$transfer->method->name:''}}</option>
                                                                </select>
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                    <label>Description</label>
                                                                    <textarea class="form-control" name="description" placeholder="Write Description">{!!$transfer->billing_note!!}</textarea>
                                                            </div>
                                                       </div>
                                                           <div class="modal-footer">
                                                             <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close </button>
                                                             <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Update</button>
                                                           </div>
                                                       </form>
                                                     </div>
                                                   </div>
                                                 </div>

                                                <a href="{{route('admin.accountsTransfer',['delete',$transfer->id])}}" class="btn btn-sm btn-danger" onclick="return confirm('Are You Want To Delete?')"><i class="fa fa-trash"></i></a>
                                               
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Basic Inputs end -->
</div>


 <!-- Modal -->
 <div class="modal fade text-left" id="addTransfer" >
   <div class="modal-dialog" role="document">
     <div class="modal-content">
        <form action="{{route('admin.accountsMethod','create')}}" method="post" enctype="multipart/form-data">
            @csrf
           <div class="modal-header">
             <h4 class="modal-title">New Method</h4>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times; </span>
             </button>
           </div>
           <div class="modal-body">
                <div class="form-group">
                    <label>Method Name*</label>
                    <input type="text" name="name"  class="form-control" placeholder="Enter method name" required="">
                </div>
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control" required="">
                </div>

                <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description" placeholder="Write Description"></textarea>
                </div>
                <div>
                    <label>Status*</label>
                    <select class="form-control" name="status" required="">
                        <option value="">Select Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
           </div>
           <div class="modal-footer">
             <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close </button>
             <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add Method</button>
           </div>
       </form>
     </div>
   </div>
</div>

@endsection 

@push('js') 
<script type="text/javascript">

</script>
@endpush
