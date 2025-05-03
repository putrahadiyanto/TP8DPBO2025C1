<?php

class JurusanView {
    public function renderIndex($data) {
        
        include "view/layouts/header.php";

        $message = isset($_GET['message']) ? $_GET['message'] : null;
        if ($message == 'success') {
            echo '<div class="alert alert-success">Sukses</div>';
        } elseif ($message == 'error') {
            echo '<div class="alert alert-danger">Gagal, terpakai di tabel lain?</div>';
        }

        echo '
            <div class="my-4 mx-5">
                <div class="col-1">
                <a type="button" class="btn btn-primary nav-link active" href="index.php?table=jurusan&action=create">Add New</a>
                </div>
            </div>
            <table class="table mr-6">
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>KAPRODI</th>
                    <th>AKREDITASI</th>
                    <th>TANGGAL DIDIRIKAN</th>
                    <th>EMAIL</th>
                    <th>FAKULTAS</th>
                    <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>';
        foreach ($data as $row) {
            echo "<tr>
                    <th>{$row['id']}</th>
                    <td>{$row['name']}</td>
                    <td>{$row['kaprodi']}</td>
                    <td>{$row['akreditasi']}</td>
                    <td>{$row['tanggal_didirikan']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['fakultas_name']}</td>
                    <td>
                        <a class='btn btn-success' href='index.php?table=jurusan&action=update&id={$row['id']}'>Edit</a>
                        <a class='btn btn-danger' href='index.php?table=jurusan&action=delete&id={$row['id']}' onclick='return confirm(\"Apakah anda yakin data ingin dihapus?\");'>Delete</a>
                    </td>
                </tr>";
        }
        echo '  </tbody>
            </table>';
        
        include "view/layouts/footer.php";
    }

    public function renderCreate($fakultas_list) {
        include "view/layouts/header.php";

        echo '
        <div class="col-lg-6 m-auto">

            <form method="post" action="index.php?table=jurusan&action=create">
            <br><br>
            <div class="card">

                <div class="card-header bg-primary">
                <h1 class="text-white text-center"> Create Jurusan</h1>
                </div><br>

                <label> NAME: </label>
                <input type="text" name="name" class="form-control" required> <br>

                <label> KAPRODI: </label>
                <input type="text" name="kaprodi" class="form-control" required> <br>

                <label> AKREDITASI: </label>
                <input type="text" name="akreditasi" class="form-control"> <br>

                <label> TANGGAL DIDIRIKAN: </label>
                <input type="date" name="tanggal_didirikan" class="form-control"> <br>

                <label> EMAIL: </label>
                <input type="email" name="email" class="form-control"> <br>

                <label> FAKULTAS: </label>
                <select name="id_fakultas" class="form-control custom-select" required>
                    <option value="" disabled selected>-- Pilih Fakultas --</option>';
                    
                    foreach ($fakultas_list as $fakultas) {
                        echo '<option value="' . htmlspecialchars($fakultas['id']) . '">' . htmlspecialchars($fakultas['name']) . '</option>';
                    }
                    
        echo '    </select>
                <br>

                <button class="btn btn-success my-4" type="submit" name="submit">Submit </button><br>
                <a class="btn btn-info" type="submit" name="cancel" href="index.php"> Cancel </a><br>

            </div>
            </form>
        </div>';
        
        include "view/layouts/footer.php";
    }


    public function renderEdit($data, $fakultas_list) {
        include "view/layouts/header.php";
        
        $jurusan = $data[0];
        
        $id = $jurusan['id'];
        $name = $jurusan['name'];
        $kaprodi = $jurusan['kaprodi'];
        $akreditasi = $jurusan['akreditasi'];
        $tanggal_didirikan = $jurusan['tanggal_didirikan'];
        $email = $jurusan['email'];
        $id_fakultas = $jurusan['id_fakultas'];

        echo '
        <div class="col-lg-6 m-auto">

            <form method="post" action="index.php?table=jurusan&action=update">

            <br><br>
            <div class="card">

                <div class="card-header bg-warning">
                <h1 class="text-white text-center"> Update Jurusan </h1>
                </div><br>

                <input type="hidden" name="id" value="' . $id . '" class="form-control"> <br>

                <label> NAME: </label>
                <input type="text" name="name" value="' . $name . '" class="form-control" required> <br>

                <label> KAPRODI: </label>
                <input type="text" name="kaprodi" value="' . $kaprodi . '" class="form-control" required> <br>

                <label> AKREDITASI: </label>
                <input type="text" name="akreditasi" value="' . $akreditasi . '" class="form-control"> <br>

                <label> TANGGAL DIDIRIKAN: </label>
                <input type="date" name="tanggal_didirikan" value="' . $tanggal_didirikan . '" class="form-control"> <br>

                <label> EMAIL: </label>
                <input type="email" name="email" value="' . $email . '" class="form-control"> <br>

                <label> FAKULTAS: </label>
                <select name="id_fakultas" class="form-control custom-select" required>
                    <option value="" disabled>-- Pilih Fakultas --</option>';
                    
                    foreach ($fakultas_list as $fakultas) {
                        $selected = ($fakultas['id'] == $id_fakultas) ? 'selected' : '';
                        echo '<option value="' . htmlspecialchars($fakultas['id']) . '" ' . $selected . '>' . 
                             htmlspecialchars($fakultas['name']) . '</option>';
                    }
                    
        echo '    </select>
                <br>

                <button class="btn btn-success my-4" type="submit" name="submit"> Submit </button><br>
                <a class="btn btn-info" type="submit" name="cancel" href="index.php"> Cancel </a><br>

            </div>
            </form>
        </div>
        ';

        include "view/layouts/footer.php";
    }
}
?>