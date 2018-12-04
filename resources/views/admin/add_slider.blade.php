@extends('admin_layout');
@section('admin_content')
    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="index.html">Home</a>
            <i class="icon-angle-right"></i> 
        </li>
        <li>
            <i class="icon-edit"></i>
            <a href="#">Forms</a>
        </li>
    </ul>

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Add Slider</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <?php 
                $message = Session::get('message');
                if($message){
                    echo "<p class='alert alert-success'>" . $message . "</p>";
                    Session::put('message', null);
                }
            ?>
            <div class="box-content">
            <form class="form-horizontal" action="{{URL::to('/save-slider')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="date01">Slider name</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="slider_name">
                            </div>
                        </div>
        
                        <div class="control-group hidden-phone">
                            <label class="control-label" for="textarea2">Image</label>
                            <div class="controls">
                                <input type="file" class="input-file uniform_on" name="slider_image">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="date01">Public</label>
                            <div class="controls">
                                <input type="checkbox" class="input-xlarge" name="public" value="1">
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Add Slider</button>
                            <button type="reset" class="btn">Cancel</button>
                        </div>
                </fieldset>
                </form>   
            </div>
        </div><!--/span-->

    </div><!--/row-->
@endsection