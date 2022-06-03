<?php

namespace App\Repositories\AgentRepo\AgentRepository;

use App\Repositories\AgentRepo\AgentRepositoryInterface\AgentRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class AgentRepository extends BaseRepository implements AgentRepositoryInterface {
    public function getModel()
    {
        // TODO: Implement getModel() method.
        return \App\ModelApi\User::class;
    }

    public function getAgentActived()
    {
        // TODO: Implement getAgentActived() method.
        return $this->model->select('*')->whereNotIn('status', [6,7])->get();
    }

    public function agentRegister($data, $dataJoinTable = null)
    {
        $id = DB::table('users')->insertGetId(
            $data
        );

        $dataJoinTable['user_id'] = $id;
        $this->insertJoinTable($dataJoinTable, 'people');

        if ($id) return true;

        return  false;
    }

    public function insertJoinTable($data, $table)
    {
        DB::table('people')->insert($data);
    }


}
