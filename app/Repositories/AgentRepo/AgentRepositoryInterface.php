<?php
namespace App\Repositories\AgentRepo\AgentRepositoryInterface;

interface AgentRepositoryInterface
{
    public function getAgentActived();

    public function insertJoinTable($data, $table);
}
