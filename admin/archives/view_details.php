<?php
// File: Master.php
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

        if ($resp['status'] == 'success') {
            $this->settings->set_flashdata('success', $resp['msg']);
        }

        return json_encode($resp);
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

            // Handle Image Upload
            if (isset($_FILES['img']) && $_FILES['img']['tmp_name'] != '') {
                $fname = 'uploads/banners/archive-' . $aid . '.png';
                $dir_path = base_app . $fname;
                $upload = $_FILES['img']['tmp_name'];
                $type = mime_content_type($upload);
                $allowed = ['image/png', 'image/jpeg'];

                if (in_array($type, $allowed)) {
                    move_uploaded_file($upload, $dir_path);
                    $this->conn->query("UPDATE `archive_list` SET `banner_path` = '{$fname}' WHERE id = '{$aid}'");
                } else {
                    $resp['msg'] .= " But the banner image upload failed due to invalid file type.";
                }
            }

            // Handle PDF Upload
            if (isset($_FILES['pdf']) && $_FILES['pdf']['tmp_name'] != '') {
                $fname = 'uploads/pdf/archive-' . $aid . '.pdf';
                $dir_path = base_app . $fname;
                if (move_uploaded_file($_FILES['pdf']['tmp_name'], $dir_path)) {
                    $this->conn->query("UPDATE `archive_list` SET `document_path` = '{$fname}' WHERE id = '{$aid}'");
                } else {
                    $resp['msg'] .= " But the project document upload failed.";
                }
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
}

$Master = new Master();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$sysset = new SystemSettings();

switch ($action) {
    case 'update_status':
        echo $Master->update_status();
        break;
    case 'save_archive':
        echo $Master->save_archive();
        break;
    default:
        echo json_encode(['status' => 'failed', 'msg' => 'Invalid action.']);
        break;
}
