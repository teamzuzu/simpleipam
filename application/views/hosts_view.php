<?php $site_title = getenv('SITE_TITLE') ?: 'SimpleIPAM'; ?>
<title><?php echo htmlspecialchars($site_title); ?> Hosts</title>
<div class="container">

  <h2>Hosts</h2>

  <br />

  <div class="row">
      <div class="col-sm-6">
          <?php
          $attr = array("class" => "form-horizontal", "role" => "form", "id" => "form1", "name" => "form1");
          echo form_open("hosts/search", $attr);?>
              <div class="form-group">
		  <div class="col-md-6">
		  <input class="form-control" id="host_name" name="host_name" placeholder="search for hosts" type="text" value="<?php echo set_value('host_name', $host_name); ?>"/>
                  </div>
                  <div class="col-md-6">
                      <input id="btn_search" name="btn_search" type="submit" class="btn btn-danger" value="Search" />
                      <a href="<?php echo base_url(). "hosts/"; ?>" class="btn btn-primary">Show All</a>
                  </div>
              </div>
          <?php echo form_close(); ?>
      </div>
      <div class="col-sm-6 text-right">
        <button class="btn btn-success" onclick="add_hosts()"><i class="glyphicon glyphicon-plus"></i> Add Host</button>
      </div>
    </div>

    <br />

    <?php  $count = ($total_rows == 0) ? "$total_rows entries" : "Showing $start to $end of $total_rows entries"; ?>
    <?php  echo $count; ?>

    <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
         <tr>
             <th width="100px">address</th>
             <th width="180px">host</th>
             <th width="150px">mac</th>
             <th>note</th>
             <th width="120px">Operation</th>
         </tr>
      </thead>

         <?php foreach($hosts as $host): ?>
         <tr>
             <td><?php echo $host['address']; ?></td>
             <td><?php echo $host['host']; ?></td>
             <td><?php echo $host['mac']; ?></td>
             <td><?php echo $host['note']; ?></td>
             <td>
                  <button class="btn btn-warning btn-xs" onclick="edit_host(<?php echo $host['id'];?>)">
                    <i class="glyphicon glyphicon-pencil"></i> Edit
                  </button>
                  <button class="btn btn-danger btn-xs" onclick="delete_host(<?php echo $host['id'];?>)">
                    <i class="glyphicon glyphicon-remove"></i> Delete
                  </button>
              </td>
          </tr>
          <?php endforeach; ?>

         </tbody>

          <tfoot>
         </tfoot>

    </table>

    <br \>
     <div class="row">
         <div class="col-md-9">
             <?php echo $pagination; ?>
         </div>
     </div>

</div>

    <script src="<?php echo base_url('assets/jquery/jquery.min.js')?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
    <script src="<?php echo base_url('assets/datatables/js/ip-address.js')?>"></script>
    <script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>


    <script type="text/javascript">
    $(document).ready( function () {

        $('#table_id').DataTable({
          columnDefs: [
            { type: 'ip-address', targets: [ 0 ] }
          ],
          "oLanguage": {
          "sSearch": "Filter: "
          },
          //order: [ [ 0, "asc" ] ],
          order: [ ],
          //lengthMenu: [ 10, 20, 100, 300, 500, 750, 1000 ],
          displayLength: 1000,
          //bProcessing: true,
          lengthChange: false,
          info: false,
          paging: false
        });
    } );
      var save_method; //for save method string
      var table;

      function add_hosts()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Add Host'); // Set Title to Bootstrap modal title
    }


    function edit_host(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string

      //Ajax Load data from ajax
      $.ajax({
        //controller's ajax_edit function
        url : "<?php echo site_url('hosts/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id"]').val(data.id);
            $('[name="address"]').val(data.address);
            $('[name="host"]').val(data.host);
            $('[name="mac"]').val(data.mac);
            $('[name="note"]').val(data.note);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Host'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }


    function save()
    {
      var url;
      if(save_method == 'add')
      {
          url = "<?php echo site_url('hosts/hosts_add')?>";
      }
      else
      {
        url = "<?php echo site_url('hosts/hosts_update')?>";
      }

       // ajax adding data to database
          $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
                if(data.status) //if success close modal and reload ajax table
                {
                   //if success close modal and reload ajax table
                   $('#modal_form').modal('hide');
                  location.reload();// for reload a page
                }
                else
                {
                    for (var i = 0; i < data.inputerror.length; i++) 
                    {
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
    }


    function delete_host(id)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('hosts/hosts_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
               location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

      }
    }


    </script>

  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Hosts Form</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
          <input type="hidden" value="" name="id"/>
	  <div class="form-body">

            <div class="form-group">
              <label class="control-label col-md-3">address</label>
              <div class="col-md-6">
                <input name="address" placeholder="192.168.100.1" class="form-control" type="text">
                <span class="help-block"></span>
              </div>
              <div class="col-md-3">
                <p class="text-left">*Required</p>
              </div>
	    </div>

            </div>
            <div class="form-group">
              <label class="control-label col-md-3">host</label>
              <div class="col-md-6">
                <input name="host" placeholder="test-server-01" class="form-control" type="text">
                <span class="help-block"></span>
              </div>
              <div class="col-md-3">
                <p class="text-left">*Required</p>
              </div>
	    </div>


            <div class="form-group">
              <label class="control-label col-md-3">mac</label>
              <div class="col-md-6">
                <input name="mac" placeholder="24:5e:be:32:df:75" class="form-control" type="text">
                <span class="help-block"></span>
              </div>
              <div class="col-md-3">
                <p class="text-left">*Required</p>
              </div>
	    </div>

            <div class="form-group">
              <label class="control-label col-md-3">Note</label>
              <div class="col-md-9">
                 <input name="note" placeholder="" class="form-control" type="text">
	      </div>
           </div>
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
	  </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
