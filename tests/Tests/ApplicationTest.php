<?php

namespace Charger\Tests;

use Charger\Workflow\SubscriberWorkflow;
use Vespolina\Workflow\Token;

class ApplicationTest extends \PHPUnit_Framework_TestCase
{
    const PROPER_CUSTOMER = 'proper customer';
    const PROSPECT_CUSTOMER = 'prospect customer';
    const SUBSCRIBER_CUSTOMER = 'subscriber customer';

    /**
     * @test
     */
    public function successful_sale()
    {
        $stimuli1 = [true, ['first' => 'luis', 'last' => 'cordova'], true];
        $stimuli2 = [true, null, false];
        $stimuli3 = [true, ['first' => 'luis', 'last' => 'cordova'], true];

        $token1 = new Token($stimuli1);
        $token2 = new Token($stimuli2);
        $token3 = new Token($stimuli3);

        $workflow = new SubscriberWorkflow();
        $workflow->execute('purchase', $token1);
        $workflow->execute('no-purchase', $token1);

        $this->assertEquals(self::PROPER_CUSTOMER, $token1->getLocation());
        $this->assertEquals('data1', $token1->getData('amount'));

        $this->assertEquals(self::PROSPECT_CUSTOMER, $token2->getLocation());
        $this->assertEquals(self::SUBSCRIBER_CUSTOMER, $token3->getLocation());

        // more actions
    }

    public function failed_sale()
    {

    }
}