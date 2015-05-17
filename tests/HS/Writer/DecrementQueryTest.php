<?php
/**
 * @author KonstantinKuklin <konstantin.kuklin@gmail.com>
 */

namespace HS\Tests\Writer;

use HS\Tests\TestWriterCommon;

class DecrementQueryTest extends TestWriterCommon
{
    public function testSingleDecrementByIndexId()
    {
        $writer = $this->getWriter();

        $indexId = $writer->getIndexId(
            $this->getDatabase(),
            $this->getTableName(),
            'PRIMARY',
            array('key', 'num')
        );
        $decrementQuery = $writer->decrementByIndex($indexId, '=', array(107), array(0, 2));
        $writer->getResultList();

        $decrementResult = $decrementQuery->getResult();
        self::assertTrue($decrementResult->isSuccessfully(), "Fall incrementByIndexQuery return bad status.");

        self::assertTrue(
            $decrementResult->getNumberModifiedRows() > 0,
            "Fall incrementByIndexQuery didn't modified rows."
        );

        self::assertTablesHSEqual(__METHOD__);
    }

    public function testSingleDecrement()
    {
        $writer = $this->getWriter();

        $decrementQuery = $writer->decrement(
            array('key', 'num'),
            $this->getDatabase(),
            $this->getTableName(),
            'PRIMARY',
            '=',
            array(107),
            array(0, 5)
        );
        $writer->getResultList();

        $decrementResult = $decrementQuery->getResult();
        self::assertTrue($decrementResult->isSuccessfully(), "Fall incrementQuery return bad status.");
        self::assertTrue($decrementResult->getNumberModifiedRows() > 0, "Fall incrementQuery didn't modified rows.");

        self::assertTablesHSEqual(__METHOD__);
    }
} 