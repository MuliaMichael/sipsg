<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Pengembalian PS SIPSG</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Laporan Pengembalian</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                <?= $title ?>
            </div>
            <div class="card-body">
                <!-- isi Report -->
                <a target="_blank" class="btn btn-primary mb-3" type="button" href="/balik/exportpdf">Export PDF</a>
                <a class="btn btn-dark mb-3" type="button" href="/balik/exportexcel">Export Excel</a>
                <i class="fas fa-circle ml-3" style="font-size: 2rem;color: rgb(128,128,128);"></i>SELESAI
                <i class="fas fa-circle ml-3" style="font-size: 2rem; color: rgb(255, 210, 48);"></i>TENGGAT
                <i class="fas fa-circle ml-3" style="font-size: 2rem; color: rgb(255, 0, 0);"></i>PROSES



                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Id Pengembalian</th>
                            <th>Tanggal Transaksi</th>
                            <th>User</th>
                            <th>Customer</th>
                            <th>Sisa Hari Sewa</th>
                            <th>Total</th>
                            <th>Denda</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        // $status = '<i class="fas fa-circle" style="font-size: 2rem; color: rgb(255, 210, 48);"></i>';
                        // $status = '<i class="fas fa-circle" style="font-size: 2rem; color: rgb(255, 0, 0);"></i>';

                        foreach ($dataPengembalian as $value) : ?>
                            <?php
                            $now = date("d-m-Y H:i:s");
                            // $now = date("25-11-2022 22:12:31");
                            $rentDay = date("d-m-Y H:i:s", strtotime($value['tgl_transaksi'] . '+ ' . $value['day'] . ' days'));

                            //sistem sisa hari sewa
                            if ($now <= $rentDay) {
                                $denda = 0;
                                $disabled = "disabled";

                                $status = '<i class="fas fa-circle" style="font-size: 2rem; color: rgb(255, 0, 0);"></i>';



                                $diff = abs(strtotime($rentDay) - strtotime($now));
                                // $diff = abs(strtotime("01-12-2022 18:59:59") - strtotime("01-12-2022 20:59:59"));

                                $years = floor($diff / (365 * 60 * 60 * 24));
                                $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                                $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                                $hours = floor(($diff - $days * 24 * 60 * 60) / (60 * 60));
                                $minutes = floor((($diff  - $days * 24 * 60 * 60 - $hours * 60 * 60)) / 60);

                                if ($diff >= 60 && $diff <= 3600) {
                                    $date = $minutes . " menit";
                                } else if ($diff >=  3600 && $diff <= 86400) {
                                    $date = $hours . " jam " . $minutes . " menit";
                                } else if ($diff >=  86400 && $diff <= 2592000) {
                                    $date = $days . " hari " . $hours . " jam " . $minutes . " menit";
                                } else if ($diff >= 2592000 && $diff <= 31536000) {
                                    $date = $months . " bulan " . $days . " hari "  . $hours . " jam " . $minutes . " menit";
                                } else if ($diff >= 31536000) {
                                    $date = $years . " tahun "  . $months . " bulan " . $days . " hari " . $hours . " jam " . $minutes . " menit";
                                }
                            } else {


                                $disabled = "";
                                //kalkulasi biaya denda keterlambatan


                                if ($value['status'] == 'aktif') {
                                    $date = "TENGGAT";
                                    $status = '<i class="fas fa-circle" style="font-size: 2rem; color: rgb(255, 210, 48);"></i>';
                                } else {
                                    $date = $value['status'];
                                    $disabled = 'disabled';
                                    $status = '<i class="fas fa-circle" style="font-size: 2rem;rgb(128,128,128);"></i>';
                                }


                                $effect = $now;
                                $start = $rentDay;

                                // $effect = strtotime('01-12-2022 21:59:59');
                                // $start = strtotime("01-12-2022 18:59:59");
                                $type = $value['ps_category_id'];


                                $snowBall = strtotime($effect) - strtotime($start);
                                if ($snowBall >= 3600) {
                                    $subtotal = floor($snowBall / 3600);
                                    if ($type == 5) {
                                        $total = $subtotal * 5000;
                                    } else if ($type == 1 || $type == 2 || $type == 3) {
                                        $total = $subtotal * 10000;
                                    } else if ($type == 4) {
                                        $total = $subtotal * 20000;
                                    }
                                }
                                $denda = $total;
                            }


                            //data tabel pengembalian
                            $data = array(


                                'date' => $date,
                                'denda' => $denda,
                                'status' => $status,
                                'disabled' => $disabled,


                            );

                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value['id_pengembalian'] ?></td>
                                <td><?= date("d/m/Y H:i:s", strtotime($value['tgl_transaksi'])) ?></td>
                                <td><?= $value['firstname'] ?> <?= $value['lastname'] ?></td>
                                <td><?= $value['name_cust'] ?></td>
                                <td><?= $data['date'] ?></td>
                                <td><?php
                                    if ($value['status'] !== "selesai") {
                                        $dendaS = $data['denda'];
                                    } else {
                                        $dendaS = $value['denda'];
                                    }
                                    echo number_to_currency($value['total'] + $dendaS, 'IDR', 'id_ID', 2); ?></td>
                                <td><?php if ($value['status'] !== "selesai") {
                                        echo number_to_currency($data['denda'], 'IDR', 'id_ID', 2);
                                    } else {
                                        echo number_to_currency($value['denda'], 'IDR', 'id_ID', 2);
                                    }
                                    ?></td>
                                <td><?= $data['status'] ?></td>
                                <td><button onclick="add_pengembalian('<?= $value['ps_id'] ?>','<?= $value['id_pengembalian'] ?>','<?= $value['stock'] ?>','<?= $data['denda'] ?>')" class="btn btn-primary" <?= $data['disabled'] ?> type="submit">Pengambilan</button></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
        <script>
            function add_pengembalian(ps_id, id_pengembalian, stock, denda) {

                $.ajax({
                    url: "/jual/pengembalian",
                    method: "POST",
                    data: {
                        id_pengembalian: id_pengembalian,
                        ps_id: ps_id,
                        stock: stock,
                        status: "selesai",
                        denda: denda,
                    },
                    success: function(data) {
                        //done

                        alert('Berhasil Dikembalikan');
                    }
                });
            }
        </script>


</main>
<?= $this->endSection() ?>