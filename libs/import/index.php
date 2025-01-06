<?php
include "vendor/autoload.php";
include "cfg/dbconnect.php";
$file_err = $err_msg = "";
$result_import = "";
$valid_exts = array("xls", "xlsx");
$upload_dir = "uploads/";
if (isset($_POST['submit'])) {
    if ($_FILES['input_file']['name'] == "") {
        $file_err = "Please select a file";
    } else {
        $file_name = $_FILES['input_file']['name'];
        $tmp_name = $_FILES['input_file']['tmp_name'];
        $type = $_FILES['input_file']['type'];
        $ext = strtolower(pathinfo(
            $file_name
            ,
            PATHINFO_EXTENSION
        ));
        if (in_array($ext, $valid_exts)) {
            $new_file = time() . "-" . basename($file_name);
            try {
                move_uploaded_file($tmp_name, $upload_dir . $new_file);
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                $spreadsheet = $reader->load($upload_dir . $new_file);
                $worksheet = $spreadsheet->getActiveSheet();
                $data = $worksheet->toArray();
                unset($data[0]); //remove header
                $result_count = 0;
                foreach ($data as $row) {
                    $code = $row[0];
                    $name = $row[1];
                    $quantity = 0;
                    $image_url = "";
                    $active = "ü";
                    $sql = "insert into excel (code, name, quantity, image_url, active) values(?,?,?,?,?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ssiss", $code, $name, $quantity, $image_url, $active);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $result_count += $result->num_rows;
                }
                $result_import = $result->num_rows . " adet kayıt import edildi...";
            } catch (Exception $e) {
                $err_msg = $e->getMessage();
            }
        } else {
            $err_msg = "Invalid File";
        }
    }
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Excel data into MYSQL table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>  -->
    <div class="container">
        <h1>Import Excel data into MYSQL table</h1>
        <?php
        if (!empty($err_msg)) { ?>
            <div class="alert alert-danger"><?php echo $err_msg; ?></div>
            <?php
        } else if (empty($err_msg) && isset($_POST['submit'])) { ?>
                <div class="alert alert-success"><?php echo $result_import; ?></div>
            <?php
        }
        ?>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="input_file" class="form-label fw-bold">Upload file</label>
                <input type="file" name="input_file" id="input_file" class="form-control" aria-describedby="fileHelpId">
                <div id="fileHelpId" class="form-text">Allowed File Type: xls, xlsx. Must have header line.</div>
            </div>
            <div class="text-danger"><?php echo $file_err; ?></div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
</body>

</html>