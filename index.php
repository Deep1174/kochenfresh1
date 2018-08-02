<!--right side content section start here-->
<div class="page-content">
  <div class="page-head">
    <div class="page-main-head">
      <h1 id="head"> Manage Category</h1>
    </div>
   
    <div class="clearfix"></div>
  </div>
  <div class="form_section">
   <!-- error message section -->
  <?php if($this->session->flashdata('fail')!=''){ ?>
    <div class="alert alert-danger"><?=$this->session->flashdata('fail')?></div>
  <?php } ?>  
  <?php if($this->session->flashdata('success')!=''){ ?>
    <div class="alert alert-success"><?=$this->session->flashdata('success')?></div>
  <?php } ?>  
  <!--  error message section-->  
    <div class="container-fluid">
      <div class="row">
        <div class="form-content">
          <div class="form-row">
            <div class="form-content-inner">
            <form action="<?=base_url()?>Category/save" method="post" enctype="multipart/form-data">
              <div class="col-md-12 col-sm-12">
                <div class="form-group">
                  <label for="designationname"> Category Name <span class="star">*</span> </label>
                  <input type="text" name="cat_name" id="catName" class="form-control" placeholder="Enter Category Name" data-validation="required" data-validation-error-msg="Please Enter Company Name" />
                  <input type="hidden" name="cat_id" id="catIdHiddn"/>
                </div>
				
              </div>
			   <div class="col-md-6 col-sm-6">
			   <div class="form-group">
                  <label for="designationname"> Upload Image [jpeg,jpg,png][1024 X 728]   </label>
                  <input type="file" name="image" id="image" class="form-control"  onchange="readURL(this);" />
                 <span id="err" style="color:red"></span>
                </div>
				</div>

				 <img id="image_div" src=""  height='70' width='80' style="display:none;"/>
              <div class="clearfix"></div>
              <div class="col-md-6 col-sm-6">
                <input name="" type="submit" id="submit_btn" value="Save" class="yellow btn-radius15 ">
              </div>
              <div class="col-md-6 col-sm-6">
              <a href="javascript:void(0);" class="darkgrey btn-radius15 " title="Cancel" onclick="cancel()">Cancel </a>
              </div>
              <div class="clearfix"></div>
            </form>
            <?php  if(!empty($all_category)){ ?>
              <div class="small-table-content">
                <div class="col-md-12">
                  <div class="form-group">
                    <table class="table table-bordered  table-striped">
                      <thead class="thead-inverse">
                        <tr>
                          <th>Category</th>
						  <th>Image</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        foreach($all_category as $val){
                          $jsonData = json_encode($val);
                      ?>
                        <tr>
                          <td><?php echo isset($val['cat_name'])?$val['cat_name']:'';?></td>
						  <td>
              <?php if($val['image']!='') { ?>
              <image src="<?= base_url()?>uploads/category/<?=$val['image']?>" height="42" width="42"/>
              <?php } else { ?>
              <image src="<?= base_url()?>uploads/Banner/banner_no_image.png" height="42" width="42"/>

              <?php  } ?>

              </td>
                          <td><a class="edit" onclick='edit_category(<?php echo $jsonData;?>)' title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>

                          <a href="<?php echo base_url();?>Category/delete/<?php echo $val['cat_id'];?>" class="delete" title="Delete" onclick="return confirm('Are you sure you want to delete ?')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                        </td>
                        </tr>
                     <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
             <?php } ?>
             <?php echo $link;?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
function edit_category(jsonData)
{
  $('#head').html('Edit Category ' + jsonData.cat_name );
  $('#catIdHiddn').val(jsonData.cat_id);
  $('#catName').val(jsonData.cat_name);
   
  if(jsonData.image!='')
  {
	  $('#image_div').css('display','block');
	  var html="<image height='70' width='80' src='<?=base_url()?>uploads/category/"+jsonData.image+"'>";
	   $('#image_div').attr('src','<?=base_url()?>uploads/category/'+jsonData.image);
  }
  else
  { 
    $('#image_div').css('display','block');
    var html="<image height='70' width='80' src='<?=base_url()?>uploads/category/cat_name_no_image.png'>";
     $('#image_div').attr('src','<?=base_url()?>uploads/category/cat_name_no_image.png');

  }
  
}
function cancel()
{
  window.location.reload();
}
function readURL(input) {
	$('#image_div').css('display','block');
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#image_div')
          .attr('src', e.target.result)
          .width(42)
          .height(42);
        };
      reader.readAsDataURL(input.files[0]);
    }
  }
   
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script>
    $(document).ready(function () {
    $(".alert-success").delay(2000).fadeOut(2000);
    $(".alert-danger").delay(2000).fadeOut(2000);
   $('#image').on('change',function(e)
        {
           var files = e.originalEvent.target.files;
             myfile= $( this ).val();
             var ext = myfile.split('.').pop();
             if(ext=="png" || ext=="jpeg"  || ext=="jpg"){
                file_error  = 0;
				$('#err').text('');
				$('#submit_btn').show();
				$('#submit_btn').attr('type','submit');
             } 
             else
             {
              file_error  = 1;
			  $('#err').text('Please upload valid file type');
              $('#image_div').css('display','none');
			  $('#submit_btn').attr('type','button');
             }
        });
   });
	
  </script>