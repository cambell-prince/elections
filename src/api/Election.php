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
        $dto =  JsonEncoder::encode($model);
        unset($dto['ballots']);
        $dto['ballotCount'] = $model->ballotCount();
        $dto['ballotsUsed'] = $model->ballotsUsed();
        return $dto;
    }

    public static function update($data, $id = '') {
        $model = new ElectionModel($id);
        JsonDecoder::decode($model, $data);
        return $model->write();
    }

    public static function delete($id) {
        return ElectionModel::delete($id);
    }

    public static function createBallots($id) {

    }

    public static function postBallot($data, $id) {

    }
}