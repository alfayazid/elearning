    <h1 class="page-header"><span class="glyphicon glyphicon-th-list"></span>  Daftar Mata Kuliah</h1>
    <a href="<? echo base_url('index.php/rest_client/tambah_matkul');?>" class="btn btn-danger-wrapper"><span class="glyphicon glyphicon-plus"></span>  Tambah Mata Kuliah</a>
    <br />
    <? if(isset($matkul)){
        foreach ($matkul as $row ) { 
    ?>
        <h3><a href="<? echo base_url('index.php/rest_client/lihatsoal'); ?>/<?echo $row->id;?>"><span class="glyphicon glyphicon-book"></span></span> <? echo $row->nama_matkul; ?></h3></a>
        Dosen : <? echo $row->nama; ?>
        <hr />

    <?
        }
    } 
    ?>