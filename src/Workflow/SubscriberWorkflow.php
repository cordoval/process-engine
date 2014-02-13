<?php

namespace Charger\Workflow;

use Vespolina\Workflow\Task\Automatic;
use Vespolina\Workflow\Place;
use Vespolina\Workflow\Workflow;
use Vespolina\Workflow\Token;
use Monolog\Logger;

class SubscriberWorkflow
{
    protected $workflow;

    /**
     * @return $this
     */
    public function __construct()
    {
        $logger = new Logger('test');
        $workflow = new Workflow($logger);

        // person
        // t: lead lands
        // prospect client
        // t: information completed
        // proper client
        // t: recurring
        // subscriber
        // t: unsubscribe or cancel
        // proper client
        // create sequence
        $a = new ProspectTask();
        $p1 = new ProspectPlace();
        $b = new ProperClientTask();
        $c = new SubscriberTask();
        $p = new Place();

        $workflow->connect($workflow->getStart(), $a);
        $workflow->connect($a, $p);
        $workflow->connect($p, $b);
        $workflow->connect($b, $workflow->getFinish());

        $workflow->accept(new Token());

        return $workflow;
    }

    public function execute($step, $token)
    {
        // set conditions for $step

        // pre
        // $service->update();
        $token->setData(x(step));

        $result = $this->workflow->accept($token);

        if ($result) {
            // post fn(step)
            // $service->update();
            $token->getData(x);
            $token->setData(y);
        }
    }
}