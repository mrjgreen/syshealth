<?php
class NetworkDataParserTest extends \PHPUnit_Framework_TestCase
{
    public function testItParsesOutput()
    {
$netInfo = <<<EOL
Inter-|   Receive                                                |  Transmit
 face |bytes    packets errs drop fifo frame compressed multicast|bytes    packets errs drop fifo colls carrier compressed
    lo:701626552814 1182991507    0    0    0     0          0         0 701626552814 1182991507    0    0    0     0       0          0
   em1:3126907631323 3965480785    0    0    0     0          0   1133250 1885251706598 3916290542    0    0    0     0       0          0
   em2:  389677    2495    0    0    0     0          0        28      746      11    0    0    0     0       0          0

EOL;

        $parser = new \Syshealth\System\DataParser\NetParser();

        $output = $parser->parse(trim($netInfo));

        $this->assertCount(3, $output);

        $equals = array(
            array('lo', 701626552814, 701626552814),
            array('em1', 3126907631323, 1885251706598),
            array('em2', 389677, 746),
        );

        $this->assertEquals($equals, $output);

    }
}