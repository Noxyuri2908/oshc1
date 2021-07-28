<?php

use Illuminate\Database\Seeder;

class QasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('qas')->delete();
        
        \DB::table('qas')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'What is OSHC?',
            'content' => '<p>Overseas Student Health Cover (OSHC) helps you pay for hospital and medical services which you may need while studying in Australia.</p>',
                'name_cn' => 'What is OSHC?',
                'name_vi' => 'What is OSHC?',
            'content_cn' => '<p>Overseas Student Health Cover (OSHC) helps you pay for hospital and medical services which you may need while studying in Australia.</p>',
            'content_vi' => '<p>Overseas Student Health Cover (OSHC) helps you pay for hospital and medical services which you may need while studying in Australia.</p>',
                'area_id' => 1,
                'status' => 1,
                'created_at' => '2019-08-27 07:48:21',
                'updated_at' => '2019-10-07 07:57:58',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Why do I need OSHC?',
                'content' => '<p>As an overseas student, it is a requirement of your overseas student visa that you have OSHC when you apply for your visa and then keep it for the entire duration of your stay in Australia under the student visa.</p>',
                'name_cn' => 'Why do I need OSHC?',
                'name_vi' => 'Why do I need OSHC?',
                'content_cn' => '<p>As an overseas student, it is a requirement of your overseas student visa that you have OSHC when you apply for your visa and then keep it for the entire duration of your stay in Australia under the student visa.</p>',
                'content_vi' => '<p>As an overseas student, it is a requirement of your overseas student visa that you have OSHC when you apply for your visa and then keep it for the entire duration of your stay in Australia under the student visa.</p>',
                'area_id' => 1,
                'status' => 1,
                'created_at' => '2019-08-27 07:51:35',
                'updated_at' => '2019-10-07 07:58:38',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'What if I have a family or dependants?',
                'content' => '<p>They will not be covered under your singles policy. You should take out an OSHC family policy to cover your spouse or de-facto partner or any child or step child who is unmarried and under the age of 18. We also have Extras cover for families.</p>',
                'name_cn' => 'What if I have a family or dependants?',
                'name_vi' => 'What if I have a family or dependants?',
                'content_cn' => '<p>They will not be covered under your singles policy. You should take out an OSHC family policy to cover your spouse or de-facto partner or any child or step child who is unmarried and under the age of 18. We also have Extras cover for families.</p>',
                'content_vi' => '<p>They will not be covered under your singles policy. You should take out an OSHC family policy to cover your spouse or de-facto partner or any child or step child who is unmarried and under the age of 18. We also have Extras cover for families.</p>',
                'area_id' => 1,
                'status' => 1,
                'created_at' => '2019-08-27 07:52:50',
                'updated_at' => '2019-10-07 07:59:14',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'What am I covered for by OSHC?',
                'content' => '<p>Your OSHC provider pays for the following services but please remember it is important that you should contact your provider prior to any major treatments, especially staying in the hospital.</p>

<p><strong>Doctors:</strong>&nbsp;100% of the Medicare Benefits Schedule fee (MBS Fee) for General Practitioners&rsquo; standard consultations (doctors may charge above the MBS Fee) and 85% of the MBS Fee for other out-of-hospital services.</p>

<p><strong>Hospitals</strong>:&nbsp;Including accommodation, operating theatre, day services, emergency and accident services, outpatient medical and post operative services.</p>

<p><strong>Prescription Medicines</strong>:&nbsp;You pay a set amount towards the cost (PBS amount) and your provider pays the rest, up to a maximum of $50 per item to a maximum of $300 for a single membership ($600 family). As an overseas student, you may face significant out of pocket costs if you need treatment with &ldquo;high cost&rdquo; pharmaceuticals, particularly oncology (cancer) treatment.</p>

<p><strong>Pathology and X-rays</strong>: 85% of the MBS Fee for out-of-hospital services or 100% of the MBS Fee for in-hospital services.</p>

<p><strong>Emergency ambulance transport</strong>: Your provider covers 100% of the cost of emergency transportation in an ambulance.</p>

<p><strong>Prosthetic devices</strong>: Your provider covers the full cost of any No Gap prostheses and the minimum benefit for Gap permitted prostheses. Surgically implanted prostheses could include, for example, stents for coronary arteries, artificial hips/knees or titanium plates/screws for reconstructions &amp; bone breaks.</p>

<p><em>Important</em>: Waiting periods apply for pre-existing conditions. That is, an ailment, illness or condition which either you or one of your dependants have, the signs or symptoms of which, in the opinion of a Medical Practitioner appointed by your provider, existed at any time in the 6 month period before you or your dependant arrived in Australia. For pre-existing medical conditions and pregnancy related services including childbirth there is a waiting period of 12 months. That means you won&rsquo;t be covered for these conditions until the waiting period is over. For a pre-existing condition of a psychiatric nature, there is a waiting period of 2 months.</p>',
                'name_cn' => 'What am I covered for by OSHC?',
                'name_vi' => 'What am I covered for by OSHC?',
                'content_cn' => '<p>Your OSHC provider pays for the following services but please remember it is important that you should contact your provider prior to any major treatments, especially staying in the hospital.</p>

<p><strong>Doctors:</strong>&nbsp;100% of the Medicare Benefits Schedule fee (MBS Fee) for General Practitioners&rsquo; standard consultations (doctors may charge above the MBS Fee) and 85% of the MBS Fee for other out-of-hospital services.</p>

<p><strong>Hospitals</strong>:&nbsp;Including accommodation, operating theatre, day services, emergency and accident services, outpatient medical and post operative services.</p>

<p><strong>Prescription Medicines</strong>:&nbsp;You pay a set amount towards the cost (PBS amount) and your provider pays the rest, up to a maximum of $50 per item to a maximum of $300 for a single membership ($600 family). As an overseas student, you may face significant out of pocket costs if you need treatment with &ldquo;high cost&rdquo; pharmaceuticals, particularly oncology (cancer) treatment.</p>

<p><strong>Pathology and X-rays</strong>: 85% of the MBS Fee for out-of-hospital services or 100% of the MBS Fee for in-hospital services.</p>

<p><strong>Emergency ambulance transport</strong>: Your provider covers 100% of the cost of emergency transportation in an ambulance.</p>

<p><strong>Prosthetic devices</strong>: Your provider covers the full cost of any No Gap prostheses and the minimum benefit for Gap permitted prostheses. Surgically implanted prostheses could include, for example, stents for coronary arteries, artificial hips/knees or titanium plates/screws for reconstructions &amp; bone breaks.</p>

<p><em>Important</em>: Waiting periods apply for pre-existing conditions. That is, an ailment, illness or condition which either you or one of your dependants have, the signs or symptoms of which, in the opinion of a Medical Practitioner appointed by your provider, existed at any time in the 6 month period before you or your dependant arrived in Australia. For pre-existing medical conditions and pregnancy related services including childbirth there is a waiting period of 12 months. That means you won&rsquo;t be covered for these conditions until the waiting period is over. For a pre-existing condition of a psychiatric nature, there is a waiting period of 2 months.</p>',
                'content_vi' => '<p>Your OSHC provider pays for the following services but please remember it is important that you should contact your provider prior to any major treatments, especially staying in the hospital.</p>

<p><strong>Doctors:</strong>&nbsp;100% of the Medicare Benefits Schedule fee (MBS Fee) for General Practitioners&rsquo; standard consultations (doctors may charge above the MBS Fee) and 85% of the MBS Fee for other out-of-hospital services.</p>

<p><strong>Hospitals</strong>:&nbsp;Including accommodation, operating theatre, day services, emergency and accident services, outpatient medical and post operative services.</p>

<p><strong>Prescription Medicines</strong>:&nbsp;You pay a set amount towards the cost (PBS amount) and your provider pays the rest, up to a maximum of $50 per item to a maximum of $300 for a single membership ($600 family). As an overseas student, you may face significant out of pocket costs if you need treatment with &ldquo;high cost&rdquo; pharmaceuticals, particularly oncology (cancer) treatment.</p>

<p><strong>Pathology and X-rays</strong>: 85% of the MBS Fee for out-of-hospital services or 100% of the MBS Fee for in-hospital services.</p>

<p><strong>Emergency ambulance transport</strong>: Your provider covers 100% of the cost of emergency transportation in an ambulance.</p>

<p><strong>Prosthetic devices</strong>: Your provider covers the full cost of any No Gap prostheses and the minimum benefit for Gap permitted prostheses. Surgically implanted prostheses could include, for example, stents for coronary arteries, artificial hips/knees or titanium plates/screws for reconstructions &amp; bone breaks.</p>

<p><em>Important</em>: Waiting periods apply for pre-existing conditions. That is, an ailment, illness or condition which either you or one of your dependants have, the signs or symptoms of which, in the opinion of a Medical Practitioner appointed by your provider, existed at any time in the 6 month period before you or your dependant arrived in Australia. For pre-existing medical conditions and pregnancy related services including childbirth there is a waiting period of 12 months. That means you won&rsquo;t be covered for these conditions until the waiting period is over. For a pre-existing condition of a psychiatric nature, there is a waiting period of 2 months.</p>',
                'area_id' => 1,
                'status' => 1,
                'created_at' => '2019-08-27 07:53:55',
                'updated_at' => '2019-10-07 08:01:43',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'What if I have a pre-existing condition?',
            'content' => '<p>You or one of your dependants has a pre-existing condition if the signs or symptoms of the ailment, illness or condition you have (in the opinion of a Medical Practitioner appointed by your provider) existed at any time in the 6 month period before you or your dependant arrived in Australia on a student visa. For pre-existing medical conditions and pregnancy related services including childbirth there is a waiting period of 12 months. That means you won&rsquo;t be covered for these conditions until the waiting period is over. For a pre-existing condition of a psychiatric nature, there is waiting period of 2 months.</p>',
                'name_cn' => 'What if I have a pre-existing condition?',
                'name_vi' => 'What if I have a pre-existing condition?',
            'content_cn' => '<p>You or one of your dependants has a pre-existing condition if the signs or symptoms of the ailment, illness or condition you have (in the opinion of a Medical Practitioner appointed by your provider) existed at any time in the 6 month period before you or your dependant arrived in Australia on a student visa. For pre-existing medical conditions and pregnancy related services including childbirth there is a waiting period of 12 months. That means you won&rsquo;t be covered for these conditions until the waiting period is over. For a pre-existing condition of a psychiatric nature, there is waiting period of 2 months.</p>',
            'content_vi' => '<p>You or one of your dependants has a pre-existing condition if the signs or symptoms of the ailment, illness or condition you have (in the opinion of a Medical Practitioner appointed by your provider) existed at any time in the 6 month period before you or your dependant arrived in Australia on a student visa. For pre-existing medical conditions and pregnancy related services including childbirth there is a waiting period of 12 months. That means you won&rsquo;t be covered for these conditions until the waiting period is over. For a pre-existing condition of a psychiatric nature, there is waiting period of 2 months.</p>',
                'area_id' => 1,
                'status' => 1,
                'created_at' => '2019-10-07 08:09:22',
                'updated_at' => '2019-10-07 08:09:22',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'What is direct billing?',
            'content' => '<p>Direct billing is when you visit your General Practitioner (GP) and your GP charges you the MBS Fee. Some doctors have arrangements with OSHC provider to bill directly for the full MBS amount so you won&rsquo;t have any out-of-pocket expenses. Not all GPs direct bill.</p>',
                'name_cn' => 'What is direct billing?',
                'name_vi' => 'What is direct billing?',
            'content_cn' => '<p>Direct billing is when you visit your General Practitioner (GP) and your GP charges you the MBS Fee. Some doctors have arrangements with OSHC provider to bill directly for the full MBS amount so you won&rsquo;t have any out-of-pocket expenses. Not all GPs direct bill.</p>',
            'content_vi' => '<p>Direct billing is when you visit your General Practitioner (GP) and your GP charges you the MBS Fee. Some doctors have arrangements with OSHC provider to bill directly for the full MBS amount so you won&rsquo;t have any out-of-pocket expenses. Not all GPs direct bill.</p>',
                'area_id' => 1,
                'status' => 1,
                'created_at' => '2019-10-07 08:10:09',
                'updated_at' => '2019-10-07 08:10:09',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Will OSHC cover me when I travel overseas or if I’m on holiday?',
                'content' => '<p>OSHC only covers you while you are in Australia. If you travel outside of Australia you&rsquo;ll need to take out Travel Insurance &ndash; offers &ldquo;Cover-More&rdquo;</p>',
                'name_cn' => 'Will OSHC cover me when I travel overseas or if I’m on holiday?',
                'name_vi' => 'Will OSHC cover me when I travel overseas or if I’m on holiday?',
                'content_cn' => '<p>OSHC only covers you while you are in Australia. If you travel outside of Australia you&rsquo;ll need to take out Travel Insurance &ndash; offers &ldquo;Cover-More&rdquo;</p>',
                'content_vi' => '<p>OSHC only covers you while you are in Australia. If you travel outside of Australia you&rsquo;ll need to take out Travel Insurance &ndash; offers &ldquo;Cover-More&rdquo;</p>',
                'area_id' => 1,
                'status' => 1,
                'created_at' => '2019-10-07 08:10:35',
                'updated_at' => '2019-10-07 08:10:35',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'What about cover for dental care and prescription glasses?',
                'content' => '<p>You can purchase more cover to have benefits for a range of other services such as dental services, prescription glasses, physiotherapy and chiropractic. Please remember that this cover doesn&rsquo;t satisfy your visa requirement and can only be purchased in addition to OSHC. Some waiting periods will apply.</p>',
                'name_cn' => 'What about cover for dental care and prescription glasses?',
                'name_vi' => 'What about cover for dental care and prescription glasses?',
                'content_cn' => '<p>You can purchase more cover to have benefits for a range of other services such as dental services, prescription glasses, physiotherapy and chiropractic. Please remember that this cover doesn&rsquo;t satisfy your visa requirement and can only be purchased in addition to OSHC. Some waiting periods will apply.</p>',
                'content_vi' => '<p>You can purchase more cover to have benefits for a range of other services such as dental services, prescription glasses, physiotherapy and chiropractic. Please remember that this cover doesn&rsquo;t satisfy your visa requirement and can only be purchased in addition to OSHC. Some waiting periods will apply.</p>',
                'area_id' => 1,
                'status' => 1,
                'created_at' => '2019-10-07 08:11:05',
                'updated_at' => '2019-10-07 08:11:05',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Am I covered once I finish studying?',
            'content' => '<p>OSHC covers you for the duration of your student visa. If you plan to stay in Australia after your student visa expires, you&rsquo;ll need to apply for another visa that is specific to your future needs. Visit&nbsp;<a href="http://www.immi.gov.au/">www.immi.gov.au</a>&nbsp;for more information. If you obtain a different visa (eg an overseas visitor visa, a working visa) you will need to organise different health insurance, as OSHC can only cover you while you are on a student visa.</p>',
                'name_cn' => 'Am I covered once I finish studying?',
                'name_vi' => 'Am I covered once I finish studying?',
            'content_cn' => '<p>OSHC covers you for the duration of your student visa. If you plan to stay in Australia after your student visa expires, you&rsquo;ll need to apply for another visa that is specific to your future needs. Visit&nbsp;<a href="http://www.immi.gov.au/">www.immi.gov.au</a>&nbsp;for more information. If you obtain a different visa (eg an overseas visitor visa, a working visa) you will need to organise different health insurance, as OSHC can only cover you while you are on a student visa.</p>',
            'content_vi' => '<p>OSHC covers you for the duration of your student visa. If you plan to stay in Australia after your student visa expires, you&rsquo;ll need to apply for another visa that is specific to your future needs. Visit&nbsp;<a href="http://www.immi.gov.au/">www.immi.gov.au</a>&nbsp;for more information. If you obtain a different visa (eg an overseas visitor visa, a working visa) you will need to organise different health insurance, as OSHC can only cover you while you are on a student visa.</p>',
                'area_id' => 1,
                'status' => 1,
                'created_at' => '2019-10-07 08:11:32',
                'updated_at' => '2019-10-07 08:11:32',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'What happens if I don’t keep my OSHC current?',
                'content' => '<p>The Department of Immigration &amp; Boarder Protection&nbsp;requires holders of a student visa to maintain OSHC for their entire stay in Australia. If you allow your cover to lapse, you will be in breach of your visa conditions. You&rsquo;ll also need to renew your OSHC and have to back-pay for any period that you were not covered by OSHC. In addition, you are not entitled to receive benefits for periods when you were not covered by OSHC even if you re-activate your policy and backdate your payments for that period. This may also result in you having to pay very significant hospital, medical or other costs yourself.</p>',
                'name_cn' => 'What happens if I don’t keep my OSHC current?',
                'name_vi' => 'What happens if I don’t keep my OSHC current?',
                'content_cn' => '<p>The Department of Immigration &amp; Boarder Protection&nbsp;requires holders of a student visa to maintain OSHC for their entire stay in Australia. If you allow your cover to lapse, you will be in breach of your visa conditions. You&rsquo;ll also need to renew your OSHC and have to back-pay for any period that you were not covered by OSHC. In addition, you are not entitled to receive benefits for periods when you were not covered by OSHC even if you re-activate your policy and backdate your payments for that period. This may also result in you having to pay very significant hospital, medical or other costs yourself.</p>',
                'content_vi' => '<p>The Department of Immigration &amp; Boarder Protection&nbsp;requires holders of a student visa to maintain OSHC for their entire stay in Australia. If you allow your cover to lapse, you will be in breach of your visa conditions. You&rsquo;ll also need to renew your OSHC and have to back-pay for any period that you were not covered by OSHC. In addition, you are not entitled to receive benefits for periods when you were not covered by OSHC even if you re-activate your policy and backdate your payments for that period. This may also result in you having to pay very significant hospital, medical or other costs yourself.</p>',
                'area_id' => 1,
                'status' => 1,
                'created_at' => '2019-10-07 08:12:01',
                'updated_at' => '2019-10-07 08:12:01',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'What do I do if I get sick?',
            'content' => '<p>Many minor illnesses can be treated with medicine from a pharmacy. However, if you&rsquo;re sick your first stop should be a visit to a family doctor (called a GP or General Practitioner) &ndash; the GP will then advise you on what you need to do next.</p>',
                'name_cn' => 'What do I do if I get sick?',
                'name_vi' => 'What do I do if I get sick?',
            'content_cn' => '<p>Many minor illnesses can be treated with medicine from a pharmacy. However, if you&rsquo;re sick your first stop should be a visit to a family doctor (called a GP or General Practitioner) &ndash; the GP will then advise you on what you need to do next.</p>',
            'content_vi' => '<p>Many minor illnesses can be treated with medicine from a pharmacy. However, if you&rsquo;re sick your first stop should be a visit to a family doctor (called a GP or General Practitioner) &ndash; the GP will then advise you on what you need to do next.</p>',
                'area_id' => 1,
                'status' => 1,
                'created_at' => '2019-10-07 08:12:29',
                'updated_at' => '2019-10-07 08:12:29',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'When should I go?',
            'content' => '<p>Go to the GP for minor medical issues (such as stomach ache, sneezing, coughing, fever, a skin rash, diarrhoea). The GP can provide you with advice and a prescription for medication to treat your illness. The GP can also refer you for an x-ray or blood tests or to a specialist doctor if this is necessary.</p>',
                'name_cn' => 'When should I go?',
                'name_vi' => 'When should I go?',
            'content_cn' => '<p>Go to the GP for minor medical issues (such as stomach ache, sneezing, coughing, fever, a skin rash, diarrhoea). The GP can provide you with advice and a prescription for medication to treat your illness. The GP can also refer you for an x-ray or blood tests or to a specialist doctor if this is necessary.</p>',
            'content_vi' => '<p>Go to the GP for minor medical issues (such as stomach ache, sneezing, coughing, fever, a skin rash, diarrhoea). The GP can provide you with advice and a prescription for medication to treat your illness. The GP can also refer you for an x-ray or blood tests or to a specialist doctor if this is necessary.</p>',
                'area_id' => 1,
                'status' => 1,
                'created_at' => '2019-10-07 08:15:36',
                'updated_at' => '2019-10-07 08:15:36',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'What is a Hospital?',
            'content' => '<p>In Australia there are public hospitals (owned and run by the government) and private hospitals. We have partnerships with some private hospitals. You can choose where you wish to have your medical treatment.</p>',
                'name_cn' => 'What is a Hospital?',
                'name_vi' => 'What is a Hospital?',
            'content_cn' => '<p>In Australia there are public hospitals (owned and run by the government) and private hospitals. We have partnerships with some private hospitals. You can choose where you wish to have your medical treatment.</p>',
            'content_vi' => '<p>In Australia there are public hospitals (owned and run by the government) and private hospitals. We have partnerships with some private hospitals. You can choose where you wish to have your medical treatment.</p>',
                'area_id' => 1,
                'status' => 1,
                'created_at' => '2019-10-07 08:16:08',
                'updated_at' => '2019-10-07 08:16:08',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'When should I go?',
                'content' => '<p>Hospitals are used for medical emergencies and for operations.</p>

<p>If you go to hospital for a minor issue, you&rsquo;ll wait a long time before seeing the doctor.</p>',
                'name_cn' => 'When should I go?',
                'name_vi' => 'When should I go?',
                'content_cn' => '<p>Hospitals are used for medical emergencies and for operations.</p>

<p>If you go to hospital for a minor issue, you&rsquo;ll wait a long time before seeing the doctor.</p>',
                'content_vi' => '<p>Hospitals are used for medical emergencies and for operations.</p>

<p>If you go to hospital for a minor issue, you&rsquo;ll wait a long time before seeing the doctor.</p>',
                'area_id' => 1,
                'status' => 1,
                'created_at' => '2019-10-07 08:18:13',
                'updated_at' => '2019-10-07 08:18:13',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'What is a pharmacy?',
                'content' => '<p>The pharmacy is a place that sells medicines and other health-related items. Some of these medicines are only available when prescribed by a doctor.</p>

<p>Pharmacist can often give you advice on minor illnesses and give you non-prescription medicines to</p>',
                'name_cn' => 'What is a pharmacy?',
                'name_vi' => 'What is a pharmacy?',
                'content_cn' => '<p>The pharmacy is a place that sells medicines and other health-related items. Some of these medicines are only available when prescribed by a doctor.</p>

<p>Pharmacist can often give you advice on minor illnesses and give you non-prescription medicines to</p>',
                'content_vi' => '<p>The pharmacy is a place that sells medicines and other health-related items. Some of these medicines are only available when prescribed by a doctor.</p>

<p>Pharmacist can often give you advice on minor illnesses and give you non-prescription medicines to</p>',
                'area_id' => 1,
                'status' => 1,
                'created_at' => '2019-10-07 08:18:33',
                'updated_at' => '2019-10-07 08:18:33',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'When should I go?',
                'content' => '<p>If your doctor gives you a prescription for medicine, the pharmacy is where you need to go to get it.</p>

<p>Pharmacists can give you medicines for some minor illnesses like headache, fever, coughs and sneezes without a prescription.</p>

<p>You can also buy bandages, vitamins and other health-related items at the pharmacy.</p>',
                'name_cn' => 'When should I go?',
                'name_vi' => 'When should I go?',
                'content_cn' => '<p>If your doctor gives you a prescription for medicine, the pharmacy is where you need to go to get it.</p>

<p>Pharmacists can give you medicines for some minor illnesses like headache, fever, coughs and sneezes without a prescription.</p>

<p>You can also buy bandages, vitamins and other health-related items at the pharmacy.</p>',
                'content_vi' => '<p>If your doctor gives you a prescription for medicine, the pharmacy is where you need to go to get it.</p>

<p>Pharmacists can give you medicines for some minor illnesses like headache, fever, coughs and sneezes without a prescription.</p>

<p>You can also buy bandages, vitamins and other health-related items at the pharmacy.</p>',
                'area_id' => 1,
                'status' => 1,
                'created_at' => '2019-10-07 08:18:59',
                'updated_at' => '2019-10-07 08:18:59',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Claim form OSHC Providers',
                'content' => '<p><a href="https://oshcstudents.com.au/wp-content/uploads/2016/01/Allianz-OSHC-claim-form.pdf" target="_blank">ALLIANZ OSHC</a><br />
<a href="https://oshcstudents.com.au/wp-content/uploads/2016/01/AHM-OSHC-claim-form.pdf" target="_blank">AHM OSHC</a><br />
<a href="https://oshcstudents.com.au/wp-content/uploads/2016/01/Medibank-OSHC-claim-form.pdf" target="_blank">MEDIBANK OSHC</a><br />
<a href="https://oshcstudents.com.au/wp-content/uploads/2016/01/Bupa-OSHC-claim-form.pdf" target="_blank">BUPA OSHC</a><br />
<a href="https://oshcstudents.com.au/wp-content/uploads/2016/01/NIB-OSHC-claim-form.pdf" target="_blank">NIB OSHC</a></p>',
                'name_cn' => 'Claim form OSHC Providers',
                'name_vi' => 'Claim form OSHC Providers',
                'content_cn' => '<p><a href="https://oshcstudents.com.au/wp-content/uploads/2016/01/Allianz-OSHC-claim-form.pdf" target="_blank">ALLIANZ OSHC</a><br />
<a href="https://oshcstudents.com.au/wp-content/uploads/2016/01/AHM-OSHC-claim-form.pdf" target="_blank">AHM OSHC</a><br />
<a href="https://oshcstudents.com.au/wp-content/uploads/2016/01/Medibank-OSHC-claim-form.pdf" target="_blank">MEDIBANK OSHC</a><br />
<a href="https://oshcstudents.com.au/wp-content/uploads/2016/01/Bupa-OSHC-claim-form.pdf" target="_blank">BUPA OSHC</a><br />
<a href="https://oshcstudents.com.au/wp-content/uploads/2016/01/NIB-OSHC-claim-form.pdf" target="_blank">NIB OSHC</a></p>',
                'content_vi' => '<p><a href="https://oshcstudents.com.au/wp-content/uploads/2016/01/Allianz-OSHC-claim-form.pdf" target="_blank">ALLIANZ OSHC</a><br />
<a href="https://oshcstudents.com.au/wp-content/uploads/2016/01/AHM-OSHC-claim-form.pdf" target="_blank">AHM OSHC</a><br />
<a href="https://oshcstudents.com.au/wp-content/uploads/2016/01/Medibank-OSHC-claim-form.pdf" target="_blank">MEDIBANK OSHC</a><br />
<a href="https://oshcstudents.com.au/wp-content/uploads/2016/01/Bupa-OSHC-claim-form.pdf" target="_blank">BUPA OSHC</a><br />
<a href="https://oshcstudents.com.au/wp-content/uploads/2016/01/NIB-OSHC-claim-form.pdf" target="_blank">NIB OSHC</a></p>',
                'area_id' => 1,
                'status' => 0,
                'created_at' => '2019-10-07 08:19:26',
                'updated_at' => '2020-09-13 18:44:46',
            ),
        ));
        
        
    }
}