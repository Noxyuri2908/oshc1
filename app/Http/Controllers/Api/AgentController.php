<?php

namespace App\Http\Controllers\Api;

use App\Repositories\AgentRepo\AgentRepository\AgentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class AgentController extends Controller
{
    //
    protected $AgentRepo;

    public function __construct(AgentRepository $agentRepository)
    {
        $this->AgentRepo = $agentRepository;
    }

    public function getAgent()
    {
        $agent = $this->AgentRepo->getAgentActived();

        return response()->json(['data' => $agent]);
    }

    public function registerAgent()
    {
        $messenger = array();
        $input = Input::all();
        $user = [
            'name'=> $input['name_company'],
            'username'=> $input['username'],
            'email'=> $input['email'],
            'office'=>$input['physical_add'],
            'tel_1'=> $input['phone_no'],
            'tel_2'=> $input['mobile_no'],
            'country'=> $input['country'],
            'note'=> $input['q_c'],
            'agent_code' => $input['agent_code'],
            'status'=> 7,
            'department'=> 3
        ];

        $people = [
            'name' => $input['contact_person'],
            'position' => $input['position_title']
        ];


        if ($this->AgentRepo->agentRegister($user, $people))
        {
            $messenger['status'] = 200;
            $messenger['message'] = 'User created successfully';
            $messenger['data'] = $user;

            return response()->json($messenger);
        }

        $messenger['status'] = 500;
        $messenger['message'] = 'User not created';
        return response()->json($messenger);
    }

}
