<?php $this->load->helper('form');


?>
<!DOCTYPE html>
<html>
<head>
  <title>TODOs</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <script src="<?php echo asset_url(); ?>js/jquery.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/materialize.min.css">
  <script src="<?php echo asset_url(); ?>js/materialize.min.js"></script>


  <link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/todo.css">
  <link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/animate.css">

  <script type="text/javascript">var base_url = "<?php echo base_url(); ?>index.php/user/getTodo"</script>
  <script src="<?php echo asset_url(); ?>js/todo.js"></script>

<?php if($this->session->flashdata('error_new')){ $flag = TRUE;?>
<script type="text/javascript">
  $(document).ready(function(){
    $("#todo_new").openModal();
  });
</script>
<?php } ?>
<?php if($this->session->flashdata('success')){ ?>
<script type="text/javascript">
  $(document).ready(function(){
    Materialize.toast("<?php echo $this->session->flashdata('msg') ?>",2000,'green');
  });
</script>
<?php } ?>
</head>
<body class="teal lighten-1">
  <div class="row">
    <p class="teal-text text-darken-1 center-align heading flow-text">todo</p>
    <div class="col s6 offset-s3">
      <div class="card white">
        <div class="card-content" style="padding: 0">
          <div class="card-title teal darken-1 white-text">
            <span class="title">My List</span>
            <img src="<?php echo asset_url(); ?>img/2.gif" class="loader">
          </div>
          <div class="content">
            <ul class="collection with-header" style="margin: 0">
              <a class="collection-item modal-trigger" data-target="todo_new"><h5 class="grey-text" style="cursor: pointer;">Add New Todo</h5></a>
            </ul>
            <ul class="collapsible" id="todo_list" data-collapsible="accordion" style="margin: 0">
            <!-- <li data-id="1" style=""><div class="collapsible-header"><input type="checkbox" id="0"><label for="0">&nbsp;</label><span class="todo_name">Deposit Cash</span><span class="red-text todo_delete"><i class="material-icons">clear</i></span></div><div class="collapsible-body"><p>Deposit cash in bank</p></div></li> -->
              <!-- <li data-id="1">
                <div class="collapsible-header"><input type="checkbox" id="1" />
                  <label for="1">&nbsp;</label><span class="todo_name">First</span><span class="red-text todo_delete"><i class="material-icons">clear</i></span></div>
                  <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
                </li> -->
                </ul>
              </div>
              <div class="card-action center-align card-options">
                <span>All</span>
                <span>Completed</span>
              </div>
              <div class="card-action center-align card-footer">
                <span id="footer-text"></span>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal Structure -->
        <div id="todo_new" class="modal modal-fixed-footer">
          <div class="modal-content">
            <h4>New Todo</h4>
            <?php if(!$this->session->flashdata('success')){echo $this->session->flashdata('msg');} ?>
            <?php echo form_open('user/newTodo',array('id'=>'newTodoForm')); ?>
            <div class="row">
              <div class="input-field col s12">
                <input id="todo_title" type="text" name="todo_title" required="required" value="<?php echo $this->session->flashdata('title'); ?>">
                <label for="todo_title">Title</label>
              </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                  <textarea id="textarea1" class="materialize-textarea" name="todo_descr"><?php echo $this->session->flashdata('descr'); ?></textarea>
                  <label for="textarea1">Description</label>
                </div>
            </div>


            <div class="row">
                <div class="input-field col s12 dpicker">
                  <label>Deadline</label>
                  <input type="date" class="datepicker" name="todo_deadline" required="required" value="<?php echo $this->session->flashdata('deadline'); ?>">
                </div>
            </div>
          </div>




          <div class="modal-footer">
            <button class="btn waves-effect waves-light" type="submit" name="todo_submit" value="add">Add</button>
            <a class=" modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
          </div>
          <?php echo form_close(); ?>
        </div> 
      </body>

      </html>