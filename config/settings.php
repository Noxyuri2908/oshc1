<?php

return [
    'agents' => [
        'keys' => [
            'name' => [
                'value' => 'Name',
                'isShow' => true,
                'class' => 'width-200 agent-name text-center',
                'order' => 2,
                'filter_blade' => 'CRM.elements.agents.filters.name'
            ],
            'username' => [
                'value' => '',
                'isShow' => false
            ],
            'email' => [
                'value' => 'Company email',
                'isShow' => true,
                'class' => 'width-170 agent-email text-center',
                'order' => 17,
                'filter_blade' => 'CRM.elements.agents.filters.company-email'
            ],
            'email_verified_at' => [
                'value' => 'Name',
                'isShow' => false
            ],
            'password' => [
                'value' => 'Name',
                'isShow' => false
            ],
            'created_by' => [
                'value' => 'Name',
                'isShow' => false
            ],
            'status' => [
                'value' => 'Status',
                'isShow' => true,
                'class' => 'width-100 agent-status text-center',
                'order' => 4,
                'filter_blade' => 'CRM.elements.agents.filters.status'
            ],
            'staff_id' => [
                'value' => 'Name',
                'isShow' => false
            ],
            'shares' => [
                'value' => 'Name',
                'isShow' => false
            ],
            'commission_offer' => [
                'value' => 'Com',
                'isShow' => true,
                'class' => 'width-50 agent-comm text-center' ,
                'order' => 9,
                'filter_blade' => 'CRM.elements.agents.filters.comm'
            ],
            'remember_token' => [
                'value' => 'Name',
                'isShow' => false
            ],
            'created_at' => [
                'value' => 'Creation date',
                'isShow' => true,
                'class' => 'width-100 agent-creation text-center',
                'order' => 13,
                'filter_blade' => 'CRM.elements.agents.filters.creation-date'
            ],
            'updated_at' => [
                'value' => 'Name',
                'isShow' => false
            ],
            'is_default' => [
                'value' => 'Name',
                'isShow' => false
            ],
            'had_case' => [
                'value' => 'Name',
                'isShow' => false
            ],
            'first_case_date' => [
                'value' => 'Name',
                'isShow' => false
            ],
            'note1' => [
                'value' => 'Note 1',
                'isShow' => true,
                'class' => 'width-250 agent-note-1 text-center',
                'order' => 14,
                'filter_blade' => 'CRM.elements.agents.filters.note-1'
            ],
            'note2' => [
                'value' => 'Note 2',
                'isShow' => true,
                'class' => 'width-250 agent-note-2 text-center',
                'order' => 15,
                'filter_blade' => 'CRM.elements.agents.filters.note-2'
            ],
            'potential_service' => [
                'value' => 'Service',
                'isShow' => true,
                'class' => 'width-170 agent-service text-center',
                'order' => 6,
                'filter_blade' => 'CRM.elements.agents.filters.service'
            ],
            'registered_date' => [
                'value' => 'Registered date',
                'isShow' => false,
                'class' => 'width-100 agent-registered text-center',
                'filter_blade' => 'CRM.elements.agents.filters.registered-date'
            ],
            'agent_code' => [
                'value' => 'Code',
                'isShow' => true,
                'class' => 'width-80 agent-code text-center',
                'order' => 10,
                'filter_blade' => 'CRM.elements.agents.filters.code'
            ],
            'rating' => [
                'value' => 'Rating',
                'isShow' => true,
                'class' => 'width-50 agent-rating text-center',
                'order' => 7,
                'filter_blade' => 'CRM.elements.agents.filters.rating'
            ],
            'country' => [
                'value' => 'Country',
                'isShow' => true,
                'class' => 'width-100 agent-country text-center',
                'order' => 3,
                'filter_blade' => 'CRM.elements.agents.filters.country'
            ],
            'city' => [
                'value' => 'City',
                'isShow' => true,
                'class' => 'width-100 agent-city text-center',
                'order' => 21,
                'filter_blade' => 'CRM.elements.agents.filters.city'
            ],
            'office' => [
                'value' => 'Department / Office',
                'isShow' => true,
                'class' => 'width-170 agent-office text-center',
                'order' => 22,
                'filter_blade' => 'CRM.elements.agents.filters.department-office'
            ],
            'department' => [
                'value' => 'Branch',
                'isShow' => true,
                'class' => 'width-80 agent-branch text-center',
                'order' => 1,
                'filter_blade' => 'CRM.elements.agents.filters.branch'
            ],
            'type_id' => [
                'value' => 'Type of agent',
                'isShow' => true,
                'class' => 'width-120 agent-type-of-agent text-center',
                'order' => 16,
                'filter_blade' => 'CRM.elements.agents.filters.type-of-agent'
            ],
            'market_id' => [
                'value' => 'Market',
                'isShow' => true,
                'class' => 'width-150 agent-market text-center',
                'order' => 5,
                'filter_blade' => 'CRM.elements.agents.filters.market'
            ],
            'tel_1' => [
                'value' => 'Tel 1',
                'isShow' => true,
                'class' => 'width-170 agent-tel-1 text-center',
                'order' => 18,
                'filter_blade' => 'CRM.elements.agents.filters.tel-1'
            ],
            'tel_2' => [
                'value' => 'Tel 2',
                'isShow' => true,
                'class' => 'width-170 agent-tel-2 text-center',
                'order' => 19,
                'filter_blade' => 'CRM.elements.agents.filters.tel-2'
            ],
            'fb' => [
                'value' => 'Name',
                'isShow' => false
            ],
            'website' => [
                'value' => 'Website',
                'isShow' => true,
                'class' => 'width-170 agent-website text-center',
                'order' => 20,
                'filter_blade' => 'CRM.elements.agents.filters.website'
            ],
            'person_in_charge' => [
                'value' => 'PC',
                'isShow' => true,
                'class' => 'width-80 agent-pc text-center',
                'order' => 11,
                'filter_blade' => 'CRM.elements.agents.filters.person-in-charge'
            ],
            'contact_person' => [
                'value' => 'Contact',
                'isShow' => true,
                'class' => 'width-50 agent-contact text-center',
                'order' => 8,
                'filter_blade' => 'CRM.elements.agents.filters.contact'
            ],
            'note' => [
                'value' => 'Name',
                'isShow' => false
            ],
            'type' => [
                'value' => 'Name',
                'isShow' => false
            ],
            'type_agent' => [
                'value' => 'Name',
                'isShow' => false
            ],
            'date_of_contract' => [
                'value' => 'Date of contract',
                'isShow' => true,
                'class' => 'width-100 date-of-contract text-center',
                'order' => 12,
                'filter_blade' => 'CRM.elements.agents.filters.date-of-contract'
            ],
        ]
    ],
    'follows_up' => [
        'keys' => [
            'user_id' => [
                'value' => 'Agent',
                'isShow' => true,
                'class' => 'width-220 follow_agent text-center',
                'order' => 1,
                'filter_blade' => 'CRM.elements.task.sale.table.follow_up_agent.filters.agent'
            ],
            'process_date' => [
                'value' => 'Processing date',
                'isShow' => true,
                'class' => 'width-180 follow_processing_date text-center',
                'order' => 3,
                'filter_blade' => 'CRM.elements.task.sale.table.follow_up_agent.filters.processing-date'
            ],
            'status' => [
                'value' => 'Status',
                'isShow' => true,
                'class' => 'width-110 follow_status text-center',
                'order' => 14,
                'filter_blade' => 'CRM.elements.task.sale.table.follow_up_agent.filters.status'
            ],
            'rating' => [
                'value' => 'Rating',
                'isShow' => true,
                'class' => 'width-80 follow_rating text-center',
                'order' => 16,
                'filter_blade' => 'CRM.elements.task.sale.table.follow_up_agent.filters.rating'
            ],
            'contact_by' => [
                'value' => 'Contact by',
                'isShow' => true,
                'class' => 'width-120 follow_contact_by	text-center',
                'order' => 4,
                'filter_blade' => 'CRM.elements.task.sale.table.follow_up_agent.filters.contact-by'
            ],
            'des' => [
                'value' => 'FLU Description',
                'isShow' => true,
                'class' => 'width-300 follow_description text-center',
                'order' => 5,
                'filter_blade' => 'CRM.elements.task.sale.table.follow_up_agent.filters.task-description'
            ],
            'type' => [
                'isShow' => false,
            ],
            'person_in_charge' => [
                'value' => 'PC',
                'isShow' => true,
                'class' => 'width-100 follow_pc text-center',
                'order' => 2,
                'filter_blade' => 'CRM.elements.task.sale.table.follow_up_agent.filters.person-in-charge'
            ],
            'created_at' => [
                'isShow' => false,
            ],
            'updated_at' => [
                'isShow' => false,
            ],
            'potential_service' => [
                'value' => 'Potential Service',
                'isShow' => true,
                'class' => 'width-150 follow_potential_service text-center',
                'order' => 15,
                'filter_blade' => 'CRM.elements.task.sale.table.follow_up_agent.filters.service'
            ],
            'condition_follow' => [
                'isShow' => false,
            ],
            'create_person' => [
                'value' => 'Created by',
                'isShow' => true,
                'class' => 'width-80 follow_create_person text-center',
                'order' => 8,
                'filter_blade' => 'CRM.elements.task.sale.table.follow_up_agent.filters.create-person'
            ],
            'assigned_person' => [
                'value' => 'Assignee',
                'isShow' => true,
                'class' => 'width-100 follow_assigned_person text-center',
                'order' => 9,
                'filter_blade' => 'CRM.elements.task.sale.table.follow_up_agent.filters.assignee-person'
            ],
            'follow_up_status' => [
                'value' => 'FLU status',
                'isShow' => true,
                'class' => 'width-140 follow_status text-center',
                'order' => 6,
                'filter_blade' => 'CRM.elements.task.sale.table.follow_up_agent.filters.flu-status'
            ],
            'hot_issue' => [
                'value' => 'Hot issue',
                'isShow' => true,
                'class' => 'width-80 follow_hot_issue text-center',
                'order' => 7,
                'filter_blade' => 'CRM.elements.task.sale.table.follow_up_agent.filters.hot-issue'
            ],
            'due_date' => [
                'value' => 'Due date',
                'isShow' => true,
                'class' => 'width-120 follow_due_date text-center',
                'order' => 12,
                'filter_blade' => 'CRM.elements.task.sale.table.follow_up_agent.filters.due-date'
            ],
            'estimate' => [
                'value' => 'Time estimate',
                'isShow' => true,
                'class' => 'width-110 follow_time_estimate text-center',
                'order' => 13,
                'filter_blade' => 'CRM.elements.task.sale.table.follow_up_agent.filters.time-estimate'
            ],
            'title_task' => [
                'value' => 'Task',
                'isShow' => true,
                'class' => 'width-170 follow_title_task text-center',
                'order' => 10,
                'filter_blade' => 'CRM.elements.task.sale.table.follow_up_agent.filters.title-task'
            ],
            'task_description' => [
                'value' => 'Task description',
                'isShow' => true,
                'class' => 'width-200 follow_task_description text-center',
                'order' => 11,
                'filter_blade' => 'CRM.elements.task.sale.table.follow_up_agent.filters.task-description'
            ]
        ]
    ],
    'profit' => [
        'keys' => [
            'user_id' => [
                'value' => 'Agent',
                'isShow' => true,
                'class' => 'width-220 follow_agent text-center',
                'order' => 1,
                'filter_blade' => 'CRM.elements.task.sale.table.follow_up_agent.filters.agent'
            ],
        ]
    ]

];
