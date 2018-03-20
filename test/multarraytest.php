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
use MultArray\MultArray;
final class MultArrayTest extends TestCase{
    public function testMultToCsv(){
        $data = [[
            '_id'=>'123',
            'name'=>[
                'first'=>'Tim',
                'last'=>'Huang',
            ]
        ]];
        $csvfile = './test.csv';
        $csv = MultArray::toCsv($data);
        file_put_contents($csvfile, $csv);
        $render_data = MultArray::fromCsv($csvfile);
        unlink($csvfile);

        $this->assertEquals(
            $data,
            $render_data
        );
        
    }
}
