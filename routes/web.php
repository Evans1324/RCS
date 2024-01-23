<?php

use App\Http\Controllers\AccGrpSettingsController;
use App\Http\Controllers\AccountGroupController;
use App\Http\Controllers\AccountSubtitlesController;
use App\Http\Controllers\AccountTitlesController;
use App\Http\Controllers\CustomerTypeController;
use App\Http\Controllers\Form56Controller;
use App\Http\Controllers\HolidaysController;
use App\Http\Controllers\HospitalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReportOfficersController;
use App\Http\Controllers\CollectionRatesController;
use App\Http\Controllers\RateChangeController;
use App\Http\Controllers\SerialController;
use App\Http\Controllers\SerialSGController;
use App\Http\Controllers\AccessPCController;
use App\Http\Controllers\LandTaxColController;
use App\Http\Controllers\MunicipalityController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CertificationController;
use App\Http\Controllers\ProvincialPermitController;
use App\Http\Controllers\CollectionsDeposits;
use App\Http\Controllers\ContractorsController;
use App\Http\Controllers\PermitteesController;
use App\Http\Controllers\PermitFeesDataBankController;
use App\Http\Controllers\SpecialCaseController;
use App\Http\Controllers\BiddersController;
use App\Http\Controllers\RentalsController;
use App\Http\Controllers\MunicipalReceiptController;
use App\Http\Controllers\sgMonthlyController;
use App\Http\Controllers\CashCollectionsController;
use App\Http\Controllers\CashCollectionReportController;
use App\Http\Controllers\procincialIncomeReportController;
use App\Http\Controllers\BudgetEstimateController;
use App\Http\Controllers\DistrictHospitalController;
use App\Http\Controllers\CashReportController;
use App\Http\Controllers\CounterCheckController;
use App\Http\Controllers\AccountSubSubtitlesController;
use App\Http\Controllers\AccountsReceivableController;
use App\Http\Controllers\MemoController;
use App\Http\Controllers\BankDetailsController;
use App\Http\Controllers\AccountAccessController;
use App\Http\Controllers\RealPropertyTaxController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return view('auth/login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('icons', ['as' => 'pages.icons', 'uses' => 'App\Http\Controllers\PageController@icons']);
	Route::get('notifications', ['as' => 'pages.notifications', 'uses' => 'App\Http\Controllers\PageController@notifications']);
	Route::get('customer_payor', ['as' => 'pages.customer_payor', 'uses' => 'App\Http\Controllers\PageController@customer_payor']);
	Route::get('account_category_settings', ['as' => 'pages.account_category_settings', 'uses' => 'App\Http\Controllers\PageController@account_category_settings']);
	Route::get('form_56', ['as' => 'pages.form_56', 'uses' => 'App\Http\Controllers\PageController@form_56']);
	Route::get('account_group_settings', ['as' => 'pages.account_group_settings', 'uses' => 'App\Http\Controllers\PageController@account_group_settings']);
	Route::get('district_hospital', ['as' => 'pages.district_hospital', 'uses' => 'App\Http\Controllers\PageController@district_hospital']);
	Route::get('account_titles', ['as' => 'pages.account_titles', 'uses' => 'App\Http\Controllers\PageController@account_titles']);
	Route::get('account_subtitles', ['as' => 'pages.account_subtitles', 'uses' => 'App\Http\Controllers\PageController@account_subtitles']);
	Route::get('budget_estimate', ['as' => 'pages.budget_estimate', 'uses' => 'App\Http\Controllers\PageController@budget_estimate']);
	Route::get('collection_rates', ['as' => 'pages.collection_rates', 'uses' => 'App\Http\Controllers\PageController@collection_rates']);
	Route::get('report_officer', ['as' => 'pages.report_officer', 'uses' => 'App\Http\Controllers\PageController@report_officer']);
	Route::get('customer_type', ['as' => 'pages.customer_type', 'uses' => 'App\Http\Controllers\PageController@customer_type']);
	Route::get('holidays', ['as' => 'pages.holidays', 'uses' => 'App\Http\Controllers\PageController@holidays']);
	Route::get('accountable_forms', ['as' => 'pages.accountable_forms', 'uses' => 'App\Http\Controllers\PageController@accountable_forms']);
	Route::get('serial', ['as' => 'pages.serial', 'uses' => 'App\Http\Controllers\PageController@serial']);
	Route::get('serial_sg', ['as' => 'pages.serial_sg', 'uses' => 'App\Http\Controllers\PageController@serial_sg']);
	Route::get('access_pc', ['as' => 'pages.access_pc', 'uses' => 'App\Http\Controllers\PageController@access_pc']);
	Route::get('land_tax_collection', ['as' => 'pages.land_tax_collection', 'uses' => 'App\Http\Controllers\PageController@land_tax_collection']);
	Route::get('accounts_daily_reports', ['as' => 'pages.accounts_daily_reports', 'uses' => 'App\Http\Controllers\PageController@accounts_daily_reports']);
	Route::get('collections_deposits', ['as' => 'pages.collections_deposits', 'uses' => 'App\Http\Controllers\PageController@collections_deposits']);
	Route::get('property_tax', ['as' => 'pages.property_tax', 'uses' => 'App\Http\Controllers\PageController@property_tax']);
	Route::get('special_case', ['as' => 'pages.special_case', 'uses' => 'App\Http\Controllers\PageController@special_case']);
	Route::get('contractors', ['as' => 'pages.contractors', 'uses' => 'App\Http\Controllers\PageController@contractors']);
	Route::get('permittees_sg', ['as' => 'pages.permittees_sg', 'uses' => 'App\Http\Controllers\PageController@permittees_sg']);
	Route::get('permittees_others', ['as' => 'pages.permittees_others', 'uses' => 'App\Http\Controllers\PageController@permittees_others']);
	Route::get('cutoffs', ['as' => 'pages.cutoffs', 'uses' => 'App\Http\Controllers\PageController@cutoffs']);
	Route::get('client_input', ['as' => 'pages.client_input', 'uses' => 'App\Http\Controllers\PageController@client_input']);
	Route::get('mun_receipts', ['as' => 'pages\municipalReceipts.municipal_receipt', 'uses' => 'App\Http\Controllers\PageController@mun_receipts']);
	Route::get('sandgravel_monthly_report', ['as' => 'pages.sandgravel_monthly_report', 'uses' => 'App\Http\Controllers\PageController@sandgravel_monthly_report']);
	Route::get('cash_collections', ['as' => 'pages.cash_collections', 'uses' => 'App\Http\Controllers\PageController@cash_collections']);
	Route::get('provincial_income_report', ['as' => 'pages.provincial_income_report', 'uses' => 'App\Http\Controllers\PageController@provincial_income_report']);
	Route::get('cash_collections_deposits', ['as' => 'pages.cash_collections_deposits', 'uses' => 'App\Http\Controllers\PageController@cash_collections_deposits']);
	Route::get('counter_check_reports', ['as' => 'pages.counter_check_reports', 'uses' => 'App\Http\Controllers\PageController@counter_check_reports']);
	Route::get('accounts_receivable', ['as' => 'pages.accounts_receivable', 'uses' => 'App\Http\Controllers\PageController@accounts_receivable']);
	Route::get('memo', ['as' => 'pages.memo', 'uses' => 'App\Http\Controllers\PageController@memo']);
	Route::get('account_access', ['as' => 'pages.account_access', 'uses' => 'App\Http\Controllers\PageController@account_access']);
	Route::get('property_tax_sef', ['as' => 'pages.property_tax_sef', 'uses' => 'App\Http\Controllers\PageController@property_tax_sef']);
}); 

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});



// Route::get('account_category_settings', [PostController::class, 'index']);
Route::post('store-form', [PostController::class, 'store']);
Route::post('soft_delete_data', [PostController::class, 'getDeletedData'])->name('soft_delete_data');

Route::post('account-group-form', [AccountGroupController::class, 'accountGroup']);
Route::post('group_soft_delete', [AccountGroupController::class, 'getGroupDelData'])->name('group_soft_delete');

Route::post('update_form56', [Form56Controller::class, 'updateForm56Data'])->name('update_form56');

Route::post('insert_hospital_data', [HospitalController::class, 'hospital'])->name('insert_hospital_data');
Route::post('soft_delete_hospital', [HospitalController::class, 'getHospitalDeletedData'])->name('soft_delete_hospital');

Route::post('account_titles_form', [AccountTitlesController::class, 'acountTitlesInsert'])->name('account_titles_form');
Route::post('titles_soft_delete', [AccountTitlesController::class, 'deleteTitles'])->name('titles_soft_delete');

Route::post('account_subtitles_form', [AccountSubtitlesController::class, 'acountSubtitlesInsert'])->name('account_subtitles_form');
Route::post('subtitles_soft_delete', [AccountSubtitlesController::class, 'accountSubtitlesDelete'])->name('subtitles_soft_delete');

Route::post('submitNestedSubtitles', [AccountSubSubtitlesController::class, 'submitNestedSubtitles'])->name('submitNestedSubtitles');
Route::post('accountNestedSubtitlesDelete', [AccountSubSubtitlesController::class, 'accountNestedSubtitlesDelete'])->name('accountNestedSubtitlesDelete');

Route::post('report_officers_form', [ReportOfficersController::class, 'officerDataInsert'])->name('report_officers_form');
Route::post('report_officers_delete', [ReportOfficersController::class, 'officerDataDelete'])->name('report_officers_delete');

Route::post('customer_type_form', [CustomerTypeController::class, 'customerTypeInsert'])->name('customer_type_form');
Route::post('customer_type_delete', [CustomerTypeController::class, 'customerTypeDelete'])->name('customer_type_delete');

Route::post('holidays_form', [HolidaysController::class, 'holidaysDataInsert'])->name('holidays_form');
Route::post('holidays_delete', [HolidaysController::class, 'holidaysDataDelete'])->name('holidays_delete');
Route::post('adjustReportDate', [HolidaysController::class, 'adjustReportDate'])->name('adjustReportDate');

Route::post('getTitleRate', [CollectionRatesController::class, 'getTitleRate'])->name('getTitleRate');
Route::post('getSubtitleRate', [CollectionRatesController::class, 'getSubtitleRate'])->name('getSubtitleRate');

Route::post('submit_collection_rate', [RateChangeController::class, 'submitRateChange'])->name('submit_collection_rate');
Route::post('accountAccessForm', [RateChangeController::class, 'accountAccessForm'])->name('accountAccessForm');
Route::post('getActiveAccounts', [RateChangeController::class, 'getActiveAccounts'])->name('getActiveAccounts');

Route::post('submit_serial_form', [SerialController::class, 'insertSerialData'])->name('submit_serial_form');
Route::post('delete_serial_form', [SerialController::class, 'deleteSerialData'])->name('delete_serial_form');
Route::post('getCurrentSerial', [SerialController::class, 'getCurrentSerial'])->name('getCurrentSerial');
Route::post('getCurrentSerialCash', [SerialController::class, 'getCurrentSerialCash'])->name('getCurrentSerialCash');
Route::post('getSeriesRPT', [SerialController::class, 'getSeriesRPT'])->name('getSeriesRPT');
Route::post('getSeriesSEF', [SerialController::class, 'getSeriesSEF'])->name('getSeriesSEF');
Route::post('updateSerialStatus', [SerialController::class, 'updateSerialStatus'])->name('updateSerialStatus');

Route::post('submit_serial_sg_form', [SerialSGController::class, 'insertSerialSGData'])->name('submit_serial_sg_form');
Route::post('delete_serial_sg_form', [SerialSGController::class, 'deleteSerialSGData'])->name('delete_serial_sg_form');
Route::post('sgDeliveryReceipts', [SerialSGController::class, 'sgDeliveryReceipts'])->name('sgDeliveryReceipts');
Route::get('getCurrentDeliveryReceipts', [SerialSGController::class, 'getCurrentDeliveryReceipts'])->name('getCurrentDeliveryReceipts');
Route::post('getCurrentSeriesSG', [SerialSGController::class, 'getCurrentSeriesSG'])->name('getCurrentSeriesSG');

Route::post('submit_pc_form', [AccessPCController::class, 'insertPCData'])->name('submit_pc_form');
Route::post('delete_pc_form', [AccessPCController::class, 'deletePCData'])->name('delete_pc_form');
Route::post('getFormData', [AccessPCController::class, 'getFormData'])->name('getFormData');

Route::post('getBarangays', [MunicipalityController::class, 'getBarangays'])->name('getBarangays');
Route::post('getMunicipality', [MunicipalityController::class, 'getMunicipality'])->name('getMunicipality');
Route::post('getMunBar', [MunicipalityController::class, 'getMunBar'])->name('getMunBar');

Route::post('land_tax_form', [LandTaxColController::class, 'insertLandTax'])->name('land_tax_form');
Route::post('land_tax_form_del', [LandTaxColController::class, 'deleteLandTaxData'])->name('land_tax_form_del');
Route::post('land_tax_acc_data', [LandTaxColController::class, 'getAccountsData'])->name('land_tax_acc_data');
Route::post('getSeries', [LandTaxColController::class, 'getSeries'])->name('getSeries');
Route::post('getSeriesCash', [LandTaxColController::class, 'getSeriesCash'])->name('getSeriesCash');
Route::post('getIndividualsLastName', [LandTaxColController::class, 'getIndividualsLastName'])->name('getIndividualsLastName');
Route::post('getIndividualsFirsttName', [LandTaxColController::class, 'getIndividualsFirsttName'])->name('getIndividualsFirsttName');
Route::post('updateReceiptStatus', [LandTaxColController::class, 'updateReceiptStatus'])->name('updateReceiptStatus');
Route::post('getSeriesSG', [LandTaxColController::class, 'getSeriesSG'])->name('getSeriesSG');
Route::post('getReceiptData', [LandTaxColController::class, 'getReceiptData'])->name('getReceiptData');
Route::post('updateToPrintedStatus', [LandTaxColController::class, 'updateToPrintedStatus'])->name('updateToPrintedStatus');
Route::post('openReceiptAction', [LandTaxColController::class, 'openReceiptAction'])->name('openReceiptAction');
Route::post('updateSeriesStatus', [LandTaxColController::class, 'updateSeriesStatus'])->name('updateSeriesStatus');
// Route::post('land_tax_series_counter', [LandTaxColController::class, 'seriesCounter'])->name('land_tax_series_counter');

Route::post('getAccountTitles', [CollectionRatesController::class, 'getAccountTitles'])->name('getAccountTitles');
Route::post('getSchedules', [CollectionRatesController::class, 'getSchedules'])->name('getSchedules');
Route::post('getCollData', [CollectionRatesController::class, 'getCollData'])->name('getCollData');
Route::post('getContractors', [CollectionRatesController::class, 'getContractors'])->name('getContractors');
Route::post('getPermitFeesTradeName', [CollectionRatesController::class, 'getPermitFeesTradeName'])->name('getPermitFeesTradeName');
Route::post('getPermitteesTradeName', [CollectionRatesController::class, 'getPermitteesTradeName'])->name('getPermitteesTradeName');
Route::post('saveYearSelected', [CollectionRatesController::class, 'saveYearSelected'])->name('saveYearSelected');

Route::get('getWordTemplate/{id}', [PageController::class, 'getWordTemplate', 'as'=>'id'])->name('getWordTemplate');
Route::get('printReceipt/{id}', [PageController::class, 'printReceipt', 'as'=>'id'])->name('printReceipt');
Route::get('printReceiptRPT/{id}', [PageController::class, 'printReceiptRPT', 'as'=>'id'])->name('printReceiptRPT');
Route::get('printCollectionsDeposits/{id}', [PageController::class, 'printCollectionsDeposits', 'as'=>'id'])->name('printCollectionsDeposits');

Route::post('cert_form', [CertificationController::class, 'insertCertData'])->name('cert_form');
Route::post('getCertificateDetails', [CertificationController::class, 'getCertificateDetails'])->name('getCertificateDetails');

Route::post('getPositions', [CollectionsDeposits::class, 'getPositions'])->name('getPositions');
Route::post('submitCollectionDepositReport', [CollectionsDeposits::class, 'submitCollectionDepositReport'])->name('submitCollectionDepositReport');

Route::post('saveNewContractorsForm', [ContractorsController::class, 'saveNewContractors'])->name('saveNewContractorsForm');
Route::post('addNewContractorsForm', [ContractorsController::class, 'addNewContractors'])->name('addNewContractorsForm');
Route::post('deleteContractorsForm', [ContractorsController::class, 'deleteContractors'])->name('deleteContractorsForm');
Route::post('getContractorsData', [ContractorsController::class, 'getContractorsData'])->name('getContractorsData');

Route::post('saveNewPermitteesForm', [PermitteesController::class, 'saveNewPermittees'])->name('saveNewPermitteesForm');
Route::post('deletePermitteesForm', [PermitteesController::class, 'deletePermittees'])->name('deletePermitteesForm');
Route::post('saveNewPermitteesRevenueTax', [PermitteesController::class, 'saveNewPermitteesRevenueTax'])->name('saveNewPermitteesRevenueTax');

Route::post('saveNewPermitteesOthersForm', [PermitFeesDataBankController::class, 'saveNewPermitteesOthers'])->name('saveNewPermitteesOthersForm');
Route::post('addNewPermitteesOthersForm', [PermitFeesDataBankController::class, 'addNewPermitteesOthers'])->name('addNewPermitteesOthersForm');
Route::post('deletePermitteesOthersForm', [PermitFeesDataBankController::class, 'deletePermitteesOthers'])->name('deletePermitteesOthersForm');

Route::post('saveReportCutoffForm', [CutOffsController::class, 'saveReportCutoff'])->name('saveReportCutoffForm');
Route::post('deleteReportCutoffForm', [CutOffsController::class, 'deleteReportCutoff'])->name('deleteReportCutoffForm');

Route::post('submitSpecialCaseForm', [SpecialCaseController::class, 'specialCaseSharing'])->name('submitSpecialCaseForm');
Route::post('deleteSpecialCaseForm', [SpecialCaseController::class, 'deleteSharing'])->name('deleteSpecialCaseForm');

Route::post('insertBiidersInfo', [BiddersController::class, 'insertBiidersInfo'])->name('insertBiidersInfo');
Route::post('biddersAutoComplete', [BiddersController::class, 'biddersAutoComplete'])->name('biddersAutoComplete');

Route::post('rentalsAutoComplete', [RentalsController::class, 'rentalsAutoComplete'])->name('rentalsAutoComplete');
Route::post('insertRentalsInfo', [RentalsController::class, 'insertRentalsInfo'])->name('insertRentalsInfo');

Route::post('submit_mun_receipt_form', [MunicipalReceiptController::class, 'setMunicipalReceipts'])->name('submit_mun_receipt_form');
Route::post('update_mun_receipt_form', [MunicipalReceiptController::class, 'updateMunicipalReceipts'])->name('update_mun_receipt_form');
Route::post('delete_mun_receipt_form', [MunicipalReceiptController::class, 'deleteMunicipalReceipts'])->name('delete_mun_receipt_form');
// Route::get('generateCertificate/{id}', [PageController::class, 'generateCertificate', 'as'=>'id'])->name('generateCertificate');

Route::post('generateMonthlyReportSG', [sgMonthlyController::class, 'generateMonthlyReportSG'])->name('generateMonthlyReportSG');

Route::post('getCashReceiptData', [CashCollectionsController::class, 'getCashReceiptData'])->name('getCashReceiptData');
Route::post('getOPAGReceiptData', [CashCollectionsController::class, 'getOPAGReceiptData'])->name('getOPAGReceiptData');
Route::post('getPVETReceiptData', [CashCollectionsController::class, 'getPVETReceiptData'])->name('getPVETReceiptData');
Route::post('getPHOReceiptData', [CashCollectionsController::class, 'getPHOReceiptData'])->name('getPHOReceiptData');
Route::post('getHospitalReceiptData', [CashCollectionsController::class, 'getHospitalReceiptData'])->name('getHospitalReceiptData');
Route::post('getIndividualsLastNameCash', [CashCollectionsController::class, 'getIndividualsLastNameCash'])->name('getIndividualsLastNameCash');
Route::post('getIndividualsFirsttNameCash', [CashCollectionsController::class, 'getIndividualsFirsttNameCash'])->name('getIndividualsFirsttNameCash');
Route::post('submitCashCollections', [CashCollectionsController::class, 'submitCashCollections'])->name('submitCashCollections');
Route::post('getAccountTitlesCash', [CashCollectionsController::class, 'getAccountTitlesCash'])->name('getAccountTitlesCash');
Route::post('getAccountTitlesOpag', [CashCollectionsController::class, 'getAccountTitlesOpag'])->name('getAccountTitlesOpag');
Route::post('getAccountTitlesPvet', [CashCollectionsController::class, 'getAccountTitlesPvet'])->name('getAccountTitlesPvet');
Route::post('getAccountTitlesPho', [CashCollectionsController::class, 'getAccountTitlesPho'])->name('getAccountTitlesPho');
Route::post('deleteCashData', [CashCollectionsController::class, 'deleteCashData'])->name('deleteCashData');
Route::post('deleteHospitalData', [CashCollectionsController::class, 'deleteHospitalData'])->name('deleteHospitalData');
Route::post('updateReceiptStatusCash', [CashCollectionsController::class, 'updateReceiptStatusCash'])->name('updateReceiptStatusCash');

Route::post('generateProvIncomeReport', [procincialIncomeReportController::class, 'generateProvIncomeReport'])->name('generateProvIncomeReport');
Route::post('getAccountTitlesPIR', [procincialIncomeReportController::class, 'getAccountTitlesPIR'])->name('getAccountTitlesPIR');

Route::post('budgetEstimateField', [BudgetEstimateController::class, 'budgetEstimateField'])->name('budgetEstimateField');
Route::post('yearlyBudget', [BudgetEstimateController::class, 'yearlyBudget'])->name('yearlyBudget');

Route::post('submitDistrictHospitals', [DistrictHospitalController::class, 'submitDistrictHospitals'])->name('submitDistrictHospitals');

Route::post('generateCashReport', [CashReportController::class, 'generateCashReport'])->name('generateCashReport');

Route::post('generateProvIncomeCounterCheck', [CounterCheckController::class, 'generateProvIncomeCounterCheck'])->name('generateProvIncomeCounterCheck');
Route::post('generateProvIncomeCounterCheckExcel', [CounterCheckController::class, 'generateProvIncomeCounterCheckExcel'])->name('generateProvIncomeCounterCheckExcel');
Route::post('counterCheckAllExcelReport', [CounterCheckController::class, 'counterCheckAllExcelReport'])->name('counterCheckAllExcelReport');

Route::post('getAccountsReceivableData', [AccountsReceivableController::class, 'getAccountsReceivableData'])->name('getAccountsReceivableData');

Route::post('generateAccTitles', [MemoController::class, 'generateAccTitles'])->name('generateAccTitles');
Route::post('saveMemoTransaction', [MemoController::class, 'saveMemoTransaction'])->name('saveMemoTransaction');
Route::post('deleteMemoData', [MemoController::class, 'deleteMemoData'])->name('deleteMemoData');
Route::post('cancelMemoData', [MemoController::class, 'cancelMemoData'])->name('cancelMemoData');
Route::post('restoreMemoData', [MemoController::class, 'restoreMemoData'])->name('restoreMemoData');
Route::post('getMemoTransactionData', [MemoController::class, 'getMemoTransactionData'])->name('getMemoTransactionData');

Route::post('check_form', [BankDetailsController::class, 'insertCheck'])->name('check_form');
Route::post('viewCheckDetails', [BankDetailsController::class, 'viewCheckDetails'])->name('viewCheckDetails');

Route::post('rptSumbmitForm', [RealPropertyTaxController::class, 'rptSumbmitForm'])->name('rptSumbmitForm');
Route::post('rptSubmitFormSEF', [RealPropertyTaxController::class, 'rptSubmitFormSEF'])->name('rptSubmitFormSEF');
Route::post('getAccountTitlesSEF', [RealPropertyTaxController::class, 'getAccountTitlesSEF'])->name('getAccountTitlesSEF');
Route::post('getSEFTransactionData', [RealPropertyTaxController::class, 'getSEFTransactionData'])->name('getSEFTransactionData');
Route::post('getReceiptRPTData', [RealPropertyTaxController::class, 'getReceiptRPTData'])->name('getReceiptRPTData');
Route::post('deleteDataSEF', [RealPropertyTaxController::class, 'deleteDataSEF'])->name('deleteDataSEF');
Route::post('cancelDataSEF', [RealPropertyTaxController::class, 'cancelDataSEF'])->name('cancelDataSEF');
Route::post('restoreDataSEF', [RealPropertyTaxController::class, 'restoreDataSEF'])->name('restoreDataSEF');
Route::post('getBarangaysOnly', [RealPropertyTaxController::class, 'getBarangaysOnly'])->name('getBarangaysOnly');
Route::post('getClassification', [RealPropertyTaxController::class, 'getClassification'])->name('getClassification');
Route::post('getFullPartial', [RealPropertyTaxController::class, 'getFullPartial'])->name('getFullPartial');
Route::post('updateSeriesStatusSEF', [RealPropertyTaxController::class, 'updateSeriesStatusSEF'])->name('updateSeriesStatusSEF');
Route::post('getRPTData', [RealPropertyTaxController::class, 'getRPTData'])->name('getRPTData');
Route::post('deleteDataRPT', [RealPropertyTaxController::class, 'deleteDataRPT'])->name('deleteDataRPT');
Route::post('cancelDataRPT', [RealPropertyTaxController::class, 'cancelDataRPT'])->name('cancelDataRPT');
Route::post('restoreDataRPT', [RealPropertyTaxController::class, 'restoreDataRPT'])->name('restoreDataRPT');
Route::post('openRPTReceipt', [RealPropertyTaxController::class, 'openRPTReceipt'])->name('openRPTReceipt');
