<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-normal">{{ __('Revenue Collection System') }}</a>
        </div>
        @if (Auth::user()->id == 1 && Auth::user()->office == "Revenue")
            <ul class="nav">
                <li @if ($pageSlug == 'dashboard') class="active " @endif>
                    <a href="{{ route('home') }}">
                        <i class="tim-icons icon-chart-pie-36"></i>
                        <p>{{ __('Dashboard') }}</p>
                    </a>
                </li>
                <li @if ($pageSlug == 'land_tax_collection') class="active " @endif>
                    <a href="{{ route('pages.land_tax_collection') }}">
                        <i class="tim-icons icon-atom"></i>
                        <p>{{ __('Revenue Collection') }}</p>
                    </a>
                </li>
                <li @if ($pageSlug == 'accounts_receivable') class="active " @endif>
                    <a href="{{ route('pages.accounts_receivable') }}">
                        <i class="tim-icons icon-app"></i>
                        <p>{{ __('Accounts Reeceivable') }}</p>
                    </a>
                </li>
                <li @if ($pageSlug == 'memo') class="active " @endif>
                    <a href="{{ route('pages.memo') }}">
                        <i class="tim-icons icon-vector"></i>
                        <p>{{ __('Memo Entry') }}</p>
                    </a>
                </li>
                <li>
                    <a data-toggle="collapse" href="#collection_reports" aria-expanded="false">
                        <i class="tim-icons icon-chart-bar-32" ></i>
                        <span class="nav-link-text" >{{ __('Collection Reports') }}</span>
                        <b class="caret mt-1"></b>
                    </a>

                    <div class="collapse show" id="collection_reports">
                        <ul class="nav pl-4">
                            <li @if ($pageSlug == 'collections_deposits') class="active " @endif>
                                <a href="{{ route('pages.collections_deposits')  }}">
                                    <i class="tim-icons icon-chart-bar-32"></i>
                                    <p>{{ __('Collections & Deposits') }}</p>
                                </a>
                            </li>

                            <li @if ($pageSlug == 'sandgravel_monthly_report') class="active " @endif>
                                <a href="{{ route('pages.sandgravel_monthly_report')  }}">
                                    <i class="tim-icons icon-coins"></i>
                                    <p>{{ __('S&G Monthly Report') }}</p>
                                </a>
                            </li>

                            <li @if ($pageSlug == 'provincial_income_report') class="active " @endif>
                                <a href="{{ route('pages.provincial_income_report')  }}">
                                    <i class="tim-icons icon-chart-bar-32"></i>
                                    <p>{{ __('Provincial Income Report') }}</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a data-toggle="collapse" href="#counter_check_reports" aria-expanded="false">
                        <i class="tim-icons icon-chart-bar-32" ></i>
                        <span class="nav-link-text" >{{ __('Counter Check Report') }}</span>
                        <b class="caret mt-1"></b>
                    </a>

                    <div class="collapse show" id="counter_check_reports">
                        <ul class="nav pl-4">
                            <li @if ($pageSlug == 'counter_check_reports') class="active " @endif>
                                <a href="{{ route('pages.counter_check_reports')  }}">
                                    <i class="tim-icons icon-chart-bar-32"></i>
                                    <p>{{ __('Accounts Daily') }}</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a data-toggle="collapse" href="#real_property_tax" aria-expanded="true">
                        <i class="tim-icons icon-money-coins" ></i>
                        <span class="nav-link-text" >{{ __('Real Property Tax') }}</span>
                        <b class="caret mt-1"></b>
                    </a>

                    <div class="collapse show" id="real_property_tax">
                        <ul class="nav pl-4">
                            <li @if ($pageSlug == 'property_tax') class="active " @endif>
                                <a href="{{ route('pages.property_tax')  }}">
                                    <i class="tim-icons icon-double-right"></i>
                                    <p>{{ __('Real Property Tax') }}</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a data-toggle="collapse" href="#cash_coll_id" aria-expanded="true">
                        <i class="tim-icons icon-link-72" ></i>
                        <span class="nav-link-text" >{{ __('Cash Divison') }}</span>
                        <b class="caret mt-1"></b>
                    </a>

                    <div class="collapse show" id="cash_coll_id">
                        <ul class="nav pl-4">
                            <li @if ($pageSlug == 'cash_collections') class="active " @endif>
                                <a href="{{ route('pages.cash_collections')  }}">
                                    <i class="tim-icons icon-double-right"></i>
                                    <p>{{ __('Collections') }}</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li @if ($pageSlug == 'customer_payor') class="active " @endif>
                    <a href="{{ route('pages.customer_payor') }}">
                        <i class="tim-icons icon-badge"></i>
                        <p>{{ __('Customer Payor') }}</p>
                    </a>
                </li>
                <li @if ($pageSlug == 'municipal_receipts') class="active " @endif>
                    <a href="{{ route('pages\municipalReceipts.municipal_receipt') }}">
                        <i class="tim-icons icon-bank"></i>
                        <p>{{ __('Municipal Receipts') }}</p>
                    </a>
                </li>
                <li @if ($pageSlug == 'icons') class="active " @endif>
                    <a href="{{ route('pages.icons') }}">
                        <i class="tim-icons icon-atom"></i>
                        <p>{{ __('Icons') }}</p>
                    </a>
                </li>
                <li @if ($pageSlug == 'notifications') class="active " @endif>
                    <a href="{{ route('pages.notifications') }}">
                        <i class="tim-icons icon-bell-55"></i>
                        <p>{{ __('Notifications') }}</p>
                    </a>
                </li>
                <li>
                    <a data-toggle="collapse" href="#system_settings" aria-expanded="true">
                        <i class="tim-icons icon-settings-gear-63" ></i>
                        <span class="nav-link-text" >{{ __('System Settings') }}</span>
                        <b class="caret mt-1"></b>
                    </a>
                    
                    <div class="collapse show" id="system_settings">
                        <ul class="nav pl-4">
                            <li @if ($pageSlug == 'client_input') class="active " @endif>
                                <a href="{{ route('pages.client_input')  }}">
                                    <i class="tim-icons icon-single-02"></i>
                                    <p>{{ __('Client Input') }}</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'customer_type') class="active " @endif>
                                <a href="{{ route('pages.customer_type')  }}">
                                    <i class="tim-icons icon-single-02"></i>
                                    <p>{{ __('Client Type') }}</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'contractors') class="active " @endif>
                                <a href="{{ route('pages.contractors')  }}">
                                    <i class="tim-icons icon-single-02"></i>
                                    <p>{{ __('Contractors') }}</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'permittees_sg') class="active " @endif>
                                <a href="{{ route('pages.permittees_sg')  }}">
                                    <i class="tim-icons icon-single-02"></i>
                                    <p>{{ __('Permittees S&G') }}</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'permittees_others') class="active " @endif>
                                <a href="{{ route('pages.permittees_others')  }}">
                                    <i class="tim-icons icon-single-02"></i>
                                    <p>{{ __('Permittees Others') }}</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'special_case') class="active " @endif>
                                <a href="{{ route('pages.special_case')  }}">
                                    <i class="tim-icons icon-delivery-fast"></i>
                                    <p>{{ __('Special Case') }}</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'cutoffs') class="active " @endif>
                                <a href="{{ route('pages.cutoffs')  }}">
                                    <i class="tim-icons icon-scissors"></i>
                                    <p>{{ __('Report Cutoff') }}</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'district_hospital') class="active " @endif>
                                <a href="{{ route('pages.district_hospital')  }}">
                                    <i class="tim-icons icon-components"></i>
                                    <p>{{ __('Hospitals') }}</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'holidays') class="active " @endif>
                                <a href="{{ route('pages.holidays')  }}">
                                    <i class="tim-icons icon-calendar-60"></i>
                                    <p>{{ __('Holidays') }}</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'report_officer') class="active " @endif>
                                <a href="{{ route('pages.report_officer')  }}">
                                    <i class="tim-icons icon-single-02"></i>
                                    <p>{{ __('Report Officers') }}</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a data-toggle="collapse" href="#collection_settings" aria-expanded="true">
                        <i class="tim-icons icon-settings-gear-63" ></i>
                        <span class="nav-link-text" >{{ __('Collection Settings') }}</span>
                        <b class="caret mt-1"></b>
                    </a>

                    <div class="collapse show" id="collection_settings">
                        <ul class="nav pl-4">
                            <li @if ($pageSlug == 'serial') class="active " @endif>
                                <a href="{{ route('pages.serial')  }}">
                                    <i class="tim-icons icon-single-02"></i>
                                    <p>{{ __('Serial') }}</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'serial_sg') class="active " @endif>
                                <a href="{{ route('pages.serial_sg')  }}">
                                    <i class="tim-icons icon-single-02"></i>
                                    <p>{{ __('Serial SG') }}</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'access_pc') class="active " @endif>
                                <a href="{{ route('pages.access_pc')  }}">
                                    <i class="tim-icons icon-single-02"></i>
                                    <p>{{ __('Access PCs') }}</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'form_56') class="active " @endif>
                                <a href="{{ route('pages.form_56')  }}">
                                    <i class="tim-icons icon-single-copy-04"></i>
                                    <p>{{ __('Form 56') }}</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'account_category_settings') class="active " @endif>
                                <a href="{{ route('pages.account_category_settings')  }}">
                                    <i class="tim-icons icon-single-02"></i>
                                    <p>{{ __('Acc. Category Settings') }}</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'account_group_settings') class="active " @endif>
                                <a href="{{ route('pages.account_group_settings')  }}">
                                    <i class="tim-icons icon-single-02"></i>
                                    <p>{{ __('Acc. Group Settings') }}</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'account_titles') class="active " @endif>
                                <a href="{{ route('pages.account_titles')  }}">
                                    <i class="tim-icons icon-single-02"></i>
                                    <p>{{ __('Account Titles') }}</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'account_subtitles') class="active " @endif>
                                <a href="{{ route('pages.account_subtitles')  }}">
                                    <i class="tim-icons icon-single-02"></i>
                                    <p>{{ __('Account Subtitles') }}</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'account_access') class="active " @endif>
                                <a href="{{ route('pages.account_access')  }}">
                                    <i class="tim-icons icon-single-02"></i>
                                    <p>{{ __('Account Access') }}</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'budget_estimate') class="active " @endif>
                                <a href="{{ route('pages.budget_estimate')  }}">
                                    <i class="tim-icons icon-single-02"></i>
                                    <p>{{ __('Budget Estimate') }}</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'collection_rates') class="active " @endif>
                                <a href="{{ route('pages.collection_rates')  }}">
                                    <i class="tim-icons icon-single-02"></i>
                                    <p>{{ __('Collection Rates') }}</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'collection_rates') class="active " @endif>
                                <a href="{{ route('pages.collection_rates')  }}">
                                    <i class="tim-icons icon-single-02"></i>
                                    <p>{{ __('Collection Rates') }}</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'collection_rates') class="active " @endif>
                                <a href="{{ route('pages.collection_rates')  }}">
                                    <i class="tim-icons icon-single-02"></i>
                                    <p>{{ __('Collection Rates') }}</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        @endif

        @if (Auth::user()->office == "Cash")
            <ul class="nav">
                <li>
                    <a data-toggle="collapse" href="#cash_coll_id" aria-expanded="true">
                        <i class="tim-icons icon-link-72" ></i>
                        <span class="nav-link-text" >{{ __('Cash Divison') }}</span>
                        <b class="caret mt-1"></b>
                    </a>

                    <div class="collapse show" id="cash_coll_id">
                        <ul class="nav pl-4">
                            <li @if ($pageSlug == 'cash_collections') class="active " @endif>
                                <a href="{{ route('pages.cash_collections')  }}">
                                    <i class="tim-icons icon-double-right"></i>
                                    <p>{{ __('Collections') }}</p>
                                </a>
                            </li>

                            <li @if ($pageSlug == 'cash_collections_deposits') class="active " @endif>
                                <a href="{{ route('pages.cash_collections_deposits')  }}">
                                    <i class="tim-icons icon-double-right"></i>
                                    <p>{{ __('Cash Collections Report') }}</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li @if ($pageSlug == 'accounts_receivable') class="active " @endif>
                    <a href="{{ route('pages.accounts_receivable') }}">
                        <i class="tim-icons icon-app"></i>
                        <p>{{ __('Accounts Reeceivable') }}</p>
                    </a>
                </li>

                <li>
                    <a data-toggle="collapse" href="#counter_check_reports" aria-expanded="false">
                        <i class="tim-icons icon-chart-bar-32" ></i>
                        <span class="nav-link-text" >{{ __('Counter Check Report') }}</span>
                        <b class="caret mt-1"></b>
                    </a>

                    <div class="collapse show" id="counter_check_reports">
                        <ul class="nav pl-4">
                            <li @if ($pageSlug == 'counter_check_reports') class="active " @endif>
                                <a href="{{ route('pages.counter_check_reports')  }}">
                                    <i class="tim-icons icon-chart-bar-32"></i>
                                    <p>{{ __('Accounts Daily') }}</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a data-toggle="collapse" href="#collection_settings" aria-expanded="true">
                        <i class="tim-icons icon-settings-gear-63" ></i>
                        <span class="nav-link-text" >{{ __('Collection Settings') }}</span>
                        <b class="caret mt-1"></b>
                    </a>

                    <div class="collapse show" id="collection_settings">
                        <ul class="nav pl-4">
                            <li @if ($pageSlug == 'serial') class="active " @endif>
                                <a href="{{ route('pages.serial')  }}">
                                    <i class="tim-icons icon-single-02"></i>
                                    <p>{{ __('Serial') }}</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        @endif
        
    </div>
</div>
