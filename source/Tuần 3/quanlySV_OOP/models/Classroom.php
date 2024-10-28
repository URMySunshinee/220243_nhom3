<?php
require_once 'Manageable.php';
require_once '../db.php';

class Classroom implements Manageable {
    public function add($data) {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO lophoc (maLop, tenLop, namHoc) VALUES (?, ?, ?)");
        $stmt->execute([$data['maLop'], $data['tenLop'], $data['namHoc']]);
    }

    public function edit($id, $data) {
        global $conn;
        $stmt = $conn->prepare("UPDATE lophoc SET tenLop=?, namHoc=? WHERE maLop=?");
        $stmt->execute([$data['tenLop'], $data['namHoc'], $id]);
    }

    public function delete($id) {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM lophoc WHERE maLop=?");
        $stmt->execute([$id]);
    }
}
?>
