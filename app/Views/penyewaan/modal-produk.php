<div class="modal fade" id="modalProduk" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel">DATA PRODUK</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <!-- Tabel Playstation Modul 12 halaman 12-->
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="10%">Foto Playstation</th>
                            <th width="15%">Nama PS</th>
                            <th width="15%">Id Category</th>
                            <th width="15%">Tipe PS</th>
                            <th width="15%">Warna PS</th>
                            <th width="15%">Harga Sewa </th>
                            <th width="10%">Stock PS</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $no = 1;


                        foreach ($dataPlaystation as $value) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <img src="img/<?= $value['cover'] ?>" alt="" width="100">
                                </td>

                                <td> <?= $value['nama_ps']  ?> </td>
                                <td> <?= $value['ps_category_id'] ?></td>
                                <td> <?= $value['tipe_ps'] ?> </td>
                                <td> <?= $value['warna_ps'] ?> </td>
                                <td> <?= $value['harga_ps'] ?> </td>
                                <td> <?= $value['stock'] ?> </td>

                                <td>
                                    <button onclick="add_cart('<?= $value['ps_id'] ?>','<?= $value['nama_ps'] ?>','<?= $value['harga_ps'] ?>','<?= $value['discount'] ?>',
                                    '<?= $value['ps_category_id'] ?>','<?= $value['stock'] ?>')" class="btn btn-success"><i class="fa fa-cart-plus"></i> Tambahkan</button>
                                </td>

                            </tr>
                            <input type="hidden" id="ps_category_id" value="<?= $value['ps_category_id'] ?>">
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <!-- Modul 12 halaman 12 -->
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!--Modul 12 halaman 38-->
<div class="modal fade" id="modalUbah" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-x1">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel">Ubah Jumlah Hari</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row mt-3">
                    <div class="col-sm-7">
                        <input type="hidden" id="rowid">
                        <input type="hidden" id='color'>
                        <input type="hidden" id='type'>
                        <input type="hidden" id='price'>

                        <input type="number" id="day" class="form-control" placeholder="Masukan Jumlah Hari" min="1" value="1">
                    </div>
                    <div class="col-sm-5">
                        <button class="btn btn-primary" onclick="update_cart()">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function add_cart(id, nama_ps, harga_ps, discount, category, stock) {



        // var total_bayar_hari = 0;
        // if (category == 5) {
        //     total_bayar_hari = 50000;
        // } else if (category == 1 || category == 2 || category == 3) {
        //     total_bayar_hari = 120000;
        // } else if (category == 4) {
        //     total_bayar_hari = 200000;
        // }



        $.ajax({
            url: "/jual",
            method: "POST",
            data: {
                id: id,
                nama_ps: nama_ps,
                qty: 1,
                harga_ps: harga_ps,
                discount: discount,
                day: 1,
                type: category,
                stock: stock,

            },
            success: function(data) {

                load();
            }
        });
    }



    function update_cart() {
        var rowid = $('#rowid').val();
        var day = $('#day').val();
        var color = $('#color').val();
        var type = $('#type').val();
        var price = $('#price').val();



        // var total_bayar_hari = 0;
        // if (type == 5) {
        //     total_bayar_hari = day * 50000;
        // } else if (type == 1 || type == 2 || type == 3) {
        //     total_bayar_hari = day * 120000;
        // } else if (type == 4) {
        //     total_bayar_hari = day * 200000;
        // }





        $.ajax({
            url: "/jual/update",
            method: "POST",
            data: {
                rowid: rowid,
                day: day,
                color: color,
                type: type,
                price: price,


            },
            success: function(data) {

                load();
                $('#modalUbah').modal('hide');
            }
        });
    }
</script>

<script>
    function load() {

        $('#detail_cart').load('/jual/load');
        $('#spanTotal').load('/jual/gettotal');
    }

    $(document).ready(function() {
        load();
    });

    $(document).on('click', '.ubah_cart', function() {
        var row_id = $(this).attr("id");
        var day = $(this).attr("day");
        var color = $(this).attr("color");
        var type = $(this).attr("type");
        var price = $(this).attr("price");


        $('#rowid').val(row_id);
        $('#day').val(day);
        $('#color').val(color);
        $('#type').val(type);
        $('#price').val(price);


        $('#modalUbah').modal('show');
    });

    $(document).on('click', '.hapus_cart', function() {
        var row_id = $(this).attr("id");
        $.ajax({
            url: "jual/" + row_id,
            method: "DELETE",
            success: function(data) {
                load();
            }
        });
    });

    function bayar() {
        var nominal = $('#nominal').val();
        var idcust = $('#id-cust').val();
        var ps_id = $('#ps_category_id').val();
        $.ajax({
            url: "/jual/bayar",
            method: "POST",
            data: {
                'nominal': nominal,
                'id-cust': idcust,
                'ps_id': ps_id,
            },
            success: function(response) {
                var result = JSON.parse(response);
                console.log(result)
                swal({
                    title: result.msg,
                    icon: result.status ? "success" : "error",
                });
                load();
                $('#nominal').val("");
                $('#kembalian').val(result.data.kembalian);
            }
        });
    }
</script>