@extends('admin_layout')
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
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Add Product</h2>
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
            <form class="form-horizontal" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="date01">Product name</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="product_name">
                            </div>
                        </div>



                        <div class="control-group">
                            <label class="control-label" for="selectError3">Select Category</label>
                            <div class="controls">
                            <?php $all_public_category = DB::table('tbl_category')->where('public', 1)->get(); ?>
                                <select id="selectError3" name="category_id">
                                    <option selected>Select category</option>
                                    @foreach ($all_public_category as $v_category)
                                        <option value="{{$v_category->category_id}}">{{$v_category->category_name}}</option> 
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                                <label class="control-label" for="selectError3">Select Manufacture</label>
                                <div class="controls">
                                <?php $all_public_manufacture = DB::table('tbl_manufacture')->where('public', 1)->get(); ?>
                                    <select id="selectError3" name="manufacture_id">
                                        <option selected>Select manufacture</option>
                                        @foreach ($all_public_manufacture as $v_manufacture)
                                            <option value="{{$v_manufacture->manufacture_id}}">{{$v_manufacture->manufacture_name}}</option> 
                                        @endforeach
                                    </select>
                                </div>
                            </div>
        
                        <div class="control-group">
                            <label class="control-label" for="textarea2">Product sort description</label>
                            <div class="controls">
                                <textarea class="cleditor" name="product_short_description" rows="1"></textarea>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="textarea2">Product long description</label>
                            <div class="controls">
                                <textarea class="cleditor" name="product_long_description" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="date01">Product price</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="product_price">
                            </div>
                        </div>

                        <div class="control-group hidden-phone">
                            <label class="control-label" for="textarea2">Image</label>
                            <div class="controls">
                                <input type="file" class="input-file uniform_on" id="fileInput" name="product_image">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="date01">Product size</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="product_size">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="date01">Product color</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="product_color">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="date01">Public</label>
                            <div class="controls">
                                <input type="checkbox" class="input-xlarge" name="public" value="1">
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Add Product</button>
                            <button type="reset" class="btn">Cancel</button>
                        </div>
                </fieldset>
                </form>   
            </div>
        </div><!--/span-->

    </div><!--/row-->
@endsection