<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use App\Models\Post;
use App\Models\AccountGroup;
use App\Models\AccountTitles;
use App\Models\AccountSubtitles;
use App\Models\RateChange;
use App\Models\Municipalities;
use App\Models\AccountableOfficers;
use App\Models\CollectionRate;
use App\Models\CustomerType;
use App\Models\Serial;
use App\Models\AccessPC;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;
use Dompdf\Dompdf;
use App\Models\LandTaxInfo;
use App\Models\LandTaxAccount;
use App\Models\Holidays;
use App\Models\AccountSubSubtitles;


class PageController extends Controller
{
    /**
     * Display icons page
     *
     * @return \Illuminate\View\View
     */
    public function icons()
    {
        return view('pages.icons');
    }

    /**
     * Display notifications page
     *
     * @return \Illuminate\View\View
     */
    public function notifications()
    {
        return view('pages.notifications');
    }

    /**
     * Display Customer/Payor page
     * 
     * @return \Illuminate\View\View
     */
    public function customer_payor() 
    {
        return view('pages.customer_payor');
    }

    /**
     * Display Account Category Settings page
     * 
     * @return \Illuminate\View\View
     */
    public function account_category_settings() 
    {
        $acc_categories = DB::table("posts")->where('deleted_at', null)->orderBy('id','asc')->get();
        return view('pages.account_category_settings', ['acc_categories'=>$acc_categories]);
    }

    /**
     * Display Form 56 page
     * 
     * @return \Illuminate\View\View
     */
    public function form_56() 
    {
        $form56 = DB::table('form56s')->latest()->first();
        $form56Table = DB::table('form56s')->get();
        return view('pages.form_56', ['form56'=>$form56, 'form56Table'=>$form56Table]);
    }

    /**
     * Display Account Group Settings page
     * 
     * @return \Illuminate\View\View
     */
    public function account_group_settings() 
    {
        $display_categories = DB::table('posts')->select('id', 'acc_category_settings')->where('deleted_at', null)->get();
        $acc_group = DB::table("account_groups")->where('account_groups.deleted_at', null)->join('posts', 'account_groups.category_id', 'posts.id')->get();
        return view('pages.account_group_settings', ['acc_group'=>$acc_group, 'display_categories'=>$display_categories]);
    }

    /**
     * Display District Hospital Remittance page
     * 
     * @return \Illuminate\View\View
     */
    public function district_hospital() 
    {
        $hospital_data = DB::table("hospitals")->where('deleted_at', null)->orderBy('id','asc')->get();
        return view('pages.district_hospital', ['hospital_data'=>$hospital_data]);
    }

    /**
     * Display Account Titles page
     *
     * @return \Illuminate\View\View
     */
    public function account_titles()
    {
        $display_group = DB::table('account_groups')->select('id', 'type')->where('deleted_at', null)->get();
        $acc_titles = DB::table("account_titles")->select('account_titles.*', 'account_groups.*', 'account_titles.id')
        ->where('account_titles.deleted_at', null)
        ->join('account_groups', 'account_titles.title_category_id', 'account_groups.id')
        ->get();
        return view('pages.account_titles', ['acc_titles'=>$acc_titles, 'display_group'=>$display_group]);
    }

    /**
     * Display Account Subtitles page
     *
     * @return \Illuminate\View\View
     */
    public function account_subtitles()
    {
        $display_group_cat = DB::table('account_titles')->select('id', 'title_name')->where('deleted_at', null)->get();

        $acc_subtitles = DB::table('account_subtitles')->select('account_subtitles.id AS main_id', 'account_subtitles.*', 'account_titles.*')->where('account_subtitles.deleted_at', null)->join('account_titles', 'account_subtitles.title_id', 'account_titles.id')->get();

        $nested_subtitles = DB::table('account_sub_subtitles')->select('account_subtitles.subtitle AS subtitle', 'account_sub_subtitles.*')->where('account_subtitles.deleted_at', null)->join('account_subtitles', 'account_sub_subtitles.subtitle_id', 'account_subtitles.id')->get();

        return view('pages.account_subtitles', ['acc_subtitles'=>$acc_subtitles, 'display_group_cat'=>$display_group_cat, 'nested_subtitles'=>$nested_subtitles]);
    }

    /**
     * Display Budget Estimate page
     *
     * @return \Illuminate\View\View
     */
    public function budget_estimate()
    {
        $year = 2022;
        $accCategories = Post::all();
        $accGroups = AccountGroup::all();
        $accTitles = AccountTitles::select('*', 'budget_estimates.amount AS budget', 'account_titles.id')
        // ->whereNotIn('account_titles.title_name', ['BAC Drugs & Meds', 'BAC Goods & Services', 'BAC INFRA'])
        ->where([['budget_estimates.year', $year], ['account_titles.title_pos', '<>', 0]])
        ->orderBy('account_titles.title_pos', 'asc')
        ->leftJoin('budget_estimates', 'account_titles.id', 'budget_estimates.acc_titles_id')
        ->get();
        
        $accSubtitles = AccountSubtitles::select('account_subtitles.id AS main_id', 'account_subtitles.*', 'budget_estimates.amount AS budget', 'account_subtitles.id')
        ->where('budget_estimates.year', $year)
        ->leftJoin('budget_estimates', 'account_subtitles.id', 'budget_estimates.sub_titles_id')
        ->get();

        $nested_subtitles = DB::table('account_sub_subtitles')->where('account_subtitles.deleted_at', null)->join('account_subtitles', 'account_sub_subtitles.subtitle_id', 'account_subtitles.id')->get();
        
        $accSubSubtitles = AccountSubSubtitles::select('*', 'budget_estimates.amount AS budget', 'account_sub_subtitles.id')
        ->where('budget_estimates.year', $year)
        ->leftJoin('budget_estimates', 'account_sub_subtitles.id', 'budget_estimates.sub_subtitles_id')
        ->get();
        return view('pages.budget_estimate', ['accCategories'=>$accCategories, 'accGroups'=>$accGroups, 'accTitles'=>$accTitles, 'accSubtitles'=>$accSubtitles, 'nested_subtitles'=>$nested_subtitles, 'accSubSubtitles'=>$accSubSubtitles]);
    }

    /**
     * Display Collection Rates page
     *
     * @return \Illuminate\View\View
     */
    public function collection_rates()
    {
        $accCategories = Post::all();
        $accGroups = AccountGroup::all();
        $accTitles = AccountTitles::all();
        $accSubtitles = AccountSubtitles::all();
        $rateChange = RateChange::latest()->first();
        return view('pages.collection_rates', ['rateChange'=>$rateChange, 'accCategories'=>$accCategories, 'accGroups'=>$accGroups, 'accTitles'=>$accTitles, 'accSubtitles'=>$accSubtitles]);
    }

    /**
     * Display Report Officers page
     *
     * @return \Illuminate\View\View
     */
    public function report_officer()
    {
        $displayOfficers = DB::table('cert_officers')
        ->select('cert_officers.*', 'officers.*', 'positions.*', 'departments.*', 'cert_officers.id' ,'officers.id AS officerId', 'positions.id AS posId', 'departments.id AS deptId')
        ->where('deleted_at', null)
        ->join('officers', 'cert_officers.officer_id', 'officers.id')
        ->join('positions', 'cert_officers.position_id', 'positions.id')
        ->join('departments', 'cert_officers.department_id', 'departments.id')
        ->get();

        return view('pages.report_officer', ['displayOfficers'=>$displayOfficers]);
    }

    /**
     * Display Customer Type page
     *
     * @return \Illuminate\View\View
     */
    public function customer_type()
    {
        $displayTypes = DB::table('customer_types')->where('deleted_at', null)->get();
        return view('pages.customer_type', ['displayTypes'=>$displayTypes]);
    }
    
    /**
     * Display Holidays page
     *
     * @return \Illuminate\View\View
     */
    public function holidays()
    {
        $displayHolidays = DB::table('holidays')->where('deleted_at', null)->get();
        return view('pages.holidays', ['displayHolidays'=>$displayHolidays]);
    }

    /**
     * Display Serial page
     *
     * @return \Illuminate\View\View
     */
    public function serial()
    {
        $acc_categories = DB::table('posts')->where('deleted_at', null)->get();
        
        $displaySerial = Serial::select('land_tax_infos.report_date', 'start_serial', 'end_serial', 'municipalities.municipality', 'posts.acc_category_settings', 'accountable_officers.*', 'serials.*', 'serials.created_at AS created', 'serials.updated_at AS updated', DB::raw('max(land_tax_infos.serial_number) AS latest'))
        ->where('assigned_office', null)
        ->groupBy('serials.id', 'serials.start_serial', 'serials.end_serial')
        ->orderBy('serials.status', 'asc')
        ->orderBy('start_serial', 'asc')
        ->leftJoin('posts', 'serials.fund_id', 'posts.id')
        ->leftJoin('municipalities', 'serials.mun_id', 'municipalities.id')
        ->leftJoin('accountable_officers', 'serials.acc_officer_id', 'accountable_officers.id')
        ->leftJoin('land_tax_infos', 'serials.id', 'land_tax_infos.series_id')
        ->get();
        
        $display = DB::table('serials')
        ->where('serials.deleted_at', null)
        ->leftJoin('accountable_officers', 'serials.acc_officer_id', 'accountable_officers.id')
        ->get();

        $displaySerialCash = Serial::select('land_tax_infos.report_date', 'start_serial', 'end_serial', 'municipalities.municipality', 'posts.acc_category_settings', 'accountable_officers.*', 'serials.*', DB::raw('max(land_tax_infos.serial_number) AS latest'))
        ->where('assigned_office', 'Cash')
        ->groupBy('serials.id', 'serials.start_serial', 'serials.end_serial')
        ->orderBy('serials.status', 'asc')
        ->orderBy('start_serial', 'asc')
        ->leftJoin('posts', 'serials.fund_id', 'posts.id')
        ->leftJoin('municipalities', 'serials.mun_id', 'municipalities.id')
        ->leftJoin('accountable_officers', 'serials.acc_officer_id', 'accountable_officers.id')
        ->leftJoin('land_tax_infos', 'serials.id', 'land_tax_infos.series_id')
        ->get();

        $municipalities = Municipalities::all();
        $acc_officers = AccountableOfficers::all();
        return view('pages.serial', ['acc_officers'=>$acc_officers, 'municipalities'=>$municipalities, 'acc_categories'=>$acc_categories ,'displaySerial'=>$displaySerial, 'displaySerialCash'=>$displaySerialCash]);
    }

    /**
     * Display Serial SG page
     *
     * @return \Illuminate\View\View
     */
    public function serial_sg()
    {
        $displaySerialSG = DB::table('serial_s_g_s')
        ->select('serial_s_g_s.*', DB::raw('max(land_tax_infos.dr_number) AS latest'))
        ->groupBy('serial_s_g_s.id', 'serial_s_g_s.start_serial_sg', 'serial_s_g_s.serial_sg_type')
        ->orderBy('serial_s_g_s.serial_sg_type', 'asc')
        ->orderBy('serial_s_g_s.start_serial_sg', 'asc')
        // ->where('serial_s_g_s.status', 'Active')
        ->leftJoin('land_tax_infos', 'serial_s_g_s.id', 'land_tax_infos.dr_id')
        ->get();
        return view('pages.serial_sg', ['displaySerialSG'=>$displaySerialSG]);
    }

    /**
     * Display Access PC's page
     *
     * @return \Illuminate\View\View
     */
    public function access_pc()
    {
        $displayAccessPC = DB::table('access_p_c_s')->select('access_p_c_s.*', DB::raw('CONCAT(start_serial,"-", end_serial, " ", unit, " ", acc_category_settings) AS Serial'))->where('access_p_c_s.deleted_at', null)->join('serials', 'access_p_c_s.serial_id', 'serials.id')->join('posts', 'serials.fund_id', 'posts.id')->get();
        return view('pages.access_pc', ['displayAccessPC'=>$displayAccessPC]);
    }

    /**
     * Display Land Tax Collection's page
     *
     * @return \Illuminate\View\View
     */
    public function land_tax_collection(Request $request)
    {
        $displayCustType = CustomerType::all();
        $ip = request()->ip();
        $serials = DB::table('access_p_c_s')
        ->select('serials.*', DB::raw('CONCAT(start_serial,"-", end_serial, " ", unit, " ", acc_category_settings) AS Serial'))
        ->where('assigned_ip', $ip)
        ->join('serials', 'access_p_c_s.serial_id', 'serials.id')
        ->join('posts', 'serials.fund_id', 'posts.id')->orderBy('serial_id', 'desc')
        ->limit(1)
        ->get();

        $fieldSerials = DB::table('serials')
        ->select('serials.*', DB::raw('CONCAT(start_serial,"-", end_serial, " ", unit, " ", acc_category_settings) AS Serial'))
        ->where('unit', 'Pad')
        ->orderBy('start_serial', 'desc')
        ->join('posts', 'serials.fund_id', 'posts.id')
        ->limit(1)
        ->get();

        $displayCategories = DB::table('posts')->select(DB::raw('GROUP_CONCAT(acc_category_settings SEPARATOR ",") AS "ACC"'))->get();
        $displayCategories = explode(",",$displayCategories[0]->ACC);
        
        $displayOfficers = DB::table('cert_officers')
        ->select('cert_officers.*', 'officers.*', 'positions.*', 'departments.*', 'cert_officers.id')
        ->where('deleted_at', null)
        ->join('officers', 'cert_officers.officer_id', 'officers.id')
        ->join('positions', 'cert_officers.position_id', 'positions.id')
        ->join('departments', 'cert_officers.department_id', 'departments.id')
        ->get();
            
        $displayTaxID = DB::table('access_p_c_s')->where('deleted_at', null)->get();
        $acc_data = LandTaxAccount::where('info_id', $request->id)->get();

        // if (count($serials) < 1) {
        //     return abort(403,'Oops! your unit is not assigned to a series.');
        // }
        return view('pages.land_tax_collection', ['ip'=>$ip, 'acc_data'=>$acc_data, 'displayTaxID'=>$displayTaxID, 'displayCategories'=>$displayCategories, 'serials'=>$serials, 'fieldSerials'=>$fieldSerials, 'displayCustType'=>$displayCustType, 'displayOfficers'=>$displayOfficers]);
    }

    /**
     * Word Document Display
     *
     * @return \Illuminate\View\View
     */
    public function getWordTemplate($id) {
        $getCertData = DB::table('certifications')->where('land_tax_info_id', '=', $id)->first();
        $getAccounts = DB::table('land_tax_accounts')
        ->select('land_tax_infos.serial_number', 'land_tax_infos.report_date', 'land_tax_accounts.*', 'land_tax_infos.id')
        ->where('info_id', $id)
        ->leftJoin('land_tax_infos', 'land_tax_infos.id', 'land_tax_accounts.info_id')
        ->get();

        $getAdditionalPermits = DB::table('provincial_permit_arrays')
        ->select('provincial_permit_arrays.*')
        ->where('prov_cert_id', $id)
        ->get();
        
        $getLandTaxAccounts = DB::table('land_tax_accounts')
        ->select('land_tax_accounts.*','land_tax_infos.serial_number', 'land_tax_infos.report_date', 'land_tax_accounts.id')
        ->where('info_id', $id)
        ->join('land_tax_infos', 'land_tax_infos.id', 'land_tax_accounts.id')
        ->first();
        
        $getLandTaxInfo = DB::table('land_tax_infos')->where('id', $id)->first();
        $getReportOfficers = DB::table('cert_officers')->select('cert_officers.*', 'officers.id', 'officers.name', 'positions.id', 'positions.position', 'departments.id', 'departments.department')
        ->where('officers.id', $id)
        ->join('officers', 'cert_officers.officer_id', 'officers.id')
        ->join('positions', 'cert_officers.position_id', 'positions.id')
        ->join('departments', 'cert_officers.department_id', 'departments.id')
        ->get();
        
        $prepared_by = DB::table('cert_officers')
        ->select('cert_officers.*', 'officers.*', 'positions.*', 'cert_officers.id')
        ->where('cert_officers.id', $getCertData->cert_prepared_by)
        ->join('officers', 'cert_officers.officer_id', 'officers.id')
        ->join('positions', 'cert_officers.position_id', 'positions.id')
        ->first();
        
        $signee = DB::table('cert_officers')
        ->select('cert_officers.*', 'officers.*', 'positions.*', 'cert_officers.id')
        ->where('cert_officers.id', $getCertData->cert_signee)
        ->join('officers', 'cert_officers.officer_id', 'officers.id')
        ->join('positions', 'cert_officers.position_id', 'positions.id')
        ->first();

        $others = DB::table('cert_officers')
        ->where('cert_officers.id', $getCertData->second_signee)
        ->join('officers', 'cert_officers.officer_id', 'officers.id')
        ->join('positions', 'cert_officers.position_id', 'positions.id')
        ->first();

        $getDynamicPermits = DB::table('provincial_permit_arrays')
        ->select('provincial_permit_arrays.*', 'certifications.*')
        ->where('provincial_permit_arrays.id', $id)
        ->join('certifications', 'provincial_permit_arrays.id', 'certifications.land_tax_info_id')
        ->get();
        
        $year = Date('Y');
        $getSharedValues = DB::table('rate_schedules')->where('id', $id)->first();
        if ($getLandTaxInfo->certificate == 'Transfer Tax') {
            $file = public_path('storage/WordTemplates/TransferTaxTemplate.docx');
            $templateProcessor = new TemplateProcessor($file);
            $templateProcessor->setValue('date', $getCertData->cert_date);
            $templateProcessor->setValue('name', str_replace('&', 'and', $getCertData->cert_recipient));
            $templateProcessor->setValue('certDetails', str_replace(array("\r\n","&nbsp;"), array("</w:t><w:br/><w:t xml:space='preserve'>", " "), strip_tags($getCertData->cert_details)));
            $templateProcessor->setValue('series', $getLandTaxInfo->serial_number);
            $templateProcessor->cloneRow('nature', count($getAccounts));
            foreach ($getAccounts as $key => $value) {
                $templateProcessor->setValue('nature#'.($key+1), str_replace('&', 'and', $value->nature));
                $templateProcessor->setValue('amount#'.($key+1), number_format($value->amount, 2));
            }
            $templateProcessor->setValue('total_amount', $getLandTaxInfo->total_amount);
            $templateProcessor->setValue('prepared_by_name', $prepared_by->name);
            $templateProcessor->setValue('prepared_by_position', $prepared_by->position);
            $templateProcessor->setValue('signee_name', $signee->name);
            $templateProcessor->setValue('signee_position', $signee->position);
            $templateProcessor->setValue('notary_public', strip_tags(html_entity_decode($getCertData->notary_public)));
            $templateProcessor->setValue('ptr_number', $getCertData->ptr_number);
            $templateProcessor->setValue('doc_number', $getCertData->doc_number);
            $templateProcessor->setValue('page_number', $getCertData->page_number);
            $templateProcessor->setValue('book_number', $getCertData->book_number);
            $templateProcessor->setValue('cert_series', $getCertData->cert_series);
            if ($getCertData->second_signee != null) {
                $templateProcessor->setValue('absentee_title', 'By:');
                $templateProcessor->setValue('other_signee', $others->name);
                $templateProcessor->setValue('other_position', $others->position);
            } else {
                $templateProcessor->setValue('absentee_title', '');
                $templateProcessor->setValue('other_signee', '');
                $templateProcessor->setValue('other_position', '');
            }

            $pathToSave = public_path('storage/WordResults/TransferTax.docx');
            $templateProcessor->saveAs($pathToSave);
            return response()->download(public_path('storage/WordResults/TransferTax.docx'))->deleteFileAfterSend(true);
        } else if ($getLandTaxInfo->certificate == 'Sand & Gravel') {
            $file = public_path('storage/WordTemplates/Sand_GravelTemplate.docx');
            $templateProcessor = new TemplateProcessor($file);
            $templateProcessor->setValue('date', $getCertData->cert_date);
            $templateProcessor->setValue('certRecipient', str_replace('&', 'and', $getCertData->cert_recipient));
            $templateProcessor->setValue('certAddress', $getCertData->cert_address);
            $templateProcessor->setValue('certDetails', str_replace(array("\r\n","&nbsp;"), array("</w:t><w:br/><w:t xml:space='preserve'>", " "), strip_tags($getCertData->cert_details)));
            $templateProcessor->cloneRow('nature', count($getAccounts));

            $processed = 0.00;
            $crushedGravel = 0.00;
            $crushedSand = 0.00;
            $aggregate = 0.00;
            $river = 0.00;
            $boulders = 0.00;
            
            foreach ($getAccounts as $key => $value) {
                // if (strpos($value->nature, 'Crushed') !== false) {
                //     $processed=$processed+$value->quantity;
                // }
                if (strpos($value->nature, 'Crushed Gravel') !== false) {
                    $crushedGravel=$crushedGravel+$value->quantity;
                }
                if (strpos($value->nature, 'Crushed Sand') !== false) {
                    $crushedSand=$crushedSand+$value->quantity;
                }
                if (strpos($value->nature, 'Aggregate') !== false) {
                    $aggregate=$aggregate+$value->quantity;
                }
                if (strpos($value->nature, 'Sand and Gravel') !== false) {
                    $river=$river+$value->quantity;
                }
                if (strpos($value->nature, 'Boulders') !== false) {
                    $boulders=$boulders+$value->quantity;
                }
                $templateProcessor->setValue('nature#'.($key+1), str_replace('&', '&amp;', $value->nature));
                $templateProcessor->setValue('amount#'.($key+1), number_format($value->amount, 2));
            }
            $templateProcessor->setValue('series', $getLandTaxInfo->serial_number);
            $templateProcessor->setValue('signee_name', $signee->name);
            $templateProcessor->setValue('signee_position', $signee->position);
            $templateProcessor->setValue('total_amount', $getLandTaxInfo->total_amount);
            
            // $templateProcessor->setValue('less_processed', number_format($getCertData->sg_processed, 2));
            $templateProcessor->setValue('less_crushed_sand', number_format($getCertData->sg_crushed_sand, 2));
            $templateProcessor->setValue('less_crushed_gravel', number_format($getCertData->sg_crushed_gravel, 2));
            $templateProcessor->setValue('less_aggregate', number_format($getCertData->agg_basecourse, 2));
            $templateProcessor->setValue('less_river', number_format($getCertData->less_sandandgravel, 2));
            $templateProcessor->setValue('less_boulders', number_format($getCertData->less_boulders, 2));

            // $templateProcessor->setValue('processed_balance', number_format($processed, 2));
            $templateProcessor->setValue('crushedGravel_balance', number_format($crushedGravel, 2));
            $templateProcessor->setValue('crushedSand_balance', number_format($crushedSand, 2));
            $templateProcessor->setValue('aggregate_balance', number_format($aggregate, 2));
            $templateProcessor->setValue('river_balance', number_format($river, 2));
            $templateProcessor->setValue('boulders_balance', number_format($boulders, 2));
            
            // $templateProcessor->setValue('processed', number_format(($processed+$getCertData->sg_processed), 2));
            $templateProcessor->setValue('crushedGravel', number_format(($crushedGravel+$getCertData->sg_processed), 2));
            $templateProcessor->setValue('crushedSand', number_format(($crushedSand+$getCertData->sg_processed), 2));
            $templateProcessor->setValue('aggregate',  number_format(($aggregate+$getCertData->agg_basecourse), 2));
            $templateProcessor->setValue('river',  number_format(($river+$getCertData->less_sandandgravel), 2));
            $templateProcessor->setValue('boulders',  number_format(($boulders+$getCertData->less_boulders), 2));
            if ($getCertData->second_signee != null) {
                $templateProcessor->setValue('other_signee', $others->name);
                $templateProcessor->setValue('other_position', $others->position);
                $templateProcessor->setValue('absentee_message', 'In the absence of');
                $templateProcessor->setValue('absentee_message_2', 'Provincial Treasurer');
            } else {
                $templateProcessor->setValue('other_signee', '');
                $templateProcessor->setValue('other_position', '');
                $templateProcessor->setValue('absentee_message', '');
                $templateProcessor->setValue('absentee_message_2', '');
            }

            $pathToSave = public_path('storage/WordResults/Sand&Gravel.docx');
            $templateProcessor->saveAs($pathToSave);
            return response()->download(public_path('storage/WordResults/Sand&Gravel.docx'))->deleteFileAfterSend(true);
        } else if ($getLandTaxInfo->certificate == 'Provincial Permit') {
            if ($getCertData->prov_certtype == 'New') {
                $file = public_path('storage/WordTemplates/ProvincialPermitTemplate.docx');
                $templateProcessor = new TemplateProcessor($file);
                $hour = date('H', strtotime($getCertData->created_at));
                $templateProcessor->setValue('clearance', $getCertData->prov_certclearance);
                $templateProcessor->setValue('certRecipient', str_replace('&', 'and', $getCertData->cert_recipient));
                $templateProcessor->setValue('certAddress', str_replace('&', 'and', $getCertData->cert_address));
                $templateProcessor->setValue('currentYear', $year);
                $templateProcessor->setValue('certDetails', str_replace(array("\r\n","&nbsp;"), array("</w:t><w:br/><w:t xml:space='preserve'>", " "), strip_tags($getCertData->cert_details)));
                $templateProcessor->setValue('day', Date('jS', strtotime($getCertData->cert_date)));
                // if ($hour >= 12) {
                //     $templateProcessor->setValue('day', Date('jS', strtotime("-1 day", strtotime($getLandTaxInfo->report_date))));
                // } else {
                //     $templateProcessor->setValue('day', Date('jS', strtotime($getLandTaxInfo->report_date)));
                // }
                $templateProcessor->setValue('monthYear', Date('F, Y', strtotime($getLandTaxInfo->report_date)));
                if ($getCertData->prov_certbidding == 1) {
                    $templateProcessor->setValue('forBidding', '*** For bidding purposes');
                } else {
                    $templateProcessor->setValue('forBidding', '');
                }
                
                $templateProcessor->cloneRow('naturePermit', count($getAccounts));
                foreach ($getAccounts as $key => $value) {
                    $templateProcessor->setValue('naturePermit#'.($key+1), str_replace('&', '&amp;', strip_tags($value->nature)));
                    $templateProcessor->setValue('amount#'.($key+1), number_format($value->amount, 2));
                    $templateProcessor->setValue('serialNumber#'.($key+1), $value->serial_number);
                    $timeToday = date('H');
                    $provDate = date('F j, Y', strtotime($value->created_at));
                    // if ($hour >= 12) {
                    //     $provDate = date('F j, Y', strtotime('- 1 day', strtotime($value->report_date)));
                    // } else {
                    //     $provDate = date('F j, Y', strtotime($value->report_date));
                    // }
                    $templateProcessor->setValue('datec#'.($key+1), $provDate);
                    $templateProcessor->setValue('initF#'.($key+1), 'A');
                }

                $templateProcessor->cloneRow('feeCharge', count($getAdditionalPermits));
                foreach ($getAdditionalPermits as $key => $value) {
                    if ($value->prov_feecharge != null) {
                        $templateProcessor->setValue('feeCharge#'.($key+1), $value->prov_feecharge);
                        $templateProcessor->setValue('permitAmount#'.($key+1), number_format($value->prov_amount, 2, '.', ''));
                        $templateProcessor->setValue('newOR#'.($key+1), $value->prov_ornumber);
                        $templateProcessor->setValue('date#'.($key+1), Date('F j, Y', strtotime($value->prov_date)));
                        // $templateProcessor->setValue('date#'.($key+1), $value->prov_date);
                        $templateProcessor->setValue('initS#'.($key+1), $value->prov_initials);
                    } else {
                        
                    }
                }

                $templateProcessor->setValue('governor', $getCertData->prov_governor);
                $templateProcessor->setValue('signee_name', $signee->name);
                $templateProcessor->setValue('signee_position', $signee->position);
                $templateProcessor->setValue('certSignee', $getCertData->cert_signee);
                if ($getCertData->second_signee != null) {
                    $templateProcessor->setValue('other_signee', $others->name);
                    $templateProcessor->setValue('other_position', $others->position);
                    $templateProcessor->setValue('absentee_message', 'In the absence of');
                    $templateProcessor->setValue('absentee_message_2', 'Provincial Treasurer');
                } else {
                    $templateProcessor->setValue('other_signee', '');
                    $templateProcessor->setValue('other_position', '');
                    $templateProcessor->setValue('absentee_message', '');
                    $templateProcessor->setValue('absentee_message_2', '');
                }

                $pathToSave = public_path('storage/WordResults/ProvincialPermit.docx');
                $templateProcessor->saveAs($pathToSave);
                return response()->download(public_path('storage/WordResults/ProvincialPermit.docx'))->deleteFileAfterSend(true);
            } else if ($getCertData->prov_certtype == 'Renewal') {
                $file = public_path('storage/WordTemplates/ProvincialPermitTemplateRenewal.docx');
                $templateProcessor = new TemplateProcessor($file);
                $hour = date('H', strtotime($getCertData->created_at));
                $templateProcessor->setValue('clearance', $getCertData->prov_certclearance);
                $templateProcessor->setValue('certRecipient', str_replace('&', 'and', $getCertData->cert_recipient));
                $templateProcessor->setValue('certAddress', str_replace('&', 'and', $getCertData->cert_address));
                $templateProcessor->setValue('currentYear', $year);
                $templateProcessor->setValue('certDetails', str_replace(array("\r\n","&nbsp;"), array("</w:t><w:br/><w:t xml:space='preserve'>", " "), strip_tags($getCertData->cert_details)));
                $templateProcessor->setValue('day', Date('jS', strtotime($getCertData->cert_date)));
                // if ($hour >= 12) {
                //     $templateProcessor->setValue('day', Date('jS', strtotime("-1 day", strtotime($getLandTaxInfo->report_date))));
                // } else {
                //     $templateProcessor->setValue('day', Date('jS', strtotime($getLandTaxInfo->report_date)));
                // }
                
                $templateProcessor->setValue('monthYear', Date('F, Y', strtotime($getLandTaxInfo->report_date)));
                if ($getCertData->prov_certbidding == 1) {
                    $templateProcessor->setValue('forBidding', '*** For bidding purposes');
                } else {
                    $templateProcessor->setValue('forBidding', '');
                }
                
                $templateProcessor->cloneRow('naturePermit', count($getAccounts));
                foreach ($getAccounts as $key => $value) {
                    $templateProcessor->setValue('naturePermit#'.($key+1), str_replace('&', '&amp;', strip_tags($value->nature)));
                    $templateProcessor->setValue('amount#'.($key+1), number_format($value->amount, 2));
                    $templateProcessor->setValue('serialNumber#'.($key+1), $value->serial_number);
                    $timeToday = date('H');
                    $provDate = date('F j, Y', strtotime($value->created_at));
                    // if ($hour >= 12) {
                    //     $provDate = date('F j, Y', strtotime('- 1 day', strtotime($value->report_date)));
                    // } else {
                    //     $provDate = date('F j, Y', strtotime($value->report_date));
                    // }
                    $templateProcessor->setValue('datec#'.($key+1), $provDate);
                    $templateProcessor->setValue('initF#'.($key+1), 'A');

                }
                
                $templateProcessor->cloneRow('feeCharge', count($getAdditionalPermits));
                foreach ($getAdditionalPermits as $key => $value) {
                    if ($value->prov_feecharge != null) {
                        $templateProcessor->setValue('feeCharge#'.($key+1), $value->prov_feecharge);
                        $templateProcessor->setValue('permitAmount#'.($key+1), number_format($value->prov_amount, 2, '.', ''));
                        $templateProcessor->setValue('newOR#'.($key+1), $value->prov_ornumber);
                        $templateProcessor->setValue('date#'.($key+1), Date('F j, Y', strtotime($value->prov_date)));
                        $templateProcessor->setValue('initS#'.($key+1), $value->prov_initials);
                    } else {
                        
                    }
                }
                
                $templateProcessor->setValue('governor', $getCertData->prov_governor);
                $templateProcessor->setValue('signee_name', $signee->name);
                $templateProcessor->setValue('signee_position', $signee->position);
                $templateProcessor->setValue('certSignee', $getCertData->cert_signee);
                if ($getCertData->second_signee != null) {
                    $templateProcessor->setValue('other_signee', $others->name);
                    $templateProcessor->setValue('other_position', $others->position);
                    $templateProcessor->setValue('absentee_message', 'In the absence of');
                    $templateProcessor->setValue('absentee_message_2', 'Provincial Treasurer');
                } else {
                    $templateProcessor->setValue('other_signee', '');
                    $templateProcessor->setValue('other_position', '');
                    $templateProcessor->setValue('absentee_message', '');
                    $templateProcessor->setValue('absentee_message_2', '');
                }

                $pathToSave = public_path('storage/WordResults/ProvincialPermit.docx');
                $templateProcessor->saveAs($pathToSave);
                return response()->download(public_path('storage/WordResults/ProvincialPermit.docx'))->deleteFileAfterSend(true);
            }
        }
    }

    /**
     * Print Receipt template page
     *
     * @return \Illuminate\View\View
     */
    public function printReceipt($id) {
        $details = LandTaxInfo::with('parentMunicipality', 'parentBarangay', 'parentSerialSG', 'parentRentals')->find($id);
        $details->status = 'Printed';
        $details->save();
        $accounts = LandTaxAccount::where('info_id', $id)->get();
        $accountHtml = '';

        if ($details->date_edited != null) {
            $timeOfTransaction = date('M. j, Y H:i', strtotime($details->date_edited));
        } else {
            $timeOfTransaction = $details->created_at->format('M. j, Y H:i');
        }
        
        foreach ($accounts as $acc) {
            if ($acc->account == 'Tax on Sand, Gravel & Other Quarry Prod.') {
                $accountHtml = $accountHtml.'<div class="sg-title"><p><b>Sand and Gravel Tax:</b></p></div>'.'<div class="container"><p class="receipt-left">'.$acc->nature.'</p> <p class="receipt-right"> '.number_format($acc->amount, 2).'</p></div>';
            } else {
                $accountHtml = $accountHtml.'<div class="container"><p class="receipt-left">'.$acc->nature.'</p> <p class="receipt-right"> '.number_format($acc->amount, 2).'</p></div>';
            }
        }
        if ($details->client_type_id == '2' || $details->client_type_id == '3' || $details->client_type_id == '14') {
            if ($details->business_name == null) {
                $payor = $details->owner;
            } else if ($details->owner == null) {
                $payor = $details->business_name;
            } else {
                $payor = $details->business_name .' By: '. $details->owner;
            }
            $booklet = '';
        } else if ($details->client_type_id == '4') {
            $payor = $details->parentMunicipality->municipality .', '. $details->parentBarangay->barangay_name;
            $booklet = '';
            $location = '';
        } else if ($details->client_type_id == '5') {
            $payor = 'Municipal Government of ' . $details->parentMunicipality->municipality;
        } else if ($details->client_type_id == '6' || $details->client_type_id == '7') {
            if ($details->trade_name_permittees != null && $details->permittee != null) {
                $payor = $details->trade_name_permittees .' By: '. $details->permittee;
            } else if ($details->trade_name_permittees != null && $details->permittee == null) {
                $payor = $details->trade_name_permittees;
            } else if ($details->trade_name_permittees == null && $details->permittee != null) {
                $payor = $details->permittee;
            }

            if ($details->dr_number != null) {
                $booklet = '<div style="font-size: .8em !important; margin-left: -8%; margin-top:-4%;" class="booklets"><p><b>BOOKLET</b></p><br><p style="margin-top: -5%;">'. $details->parentSerialSG->start_serial_sg .' - '. $details->parentSerialSG->end_serial_sg .' ('. $details->parentSerialSG->booklets  .') </p></div>';
            } else {
                $booklet = '';
            }
        } else if ($details->client_type_id == '9') {
            $payor = $details->parentRentals->name;
        } else if ($details->client_type_id == '10' || $details->client_type_id == '11') {
            if ($details->trade_name_permit_fees != null && $details->proprietor != null) {
                $payor = $details->trade_name_permit_fees .' By: '. $details->proprietor;
            } else if ($details->trade_name_permit_fees != null && $details->proprietor == null) {
                $payor = $details->trade_name_permit_fees;
            } else if ($details->trade_name_permit_fees == null && $details->proprietor != null) {
                $payor = $details->proprietor;
            }
        } else if ($details->client_type_id == '12' || $details->client_type_id == '13') {
            if ($details->bidders_business_name == null) {
                $payor = $details->owner_representative;
            } else if ($details->owner_representative == null) {
                $payor = $details->bidders_business_name;
            } else {
                $payor = $details->bidders_business_name .' By: '. $details->owner_representative;
            }
        } else {
            if ($details->client_type_radio == 'Individual') {
                $payor = $details->first_name.' '.$details->middle_initial.' '.str_replace(',', ' ', $details->last_name);
                $booklet = '';
            } else if ($details->client_type_radio == 'Company') {
                $payor = $details->company;
                $booklet = '';
            } else {
                $payor = $details->spouses;
                $booklet = '';
            }
            $booklet = '';
        }

        if ($details->municipality_id != null && $details->barangay_id != null) {
            if ($details->client_type_id == '4') {
                $location = '';
            } else {
                $location = '<div><p class="mun-bar"><b>'.$details->parentBarangay->barangay_name.', '.$details->parentMunicipality->municipality.'</b></p></div>';
            }
            
        } else {
            $location = '';
            $booklet = '';
        }

        $f = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);
        $number = $details->total_amount;
        $formatNumber = (float) str_replace(",","",$number);
        $numberArray = explode('.', number_format($formatNumber, 2, '.', ''));
        $wholeNumber = $f->format($numberArray[0]);
        
        if (count($numberArray) > 1) {
            if ($numberArray[1] == 00) {
                $newNum = $f->format($numberArray[0]).' pesos only';
            } else {
                $newNum = $f->format($numberArray[0]).' pesos and '. $f->format($numberArray[1]).' centavos only';
            }
        } else {
            $newNum = $f->format($numberArray[0]).' pesos only';
        }

        if ($details->transact_type == 'Cash') {
            $transact = '<div class="square-cash"></div>';
        } else if ($details->transact_type == 'Check' || $details->transact_type == 'ADA-LBP' || $details->transact_type == 'Bank Deposit/Transer') {
            $transact = '<div class="square-check"></div>'.
            '<div class="bank-info">
                <div class="bank-drawee">
                    <p>'.$details->bank_name.'</p>
                </div>

                <div class="bank-number">
                    <p>'.$details->number.'</p>
                </div>

                <div class="bank-date">
                    <p>'.$details->transact_date.'</p>
                </div>
            </div>';
        } else if ($details->transact_type == 'Cash & Check') {
            $transact = '<div class="square-cash"></div>';
            $transact = '<div class="square-check"></div>';
        } else {
            $transact = '<div class="square-others"></div>
            <div class="bank-info">
                <div class="bank-deposit-number">
                    <p>'.$details->number.'</p>
                </div>
                
                <div class="bank-deposit-date">
                    <p>'.$details->transact_date.'</p>
                </div>
            </div>';
        }

        $dompdf = new Dompdf();
        $dompdf->loadHtml('
        <style type="text/css">
            body {
                font-family: Helvetica;
            }

            .container {
                display: flex;
                padding: 0;
                margin: 0;
            }

            .receipt-left {
                text-align: left;
                width: 70%;
            }

            .receipt-right {
                text-align: right;
                margin-right: 11%;
            }

            .upper-section {
                margin-left: 12px;
                margin-top: 56;
            }

            .date {
                font-size: .9em;
                margin-bottom: 15px;
            }

            .lower-section {
                position: absolute;
                top: 510;
                right: 30;
            }

            .payor-section {
                padding-top: 8px;
                margin-left: 15px;
            }

            .payor {
                float: left;
                font-size: .91em;
                padding-left: 1px;
                margin: 0;
                width: 88%;
                line-height: .81;
            }

            .sg-title {
                position: absolute;
                top: 133;
                margin: 0 0 0 -5.2%;
            }

            .natureColl {
                padding-top: 18%;
            }

            .natureColl p {
                margin-top: -4%;
                margin-left: -8%;
                padding-right: 2%;
            }

            p { /*Nature of collection */
                font-size: .76em;
            }

            .mun-bar {
                margin: 0 0 .5% -8%;
                padding: 0;
            }

            .mun-bar p {
                font-size: .8em;
                font-weight: bold;
            }

            .collecting-officer {
                position: relative;
                top: -2;
                right: 5;
                font-size: .9em;
            }

            .collector-title {
                position: relative;
                top: -8;
                left: 8;
                font-size: .8em;
            }

            hr {
                border: none;
                border-top: 1px dotted #000;
                color: #fff;
                background-color: #fff;
                height: 2px;
                width: 95%;
                margin: 1% 0 .5% -8%;
            }

            .d-none {
                margin-left: 1000%;
            }

            .total-amount {
                position: absolute;
                top: 394;
                margin-right: 11%;
                float: right;
                font-size: .9em;
            }

            .num-words {
                position: absolute;
                top: 425;
                left: -20;
                width: 100%;
                line-height: .81
            }

            .square-cash {
                position: absolute;
                bottom: 82;
                left: -22;
                //margin-left: -1.5%;
                height: 15px;
                width: 25px;
                background-color: #000;
            }

            .square-check {
                position: absolute;
                bottom: 62;
                left: -25;
                height: 15px;
                width: 25px;
                background-color: #000;
            }

            .bank-drawee {
                position: absolute;
                left: 74;
                bottom: 52;
            }

            .bank-drawee p {
                font-size: .7em;
                width: 75%;
            }

            .bank-number {
                position: absolute;
                left: 150;
                bottom: 58;
            }

            .bank-number p {
                font-size: .7em;
            }

            .bank-date {
                position: absolute;
                width: 30%;
                left: 197;
                bottom: 58;
            }

            .bank-date p {
                font-size: .7em;
            }

            .square-others {
                position: absolute;
                bottom: 46;
                left: -22;
                height: 15px;
                width: 25px;
                background-color: #000;
            }
            
            .bank-deposit-number {
                position: absolute;
                left: 157;
                bottom: 43;
            }

            .bank-deposit-date {
                position: absolute;
                width: 30%;
                left: 197;
                bottom: 43;
            }

            .bank-deposit-number p {
                font-size: .7em;
            }

            .bank-deposit-date p {
                font-size: .7em;
            }
        </style>
        
        <div class="body">
            <div class="upper-section">
                <p class="date">'.$timeOfTransaction.'</p>
            </div>
            
            <div class="payor-section">
                <p class="payor">'.$payor.'</p>
            </div>
            
            <div class="natureColl"><p>'.$accountHtml.'</p></div>
            <hr>
            '.$location.'
            <hr>
            <div style="font-size: .8em; margin-left: -8%; width: 97%">'. $details->receipt_remarks .'</div>
            <hr>
            '. $booklet .'
            
            <p class="total-amount">Php '.$details->total_amount.'</p>
            <p class="num-words">'.$newNum.'</p>
            
            '.$transact.'
            
            <br>
            <br>
            <br>
            
            <div class="lower-section">
                <p class="collecting-officer">IMELDA I. MACANES</p>
                <p class="collector-title">Provincial Treasurer</p>
            </div>
        </div>
        ');
        
        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper(array(0,0,342.9921,623.622), 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream(
            'file.pdf',
            array(
              'Attachment' => 0
            )
        );
    }

    /**
     * Display notifications page
     *
     * @return \Illuminate\View\View
     */
    public function accounts_daily_reports()
    {
        return view('pages.accounts_daily_reports');
    }

    /**
     * Display Collections & Deposits page
     *
     * @return \Illuminate\View\View
     */
    public function collections_deposits()
    {
        $acc_categories = DB::table("posts")->where('deleted_at', null)->orderBy('id','asc')->get();
        $report_officers = DB::table('cert_officers')->select('officers.*', 'positions.*', 'departments.*')->join('officers', 'cert_officers.officer_id', 'officers.id')->join('positions', 'cert_officers.position_id', 'positions.id')->join('departments', 'cert_officers.department_id', 'departments.id')->get();

        $displayTaxData = DB::table('land_tax_infos')
        ->select('land_tax_infos.id AS main_id', 'land_tax_infos.*', 'serials.*', 'access_p_c_s.*', 'access_p_c_s.id AS user_name', 'municipalities.*', 'municipalities.municipality AS mun_name')
        ->where('land_tax_infos.deleted_at', null)
        ->join('serials', 'land_tax_infos.series_id', 'serials.id')
        ->join('access_p_c_s', 'land_tax_infos.user_ip', 'access_p_c_s.id')
        ->join('municipalities', 'land_tax_infos.id', 'municipalities.id')
        ->get();

        $displayOfficers = DB::table('cert_officers')
        ->select('cert_officers.*', 'officers.*', 'positions.*', 'departments.*', 'cert_officers.id')
        ->where('deleted_at', null)
        ->join('officers', 'cert_officers.officer_id', 'officers.id')
        ->join('positions', 'cert_officers.position_id', 'positions.id')
        ->join('departments', 'cert_officers.department_id', 'departments.id')
        ->get();
        return view('pages.collections_deposits', ['displayOfficers'=>$displayOfficers, 'acc_categories'=>$acc_categories, 'report_officers'=>$report_officers, 'displayTaxData'=>$displayTaxData]);
    }

    /**
     * Display Real Property Tax page
     *
     * @return \Illuminate\View\View
     */
    public function property_tax(Request $request)
    {
        $displayMunReceipts = DB::table('municipal_receipts')
        ->select('municipal_receipts.id AS main_id', 'municipal_receipts.*', 'customer_types.id', 'customer_types.description_type AS client_types', 'municipalities.municipality AS mun_name', 'barangays.barangay_name AS bar_name')
        ->leftJoin('municipalities', 'municipal_receipts.mun_municipality_id', 'municipalities.id')
        ->leftJoin('barangays', 'municipal_receipts.mun_barangay_id', 'barangays.id')
        ->join('customer_types', 'municipal_receipts.mun_client_type_id', 'customer_types.id')
        ->get();

        $displayCustType = CustomerType::all();

        $displayOfficers = DB::table('cert_officers')
        ->select('cert_officers.*', 'officers.*', 'positions.*', 'departments.*', 'cert_officers.id')
        ->where('deleted_at', null)
        ->join('officers', 'cert_officers.officer_id', 'officers.id')
        ->join('positions', 'cert_officers.position_id', 'positions.id')
        ->join('departments', 'cert_officers.department_id', 'departments.id')
        ->get();

        $acc_data = LandTaxAccount::where('info_id', $request->id)->get();

        date_default_timezone_set("Asia/Hong_Kong");
        $current_date = date('m/d/Y H:i');
        
        return view('pages.property_tax', ['current_date'=>$current_date, 'displayMunReceipts'=>$displayMunReceipts, 'displayCustType'=>$displayCustType, 'displayOfficers'=>$displayOfficers, 'acc_data'=>$acc_data]);
    }

    /**
     * Display Special Case page
     *
     * @return \Illuminate\View\View
     */
    public function special_case()
    {
        $getSpecialCases = DB::table('special_cases')->get();
        return view('pages.special_case', ['getSpecialCases'=>$getSpecialCases]);
    }

    /**
     * Display Contractors page
     *
     * @return \Illuminate\View\View
     */
    public function contractors()
    {
        $getContractors = DB::table('contractors')
        ->get();
        return view('pages.contractors', ['getContractors'=>$getContractors]);
    }

    /**
     * Display Permittees S&G page
     *
     * @return \Illuminate\View\View
     */
    public function permittees_sg()
    {
        $getPermittees = DB::table('sand_gravel_permittees')
        ->get();
        return view('pages.permittees_sg', ['getPermittees'=>$getPermittees]);
    }

    /**
     * Display Permittees Others page
     *
     * @return \Illuminate\View\View
     */
    public function permittees_others()
    {
        $getOthers = DB::table('permit_fees_data_banks')
        ->get();
        return view('pages.permittees_others', ['getOthers'=>$getOthers]);
    }

    /**
     * Display Permittees Others page
     *
     * @return \Illuminate\View\View
     */
    public function cutoffs()
    {
        $setCutOffs = DB::table('cut_offs')
        ->get();
        return view('pages.cutoffs', ['setCutOffs'=>$setCutOffs]);
    }

    /**
     * Display Client Input page
     *
     * @return \Illuminate\View\View
     */
    public function client_input()
    {
        $displayCustType = CustomerType::all();

        return view('pages.client_input', ['displayCustType'=>$displayCustType]);
    }

    /**
     * Display Munciipal Receipts page
     *
     * @return \Illuminate\View\View
     */
    public function mun_receipts(Request $request)
    {
        $displayMunReceipts = DB::table('municipal_receipts')
        ->select('municipal_receipts.id AS main_id', 'municipal_receipts.*', 'customer_types.id', 'customer_types.description_type AS client_types', 'municipalities.municipality AS mun_name', 'barangays.barangay_name AS bar_name')
        ->leftJoin('municipalities', 'municipal_receipts.mun_municipality_id', 'municipalities.id')
        ->leftJoin('barangays', 'municipal_receipts.mun_barangay_id', 'barangays.id')
        ->join('customer_types', 'municipal_receipts.mun_client_type_id', 'customer_types.id')
        ->get();

        $displayCustType = CustomerType::all();

        $displayOfficers = DB::table('cert_officers')
        ->select('cert_officers.*', 'officers.*', 'positions.*', 'departments.*', 'cert_officers.id')
        ->where('deleted_at', null)
        ->join('officers', 'cert_officers.officer_id', 'officers.id')
        ->join('positions', 'cert_officers.position_id', 'positions.id')
        ->join('departments', 'cert_officers.department_id', 'departments.id')
        ->get();

        $acc_data = LandTaxAccount::where('info_id', $request->id)->get();

        date_default_timezone_set("Asia/Hong_Kong");
        $current_date = date('m/d/Y H:i');

        return view('pages\municipalReceipts.municipal_receipt', ['current_date'=>$current_date, 'displayMunReceipts'=>$displayMunReceipts, 'displayCustType'=>$displayCustType, 'displayOfficers'=>$displayOfficers, 'acc_data'=>$acc_data]);
    }

    /**
     * Display S&G Monthly Report page
     *
     * @return \Illuminate\View\View
     */
    public function sandgravel_monthly_report()
    {
        $displayOfficers = DB::table('cert_officers')
        ->select('cert_officers.*', 'officers.*', 'positions.*', 'departments.*', 'cert_officers.id')
        ->where('deleted_at', null)
        ->join('officers', 'cert_officers.officer_id', 'officers.id')
        ->join('positions', 'cert_officers.position_id', 'positions.id')
        ->join('departments', 'cert_officers.department_id', 'departments.id')
        ->get();

        return view('pages.sandgravel_monthly_report', ['displayOfficers'=>$displayOfficers]);
    }

    /**
     * Display PVET Collections  page
     *
     * @return \Illuminate\View\View
     */
    public function cash_collections(Request $request)
    {
        if (Auth::user()->office == "Cash") {
            $displayCustType = CustomerType::all();
            $ip = request()->ip();
            $serials = DB::table('access_p_c_s')
            ->select('serials.*', DB::raw('CONCAT(start_serial,"-", end_serial, " ", unit, " ", acc_category_settings) AS Serial'))
            ->where('assigned_ip', $ip)
            ->join('serials', 'access_p_c_s.serial_id', 'serials.id')
            ->join('posts', 'serials.fund_id', 'posts.id')->orderBy('serial_id', 'desc')->limit(1)->get();

            $displayCategories = DB::table('posts')->select(DB::raw('GROUP_CONCAT(acc_category_settings SEPARATOR ",") AS "ACC"'))->get();
            $displayCategories = explode(",",$displayCategories[0]->ACC);
            
            $displayOfficers = DB::table('cert_officers')
            ->select('cert_officers.*', 'officers.*', 'positions.*', 'departments.*', 'cert_officers.id')
            ->where('deleted_at', null)
            ->join('officers', 'cert_officers.officer_id', 'officers.id')
            ->join('positions', 'cert_officers.position_id', 'positions.id')
            ->join('departments', 'cert_officers.department_id', 'departments.id')
            ->get();

            //display officer for OPAG
            $displayOfficersOPAG = DB::table('cert_officers')
            ->select('cert_officers.*', 'officers.*', 'positions.*', 'departments.*', 'cert_officers.id')
            ->where('department', 'OPAG')
            ->join('officers', 'cert_officers.officer_id', 'officers.id')
            ->join('positions', 'cert_officers.position_id', 'positions.id')
            ->join('departments', 'cert_officers.department_id', 'departments.id')
            ->get();

            //display officer for PVET
            $displayOfficersPVET = DB::table('cert_officers')
            ->select('cert_officers.*', 'officers.*', 'positions.*', 'departments.*', 'cert_officers.id')
            ->where('department', 'PVET')
            ->join('officers', 'cert_officers.officer_id', 'officers.id')
            ->join('positions', 'cert_officers.position_id', 'positions.id')
            ->join('departments', 'cert_officers.department_id', 'departments.id')
            ->get();

            //display officer for PHO
            $displayOfficersPHO= DB::table('cert_officers')
            ->select('cert_officers.*', 'officers.*', 'positions.*', 'departments.*', 'cert_officers.id')
            ->where('department', 'PHO')
            ->join('officers', 'cert_officers.officer_id', 'officers.id')
            ->join('positions', 'cert_officers.position_id', 'positions.id')
            ->join('departments', 'cert_officers.department_id', 'departments.id')
            ->get();

            //display officer for District Hospitals
            $displayOfficersDH= DB::table('cert_officers')
            ->select('cert_officers.*', 'officers.*', 'positions.*', 'departments.*', 'cert_officers.id')
            ->where([['department', 'ADH'], ['cert_officers.officer_id', 26]])
            ->orWhere([['department', 'DMDH'], ['cert_officers.officer_id', 30]])
            ->orWhere([['department', 'IDH'], ['cert_officers.officer_id', 33]])
            ->orWhere([['department', 'KDH'], ['cert_officers.officer_id', 35]])
            ->orWhere([['department', 'NBDH'], ['cert_officers.officer_id', 36]])
            ->join('officers', 'cert_officers.officer_id', 'officers.id')
            ->join('positions', 'cert_officers.position_id', 'positions.id')
            ->join('departments', 'cert_officers.department_id', 'departments.id')
            ->get();
                
            $acc_data = LandTaxAccount::where('info_id', $request->id)->get();
            
            date_default_timezone_set("Asia/Hong_Kong");
            $current_date = date('m/d/Y H:i');

            // if (count($serials) < 1) {
            //     return abort(403,'Oops! your unit is not assigned to a series.');
            // }
            return view('pages.cash_collections', ['ip'=>$ip, 'current_date'=>$current_date, 'acc_data'=>$acc_data, 'displayCategories'=>$displayCategories, 'serials'=>$serials, 'displayCustType'=>$displayCustType, 'displayOfficers'=>$displayOfficers, 'displayOfficersOPAG'=>$displayOfficersOPAG, 'displayOfficersPVET'=>$displayOfficersPVET, 'displayOfficersPHO'=>$displayOfficersPHO, 'displayOfficersDH'=>$displayOfficersDH]);
        } else {
            return abort(403, 'No Authorization to Access this page!');
        }
        
    }

    /**
     * Display Provincial Income Report page
     *
     * @return \Illuminate\View\View
     */
    public function provincial_income_report()
    {
        $displayOfficers = DB::table('cert_officers')
        ->select('cert_officers.*', 'officers.*', 'positions.*', 'departments.*', 'cert_officers.id')
        ->where('deleted_at', null)
        ->join('officers', 'cert_officers.officer_id', 'officers.id')
        ->join('positions', 'cert_officers.position_id', 'positions.id')
        ->join('departments', 'cert_officers.department_id', 'departments.id')
        ->get();

        $accCategories = Post::all();
        $accGroups = AccountGroup::all();
        $accTitles = AccountTitles::select('*', 'account_titles.id')
        ->where('account_titles.title_pos', '<>', 0)
        ->orderBy('account_titles.title_pos', 'asc')
        ->get();
        
        $accSubtitles = AccountSubtitles::select('account_subtitles.id AS main_id', 'account_subtitles.*', 'account_subtitles.id')
        ->get();

        // $nested_subtitles = DB::table('account_sub_subtitles')->where('account_subtitles.deleted_at', null)->join('account_subtitles', 'account_sub_subtitles.subtitle_id', 'account_subtitles.id')->get();
        
        $accSubSubtitles = AccountSubSubtitles::select('*', 'account_sub_subtitles.id')
        ->get();

        return view('pages.provincial_income_report', ['displayOfficers'=>$displayOfficers, 'accGroups'=>$accGroups, 'accCategories'=>$accCategories, 'accTitles'=>$accTitles, 'accSubtitles'=>$accSubtitles, 'accSubSubtitles'=>$accSubSubtitles]);
    }

    /**
     * Display Cash Collections & Deposits Report page
     *
     * @return \Illuminate\View\View
     */
    public function cash_collections_deposits()
    {
        $acc_categories = DB::table("posts")->where('deleted_at', null)->orderBy('id','asc')->get();
        $report_officers = DB::table('cert_officers')->select('officers.*', 'positions.*', 'departments.*')->join('officers', 'cert_officers.officer_id', 'officers.id')->join('positions', 'cert_officers.position_id', 'positions.id')->join('departments', 'cert_officers.department_id', 'departments.id')->get();

        $displayTaxData = DB::table('land_tax_infos')
        ->select('land_tax_infos.id AS main_id', 'land_tax_infos.*', 'serials.*', 'access_p_c_s.*', 'access_p_c_s.id AS user_name', 'municipalities.*', 'municipalities.municipality AS mun_name')
        ->where('land_tax_infos.deleted_at', null)
        ->join('serials', 'land_tax_infos.series_id', 'serials.id')
        ->join('access_p_c_s', 'land_tax_infos.user_ip', 'access_p_c_s.id')
        ->join('municipalities', 'land_tax_infos.id', 'municipalities.id')
        ->get();

        $displayOfficers = DB::table('cert_officers')
        ->select('cert_officers.*', 'officers.*', 'positions.*', 'departments.*', 'cert_officers.id')
        ->where('deleted_at', null)
        ->join('officers', 'cert_officers.officer_id', 'officers.id')
        ->join('positions', 'cert_officers.position_id', 'positions.id')
        ->join('departments', 'cert_officers.department_id', 'departments.id')
        ->get();

        return view('pages.cash_collections_deposits', ['acc_categories'=>$acc_categories, 'report_officers'=>$report_officers, 'displayTaxData'=>$displayTaxData, 'displayOfficers'=>$displayOfficers]);
    }

    /**
     * Display Counter Check Reports page
     *
     * @return \Illuminate\View\View
     */
    public function counter_check_reports()
    {
        return view('pages.counter_check_reports');
    }

    /**
     * Display Counter Check Reports page
     *
     * @return \Illuminate\View\View
     */
    public function accounts_receivable(Request $request)
    {
        $displayCustType = CustomerType::all();
        $ip = request()->ip();
        $serials = DB::table('access_p_c_s')
        ->select('serials.*', DB::raw('CONCAT(start_serial,"-", end_serial, " ", unit, " ", acc_category_settings) AS Serial'))
        ->where('assigned_ip', $ip)
        ->join('serials', 'access_p_c_s.serial_id', 'serials.id')
        ->join('posts', 'serials.fund_id', 'posts.id')->orderBy('serial_id', 'desc')
        ->limit(1)
        ->get();

        $fieldSerials = DB::table('serials')
        ->select('serials.*', DB::raw('CONCAT(start_serial,"-", end_serial, " ", unit, " ", acc_category_settings) AS Serial'))
        ->where('unit', 'Pad')
        ->orderBy('start_serial', 'desc')
        ->join('posts', 'serials.fund_id', 'posts.id')
        ->limit(1)
        ->get();

        $displayCategories = DB::table('posts')->select(DB::raw('GROUP_CONCAT(acc_category_settings SEPARATOR ",") AS "ACC"'))->get();
        $displayCategories = explode(",",$displayCategories[0]->ACC);
        
        $displayOfficers = DB::table('cert_officers')
        ->select('cert_officers.*', 'officers.*', 'positions.*', 'departments.*', 'cert_officers.id')
        ->where('deleted_at', null)
        ->join('officers', 'cert_officers.officer_id', 'officers.id')
        ->join('positions', 'cert_officers.position_id', 'positions.id')
        ->join('departments', 'cert_officers.department_id', 'departments.id')
        ->get();
            
        $displayTaxID = DB::table('access_p_c_s')->where('deleted_at', null)->get();
        $acc_data = LandTaxAccount::where('info_id', $request->id)->get();

        // if (count($serials) < 1) {
        //     return abort(403,'Oops! your unit is not assigned to a series.');
        // }
        return view('pages.accounts_receivable', ['ip'=>$ip, 'acc_data'=>$acc_data, 'displayTaxID'=>$displayTaxID, 'displayCategories'=>$displayCategories, 'serials'=>$serials, 'fieldSerials'=>$fieldSerials, 'displayCustType'=>$displayCustType, 'displayOfficers'=>$displayOfficers]);
    }

    /**
     * Display Counter Memo page
     *
     * @return \Illuminate\View\View
     */
    public function memo()
    {
        return view('pages.memo');
    }

    /**
     * Display Counter Account Access page
     *
     * @return \Illuminate\View\View
     */
    public function account_access()
    {
        $year = 2022;
        $accCategories = Post::all();
        $accGroups = AccountGroup::all();
        $accTitles = AccountTitles::all();
        $accSubtitles = AccountSubtitles::all();
        $rateChange = RateChange::latest()->first();

        $accSubSubtitles = AccountSubSubtitles::select('*', 'budget_estimates.amount AS budget', 'account_sub_subtitles.id')
        ->where('budget_estimates.year', $year)
        ->leftJoin('budget_estimates', 'account_sub_subtitles.id', 'budget_estimates.sub_subtitles_id')
        ->get();

        return view('pages.account_access', ['rateChange'=>$rateChange, 'accCategories'=>$accCategories, 'accGroups'=>$accGroups, 'accTitles'=>$accTitles, 'accSubtitles'=>$accSubtitles, 'accSubSubtitles'=>$accSubSubtitles]);
    }
}