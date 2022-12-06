

               <?= $this->extend('layout/template') ?>
               <?= $this->section('content') ?>

               <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">DATA PLAYSTATION </h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Pengolaan Data Playstation </li>
                        </ol>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                <?= $title ?>
                            </div>
                            <div class="card-body">
                           <!-- Isi Detail -->
                           <div class="card mb-3">
                           <div class="row g-0">
                           <div class="col-md-4">
                               <img src ="<?= base_url('img/'.$result['cover'])?>"alt="" width="50%">
                           
                                </div>  
                                <div class="col-md-8">
                                <div class="card-body">
                                <h5 class="card-title"> <?= $result ['title']?></h5>
                                <p  class="card-text">Nama Playstation:<br><?= $result ['nama_ps']?></p>
                                <p  class="card-text">Tipe  Playstation: <?= $result ['tipe_ps']?></p>
                                <p  class="card-text">Warna Playstation: <?= $result ['warna_ps']?></p>
                                <p  class="card-text">Harga  Sewa : <?= $result ['harga_ps']?></p>
                                <p class="card-text">Diskon: <?= $result['discount'] ?></p>
                                <p  class="card-text">Stock Playstation: <?= $result ['stock']?></p>
                                <p  class="card-text">Kategori Playstation: <?= $result ['nama_category']?></p>
                                <div class ="d-grid gap-2 d-md-block">
                                <a class ="btn btn-dark" type="button" href ="/playstation">Kembali</a>

                           <!--  -->



                        </div>
                    </div>
                </main>
                <?= $this->endSection() ?>

            

               