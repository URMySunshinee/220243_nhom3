<?php
class Manager {
    private $model;

    public function __construct(Manageable $model) {
        $this->model = $model;
    }

    public function add($data) {
        $this->model->add($data);
    }

    public function edit($id, $data) {
        $this->model->edit($id, $data);
    }

    public function delete($id) {
        $this->model->delete($id);
    }
}
?>
