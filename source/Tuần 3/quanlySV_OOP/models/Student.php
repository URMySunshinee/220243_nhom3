<?php
require_once 'Manageable.php';
require_once '../db.php';

class Student implements Manageable {
    public function add($data) {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO sinhvien (maSV, hoLot, tenSV, ngaySinh, gioiTinh, maLop) 
                                VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$data['maSV'], $data['hoLot'], $data['tenSV'], $data['ngaySinh'], $data['gioiTinh'], $data['maLop']]);
    }

    public function edit($id, $data) {
        global $conn;
        $stmt = $conn->prepare("UPDATE sinhvien SET hoLot=?, tenSV=?, ngaySinh=?, gioiTinh=?, maLop=? WHERE maSV=?");
        $stmt->execute([$data['hoLot'], $data['tenSV'], $data['ngaySinh'], $data['gioiTinh'], $data['maLop'], $id]);
    }

    public function delete($id) {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM sinhvien WHERE maSV=?");
        $stmt->execute([$id]);
    }
}
?>
