    

<?    
    if($this->session->userdata('logged_in')!="" && $this->session->userdata('level')=="Admin")
    { ?>
    <h1 class="page-header"><i class="fa fa-users fa-fw"></i> List User</h1>
    <?php echo $this->session->flashdata('akun');?>
    <? }

    if($this->session->userdata('logged_in')!="" && $this->session->userdata('level')=="Dosen")
    { ?>
    <h1 class="page-header"><i class="fa fa-users fa-fw"></i> List User Dosen</h1>

    <? }

    ?>

                    
    <? echo $this->session->userdata('user'); ?>
                    


    <table class="table table-bordered">
        <thead >
          <tr class="info">
            
            
            <th class="text-center">Level</th>
            <th class="text-center">Nama</th>
            <th class="text-center">Username</th>
            <th class="text-center">Password</th>
            <th class="text-center">Status</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>

        <?php
                    $nomer=1;
                    
                    if(isset($user)){
                        foreach($user as $row){ ?>

                        <tr>
                            
                            <td><?php echo $row->level; ?></td>
                            <td><?php echo $row->nama; ?></td>
                            <td><?php echo $row->username; ?></td>
                            <td><?php echo $row->password; ?></td>
                            <td><?php echo $row->status; ?></td>

                            <td class="text-center"><a href="<?php echo base_url(); ?>index.php/rest_client/detail_user/<?php echo $row->id; ?>" class="btn btn-success"><span class="glyphicon glyphicon-th-list"></span>  Detail User</a></td>
                          </tr>
            
                
                            
                            
                            
                            
                    <? } } ?>
          
          
        </tbody>
      </table>