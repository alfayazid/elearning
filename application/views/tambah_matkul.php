<br />
<div class="panel panel-info">
    <div class="panel-heading">
        <i class="fa fa-book fa-fw"></i>  <? echo $judul ?>
    </div>
        <div class="panel-body">
            
            <?
              $attr = array(
                'role' => 'form',
                'class' => 'form-horizontal'
              ); 
             ?>
            <?php echo form_open('rest_client/proses_tambah_matkul',$attr) ?>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Nama Mata Kuliah</label>
                    <div class="col-sm-10">
                        <input name="nama_matkul"  type="text" class="form-control">
                    </div>
                </div>

  
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Enrollment Key</label>
                    <div class="col-sm-10">
                        <input name="enroll" type="text" class="form-control" id="inputPassword3">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-thumbs-up"></span>  Submit</button>
                    </div>
                  </div>


            </form>
        </div>
</div>