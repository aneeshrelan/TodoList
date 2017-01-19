<!DOCTYPE html>
<html>
<head>
  <title>TODOs</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/todo.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/animate.css">

<script src="<?php echo asset_url(); ?>js/jquery.js"></script>
<script src="<?php echo asset_url();  ?>js/materialize.min.js"></script>
<script src="<?php echo asset_url(); ?>js/todo.js"></script>

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
        <a class="collection-item todo_new_link"><h5 class="grey-text">Add New Todo</h5></a>
      </ul>
      <ul class="collapsible" data-collapsible="accordion" style="margin: 0">
    <li data-id="1">
      <div class="collapsible-header"><input type="checkbox" id="1" data-id="1" />
      <label for="1">&nbsp;</label><span class="todo_name">First</span><span class="red-text todo_delete" style="float:right"><i class="material-icons">clear</i></span></div>
      <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
    </li>

    <li data-id="2">
      <div class="collapsible-header"><input type="checkbox" id="2" class="todo_checkbox" />
      <label for="2">&nbsp;</label><span class="todo_name">First</span><span class="red-text todo_delete" style="float:right"><i class="material-icons">clear</i></span></div>
      <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
    </li>
  </ul>
              </div>
            <!-- <div class="card-action center-align">
              <span>All</span>
              <span>Completed</span>
            </div> -->
          </div>
        </div>
      </div>

      <div id="nutrition-facts" class="modal modal-fixed-footer">
  <div class="modal-content">
    <h4>Nutrition Facts</h4>
    <p>A bunch of text</p>
  </div>
  <div class="modal-footer">
    <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
  </div>
</div>
</body>

</html>