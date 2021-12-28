

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Products</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Products</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-8 col-xs-12">

        <div id="messages"></div>
        <?php flash()?>
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Edit Product</h3>

            <a href="<?php echo base_url('productPublic/show/'.$product_data['id'])?>">View On Catalog</a>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('products/update/'.$product_data['id']) ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label>Image Preview: </label>
                  <img src="<?php echo base_url() . $product_data['image'] ?>" width="150" height="150" class="img-circle">
                </div>

                <div class="form-group">
                  <label for="product_image">Update Image</label>
                  <div class="kv-avatar">
                      <div class="file-loading">
                          <input id="product_image" name="product_image" type="file">
                      </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="product_name">Product name</label>
                  <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter product name" value="<?php echo $product_data['name']; ?>"  autocomplete="off"/>
                </div>
                
                <div class="form-group">
                  <label for="price">Price</label>
                  <input type="text" class="form-control" id="price" name="price" placeholder="Enter price" value="<?php echo $product_data['price']; ?>" autocomplete="off" />
                </div>

                <div class="row form-group">
                  <div class="col-md-6">
                    <label for="qty">Min Stocks</label>
                    <input type="text" class="form-control" id="min_stock" name="min_stock" 
                    placeholder="Enter Qty" autocomplete="off" value="<?php echo $product_data['min_stock']?>" />
                  </div>
                  <div class="col-md-6">
                    <label for="qty">Max Stocks</label>
                    <input type="text" class="form-control" id="max_stock" name="max_stock" 
                    placeholder="Enter Qty" autocomplete="off" value="<?php echo $product_data['max_stock']?>" />
                  </div>
                </div>

                <div class="form-group">
                  <label for="qty">Qty</label>
                  <input type="text" class="form-control" 
                  value="<?php echo $product_data['quantity'] ?? '0' ?>"
                  disabled />
                </div>

                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea type="text" class="form-control" id="description" name="description" placeholder="Enter 
                  description" autocomplete="off">
                    <?php echo $product_data['description']; ?>
                  </textarea>
                </div>

                <?php $attribute_id = json_decode($product_data['attribute_value_id']); ?>
                <?php if($attributes): ?>
                  <?php foreach ($attributes as $k => $v): ?>
                    <div class="form-group">
                      <label for="groups"><?php echo $v['attribute_data']['name'] ?></label>
                      <select class="form-control select_group" id="attributes_value_id" name="attributes_value_id[]" multiple="multiple">
                        <?php foreach ($v['attribute_value'] as $k2 => $v2): ?>
                          <option value="<?php echo $v2['id'] ?>" <?php if(in_array($v2['id'], $attribute_id)) { echo "selected"; } ?>><?php echo $v2['value'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>    
                  <?php endforeach ?>
                <?php endif; ?>

                <div class="form-group">
                  <label for="category">Category</label>

                  <?php
                    $category_data = [];
                    if( !is_null($product_data['category_id']) )
                      $category_data = json_decode($product_data['category_id']); 
                  ?>

                  <select class="form-control select_group" id="category" name="category[]" multiple="multiple">
                    <?php foreach ($category as $k => $v): ?>
                      <option <?php echo isEqual($v['id'] , $category_data) ? 'selected' : ''?>
                        value="<?php echo $v['id']?>"><?php echo $v['name']?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                
                <div class="form-group">
                  <label for="store">Availability</label>
                  <select class="form-control" id="availability" name="availability">
                    <option value="1" <?php if($product_data['availability'] == 1) { echo "selected='selected'"; } ?>>Yes</option>
                    <option value="2" <?php if($product_data['availability'] != 1) { echo "selected='selected'"; } ?>>No</option>
                  </select>
                </div>



              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('products/') ?>" class="btn btn-warning">Back</a>
              </div>
            </form>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- col-md-12 -->

      <div class="col-md-4">
        <div class="box">
          <div class="box-header">
            <h4 class="box-title">Product Images</h4>

            <form method="post" action="<?php echo base_url('products/upload_images')?>" enctype="multipart/form-data">
              <input type="hidden" name="product_id" value="<?php echo $product_data['id']?>">
              <div class="form-group">
                <label>Image</label>
                <input type="file" name="images[]" multiple>
              </div>

              <div class="form-group">
                <input type="submit" name="" class="btn btn-primary btn-sm">
              </div>
            </form>
            <?php if($images) :?>
            <table class="table">
              <tr>
                <td>Image</td>
                <th>Name</th>
                <th>Delete</th>
              </tr>
              <?php foreach( $images as $key => $row) :?>
                <tr>
                  <td><img src="<?php echo base_url('assets/images/sample_image/'.$row['filename'])?>" style="width: 75px;"></td>
                  <td><?php echo $row['filename']?></td>
                  <td>
                    <a href="<?php echo base_url('attachment/delete/'.$row['id'])?>">Delete</a>
                  </td>
                </tr>
              <?php endforeach?>
            </table>
            <?php endif?>
          </div>
        </div>
      </div>
    </div>
    <!-- /.row -->
    

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
  
  $(document).ready(function() {
    $(".select_group").select2();
    $("#description").wysihtml5();

    $("#mainProductNav").addClass('active');
    $("#manageProductNav").addClass('active');
    
    var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Call your custom code here.\')">' +
        '<i class="glyphicon glyphicon-tag"></i>' +
        '</button>'; 
    $("#product_image").fileinput({
        overwriteInitial: true,
        maxFileSize: 1500,
        showClose: false,
        showCaption: false,
        browseLabel: '',
        removeLabel: '',
        browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
        removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
        removeTitle: 'Cancel or reset changes',
        elErrorContainer: '#kv-avatar-errors-1',
        msgErrorClass: 'alert alert-block alert-danger',
        // defaultPreviewContent: '<img src="/uploads/default_avatar_male.jpg" alt="Your Avatar">',
        layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
        allowedFileExtensions: ["jpg", "png", "gif"]
    });

  });
</script>