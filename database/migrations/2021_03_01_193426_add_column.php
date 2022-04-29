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
        if (!Schema::hasColumn('users', 'username')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('username')->after('name');
            });
        }

//        Schema::table('check_lists', function(Blueprint $table) {
//            $table->text('person_id')->change();
//        });

        if (!Schema::hasColumn('customers', 'exchange_rate')) {
            Schema::table('customers', function (Blueprint $table) {
                $table->double('exchange_rate', 8, 2)->after('destination');
            });
        }

        if (!Schema::hasColumn('customers', 'extend_fee')) {
            Schema::table('customers', function (Blueprint $table) {
                $table->double('extend_fee', 8, 2)->after('exchange_rate');
            });
        }

        if (!Schema::hasColumn('users', 'commission_offer')) {
            Schema::table('users', function (Blueprint $table) {
                $table->text('commission_offer')->nullable()->after('shares');
            });
        }

        if (!Schema::hasColumn('follows', 'create_person')) {
            Schema::table('follows', function (Blueprint $table) {
                $table->integer('create_person')->nullable()->after('condition_follow');
            });
        }

        if (!Schema::hasColumn('follows', 'assigned_person')) {
            Schema::table('follows', function (Blueprint $table) {
                $table->integer('assigned_person')->nullable()->after('create_person');
            });
        }

        if (!Schema::hasColumn('follows', 'follow_up_status')) {
            Schema::table('follows', function (Blueprint $table) {
                $table->integer('follow_up_status')->nullable()->after('assigned_person');
            });
        }

        if (!Schema::hasColumn('follows', 'hot_issue')) {
            Schema::table('follows', function (Blueprint $table) {
                $table->boolean('hot_issue')->nullable()->after('follow_up_status');
            });
        }

        if (!Schema::hasColumn('follows', 'due_date')) {
            Schema::table('follows', function (Blueprint $table) {
                $table->date('due_date')->nullable()->after('hot_issue');
            });
        }

        if (!Schema::hasColumn('follows', 'estimate')) {
            Schema::table('follows', function (Blueprint $table) {
                $table->integer('estimate')->nullable()->after('due_date');
            });
        }

        if (!Schema::hasColumn('follows', 'title_task')) {
            Schema::table('follows', function (Blueprint $table) {
                $table->text('title_task')->nullable()->after('estimate');
            });
        }

        if (!Schema::hasColumn('follows', 'task_description')) {
            Schema::table('follows', function (Blueprint $table) {
                $table->text('task_description')->nullable()->after('title_task');
            });
        }

        if (!Schema::hasColumn('sale_task_assigns', 'person_in_charge')) {
            Schema::table('sale_task_assigns', function (Blueprint $table) {
                $table->integer('person_in_charge')->nullable()->after('user_id');
            });
        }

        if (!Schema::hasColumn('sale_task_assigns', 'hot_issue')) {
            Schema::table('sale_task_assigns', function (Blueprint $table) {
                $table->boolean('hot_issue')->nullable()->after('person_in_charge');
            });
        }

        if (!Schema::hasColumn('sale_task_assigns', 'assigned_person')) {
            Schema::table('sale_task_assigns', function (Blueprint $table) {
                $table->integer('assigned_person')->nullable()->after('hot_issue');
            });
        }

        if (!Schema::hasColumn('sale_task_assigns', 'follow_up_status')) {
            Schema::table('sale_task_assigns', function (Blueprint $table) {
                $table->integer('follow_up_status')->nullable()->after('assigned_person');
            });
        }

        if (!Schema::hasColumn('sale_task_assigns', 'estimate')) {
            Schema::table('sale_task_assigns', function (Blueprint $table) {
                $table->integer('estimate')->nullable()->after('follow_up_status');
            });
        }

        if (!Schema::hasColumn('proposals', 'create_person')) {
            Schema::table('proposals', function (Blueprint $table) {
                $table->integer('create_person')->nullable()->after('proposal');
            });
        }

        if (!Schema::hasColumn('users', 'date_of_contract')) {
            Schema::table('users', function (Blueprint $table) {
                $table->date('date_of_contract')->nullable()->after('type_agent');
            });
        }

        if (!Schema::hasColumn('applies', 'difference')) {
            Schema::table('applies', function (Blueprint $table) {
                $table->float('difference', 10, 0)->nullable()->default(0)->after('total');
            });
        }

        if (!Schema::hasColumn('profits', 'vnd')) {
            Schema::table('profits', function (Blueprint $table) {
                $table->double('vnd', 8, 2)->nullable()->default(0.00)->after('pay_agent_extra');
            });
        }

        if (!Schema::hasColumn('refunds', 'commission')) {
            Schema::table('refunds', function (Blueprint $table) {
                $table->double('commission', 8, 2)->nullable()->default(0.00)->after('refund_bank_pp');
            });
        }

        if (!Schema::hasColumn('refunds', 'extra_fee')) {
            Schema::table('refunds', function (Blueprint $table) {
                $table->double('extra_fee', 8, 2)->nullable()->default(0.00)->after('commission');
            });
        }

        if (!Schema::hasColumn('refunds', 'bank_fee')) {
            Schema::table('refunds', function (Blueprint $table) {
                $table->double('bank_fee', 8, 2)->nullable()->default(0.00)->after('extra_fee');
            });
        }

        if (!Schema::hasColumn('refunds', 'balance')) {
            Schema::table('refunds', function (Blueprint $table) {
                $table->double('balance', 8, 2)->nullable()->default(0.00)->after('bank_fee');
            });
        }

        if (!Schema::hasColumn('refunds', 'status')) {
            Schema::table('refunds', function (Blueprint $table) {
                $table->integer('status')->nullable()->after('balance');
            });
        }

        if (!Schema::hasColumn('profits', 'profit_total')) {
            Schema::table('profits', function (Blueprint $table) {
                $table->double('profit_total', 8, 2)->nullable()->default(0.00)->after('vnd');
            });
        }

        if (!Schema::hasColumn('profits', 'profit_bankfee_VND')) {
            Schema::table('profits', function (Blueprint $table) {
                $table->double('profit_bankfee_VND', 8, 2)->nullable()->default(0.00)->after('profit_total');
            });
        }

        if (!Schema::hasColumn('profits', 'gst')) {
            Schema::table('profits', function (Blueprint $table) {
                $table->double('gst', 8, 2)->nullable()->default(0.00)->after('profit_bankfee_VND');
            });
        }

        if (!Schema::hasColumn('profits', 'pay_agent_total_amount')) {
            Schema::table('profits', function (Blueprint $table) {
                $table->double('pay_agent_total_amount', 8, 2)->nullable()->default(0.00)->after('gst');
            });
        }

        if (!Schema::hasColumn('refunds', 'std_refund_VND')) {
            Schema::table('refunds', function (Blueprint $table) {
                $table->double('std_refund_VND', 8, 2)->nullable()->default(0.00)->after('status');
            });
        }

        if (!Schema::hasColumn('refunds', 'total_amount_pay_back_student_refund')) {
            Schema::table('refunds', function (Blueprint $table) {
                $table->double('total_amount_pay_back_student_refund', 8, 2)->nullable()->default(0.00)->after('std_refund_VND');
            });
        }

        if (!Schema::hasColumn('customers', 'cover_id')) {
            Schema::table('customers', function (Blueprint $table) {
                $table->integer('cover_id')->nullable()->after('provider_of_school');
            });
        }

        if (!Schema::hasColumn('marketing_material_lists', 'type')) {
            Schema::table('marketing_material_lists', function (Blueprint $table) {
                $table->integer('type')->nullable()->after('use_for');
            });
        }

        if (!Schema::hasColumn('marketing_material_lists', 'note')) {
            Schema::table('marketing_material_lists', function (Blueprint $table) {
                $table->longText('note')->nullable()->after('type');
            });
        }

        if (!Schema::hasColumn('check_lists', 'proposer')) {
            Schema::table('check_lists', function (Blueprint $table) {
                $table->integer('proposer')->nullable()->after('solution_text');
            });
        }

        if (!Schema::hasColumn('check_lists', 'file')) {
            Schema::table('check_lists', function (Blueprint $table) {
                $table->text('file')->nullable()->after('proposer');
            });
        }

        if (!Schema::hasColumn('applies', 'hospital_access')) {
            Schema::table('applies', function (Blueprint $table) {
                $table->integer('hospital_access')->nullable()->after('type_visa');
            });
        }

        if (!Schema::hasColumn('check_lists', 'created_by')) {
            Schema::table('check_lists', function (Blueprint $table) {
                $table->integer('created_by')->nullable()->after('type_id');
            });
        }

        if (!Schema::hasColumn('applies', 'hospital_id')) {
            Schema::table('applies', function (Blueprint $table) {
                $table->integer('hospital_id')->nullable()->after('type_visa');
            });
        }

        if (!Schema::hasColumn('customers', 's_live_in_AS')) {
            Schema::table('customers', function (Blueprint $table) {
                $table->integer('s_live_in_AS')->nullable()->comment('1 => yes, 0 => no')->after('type');
            });
        }

        if (!Schema::hasColumn('admins', 'role_countries')) {
            Schema::table('admins', function (Blueprint $table) {
                $table->longText('role_countries')->nullable()->after('status');
            });
        }

        if (!Schema::hasColumn('admins', 'role_department')) {
            Schema::table('admins', function (Blueprint $table) {
                $table->longText('role_department')->nullable()->after('role_countries');
            });
        }

        if (!Schema::hasColumn('users', 'gst')) {
            Schema::table('users', function (Blueprint $table) {
                $table->integer('gst')->nullable()->after('type_agent');
            });
        }

        if (!Schema::hasColumn('people', 'is_counsellor')) {
            Schema::table('people', function (Blueprint $table) {
                $table->integer('is_counsellor')->nullable()->after('bank_address');
            });
        }

        if (!Schema::hasColumn('people', 'com_counsellor')) {
            Schema::table('people', function (Blueprint $table) {
                $table->integer('com_counsellor')->nullable()->after('is_counsellor');
            });
        }

        if (!Schema::hasColumn('customers', 'person_counsellor_id')) {
            Schema::table('customers', function (Blueprint $table) {
                $table->integer('person_counsellor_id')->nullable()->after('extend_fee');
            });
        }

        if (!Schema::hasColumn('users', 'pit')) {
            Schema::table('users', function (Blueprint $table) {
                $table->integer('pit')->nullable()->after('username');
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username')->after('name');
        });

        Schema::table('check_lists', function (Blueprint $table) {
            $table->integer('person_id')->change();
        });

        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('exchange_rate')->after('destination');
        });

        if (Schema::hasColumn('users', 'commission_offer')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('commission_offer');
            });
        }


        if (Schema::hasColumn('follows', 'create_person')) {
            Schema::table('follows', function (Blueprint $table) {
                $table->dropColumn('create_person')->after('condition_follow');
            });
        }

        if (Schema::hasColumn('follows', 'assigned_person')) {
            Schema::table('follows', function (Blueprint $table) {
                $table->dropColumn('assigned_person')->after('create_person');
            });
        }

        if (Schema::hasColumn('follows', 'follow_up_status')) {
            Schema::table('follows', function (Blueprint $table) {
                $table->dropColumn('follow_up_status')->after('assigned_person');
            });
        }

        if (Schema::hasColumn('follows', 'hot_issue')) {
            Schema::table('follows', function (Blueprint $table) {
                $table->dropColumn('hot_issue')->after('follow_up_status');
            });
        }

        if (Schema::hasColumn('follows', 'due_date')) {
            Schema::table('follows', function (Blueprint $table) {
                $table->dropColumn('due_date')->after('hot_issue');
            });
        }

        if (Schema::hasColumn('follows', 'estimate')) {
            Schema::table('follows', function (Blueprint $table) {
                $table->dropColumn('estimate')->after('due_date');
            });
        }

        if (Schema::hasColumn('follows', 'title_task')) {
            Schema::table('follows', function (Blueprint $table) {
                $table->dropColumn('title_task')->after('estimate');
            });
        }

        if (Schema::hasColumn('follows', 'task_description')) {
            Schema::table('follows', function (Blueprint $table) {
                $table->dropColumn('task_description')->after('title_task');
            });
        }


        if (Schema::hasColumn('sale_task_assigns', 'person_in_charge')) {
            Schema::table('sale_task_assigns', function (Blueprint $table) {
                $table->dropColumn('person_in_charge')->after('user_id');
            });
        }

        if (Schema::hasColumn('sale_task_assigns', 'hot_issue')) {
            Schema::table('sale_task_assigns', function (Blueprint $table) {
                $table->dropColumn('hot_issue')->after('person_in_charge');
            });
        }

        if (Schema::hasColumn('sale_task_assigns', 'assigned_person')) {
            Schema::table('sale_task_assigns', function (Blueprint $table) {
                $table->dropColumn('assigned_person')->after('hot_issue');
            });
        }

        if (Schema::hasColumn('sale_task_assigns', 'follow_up_status')) {
            Schema::table('sale_task_assigns', function (Blueprint $table) {
                $table->dropColumn('follow_up_status')->after('assigned_person');
            });
        }

        if (Schema::hasColumn('sale_task_assigns', 'estimate')) {
            Schema::table('sale_task_assigns', function (Blueprint $table) {
                $table->dropColumn('estimate')->after('follow_up_status');
            });
        }

        if (Schema::hasColumn('proposals', 'create_person')) {
            Schema::table('proposals', function (Blueprint $table) {
                $table->dropColumn('create_person')->after('proposal');
            });
        }

        if (Schema::hasColumn('users', 'date_of_contract')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('date_of_contract')->after('type_agent');
            });

        }

        if (Schema::hasColumn('customers', 'extend_fee')) {
            Schema::table('customers', function (Blueprint $table) {
                $table->dropColumn('extend_fee', 8, 2)->after('exchange_rate');
            });
        }

        if (Schema::hasColumn('applies', 'difference')) {
            Schema::table('applies', function (Blueprint $table) {
                $table->dropColumn('difference')->after('total');
            });
        }

        if (Schema::hasColumn('profits', 'vnd')) {
            Schema::table('profits', function (Blueprint $table) {
                $table->dropColumn('vnd')->after('pay_agent_extra');
            });
        }

        if (Schema::hasColumn('refunds', 'commission')) {
            Schema::table('refunds', function (Blueprint $table) {
                $table->dropColumn('commission')->after('refund_bank_pp');
            });
        }

        if (Schema::hasColumn('refunds', 'extra_fee')) {
            Schema::table('refunds', function (Blueprint $table) {
                $table->dropColumn('extra_fee')->after('commission');
            });
        }

        if (Schema::hasColumn('refunds', 'bank_fee')) {
            Schema::table('refunds', function (Blueprint $table) {
                $table->dropColumn('bank_fee')->after('extra_fee');
            });
        }

        if (Schema::hasColumn('refunds', 'balance')) {
            Schema::table('refunds', function (Blueprint $table) {
                $table->dropColumn('balance')->after('bank_fee');
            });
        }

        if (Schema::hasColumn('marketing_material_lists', 'type')) {
            Schema::table('marketing_material_lists', function (Blueprint $table) {
                $table->dropColumn('type')->after('use_for');
            });
        }

        if (Schema::hasColumn('marketing_material_lists', 'note')) {
            Schema::table('marketing_material_lists', function (Blueprint $table) {
                $table->dropColumn('note')->after('type');
            });
        }

        if (Schema::hasColumn('check_lists', 'proposer')) {
            Schema::table('check_lists', function (Blueprint $table) {
                $table->dropColumn('proposer');
            });
        }

        if (Schema::hasColumn('check_lists', 'file')) {
            Schema::table('check_lists', function (Blueprint $table) {
                $table->dropColumn('file');
            });
        }

        if (Schema::hasColumn('applies', 'hospital_access')) {
            Schema::table('applies', function (Blueprint $table) {
                $table->dropColumn('hospital_access');
            });
        }

        if (Schema::hasColumn('check_lists', 'created_by')) {
            Schema::table('check_lists', function (Blueprint $table) {
                $table->dropColumn('created_by');
            });
        }

        if (Schema::hasColumn('applies', 'hospital_id')) {
            Schema::table('applies', function (Blueprint $table) {
                $table->dropColumn('hospital_id');
            });
        }

        if (Schema::hasColumn('customers', 's_live_in_AS')) {
            Schema::table('customers', function (Blueprint $table) {
                $table->dropColumn('s_live_in_AS');
            });
        }

        if (Schema::hasColumn('admins', 'role_countries')) {
            Schema::table('admins', function (Blueprint $table) {
                $table->dropColumn('role_countries');
            });
        }

        if (Schema::hasColumn('admins', 'role_department')) {
            Schema::table('admins', function (Blueprint $table) {
                $table->dropColumn('role_department');
            });
        }

        if (Schema::hasColumn('users', 'gst')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('gst');
            });
        }

        if (Schema::hasColumn('people', 'com_counsellor')) {
            Schema::table('people', function (Blueprint $table) {
                $table->dropColumn('com_counsellor');
            });
        }

        if (Schema::hasColumn('people', 'is_counsellor')) {
            Schema::table('people', function (Blueprint $table) {
                $table->dropColumn('is_counsellor');
            });
        }

        if (Schema::hasColumn('users', 'pit')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('pit');
            });
        }
    }
}
