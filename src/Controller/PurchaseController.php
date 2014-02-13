<?php

namespace Charger\Controller;

class PurchaseController
{
    // /customer/1434354/show
    public function purchaseAction($token)
    {
        if ($workflow->isActionValid('purchase', $token)) {
            throw new \ProcessException('never allowed');
        }

        $token->setData($request);
        $token = $repo->find($id);

        $workflow->execute('purchase', $token);

        $this->redirect($token->getLanding());
    }
}