    <h1 class="page-header">Blank</h1>
                    
                    


    <table class="table table-bordered">
        <thead>
          <tr>
            
            
            <th>Level</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Password</th>
            <th>Status</th>
            <th>Action</th>
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

                            <td><a href="<?php echo base_url(); ?>index.php/rest_client/detail_user/<?php echo $row->id; ?>" class="btn btn-primary">Detail User</a></td>
                          </tr>
            
                
                            
                            
                            
                            
                    <? } } ?>
          
          
        </tbody>
      </table>