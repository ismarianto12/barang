<?php if($form == 'n'): 
 
echo $this->session->flashdata('pesan');

?>
 
<table id="example1" class="table table-bordered table-striped">
    <thead>
	<tr>
		<th>No.</th>
		<th>Setting </th>
		<th>Aksi</th>
	</tr>
	</thead>
<tbody>
	<?php $no=1; foreach($data->result() as $data): ?>
 <tr>
 	<td><?= $no ?></td>
    <td><?= $data->nilai ?></td>
    <td><a href="<?= base_url('admin/identitas/edit/'.$data->parameter) ?>" class="btn btn-info"><i class="fa fa-edit"></i>Edit</a>
        </td>
 </tr>
   <?php $no++; endforeach; ?>
</tbody>

</table>

<?php elseif($form =='y'): 
buka_form();
echo '<tr><td>Parameter </td><td><input type="text" disabled="" class="form-control" value="'.$parameter.'"></td></tr> <br />
  <small>** Keterangan Pada Parameter Tidak Bisa Di Ubah Pada Text Box </small>';

if($this->uri->segment(4) == 'no_telp'):
buat_text_box('Nilai','number','nilai',$nilai); 
else:
buat_text_box('Nilai','text','nilai',$nilai); 
endif;
tutup_form();

endif;
?>