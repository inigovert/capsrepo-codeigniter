<?php
require_once('../config.php');

class Master extends DBConnection {
    private $settings;

    public function __construct() {
        global $_settings;
        $this->settings = $_settings;
        parent::__construct();
    }

    public function __destruct() {
        parent::__destruct();
    }

    function capture_err() {
        if (!$this->conn->error) {
            return false;
        } else {
            $resp['status'] = 'failed';
            $resp['error'] = $this->conn->error;
            return json_encode($resp);
            exit;
        }
    }

    function save_archive() {
        if (empty($_POST['id'])) {
            $pref = date("Ym");
            $code = sprintf("%'.04d", 1);
            while (true) {
                $check = $this->conn->query("SELECT * FROM `archive_list` WHERE archive_code = '{$pref}{$code}'")->num_rows;
                if ($check > 0) {
                    $code = sprintf("%'.04d", abs($code) + 1);
                } else {
                    break;
                }
            }
            $_POST['archive_code'] = $pref . $code;
            $_POST['student_id'] = $this->settings->userdata('id');
            $_POST['curriculum_id'] = $this->settings->userdata('curriculum_id');
        }

        if (isset($_POST['abstract'])) {
            $_POST['abstract'] = htmlentities($_POST['abstract'], ENT_QUOTES | ENT_HTML5);
        }
        if (isset($_POST['members'])) {
            $_POST['members'] = htmlentities($_POST['members'], ENT_QUOTES | ENT_HTML5);
        }

        extract($_POST);
        $data = "";

        foreach ($_POST as $k => $v) {
            if (!in_array($k, ['id']) && !is_array($_POST[$k])) {
                $v = $this->conn->real_escape_string($v);
                $data .= (empty($data) ? "" : ",") . " `{$k}`='{$v}' ";
            }
        }

        $sql = empty($id) ? "INSERT INTO `archive_list` SET {$data}" : "UPDATE `archive_list` SET {$data} WHERE id = '{$id}'";
        $save = $this->conn->query($sql);

        if ($save) {
            $aid = !empty($id) ? $id : $this->conn->insert_id;
            $resp = [
                'status' => 'success',
                'id' => $aid,
                'msg' => empty($id) ? "Archive was successfully submitted" : "Archive details were updated successfully."
            ];

            // Handle image upload
            if (isset($_FILES['img']) && $_FILES['img']['tmp_name'] != '') {
                $this->handle_image_upload($aid, $_FILES['img']);
            }

            // Handle PDF upload
            if (isset($_FILES['pdf']) && $_FILES['pdf']['tmp_name'] != '') {
                $this->handle_pdf_upload($aid, $_FILES['pdf']);
            }

        } else {
            $resp = [
                'status' => 'failed',
                'msg' => 'An error occurred.',
                'error' => $this->conn->error
            ];
        }

        return json_encode($resp);
    }

    private function handle_image_upload($aid, $file) {
        $fname = 'uploads/banners/archive-' . $aid . '.png';
        $dir_path = base_app . $fname;
        $upload = $file['tmp_name'];
        $type = mime_content_type($upload);
        $allowed = ['image/png', 'image/jpeg'];

        if (in_array($type, $allowed)) {
            list($width, $height) = getimagesize($upload);
            $new_width = 1280;
            $new_height = 720;
            $t_image = imagecreatetruecolor($new_width, $new_height);

            imagealphablending($t_image, false);
            imagesavealpha($t_image, true);

            $gdImg = ($type == 'image/png') ? imagecreatefrompng($upload) : imagecreatefromjpeg($upload);
            imagecopyresampled($t_image, $gdImg, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

            if ($gdImg) {
                if (is_file($dir_path)) {
                    unlink($dir_path);
                }
                imagepng($t_image, $dir_path);
                imagedestroy($gdImg);
                imagedestroy($t_image);

                $this->conn->query("UPDATE archive_list SET `banner_path` = CONCAT('{$fname}', '?v=', unix_timestamp(CURRENT_TIMESTAMP)) WHERE id = '{$aid}'");
            }
        }
    }

    private function handle_pdf_upload($aid, $file) {
        $fname = 'uploads/pdf/archive-' . $aid . '.pdf';
        $dir_path = base_app . $fname;

        if (move_uploaded_file($file['tmp_name'], $dir_path)) {
            $this->conn->query("UPDATE archive_list SET `document_path` = CONCAT('{$fname}', '?v=', unix_timestamp(CURRENT_TIMESTAMP)) WHERE id = '{$aid}'");
        }
    }

    function update_status() {
        extract($_POST);
        if (!isset($id) || !isset($status)) {
            return json_encode([
                'status' => 'failed',
                'msg' => 'Invalid parameters provided.'
            ]);
        }

        $update = $this->conn->query("UPDATE `archive_list` SET status = '{$status}' WHERE id = '{$id}'");

        if ($update) {
            $resp = [
                'status' => 'success',
                'msg' => 'Archive status has been successfully updated.'
            ];
        } else {
            $resp = [
                'status' => 'failed',
                'msg' => 'An error occurred.',
                'error' => $this->conn->error
            ];
        }

        return json_encode($resp);
    }
    
    function delete_archive() {
        extract($_POST);
        if (!isset($id)) {
            return json_encode([
                'status' => 'failed',
                'msg' => 'Invalid parameters provided.'
            ]);
        }

        // Delete associated files (image and PDF) if they exist
        $query = $this->conn->query("SELECT banner_path, document_path FROM archive_list WHERE id = '{$id}'");
        if ($query && $query->num_rows > 0) {
            $row = $query->fetch_assoc();
            if (isset($row['banner_path']) && is_file(base_app . $row['banner_path'])) {
                unlink(base_app . $row['banner_path']);
            }
            if (isset($row['document_path']) && is_file(base_app . $row['document_path'])) {
                unlink(base_app . $row['document_path']);
            }
        }

        // Delete the archive entry from the database
        $delete = $this->conn->query("DELETE FROM `archive_list` WHERE id = '{$id}'");

        if ($delete) {
            $this->settings->set_flashdata('success', 'Archive entry has been successfully deleted.');
            $resp = [
                'status' => 'success',
                'msg' => 'Archive entry has been successfully deleted.'
            ];
        } else {
            $resp = [
                'status' => 'failed',
                'msg' => 'An error occurred during deletion.',
                'error' => $this->conn->error
            ];
        }

        return json_encode($resp);
    }
}

$Master = new Master();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$sysset = new SystemSettings();

switch ($action) {
    case 'save_archive':
        echo $Master->save_archive();
        break;
    case 'update_status':
        echo $Master->update_status();
        break;
    case 'delete_archive':
        echo $Master->delete_archive();
        break;
    default:
        echo json_encode(['status' => 'failed', 'msg' => 'Invalid action.']);
        break;
}
