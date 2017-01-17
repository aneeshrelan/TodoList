<!DOCTYPE html>
<html>
<head>
  <title>TODOs</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/animate.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo asset_url();  ?>js/materialize.js"></script>
<script type="text/javascript" src="<?php echo asset_url(); ?>js/todo.js"></script>
  <style type="text/css">
.heading
{
  font-size: 8em;
  font-weight: 600;
  margin: 0 auto;
}
.card-title
{
  padding: 10px;
}
.todo_name
{
  font-size: 1.5em;
}
</style>
</head>
<body class="teal lighten-1">
<div class="row">
<p class="teal-text text-darken-1 center-align heading flow-text">todo</p>
        <div class="col s6 offset-s3">
          <div class="card white">
            <div class="card-content" style="padding: 0">
              <div class="card-title teal darken-1 white-text">
                <span class="title">My List</span>
              </div>
              <div class="content">
                <ul class="collection with-header" style="margin: 0">
        <a href="#!" class="collection-item"><h5 class="grey-text">Add New Todo</h5></a>
      </ul>
      <ul class="collapsible" data-collapsible="accordion" style="margin: 0">
    <li data-id="1">
      <div class="collapsible-header"><input type="checkbox" id="1" data-id="1" />
      <label for="1">&nbsp;</label><span class="todo_name">First</span></div>
      <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
    </li>

    <li data-id="2">
      <div class="collapsible-header"><input type="checkbox" id="2" />
      <label for="2">&nbsp;</label><span class="todo_name">First</span><span class="red-text" style="float:right"><i class="material-icons">delete</i></span></div>
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
</body>

</html>