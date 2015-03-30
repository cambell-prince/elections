<?php
namespace Api;

use SIL\Mapper\Json\JsonDecoder;
use SIL\Mapper\Json\JsonEncoder;

class Election
{
    public static function readAll() {
        $result = ElectionModel::readAll();
        return $result;
    }

    public static function read($id) {
        $model = new ElectionModel($id);
        return JsonEncoder::encode($model);
    }

    public static function update($data, $id = '') {
        $model = new ElectionModel($id);
        JsonDecoder::decode($model, $data);
        return $model->write();
    }

    public static function delete($id) {
        return ElectionModel::delete($id);
    }
}