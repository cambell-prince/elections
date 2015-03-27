<?php
namespace Api;

use SIL\Mapper\MapperModel;

class ElectionModel extends MapperModel
{
    public $id;

    public $ballotId;

    public $candidates;

    public $ballots;

}