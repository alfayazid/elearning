<br />
<div class="panel panel-info">
  <div class="panel-heading">Detail User</div>
  <div class="panel-body">
    

    <?php
    if(isset($user)){
        foreach($user as $row){ ?>



        


<?
              $attr = array(
                'role' => 'form',
                'class' => 'form-horizontal'
              ); 
             ?>
            <?php echo form_open('rest_client/proses_edit_user',$attr) ?>

        <input name="id" type="hidden" class="form-control" id="inputEmail3" value="<?php echo $row->id; ?>">

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
    <div class="col-sm-10">
      <input name="nama"  type="text" class="form-control" id="inputEmail3" value="<?php echo $row->nama; ?>" readonly>
    </div>
  </div>

  
	<div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Username</label>
    <div class="col-sm-10">
      <input name="username" type="text" class="form-control" id="inputPassword3" value="<?php echo $row->username; ?>" readonly>
    </div>
  </div>

  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input name="password" type="text" class="form-control" id="inputPassword3" value="<?php echo $row->password; ?>" readonly>
    </div>
  </div>

  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Level</label>
    <div class="col-sm-10">
      <input name="level"  type="text" class="form-control" id="inputPassword3" value="<?php echo $row->level; ?>" readonly>
    </div>
  </div>

  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Status</label>
    <div class="col-sm-10">
      <input name="status"  type="text" class="form-control" id="inputPassword3" >
    </div>
  </div>

  

  

  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label"></label>
    <div class="col-sm-10">
      <button class="btn btn-primary" type="submit">Update</button>
    </div>
  </div>



  
</form>

			
			

 <? } } ?>


  		

  </div>
</div>