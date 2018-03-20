<?php
/**
 * Short description for multarraytest.php
 *
 * @package multarraytest
 * @author tim <tim@tim-PC>
 * @version 0.1
 * @copyright (C) 2018 tim <tim@tim-PC>
 * @license MIT
 */

use PHPUnit\Framework\TestCase;
use MultArray\RowArray;
final class RowArrayTest extends TestCase{
    public function testKvToMult(){
        $kvdata = [
            '_id'=>'123',
            'name[first]'=>'Tim',
            'name[last]'=>'Huang',

        ];
        $multdata = [
            '_id'=>'123',
            'name'=>[
                'first'=>'Tim',
                'last'=>'Huang',
            ]
        ];
        $ma = new RowArray($kvdata);
        $this->assertEquals(
            $multdata,
            $ma->getMultArray($kvdata)
        );
        $ma = new RowArray($multdata);
        $this->assertEquals(
            $kvdata,
            $ma->getKvArray()
        );
    }
}
