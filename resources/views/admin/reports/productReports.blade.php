@extends('admin.layouts.app') @section('title')
<title>Products Reports - {{general()->title}} | {{general()->subtitle}}</title>
@endsection @push('css')
<style type="text/css"></style>
@endpush @section('contents')


<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title mb-0">Products Reports</h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard </a></li>
                    <li class="breadcrumb-item active">Products Reports</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
        <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
            <a class="btn btn-outline-primary" href="">
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
                    <div class="card-content">
                        <div class="card-body">
                            <div id="accordion">
                                <div
                                    class="card-header collapsed"
                                    data-toggle="collapse"
                                    data-target="#collapseTwo"
                                    aria-expanded="false"
                                    aria-controls="collapseTwo"
                                    id="headingTwo"
                                    style="background: #f5f7fa; padding: 10px; cursor: pointer; border: 1px solid #00b5b8;"
                                >
                                    Search click Here..
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion" style="border: 1px solid #00b5b8; border-top: 0;">
                                    <div class="card-body">
                                        <form action="">
                                            <div class="row">
                                                <div class="col-md-5 mb-1">
                                                    <div class="input-group">
                                                        <input type="date" name="startDate" value="" class="form-control" />
                                                        <input type="date" value="" name="endDate" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-1">
                                                    <select name="supplier" class="form-control">
                                                        <option value="">Select Supplier</option>
                                                        <option value="">Select Supplier</option>
                                                        <option value="">Select Supplier</option>
                                                        <option value="">Select Supplier</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4 mb-1">
                                                    <div class="input-group">
                                                        <input type="text" name="search" value="" placeholder="Invoice No" class="form-control" />
                                                        <button type="submit" class="btn btn-success rounded-0">Search</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header" style="border-bottom: 1px solid #e3ebf3;">
                        <h4 class="card-title">Product Reports</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th style="min-width: 60px;">
                                                    <label style="cursor: pointer; margin-bottom: 0;"> S:L </label>
                                                </th>
                                                <th style="min-width: 130px;">Product</th>
                                                <th style="min-width: 120px;">Business Branch</th>
                                                <th style="min-width: 120px;">Purchase</th>
                                                <th style="min-width: 100px;">Sold</th>
                                                <th style="min-width: 100px;">Return</th>
                                                <th style="min-width: 80px;">Transfer In</th>
                                                <th style="min-width: 80px;">Transfer Out</th>
                                                <th style="min-width: 80px;">Adjusted In</th>
                                                <th style="min-width: 80px;">Adjusted Out</th>
                                                <th style="min-width: 80px;">Profit and/or Loss</th>
                                                <th style="min-width: 80px;">Stock (Qty) Amt</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <tr>
                                                <td>1</td>
                                                <td>1</td>
                                                <td>1</td>
                                                <td>1</td>
                                                <td>1</td>
                                                <td>1</td>
                                                <td>1</td>
                                                <td>1</td>
                                                <td>1</td>
                                                <td>1</td>
                                                <td>1</td>
                                                <td>1</td>
                                            </tr>
                                            
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

@endsection 

@push('js') 


<script type="text/javascript">
	$()
</script>

@endpush
