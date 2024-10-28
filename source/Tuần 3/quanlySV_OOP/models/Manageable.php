<?php
interface Manageable {
    public function add($data);
    public function edit($id, $data);
    public function delete($id);
}
?>
