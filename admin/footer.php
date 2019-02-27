  <!-- /.content-wrapper -->
  <footer class="main-footer">   
    <strong>Copyright &copy; 2018 Student Loan Repayment.</strong> All rights
    reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })

    $('.loans_det').on('click',function(){
      var loan_id = $(this).data('id');
      var parent_tr = $(this).parents('tr');
      var first_name = parent_tr.find('.first_name').text();
      var last_name = parent_tr.find('.last_name').text();
      var appointment_date = parent_tr.find('.appointment_date').text();
      var appointment_time = parent_tr.find('.appointment_time').text();

      $.ajax({
        url : 'ajax_process.php',
        method : 'post',
        data : {
          loan_id : loan_id
        },
        dataType : 'json',
        success : function(res) {
            if(res.status == "true") {
              var response = res.data;
              var pop_up = $('#modal-default');
              pop_up.find('#user_loans_agi').text("$ "+parseInt(response.user_loans_agi).toLocaleString());
              pop_up.find('#user_loans_ela').text("$ "+parseInt(response.user_loans_ela).toLocaleString());
              pop_up.find('#user_family_size').text(response.user_family_size);
              pop_up.find('#user_state').text(response.user_state);
              pop_up.find('#user_email').text(response.user_email);
              pop_up.find('#user_mobile').text(response.user_mobile);
              pop_up.find('#first_name').text(first_name);
              pop_up.find('#last_name').text(last_name);
              pop_up.find('#user_ibr').text("$ "+parseInt(response.user_ibr).toLocaleString());
              pop_up.find('#appointment_date').text(appointment_date);
              pop_up.find('#appointment_time').text(appointment_time);
              pop_up.modal();
            }
            else {
              alert('No reocords found');
            }
        }
      });
    });
  });
</script>
</body>
</html>
