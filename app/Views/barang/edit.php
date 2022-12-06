

               <?= $this->extend('layout/template') ?>
               <?= $this->section('content') ?>

               
               
               <main>
               <div class="container-fluid px-4">
                        <h1 class="mt-4">DATA BARANG PS SEMBIRING </h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Pengolaan Data Barang</li>
                        </ol>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                <?= $title ?>
                            </div>
                            <div class="card-body">
                           <!-- Form Tambah Barang -->
                            <form action ="/barang/edit/<?= $result['barang_id']?>" method="POST"  enctype="multipart/form-data">>
                                <?= csrf_field()?>
                                <input type="hidden" name="slug" value="<?= $result['slug']?>">
                                <div class ="mb-3 row">
                                <div class="mb-3 row">
                                    
                                        <label for="nama" class="col-sm-2 col-form-label"> Nama Barang</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control <?= $validation->hasError('nama') ? 'is-invalid' : '' ?>"
                                            id="nama" name="nama" value="<?= old('nama',$result['nama_barang']) ?>">
                                            <div id="validationServer03Feedback" class="invalid-feedback">
                                                <?= $validation->getError('nama') ?>
                                            </div>
                                        </div>
                                    </div>

                                        

                                            <label for ="stok" class="col-sm-2 col-form-label">Stok </label>
                                     <div class="col-sm-3">
                                        <input type ="text" class ="form-control"id="stok" name="stok">
                                        </div>
                                        </div>

                                        
                                   
                                        <div class="mb-3 row">
                            <label for="sampul" class="col-sm-2 col-form-label">Foto Barang</label>
                            <div class="col-sm-5">
                                <input type="hidden" name="sampullama" value="<?= $result['cover'] ?>">
                                <input type="file" class="form-control <?= $validation->hasError('sampul') ? 'is-invalid' : '' ?>" id="sampul" onchange="previewImage()" name="sampul">
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    <?= $validation->getError('sampul') ?>
                                </div>
                                <div class="col-sm-6 mt-2">
                                    <img src="/img/<?= $result['cover'] == "" ? "default.jpg" : $result
                                        ['cover'] ?>" alt="" class="img-thumbnail img-preview">
                                </div>

                                        </div>
                                        <label for ="kategori" class="col-sm-2 col-form-label">Kategori </label>
                                        <div class="col-sm-3">
                                        <select type ="text" class ="form-control"id="id_kategori" name="id_kategori">
                                        <?php foreach ($categoryy as $value) : ?>
                                            <option value ="<?=$value['barang_category_id']?>"<?=$value['barang_category_id']
                                            ==$result['barang_category_id']?'seleceted' : ''?>>
                                             <?= $value ['nama_category']?> </option>
                                            <?php endforeach; ?>
                                        </select>
                                          </div>
                                        </div>
                                        </div>
                                        </div>
                                        
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                            <button class ="btn btn-primary me-md-2" type="submit">Update</button>
                                            <button class ="btn btn-danger" type="reset">Reset </button>
                                            <a class ="btn btn-warning"href="/barang"role="button">Kembali</a>
                                              </div>
                                            </form>
                                          <!--  -->

                        </div>
                    </div>
                </main>
                <?= $this->endSection() ?>

            

               