<div class="page_container">
    <div class="container-fluid">
      <h2>Add Pending Sales Voucher</h2>
                                                                                                   
        <div class="row">
        <div class="col-md-12">
          <ol class="breadcrumb" style="margin-bottom: 5px;">
            <i class="fa fa-home" aria-hidden="true"></i>
            <li><a href="#"></a></li>
            <!--  <li><a href="#">Library</a></li>-->
            <li class="active">Add Pending Sales Voucher</li>
          </ol>
        </div>
      </div>
     <?php  if($this->session->flashdata('success') !=''){?>
                     <div class="alert alert-success company_alert_success" id="success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong><i class="fa fa-check" aria-hidden="true"></i>Success!</strong>
                          <?php echo $this->session->flashdata('success'); ?> 
                     </div>
                     <?php }
                      if($this->session->flashdata('fail') !=''){
                     ?>
                     <div class="alert alert-danger company_alert_error" id="fail">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                               oops!</strong> <?php echo $this->session->flashdata('fail'); ?>
                      </div>
                      <?php } ?>
      <!-------------- add item start here------------->
     
      <!-- form-section-->
      <form role="form" action="<?php echo base_url();?>SalesVoucher/save" method="post" name="po-form" autocomplete="off" enctype="multipart/form-data">
      <div class="row">
          <div class="col-lg-12"> 
               <div class="add_item_box">
                  <div class="heading">
                  <h3> Add Pending Sales Voucher</h3>
                 </div>
                 
                     <div class="data_content">
                      <div style="display:block;  border: 1px solid #9BBAED;">   
                      <?php if($this->session->userdata('user_type')=="super_admin"):?>
                                 <div class="col-md-2">
                                
                                  <div class="form-group">
                                    <label class="form-control-label"> Company Name<span>*</span></label>
                                    <div >
                                    <?php $all_cmp= get_all_company();
                                   
                                    ?>
                                    <select  class="form-control" name="company_id" id="company_id" onchange="set_data();">
                                    <?php foreach ($all_cmp as $key => $value) {
                                      if($invoice_details[0]['company_id'] == $value['company_id']):
                                      ?>
                                    <option value="<?=$value['company_id']?>"> <?=$value['company_name']?></option>
                                    <? endif; }

                                     ?>
                                      </select>
                                      </div>
                                      <div class="clearfix"></div>
                                    </div>
                               
                              </div>
                                <?php else:  $company_id = $this->session->userdata('company_id'); ?>
                                  <input type="hidden" name="company_id" value="<?= $company_id ?>" id="company_id">
                                <?php  endif; ?>
                                <div class="col-md-2">
                                 <div class="form-group">
                                  <label>Voucher Number:</label>
                                  <div class="">
                                  <div class="col-md-3">
                                  <label>SV-</label>
                                  </div>
                                  <?php                                 
                                  $entry_type = get_entry_number(8);
                                  $entry_value = $entry_type + 1;
                                  ?>
                                  <div class="col-md-9">
                                  <input type="text" class="form-control" id="entry_number" name="entry_number" value="<?php echo $entry_value;?>">
                                  </div>
                                  <div class="clearfix"></div>
                                  </div>
                                 </div>
                                 </div> 
                                <div class="col-md-2">
                                 <div class="form-group">
                                  <label>Date:</label>
                                  <input type="text" class="form-control datepicker" id="date" name="date">
                                 </div>
                                 </div>
                                 <div class="col-md-2">
                                 <div class="form-group">
                                  <label>Reference Code:</label>
                                  <input type="text" class="form-control" id="reference_code" name="reference_code" value="<?= $reference_code ?>">
                                 </div>
                                 </div>
                                 <div class="col-md-2">
                                 <div class="form-group">
                                  <label>Customer Name:</label>
                                  <input type="text" class="form-control" id="cust_name" name="cust_name" readonly="true" value="<?= $invoice_details[0]['cust_name']?>">
                                 </div>
                                 </div>
                                 <div class="col-md-2">
                                 <div class="form-group">
                                  <label>Customer Code:</label>
                                  <input type="text" class="form-control" id="cust_code" name="cust_code" readonly="true" value="<?= $invoice_details[0]['cust_code']?>">
                                 </div>
                                 </div>
                                <div class="col-md-2">
                                 <div class="form-group">
                                  <label>Customer Ref No:</label>
                                  <input type="text" class="form-control" id="cust_ref_no" name="ref_no" readonly="true" value="<?= $invoice_details[0]['ref_no']?>">
                                 </div>
                                 </div>
                                <div class="col-md-2">
                                 <div class="form-group">
                                  <label>Currency:</label>
                                  <input type="text" class="form-control" id="currency" name="currency" readonly="true" value="INR">
                                 </div>
                                 </div>
                                 <div class="col-md-2">
                                 <div class="form-group">
                                  <label>Sales Account:</label>
                                  <select class="form-control" id="Sales_account" name="Sales_account">
                                   
                                     <option value="23">Sales A/C </option>
                                  </select>
                                 </div>
                                 </div>
                                <div class="clearfix"></div>
                            </div>                            
<!----- start list item-------------->
              <div class="table_content raw_material_table view_details bttn-sec_msg">
              <h3>List Of Item</h3>
              <div class="table_content view_details bttn-sec_msg" >
                            
                             <table  class="table table-bordered"  id="parenTr">
                               <thead>
                                 <tr>
                                   <th>ware Hose</th>
                                   <th>Invoice No</th>
                                   <th>Item Code</th>
                                   <th>Quantity</th>
                                   <th>Unit Price</th>
                                   <th>Total Price</th>
                                   <th>Action</th>
                                 </tr>
                               </thead>
                               <tbody>
                               <?php 
                               $total_amount =0;
                               foreach ($invoice_details as $key => $value) {
                                 $total_amount = $total_amount + $value['quantity']*$value['selling_rate'];
                                  ?>
                                 <tr id="parenTr<?=$key?>">
                                   
                                   <td id="cost_del<?= $key ?>"><select  class="form-control" name="cost_center[]" id="cost_center<?= $key ?>">
                                    <?php foreach ($cost_center as $k => $val) {
                                      if($val['wh_location'] == $value['receiving_location']):
                                      ?>
                                    <option value="<?=$val['wh_id']?>"> <?=$val['wh_name']?></option>
                                    <?php  endif; }

                                     ?>
                                      </select>
                                     </td>
                                   <td><input list="item_data" type="text" class="form-control" name="invoice_no[]" id="invoice_no<?= $key?>" value="<?=$value['invoice_no'] ?>" readonly="true"></td>
                                   <td><input type="text" class="form-control item_name" name="item_code[]" id="item_code<?= $key?>" value="<?=$value['item_code'] ?>" readonly="true">
                                   
                                   </td>
                                   <td><input type="text" class="form-control quantity" name="quantity[]" id="quantity<?= $key?>" value="<?=$value['quantity'] ?>" onkeypress="fn(event)"onkeyup="calculate_qtn(event,'<?=$value['item_code'] ?>',this);">
                                   <td><input type="text" class="form-control" name="unit_price[]" id="unit_price<?= $key?>" value="<?=$value['selling_rate'] ?>" readonly="true"></td>
                                    <td><input type="text" class="form-control" name="amount[]" id="amount<?= $key?>" value="<?=$value['quantity']*$value['selling_rate'] ?>" readonly="true">
                                    <input type="hidden" value="<?=$value['item_id'] ?>" name="item_id[]" id="item_id<?= $key?>">
                                    </td>
                                   
                                   </td>
                                   <td><a class="approve_buttn" style=" width: 75px;" href="javascript:void(0);" onclick="add_row(<?php echo $key?>,<?php echo "'".$value['item_code']."'"?>,<?php echo $value['selling_rate']?>)"><i class="fa fa-plus-circle" aria-hidden="true">add more</i></a><input type="hidden" value="<?=$value['quantity']?>" id="<?=$value['item_code'] ?>" name="total_avl_qtn[]" >
                                   </td>
                                 </tr>
                                 <?php } ?>
                                 
                                 <tr style="text-align:right;">
                                   <td  colspan="5">
                                   <div  style="float:right;">
                                       Amount
                                    <div class="clearfix"></div>
                                    </div>
                                    </td>
                                    <td id="dr-total" colspan="2">
                                        <div class="col-sm-8" id="din_total_amount" style="text-align='right'"> <?= round($total_amount,2)?>
                                      </div>
                                       <input type="hidden" class="form-control" id="total_amount" name="total_amount"  readonly="true" value="<?= $total_amount ?>">
                                    </td>
                                 </tr>
                                 <!-- vat section -->
                                 <?php
                                 $excise_amount =0.00;
                                 $vat_amount =0.00;
                                 $gst_amount = 0.00;
                                  if($invoice_details[0]['excise_type']!='' && $invoice_details[0]['excise_amount']!=''): 
                                  
                                 ?>                                   
                                  <tr style="text-align:right;">
                                     <td  colspan="5">
                                       <div  style="float:right;">
                                          Excise(
                                          <?php if($invoice_details[0]['excise_type'] == "percentage"): 
                                                $excise_amount = ($total_amount*$invoice_details[0]['excise_amount'])/100;
                                          ?>
                                          <?=$invoice_details[0]['excise_amount']?><i class="fa fa-percent" aria-hidden="true"></i>
                                        <?php 
                                         elseif($invoice_details[0]['excise_type'] == "lumpsum"): 
                                            $excise_amount = $invoice_details[0]['excise_amount'];
                                          ?>
                                          <i class="fa fa-inr" aria-hidden="true"></i><?=$invoice_details[0]['excise_amount']?>
                                        <?php endif; ?>
                                        )
                                        <div class="clearfix"></div>
                                        </div>
                                      </td>
                                      <td id="dr-total" colspan="2">
                                          <div class="col-sm-8" id="din_total_amount"> <?= round($excise_amount,2) ?>
                                        </div>
                                         <input type="hidden" class="form-control" id="total_amount" name="total_amount"  readonly="true" value="<?= $total_amount ?>">
                                      </td>
                                 </tr>
                                  <?php endif;
                                  
                                  
                                  if($invoice_details[0]['vat_type']!='' && $invoice_details[0]['vat_amount']!=''): 
                                  
                                 ?>      <!-- excise sevtion -->                             
                                  <tr style="text-align:right;">
                                     <td  colspan="5">
                                       <div  style="float:right;">
                                          VAT(
                                          <?php if($invoice_details[0]['vat_type'] == "percentage"): 
                                                $total_inc_exc = $total_amount + $excise_amount;
                                                $vat_amount = ($total_inc_exc*$invoice_details[0]['vat_amount'])/100 ;
                                          ?>
                                          <?=$invoice_details[0]['vat_amount']?><i class="fa fa-percent" aria-hidden="true"></i>
                                        <?php 
                                         elseif($invoice_details[0]['vat_type'] == "lumpsum"): 
                                            $vat_amount = $invoice_details[0]['vat_amount']+$total_inc_exc;
                                          ?>
                                          <i class="fa fa-inr" aria-hidden="true"></i><?=$invoice_details[0]['vat_amount']?>
                                        <?php endif; ?>
                                        )
                                        <div class="clearfix"></div>
                                        </div>
                                      </td>
                                      <td id="dr-total" colspan="2">
                                          <div class="col-sm-8" id="din_total_amount"> <?= round($vat_amount,2) ?>
                                        </div>
                                         <input type="hidden" class="form-control" id="total_amount" name="total_amount"  readonly="true" value="<?= $total_amount ?>">
                                      </td>
                                 </tr>
                                  <?php endif; ?>
                                  <!-- end vat section-->
								  <!-- cst section-->
								  <?php  if($invoice_details[0]['cst_type']!='' && $invoice_details[0]['cst_amount']!=''): 
                                  
                                 ?>      <!-- excise sevtion -->                             
                                  <tr style="text-align:right;">
                                     <td  colspan="5">
                                       <div  style="float:right;">
                                          CST(
                                          <?php if($invoice_details[0]['cst_type'] == "percentage"): 
                                                $total_inc_exc = $total_amount + $excise_amount;
                                                $cst_amount = ($total_inc_exc*$invoice_details[0]['cst_amount'])/100 ;
                                          ?>
                                          <?=$invoice_details[0]['cst_amount']?><i class="fa fa-percent" aria-hidden="true"></i>
                                        <?php 
                                         elseif($invoice_details[0]['cst_type'] == "lumpsum"): 
                                            $cst_amount = $invoice_details[0]['cst_amount']+$total_inc_exc;
                                          ?>
                                          <i class="fa fa-inr" aria-hidden="true"></i><?=$invoice_details[0]['cst_amount']?>
                                        <?php endif; ?>
                                        )
                                        <div class="clearfix"></div>
                                        </div>
                                      </td>
                                      <td id="dr-total" colspan="2">
                                          <div class="col-sm-8" id="din_total_amount"> <?= round($cst_amount,2) ?>
                                        </div>
                                         <input type="hidden" class="form-control" id="total_amount" name="total_amount"  readonly="true" value="<?= $total_amount ?>">
                                      </td>
                                 </tr>
                                  <?php endif; ?>
								  <!-- cst section -->
                                  <!-- gst section -->
                                 <!-- gst section -->
								  <?php 
								  $sgst_amount = 0;
								  $cgst_amount =0;
								  $igst_amount =0;
								  $cess_amount =0;
								  ?>
                                  <!-- sgst-->
								  <?php if(isset($invoice_details[0]['gst_type']) && $invoice_details[0]['gst_type'] == "non_igst"):?>
								    <tr style="text-align:right;">
                                     <td  colspan="5">
                                       <div  style="float:right;">
                                          SGST(
                                          <?php if($invoice_details[0]['gst_type'] == "non_igst"): 
                                                $sgst_amount = ($total_amount * $invoice_details[0]['gst_amount'])/100;
                                          ?>
                                          <?=$invoice_details[0]['gst_amount']?><i class="fa fa-percent" aria-hidden="true"></i>
                                        <?php 
                                         
                                         endif; ?>
                                        )
                                        <div class="clearfix"></div>
                                        </div>
                                      </td>
                                      <td id="dr-total" colspan="2">
                                          <div class="col-sm-8" id="din_total_amount"> <?= $sgst_amount=round($sgst_amount,2) ?>
                                        </div>
                                        
                                      </td>
                                  </tr>
                                  <!-- cgst-->
								    <tr style="text-align:right;">
                                     <td  colspan="5">
                                       <div  style="float:right;">
                                          CGST(
                                          <?php if($invoice_details[0]['gst_type'] == "non_igst"): 
                                                $cgst_amount = ($total_amount * $invoice_details[0]['gst_amount'])/100;
                                          ?>
                                          <?=$invoice_details[0]['gst_amount']?><i class="fa fa-percent" aria-hidden="true"></i>
                                        <?php 
                                         
                                         endif; ?>
                                        )
                                        <div class="clearfix"></div>
                                        </div>
                                      </td>
                                      <td id="dr-total" colspan="2">
                                          <div class="col-sm-8" id="din_total_amount"> <?= $cgst_amount=round($cgst_amount,2) ?>
                                        </div>
                                         
                                      </td>
                                  </tr>
								  <?php endif; ?>
								   <!-- gst section-->
								   <!-- igst-->
								   <?php if(isset($invoice_details[0]['gst_type']) && $invoice_details[0]['gst_type'] == "igst"):?>
								    <tr style="text-align:right;">
                                     <td  colspan="5">
                                       <div  style="float:right;">
                                          IGST(
                                          <?php if($invoice_details[0]['gst_type'] == "igst"): 
                                                $igst_amount = ($total_amount * $invoice_details[0]['gst_amount'])/100;
                                          ?>
                                          <?=$invoice_details[0]['gst_amount']?><i class="fa fa-percent" aria-hidden="true"></i>
                                        <?php 
                                         
                                         endif; ?>
                                        )
                                        <div class="clearfix"></div>
                                        </div>
                                      </td>
                                      <td id="dr-total" colspan="2">
                                          <div class="col-sm-8" id="din_total_amount"> <?= $igst_amount=round($igst_amount,2) ?>
                                        </div>
                                         <input type="hidden" class="form-control" id="total_amount" name="total_amount"  readonly="true" value="<?= $total_amount ?>">
                                      </td>
                                  </tr>
								  <?php endif; ?>
								  <!-- cess-->
								  <?php if(isset($invoice_details[0]['cess']) && $invoice_details[0]['cess']): ?>
								    <tr style="text-align:right;">
                                     <td  colspan="5">
                                       <div  style="float:right;">
                                          CESS(
                                          <?php if($invoice_details[0]['cess'] != ''): 
                                                $cess_amount = ($total_amount * $invoice_details[0]['cess'])/100;
                                          ?>
                                          <?=$invoice_details[0]['cess']?><i class="fa fa-percent" aria-hidden="true"></i>
                                        <?php 
                                         
                                         endif; ?>
                                        )
                                        <div class="clearfix"></div>
                                        </div>
                                      </td>
                                      <td id="dr-total" colspan="2">
                                          <div class="col-sm-8" id="din_total_amount"> <?= $cess_amount = round($cess_amount,2) ?>
                                        </div>
                                         <input type="hidden" class="form-control" id="total_amount" name="total_amount"  readonly="true" value="<?= $total_amount ?>">
                                      </td>
                                  </tr>
								  <?php endif; ?>
                                 
                                  <tr style="text-align:right;">
                                   <td  colspan="5">
                                   <div  style="float:right;">
                                      Total Amount
                                    <div class="clearfix"></div>
                                    </div>
                                    </td>
                                    <?php
                                     $gran_total = $total_amount + $excise_amount +$vat_amount+$cst_amount+ $sgst_amount+$cgst_amount+$igst_amount+$cess_amount;
                                    ?>
                                    <td id="dr-total" colspan="2">
                                        <div class="col-sm-8" id="din_total_amount"> <?= round($gran_total,2)  ?>
                                      </div>
                                       <input type="hidden" class="form-control" id="gst_amount" name="gst_amount"  readonly="true" value="<?= $gst_amount ?>">
                                       <input type="hidden" class="form-control" id="excise_amount" name="excise_amount"  readonly="true" value="<?= $excise_amount ?>">
                                       <input type="hidden" class="form-control" id="vat_amount" name="vat_amount"  readonly="true" value="<?= $vat_amount ?>">
                                       <input type="hidden" class="form-control" id="cst_amount" name="cst_amount"  readonly="true" value="<?= $cst_amount ?>">
									   <input type="hidden" class="form-control" id="sgst_amount" name="sgst_amount"  readonly="true" value="<?= $sgst_amount ?>">
									   <input type="hidden" class="form-control" id="cgst_amount" name="cgst_amount"  readonly="true" value="<?= $cgst_amount ?>">
									   <input type="hidden" class="form-control" id="igst_amount" name="igst_amount"  readonly="true" value="<?= $igst_amount ?>">
									   <input type="hidden" class="form-control" id="cess_amount" name="cess_amount"  readonly="true" value="<?= $cess_amount ?>">
									   <input type="hidden" class="form-control" id="total_amount" name="total_amount"  readonly="true" value="<?= $gran_total ?>">
                                    </td>

                                 </tr>
                               </tbody>
                             </table>
                             <div class="form-group" style="text-align:center">
                                      <label class="col-sm-2 form-control-label"><input type="checkbox" id="doc">Upload</label>
                                       <div class="col-sm-4" style="display:none" id="doc_div"> 
                                       <input type="file" class="employe_file_input" id="document" name="document">
                                      </div>
                                    
                                     <label class="col-sm-2 form-control-label">Narration</label>
                                       <div class="col-sm-2"> 
                                       <textarea name="narration" id="narration" style="width: 317px; height: 70px;"></textarea>
                                      </div>
                                    <div class="clearfix"></div>
                            </div>
                            <div class="form-group">
                                     
                            </div>
                    </div>
              </div>
                     <!-----end list item-------------->
                     
                    <!-------- add More and list delete butn ------------>
                    
                         <div class="clearfix"></div>
                       <!-------- end list delete and add More ------------>
                       
                       <!----- submit cancel---->
                        <div class="form_fluide">
                         <div class="form-group ">
                           <input type="hidden" id="hidden_div_id" name="hidden_div_id" value="1" />
                           <input type="hidden" id="hidden_serial" name="hidden_serial" value="2" />
                           <label class="col-sm-4 form-control-label">&nbsp;</label> 
                           <div class="col-sm-8">
                             
                             <input type="hidden" value="<?= $invoice_details[0]['id'] ?>" name="invoice_id">
                             <input type="hidden" value="<?= $invoice_details[0]['ledger_id'] ?>" name="cust_ledger_id">
                             <input type="hidden" value="<?= $invoice_details[0]['cust_id'] ?>" name="cust_id">
                              <input type="hidden" value="<?= $invoice_details[0]['company_id'] ?>" name="company_id">
                             <input style="margin-left:12px;" type="submit" value="Create" class="submit_buttn">
                             <a href="<?= base_url()?>SalesVoucher/pending_list"><input type="button" value="Back"  class="submit_buttn" style="margin-left:12px;"></a>
                             <!--<input type="button" value="Reset" class="reset_buttn">-->
                           </div> 
                           <div class="clearfix"></div>
                           </div>
                        </div>
                       <!----- submit cancel end here---->
                            </div>
                        </div>
                    </div>
                </div>
      </form>
    </div>
        
       <!--******** add item end here-->  
    </div>
  </div>
  <script type="text/javascript">
  function add_row(id,item_code,offer_rate)
  {
    var new_id = parseInt(id)+parseInt(500);
    var cost_del_html = $('#cost_del'+id).html();
    var incoive_no = $('#cost_del'+id).next().children().val();
    var new_offer_rate = parseFloat(offer_rate).toFixed(2);
    //alert(incoive_no);
    var item_code_child = "`"+item_code+"`";
    var html = "<tr id='parenTr"+new_id+"'><td id='cost_del"+new_id+"'>"+cost_del_html+"</td> <td><input type='text' class='form-control' name='invoice_no[]'' id='invoice_no_child_'"+new_id+" value='"+incoive_no+"' readonly='true' ></td><td><input type='text' class='form-control' name='item_code[]' id='item_code_child_"+new_id+"' value='"+item_code+"' readonly='true'></td><td><input type='text' class='form-control quantity' name='quantity[]' id='quantity_child_"+new_id+"' value='' onkeypress='fn(event)'' onkeyup=calculate_qtn(event,'"+item_code+"',this);></td><td><input type='text' class='form-control' name='unit_price[]' id='unit_price_child_"+new_id+"' value='"+new_offer_rate+"' readonly='true'></td><td><input type='text' class='form-control' name='amount[]' id='amount_child_'"+new_id+"' value='' readonly='true'> <input type='hidden' value=' name='tem_id[]' id='item_id_child_"+new_id+"'></td><td><a class='approve_buttn' style='width: 75px;' href='javascript:void(0);' onclick='add_row("+new_id+","+item_code_child+","+new_offer_rate+")'><i class='fa fa-plus-circle' aria-hidden='true'>add more</i></a></td></tr>";
    $('#parenTr'+id).after(html);
  }

 function fn(event)
 {
  var inputValue = event.which;
  if((inputValue <= 47 || inputValue >= 58)&& (inputValue != 32 && inputValue != 0 && inputValue != 08)) { 
        event.preventDefault(); 
    }
 }
  $('#doc').click(function(e){
    if($('#doc').prop('checked') == true)
    {
      $('#doc_div').show();
    }
    if($('#doc').prop('checked') == false)
    {
      $('#doc_div').hide();
    }
  });
 function calculate_qtn(event,item_code,obj)
{
  
   var inputValue = event.which;
  if((inputValue <= 47 || inputValue >= 58)&& (inputValue != 32 && inputValue != 0 && inputValue != 08)) { 
        event.preventDefault(); 
    }
    var total_qtn = $("#"+item_code).val();
  var current_qtn = $(obj).val();
  var unit_price =$(obj).parent().next().children().val();
    var grand_amount = parseFloat(unit_price)*parseFloat(current_qtn);
  $(obj).parent().next().next().children().val(grand_amount);
  var total_qtn_now = 0;
  $("input[name='quantity[]']")
                              .map(function(){
                                var value = $(this).val();
                                var name = $(this).attr('name');
                              //  alert(name);
                                var prev_file_name =$(this).parent().prev().children().val();
                              
                                if(prev_file_name == item_code)
                                {
                                   
                                    total_qtn_now = parseInt(total_qtn_now)+ parseInt(value);
                                }
                               
                            });
                              if(total_qtn_now > total_qtn)
                              {
                                $(obj).parent().next().next().children().val('');
                                $(obj).val('');
                                alert("Please enter valid quantity");

                              }
      //price calculation
       
       if(current_qtn == "")
       {
        $(obj).parent().next().next().children().val('');
       }
 
}
  $('#other_charges').keyup(function(event){
    var total_amount = $('#total_amount').val();
    var other_charges = $('#other_charges').val();
    var total_frieght = $('#total_frieght').val();
    if(other_charges!='' && total_frieght!='')
    {
      var total = parseFloat(total_amount) + parseFloat(other_charges)+ parseFloat(total_frieght);
    }
    else if(other_charges!='' &&  total_frieght=='')
    {
      var total = parseFloat(total_amount) + parseFloat(other_charges);
      
    }
    else if(other_charges=='' &&  total_frieght!='')
    {
      var total = parseFloat(total_amount) + parseFloat(total_frieght);
    }
    else
    {
      var total = parseFloat(total_amount);
    }
   
    $('#din_total_amount').html(total);
  });
  /*********other charges sevtion**********/
  $('#document').on('change',function(e)
        {
           var files = e.originalEvent.target.files;
            for (var i=0, len=files.length; i<len; i++){
              console.log(files[i].name+'  '+files[i].type+' '+ files[i].size);
              if($.inArray(files[i].type,['image/jpeg','image/png','application/pdf']) == '-1')
              {
                file_error  = 1;
                alert('Please select valid file');
                $('#document').val('');
              }
              else
              {
                file_error  = 0;
              }
              
              
            }
            //alert(error);
        });
    $('form[name="po-form"]').on('submit',function(e){
      error = 0;
      var entry_number = $('#entry_number').val();
      var date = $('#date').val();
      var reference_code = $('#reference_code').val();
      if($.trim(entry_number) =='')
      {
        alert("Please enter Voucher Number");
        return false;
      }
      if($.trim(date)=="")
        {
        alert("Please enter date");
        return false;
      }
      if($.trim(reference_code)=="")
      {
        alert("Please enter reference code");
        return false;
      }

    });

  </script>
  