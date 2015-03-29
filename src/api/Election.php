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

    }

    public static function update($data, $id = '') {
        if (!$id) {
            $model = new ElectionModel();
            JsonDecoder::decode($model, $data);
            return $model->write();
        }

    }
}