<?php

class StudentsView {
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
                <a type="button" class="btn btn-primary nav-link active" href="index.php?table=students&action=create">Add New</a>
                </div>
            </div>
            <table class="table mr-6">
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>NIM</th>
                    <th>PHONE</th>
                    <th>JOIN DATE</th>
                    <th>JURUSAN</th>
                    <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>';
        foreach ($data as $row) {
            echo "<tr>
                    <th>{$row['id']}</th>
                    <td>{$row['name']}</td>
                    <td>{$row['nim']}</td>
                    <td>{$row['phone']}</td>
                    <td>{$row['join_date']}</td>
                    <td>{$row['jurusan_name']}</td>
                    <td>
                        <a class='btn btn-success' href='index.php?table=students&action=update&id={$row['id']}'>Edit</a>
                        <a class='btn btn-danger' href='index.php?table=students&action=delete&id={$row['id']}' onclick='return confirm(\"Apakah anda yakin data ingin dihapus?\");'>Delete</a>
                    </td>
                </tr>";
        }
        echo '  </tbody>
            </table>';
        
        include "view/layouts/footer.php";
    }

    public function renderCreate($jurusan_list) {
        include "view/layouts/header.php";

        echo '
        <div class="col-lg-6 m-auto">

            <form method="post" action="index.php?table=students&action=create">
            <br><br>
            <div class="card">

                <div class="card-header bg-primary">
                <h1 class="text-white text-center"> Create Student</h1>
                </div><br>

                <label> NAME: </label>
                <input type="text" name="name" class="form-control" required> <br>

                <label> NIM: </label>
                <input type="text" name="nim" class="form-control" required> <br>

                <label> PHONE: </label>
                <input type="text" name="phone" class="form-control" required> <br>

                <label> JOIN DATE: </label>
                <input type="date" name="join_date" class="form-control" required> <br>

                <label> JURUSAN: </label>
                <select name="id_jurusan" class="form-control custom-select" required>
                    <option value="" disabled selected>-- Pilih Jurusan --</option>';
                    
                    foreach ($jurusan_list as $jurusan) {
                        echo '<option value="' . htmlspecialchars($jurusan['id']) . '">' . htmlspecialchars($jurusan['name']) . '</option>';
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


    public function renderEdit($data, $jurusan_list) {
        include "view/layouts/header.php";
        
        $student = $data[0];
        
        $id = $student['id'];
        $name = $student['name'];
        $nim = $student['nim'];
        $phone = $student['phone'];
        $join_date = $student['join_date'];
        $id_jurusan = $student['id_jurusan'];

        echo '
        <div class="col-lg-6 m-auto">

            <form method="post" action="index.php?table=students&action=update">

            <br><br>
            <div class="card">

                <div class="card-header bg-warning">
                <h1 class="text-white text-center"> Update Student </h1>
                </div><br>

                <input type="hidden" name="id" value="' . $id . '" class="form-control"> <br>

                <label> NAME: </label>
                <input type="text" name="name" value="' . $name . '" class="form-control"> <br>

                <label> NIM: </label>
                <input type="text" name="nim" value="' . $nim . '" class="form-control"> <br>

                <label> PHONE: </label>
                <input type="text" name="phone" value="' . $phone . '" class="form-control"> <br>

                <label> JOIN DATE: </label>
                <input type="date" name="join_date" value="' . $join_date . '" class="form-control"> <br>

                <label> JURUSAN: </label>
                <select name="id_jurusan" class="form-control custom-select" required>
                    <option value="" disabled>-- Pilih Jurusan --</option>';
                    
                    foreach ($jurusan_list as $jurusan) {
                        $selected = ($jurusan['id'] == $id_jurusan) ? 'selected' : '';
                        echo '<option value="' . htmlspecialchars($jurusan['id']) . '" ' . $selected . '>' . 
                             htmlspecialchars($jurusan['name']) . '</option>';
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