<?php 

//load form helper for new/edit todo
$this->load->helper('form');


?>
<!DOCTYPE html>
<html>
<head>
  <title><?php 

    //show user's First Name in title
    echo $this->session->userdata('fname') . "'s " 

    ?>TODO List</title>


    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/todo.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/animate.css">

    <script src="<?php echo asset_url(); ?>js/jquery.js"></script>
    <script src="<?php echo asset_url(); ?>js/materialize.min.js"></script>
    <script type="text/javascript">var base_url = "<?php echo base_url(); ?>index.php/user/"</script>
    <script src="<?php echo asset_url(); ?>js/todo.js"></script>


    <?php 

    //if error from new todo form, open new todo modal automatically
    if($this->session->flashdata('error_new')){

      ?>

    <script type="text/javascript">
      $(document).ready(function(){
        $("#todo_new").openModal();
      });
    </script>

    <?php } ?>


    <?php 

    //if error from edit todo form, open edit todo modal automatically
    if($this->session->flashdata('error_edit')){

      ?>

    <script type="text/javascript">
      $(document).ready(function(){
        $("#todo_edit").openModal();
      });
    </script>

    <?php } ?>


    <?php

    //show success msg in Toast for new/edit todo success
     if($this->session->flashdata('success')){ 

      ?>
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
              <span class="title"><?php echo $this->session->userdata('fname') . "'s ";?> Todo List</span>
              <img src="<?php echo asset_url(); ?>img/2.gif" class="loader">
            </div>
            <div class="content">
              <ul class="collection with-header" style="margin: 0">
                <a class="collection-item modal-trigger" data-target="todo_new"><h5 class="grey-text" style="cursor: pointer;">Add New Todo</h5></a>
              </ul>
              <ul class="collapsible" id="todo_list" data-collapsible="expandable" style="margin: 0">

              </ul>
            </div>
            <div class="card-action center-align card-options">
              <span class="todo_total">Total: <span class="total_value"></span></span>
              <p class="show_options center-align"><span class="show_all active">All</span><span class="show_pending">Pending</span><span class="show_completed">Completed</span></p>
              <span class="mark_all">Mark All as Completed</span>
            </div>
            <div class="card-action center-align card-footer">
              <span id="footer-text"></span>
            </div>
          </div>
        </div>
        <div class="logout center-align">
          <a class="waves-effect waves-white btn-flat">Logout</a>
        </div>
      </div>



      <!-- New Todo Modal Structure -->
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




<!-- Edit Todo Modal Structure -->
      <div id="todo_edit" class="modal modal-fixed-footer">
        <div class="modal-content">
          <h4>Edit Todo</h4>
          <?php if(!$this->session->flashdata('success')){echo $this->session->flashdata('msg');} ?>
          <?php echo form_open('user/editTodo'); ?>
          <div class="row">
            <div class="input-field col s12">
              <input id="todo_title" type="text" name="todo_title" required="required" value="<?php echo $this->session->flashdata('title'); ?>">
              <input type="hidden" name="todo_id" id="todo_id" value="<?php echo $this->session->flashdata('id'); ?>">
              <label for="todo_title">Title</label>
            </div>
          </div>

          <div class="row">
            <div class="input-field col s12">
              <textarea id="todo_descr" class="materialize-textarea" name="todo_descr">value="<?php echo $this->session->flashdata('descr'); ?>"</textarea>
              <label for="textarea1">Description</label>
            </div>
          </div>


          <div class="row">
            <div class="input-field col s12 dpicker">
              <label>Deadline</label>
              <input id="todo_deadline" type="date" class="datepicker" name="todo_deadline" required="required" value="<?php echo $this->session->flashdata('deadline'); ?>">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn waves-effect waves-light" type="submit" name="todo_submit" value="modify">Modify</button>
          <a class=" modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
        </div>
        <?php echo form_close(); ?>
      </div> 


    </body>

    </html>