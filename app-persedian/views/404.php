<?php

 echo $this->session->flashdata('pesan');
 echo '
 <h2>404 NOT FOUND</h2>
            Tidak Ada Jenis Uri Yang Di Minta '.$_SERVER['REQUEST_URI'].'<br />
            Kembali Kehalaman Saya Berasal  ? <a href="'.base_url('admin/').$this->uri->segment(2).'">Kembali</a>

          <br />
          <hr />
          Saran / Solusi :

          <ol>
            <li>Periksa Paramerter Seperti edit data apakah sama dengan database</li>
            <li>Halaman yang Anda tuju telah berubah / tidak ada</li>
            <li>Jenis Permintaan Uri tidak di kenali</li>
          </ol>
            
            ' ?>