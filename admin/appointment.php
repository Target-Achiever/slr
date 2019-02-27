<?php
  include_once('header.php');

  $appointment_table = new Query();
  $appointment_table->access_table = 'slr_appointment';

  // Get admin data
  $select['conditions'] = "appointment_id !=0";
  $select['select'] = array('user_loans_id,user_mobile,user_firstname,user_lastname,user_appointment_date,user_appointment_time');
  $select['sort'] = "appointment_id desc";
  $appointment_data = $appointment_table->select($select);
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Appointment Details      
      </h1>     
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">      
          <div class="box">           
            <!-- /.box-header -->
            <div class="box-body">
			<div class="table-responsive">	
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Phone</th>
                  <th>Appointment Date</th>
                  <th>Appointment Time</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  if(!empty($appointment_data)) {
                    unset($appointment_data['count']);
                    $i=1;
                    foreach ($appointment_data as $key => $value) {
                  ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td class="first_name"><?php echo $value['user_firstname']; ?></td>
                    <td class="last_name"><?php echo $value['user_lastname']; ?></td>
                    <td><?php echo $value['user_mobile']; ?></td>
                    <td class="appointment_date"><?php echo $value['user_appointment_date']; ?></td>
                    <td class="appointment_time"><?php echo $value['user_appointment_time']; ?></td> 
                    <td class="view" data-toggle="modal"> <a href="#" class="loans_det" data-id="<?php echo $value['user_loans_id']; ?>"><i class="fa fa-eye"></i> View</td>
                  </tr>
                  <?php
                    $i++;
                    }
                  }
                  ?>
               </tbody>
                </tfoot>
              </table>
			  </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <div class="modal fade" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Appointment Details</h4>
          </div>
          <div class="modal-body">
            <table  class="table table-bordered table-striped">
                <tbody>
                  <tr>                    
                    <th>First Name</th>
                    <td id="first_name"></td>                                      
                  </tr>
                  <tr>                    
                    <th>Last Name</th>
                    <td id="last_name"></td>                                      
                  </tr>
                  <tr>
                    <th>Estimated Loan Amount</th>
                    <td id="user_loans_ela"></td>                    
                  </tr>
                  <tr>
                    <th>Adjusted Gross Income(AGI)</th>                   
                    <td id="user_loans_agi"></td>                   
                  </tr>
                  <tr>
                    <th>IBR</th>                   
                    <td id="user_ibr"></td>                   
                  </tr>
                  <tr>                    
                    <th>Family Size</th>
                    <td id="user_family_size"></td>                                      
                  </tr>
                  <tr>
                    <th>State</th>
                    <td id="user_state"></td>                    
                  </tr>
                  <tr>
                    <th>Email</th>                   
                    <td id="user_email"></td>                   
                  </tr>
                  <tr>                    
                    <th>Mobile</th>
                    <td id="user_mobile"></td>                                      
                  </tr>
                  <tr>                    
                    <th>Appointment Date</th>
                    <td id="appointment_date"></td>                                      
                  </tr>
                  <tr>                    
                    <th>Appointment Time</th>
                    <td id="appointment_time"></td>                                      
                  </tr>
               </tbody>
              </table>
          </div>
          <div class="modal-footer">        
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<?php
  include_once('footer.php');
?>