<?php

namespace \Hector\Db\Contract;

interface ConnectionManagerInterface
{
    public function get($name = ''): \Hector\Db\Connector\ConnectorInterface;
}
