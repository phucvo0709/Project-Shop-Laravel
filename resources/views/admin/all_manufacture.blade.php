@extends('admin_layout')
@section('admin_content')
    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="index.html">Home</a> 
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">Tables</a></li>
    </ul>

    <div class="row-fluid sortable">		
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>Manufactures</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <?php 
                    $message = Session::get('message');
                    if($message){
                        echo "<p class='alert alert-success'>" . $message . "</p>";
                        Session::put('message', null);
                    }
                ?>
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                  <thead>
                      <tr>
                          <th>Id</th>
                          <th>Name</th>
                          <th>Description</th>
                          <th>Status</th>
                          <th>Actions</th>
                      </tr>
                  </thead>   
                <tbody>
                    @foreach ($all_manufacture_info as $v_manufacture)
                        <tr>
                            <td>{{$v_manufacture->manufacture_id}}</td>
                            <td>{{$v_manufacture->manufacture_name}}</td>
                            <td>{{$v_manufacture->manufacture_description}}</td>
                            <td>
                            @if ($v_manufacture->public == 1)
                                <span class="label label-success">Active</span>   
                                @else
                                <span class="label label-danger">Unactive</span>   
                            @endif
                            </td>
                            <td class="center">
                                @if ($v_manufacture->public == 1)
                                    <a class="btn btn-danger" href="{{URL::to('/unactive-manufacture/'.$v_manufacture->manufacture_id)}}">
                                        <i class="halflings-icon white thumbs-down"></i>  
                                    </a>
                                    @else
                                    <a class="btn btn-success" href="{{URL::to('/active-manufacture/'.$v_manufacture->manufacture_id)}}">
                                        <i class="halflings-icon white thumbs-up"></i>  
                                    </a>
                                @endif
                                <a class="btn btn-info" href="{{URL::to('/edit-manufacture/'.$v_manufacture->manufacture_id)}}">
                                    <i class="halflings-icon white edit"></i>  
                                </a>
                                <a class="btn btn-danger" href="{{URL::to('/delete-manufacture/'.$v_manufacture->manufacture_id)}}">
                                    <i class="halflings-icon white trash"></i> 
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>            
            </div>
        </div><!--/span-->
    
    </div><!--/row-->
@endsection