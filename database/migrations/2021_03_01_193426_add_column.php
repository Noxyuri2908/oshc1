<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if (!Schema::hasColumn('users', 'username'))
        {
            Schema::table('users', function(Blueprint $table) {
                $table->string('username')->after('name');
            });
        }

        Schema::table('check_lists', function(Blueprint $table) {
            $table->text('person_id')->change();
        });

        if (!Schema::hasColumn('customers', 'exchange_rate'))
        {
            Schema::table('customers', function(Blueprint $table) {
                $table->double('exchange_rate', 8, 2)->after('destination');
            });
        }

        if (!Schema::hasColumn('customers', 'extend_fee'))
        {
            Schema::table('customers', function(Blueprint $table) {
                $table->double('extend_fee', 8, 2)->after('exchange_rate');
            });
        }

        if (!Schema::hasColumn('users', 'commission_offer'))
        {
            Schema::table('users', function(Blueprint $table) {
                $table->text('commission_offer')->nullable()->after('shares');
            });
        }

        if (!Schema::hasColumn('follows', 'create_person'))
        {
            Schema::table('follows', function(Blueprint $table) {
                $table->integer('create_person')->nullable()->after('condition_follow');
            });
        }

        if (!Schema::hasColumn('follows', 'assigned_person'))
        {
            Schema::table('follows', function(Blueprint $table) {
                $table->integer('assigned_person')->nullable()->after('create_person');
            });
        }

        if (!Schema::hasColumn('follows', 'follow_up_status'))
        {
            Schema::table('follows', function(Blueprint $table) {
                $table->integer('follow_up_status')->nullable()->after('assigned_person');
            });
        }

        if (!Schema::hasColumn('follows', 'hot_issue'))
        {
            Schema::table('follows', function(Blueprint $table) {
                $table->boolean('hot_issue')->nullable()->after('follow_up_status');
            });
        }

        if (!Schema::hasColumn('follows', 'due_date'))
        {
            Schema::table('follows', function(Blueprint $table) {
                $table->date('due_date')->nullable()->after('hot_issue');
            });
        }

        if (!Schema::hasColumn('follows', 'estimate'))
        {
            Schema::table('follows', function(Blueprint $table) {
                $table->integer('estimate')->nullable()->after('due_date');
            });
        }

        if (!Schema::hasColumn('follows', 'title_task'))
        {
            Schema::table('follows', function(Blueprint $table) {
                $table->text('title_task')->nullable()->after('estimate');
            });
        }

        if (!Schema::hasColumn('follows', 'task_description'))
        {
            Schema::table('follows', function(Blueprint $table) {
                $table->text('task_description')->nullable()->after('title_task');
            });
        }

        if (!Schema::hasColumn('sale_task_assigns', 'person_in_charge'))
        {
            Schema::table('sale_task_assigns', function(Blueprint $table) {
                $table->integer('person_in_charge')->nullable()->after('user_id');
            });
        }

        if (!Schema::hasColumn('sale_task_assigns', 'hot_issue'))
        {
            Schema::table('sale_task_assigns', function(Blueprint $table) {
                $table->boolean('hot_issue')->nullable()->after('person_in_charge');
            });
        }

        if (!Schema::hasColumn('sale_task_assigns', 'assigned_person'))
        {
            Schema::table('sale_task_assigns', function(Blueprint $table) {
                $table->integer('assigned_person')->nullable()->after('hot_issue');
            });
        }

        if (!Schema::hasColumn('sale_task_assigns', 'follow_up_status'))
        {
            Schema::table('sale_task_assigns', function(Blueprint $table) {
                $table->integer('follow_up_status')->nullable()->after('assigned_person');
            });
        }

        if (!Schema::hasColumn('sale_task_assigns', 'estimate'))
        {
            Schema::table('sale_task_assigns', function(Blueprint $table) {
                $table->integer('estimate')->nullable()->after('follow_up_status');
            });
        }

        if (!Schema::hasColumn('proposals', 'create_person'))
        {
            Schema::table('proposals', function(Blueprint $table) {
                $table->integer('create_person')->nullable()->after('proposal');
            });
        }

        if (!Schema::hasColumn('users', 'date_of_contract'))
        {
            Schema::table('users', function(Blueprint $table) {
                $table->date('date_of_contract')->nullable()->after('type_agent');
            });
        }

        if (!Schema::hasColumn('applies', 'difference'))
        {
            Schema::table('applies', function(Blueprint $table) {
                $table->float('difference', 10, 0)->nullable()->default(0)->after('total');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('users', function(Blueprint $table) {
            $table->dropColumn('username')->after('name');
        });

        Schema::table('check_lists', function(Blueprint $table) {
            $table->integer('person_id')->change();
        });

        Schema::table('customers', function(Blueprint $table) {
            $table->dropColumn('exchange_rate')->after('destination');
        });

        if (Schema::hasColumn('users', 'commission_offer'))
        {
            Schema::table('users', function(Blueprint $table) {
                $table->dropColumn('commission_offer');
            });
        }


        if (Schema::hasColumn('follows', 'create_person'))
        {
            Schema::table('follows', function(Blueprint $table) {
                $table->dropColumn('create_person')->after('condition_follow');
            });
        }

        if (Schema::hasColumn('follows', 'assigned_person'))
        {
            Schema::table('follows', function(Blueprint $table) {
                $table->dropColumn('assigned_person')->after('create_person');
            });
        }

        if (Schema::hasColumn('follows', 'follow_up_status'))
        {
            Schema::table('follows', function(Blueprint $table) {
                $table->dropColumn('follow_up_status')->after('assigned_person');
            });
        }

        if (Schema::hasColumn('follows', 'hot_issue'))
        {
            Schema::table('follows', function(Blueprint $table) {
                $table->dropColumn('hot_issue')->after('follow_up_status');
            });
        }

        if (Schema::hasColumn('follows', 'due_date'))
        {
            Schema::table('follows', function(Blueprint $table) {
                $table->dropColumn('due_date')->after('hot_issue');
            });
        }

        if (Schema::hasColumn('follows', 'estimate'))
        {
            Schema::table('follows', function(Blueprint $table) {
                $table->dropColumn('estimate')->after('due_date');
            });
        }

        if (Schema::hasColumn('follows', 'title_task'))
        {
            Schema::table('follows', function(Blueprint $table) {
                $table->dropColumn('title_task')->after('estimate');
            });
        }

        if (Schema::hasColumn('follows', 'task_description'))
        {
            Schema::table('follows', function(Blueprint $table) {
                $table->dropColumn('task_description')->after('title_task');
            });
        }


        if (Schema::hasColumn('sale_task_assigns', 'person_in_charge'))
        {
            Schema::table('sale_task_assigns', function(Blueprint $table) {
                $table->dropColumn('person_in_charge')->after('user_id');
            });
        }

        if (Schema::hasColumn('sale_task_assigns', 'hot_issue'))
        {
            Schema::table('sale_task_assigns', function(Blueprint $table) {
                $table->dropColumn('hot_issue')->after('person_in_charge');
            });
        }

        if (Schema::hasColumn('sale_task_assigns', 'assigned_person'))
        {
            Schema::table('sale_task_assigns', function(Blueprint $table) {
                $table->dropColumn('assigned_person')->after('hot_issue');
            });
        }

        if (Schema::hasColumn('sale_task_assigns', 'follow_up_status'))
        {
            Schema::table('sale_task_assigns', function(Blueprint $table) {
                $table->dropColumn('follow_up_status')->after('assigned_person');
            });
        }

        if (Schema::hasColumn('sale_task_assigns', 'estimate'))
        {
            Schema::table('sale_task_assigns', function(Blueprint $table) {
                $table->dropColumn('estimate')->after('follow_up_status');
            });
        }

        if (Schema::hasColumn('proposals', 'create_person'))
        {
            Schema::table('proposals', function(Blueprint $table) {
                $table->dropColumn('create_person')->after('proposal');
            });
        }

        if (Schema::hasColumn('users', 'date_of_contract'))
        {
            Schema::table('users', function(Blueprint $table) {
                $table->dropColumn('date_of_contract')->after('type_agent');
            });

        }

        if (Schema::hasColumn('customers', 'extend_fee'))
        {
            Schema::table('customers', function(Blueprint $table) {
                $table->dropColumn('extend_fee', 8, 2)->after('exchange_rate');
            });
        }

        if (Schema::hasColumn('applies', 'difference'))
        {
            Schema::table('applies', function(Blueprint $table) {
                $table->dropColumn('difference')->after('total');
            });
        }
    }
}
