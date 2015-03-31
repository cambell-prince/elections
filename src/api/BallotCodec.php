<?php

class BallotCodec
{
    public static function encode($electionId, $index) {
        if ($index >= 1000 || $index < 0) {
            throw new \Exception('index out of range');
        }
        if ($electionId >= 10 || $electionId < 0) {
            throw new \Exception('electionId out of range');
        }
        $number = $electionId * 1000 + $index;

        // TODO $number in base 26 + hex checksum interleaved.

        $encodedNumber = $number;

        return $encodedNumber;
    }
}
