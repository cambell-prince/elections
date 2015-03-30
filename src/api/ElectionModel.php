<?php
namespace Api;

use SIL\Mapper\MapperModel;
use SIL\Mapper\Mongo\MongoMapper;
use SIL\Mapper\MapperListModel;
use SIL\Mapper\Id;
use SIL\Mapper\ArrayOf;

class ElectionModel extends MapperModel
{
    public function __construct($id = '') {
        $this->id = new Id();
        $this->candidates = new ArrayOf(function($data) {
            return new Candidate();
        });
        parent::__construct(self::mapper(), $id);
    }

    /**
     * Returns a singleton Mapper
     * @return \SIL\Mapper\Mongo\MongoMapper
     */
    private static function mapper() {
        static $mapper = null;
        if (!$mapper) {
            $mapper = new MongoMapper(APP_DATABASE, 'election');
        }
        return $mapper;
    }

    public static function readAll() {
        $model = new MapperListModel(self::mapper(), array(), array('name'));
        $model->read();
        return $model;
    }

    public static function delete($id) {
        self::mapper()->remove($id);
        return $id;
    }

    public $id;

    public $name;

    public $ballotId;

    public $candidates;

    public $ballots;

}