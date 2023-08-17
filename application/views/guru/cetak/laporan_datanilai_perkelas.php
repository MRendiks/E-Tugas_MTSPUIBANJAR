<!doctype html>
<html lang="en">
<head>
    <title>REKAP DATA NILAI</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>

<style type="text/css">
    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font: 12pt "Tahoma";
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
    .page {
        width: 210mm;
        min-height: 297mm;
        padding: 10mm;
        margin: 5mm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    .subpage {
        border: 2px white solid;
        height: 257mm;
        outline: 5mm white solid;
    }
    @page {
        size: A4;
        margin: 0;
    }
    @media print {
        html, body {
            width: 210mm;
            height: 297mm;        
        }
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }
</style>
<body>
    <script>
        window.onload = function() {
            window.print();
        };
</script>
<div class="book">
<div class="page">
<div class="subpage">
    <div class="container-fluid">
		<b style="margin-top: 20px ">
			<div style="text-align: center; font-size: 30px;line-height: 30px; margin-top: 10px">
			   REKAP DATA NILAI KELAS <?= $nama_kelas; ?>
		   </div>
	   </b>
	   <hr color="black"style="line-height: 5px"> 
	   <hr width="100%" color="black"><p>
		<br />
		<table class="table table-bordered table-keuangan">
			<thead>
				<tr>
					<th style="width: 5%;" class="serial">No</th>
                    <th class="text-center">Nama Siswa</th>
                    <!-- <?php 

                    $tugas = []; 
                    foreach ($datanilai as $row) {
                        $tugas[$row['judul_tugas']] = 1;
                    }
                    
                    foreach ($tugas as $judul_tugas => $value) {
                        echo '<th>' . $judul_tugas . '</th>';
                    }
                    ?> -->
                    <?php $i = 1; foreach ($datanilai_pertugas as $row) : ?>
                    <th class="text-center"><?= $row['judul_tugas'] ?></th>
                    <?php endforeach; ?>
				</tr>
			</thead>
			<tbody>
                <?php $i = 1; foreach ($datanilai as $row) : ?>
                <tr>
                    <td class="text-center"><?= $i++; ?></td>
                    <td class="text-center"><?= $row['nama_siswa']; ?></td>
                    <?php foreach ($datanilai_pertugas_2 as $row2) : ?>
                        <?php 
                            if ($row['nama_siswa'] == $row2['nama_siswa']) {
                                echo '<td class="text-center">' . $row2['nilai'] . '</td>';
                            }
                            ?>
                        
                    <?php endforeach; ?>
                </tr>
                <?php endforeach; ?>
			</tbody>
		</table>
		<br />
	</div>
</div>
</div>
</div>
</body>
</html>