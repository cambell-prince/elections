<?php
namespace Api;

use SIL\Mapper\MapOf;

class Ballot
{

    public function __construct() {
        $this->votes = new MapOf();
    }

    public function isUsed() {
        return count($this->votes) > 0;
    }

    // MapOf Candidate and Rank
    public $votes;
}
