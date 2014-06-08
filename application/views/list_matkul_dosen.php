<br />
<div class="alert alert-success alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong>Warning!</strong> Better check yourself, you're not looking too good.
</div>

    <h1 class="page-header"><span class="glyphicon glyphicon-th-list"></span>  Daftar Mata Kuliah</h1>
    <a href="<? echo base_url('index.php/rest_client/tambah_matkul');?>" class="btn btn-danger"><span class="glyphicon glyphicon-plus"></span>  Tambah Mata Kuliah</a>
    <br />

    
    <? if(isset($matkul_dosen)){
        foreach ($matkul_dosen as $row ) { 
    ?>
        
        <h3><span class="glyphicon glyphicon-book"></span></span> <? echo $row ->id_dosen; ?></h3>
        
        <hr />

    <?
        }
    } 
    ?>