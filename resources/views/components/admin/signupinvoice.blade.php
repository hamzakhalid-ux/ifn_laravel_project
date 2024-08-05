<div class="container">
    <header>
        <a href="{{url('/')}}" title="logo" class="logo-holder">
            <img src="assets/images/IFN-logo.svg" alt="logo">
        </a>
    </header>
    <main>
        <h2>{{$packagedetail->package_name ?? ''}} PLAN SELECTED</h2>
        <div class="tabs-wrapper">
            <h6>Select Payment Method</h6>
            <div class="tabs">
                {{-- <a href="#tab1" class="tab-btn selected" title="Bank Transfer / Invoice">Bank Transfer / Invoice</a> --}}
                {{-- <a href="#tab2" class="tab-btn" title="Payment / Debit Card">Payment / Debit Card</a> --}}
            </div>
            <div class="tab-content">
                <div class="inner-content active" id="tab1">
                    <div class="head m-b-25">
                        <h6 class="m-0" >Invoice</h6>
                        <div>
                            <a href="{{url("send_invoice/$user_id")}}" class="btn btn-primary">Send me my invoice</a>
                            <a href="{{url("download_invoice/$user_id")}}" class="btn btn-primary">Download</a>
                        </div>
                    </div>
                    <div class="invoice-box">
                        <table class="invoice-table" style="width: 100%; margin-bottom: 35px;" >
                            <tr>
                                <td>
                                    <img src="assets/images/red-money-logo.png" alt="">
                                </td>
                                <td style="text-align: right; font-size: 24px; font-weight: 700; color: #000;">e-Invoice</td>
                            </tr>
                        </table>
                        <table class="invoice-table" style="width: 100%;">
                            <tr>
                                <td colspan="2">
                                    <p style="margin: 0; font-size: 12px; color: #000;">
                                        <span style="font-weight: 500; display: inline-block; min-width: 75px;">Invoice No:</span>IFN-{{($user_id+1)}}
                                    </p>
                                    <p style="margin: 0; font-size: 12px; color: #000;">
                                        <span style="font-weight: 500; display: inline-block; min-width: 75px;">Date:</span>{{date('j/n/Y')}}
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div style="width: 196px;">
                                        <p style="margin: 0; font-size: 12px; font-weight: 700; color: #000;">Bill to : {{($userdetail['first_name'] ?? ''). ' ' .($userdetail['last_name'] ?? '' )}}</p>
                                        <p style="margin: 0; font-size: 12px; font-weight: 700; color: #000; border-top: 1px solid #000;">{{ $userdetail['company'] ?? ''}}</p>
                                    </div>
                                </td>
                                <td>
                                    <div style="width: 196px; margin: auto 0 auto auto;">
                                        <p style="margin: 0; font-size: 12px; font-weight: 700; color: #000;">For :</p>
                                        <p style="margin: 0; font-size: 12px; font-weight: 700; color: #000; border-top: 1px solid #000;">IFN Investor</p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    {{-- <p style="margin: 0; font-size: 12px; color: #000; line-height: 1.4;">
                                        EAB Tower Rue<br>Guynemer<br>B.P 2022, Djibouti
                                    </p>
                                    <p style="margin: 8px 0 5px 0; font-size: 12px; font-weight: 700; color: #000; line-height: 1.4;">
                                        Attn : Muhammad Kashif
                                    </p> --}}
                                </td>
                            </tr>
                        </table>
                        <table class="invoice-table" style="width: 100%; font-size: 12px; color: #000;" cellspacing="0">
                            <tr>
                                <td style="width: 180px; border-top: 1px solid #000; border-bottom: 1px solid #000; padding: 4px 0;">
                                    Subscription Plan
                                </td>
                                <td style="border-top: 1px solid #000; border-bottom: 1px solid #000; padding: 4px 0;">
                                    Description
                                </td>
                                <td style="text-align: right; border-top: 1px solid #000; border-bottom: 1px solid #000; padding: 4px 0;">
                                    Amount
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top; padding: 4px 0; border-bottom: 1px solid #000;">
                                    Subscription-E-{{$packagedetail->package_id ?? 0}}
                                </td>
                                <td style="vertical-align: top; padding: 4px 0; border-bottom: 1px solid #000;">
                                    <p style="font-size: 12px; color: #000; margin: 0;">
                                        {{$packagedetail->package_description ?? ''}}<br>{{($subscriberdetail->number_of_subscriber + 1) ?? 0}} Subscription - 3 Years
                                    </p>
                                    <p style="font-size: 12px; color: #000; margin: 0;">
                                        Duration:<br>19 September 2023 - 19 September 2026
                                    </p>
                                </td>
                                <td style="text-align: right; vertical-align: top; padding: 4px 0; border-bottom: 1px solid #000;">
                                    {{$subscriberdetail->price ?? 0}}
                                </td>
                            </tr>
                        </table>
                        <table class="invoice-table" style="width: auto; margin: 8px 0 15px auto;  color: #000; text-align: right; " cellspacing="0">
                            <tr>
                                <td style="font-size: 12px; vertical-align: bottom; padding: 3px 14px;">
                                    *The total amount payable is net of tax
                                </td>
                                <td>
                                    <table class="invoice-table" style="width: auto; margin: auto 0 auto auto; font-size: 9px; color: #000; text-align: right; " cellspacing="0">
                                        <tr>
                                            <td style="width: 110px; padding: 3px 0; padding-right: 20px; ">Gross :</td>
                                            <td style="display: inline-block; width: 130px;  padding: 3px 0; padding-right: 13px; border: 1px solid #000; border-bottom: 0;"><b>{{$subscriberdetail->price ?? 0}}</b></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 110px; padding: 3px 0;  padding-right: 20px;">- Discount :</td>
                                            <td style="display: inline-block; width: 130px;  padding: 3px 0; padding-right: 13px; border: 1px solid #000; border-bottom: 0; border-top: 0;">0.00</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 110px;  padding: 3px 0; padding-right: 20px; padding-bottom: 18px;">Subtotal :</td>
                                            <td style="display: inline-block; width: 130px;  padding: 3px 0; padding-right: 13px; border: 1px solid #000; border-bottom: 0; border-top: 0; padding-bottom: 18px;">{{$subscriberdetail->price ?? 0}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 110px; padding: 3px 0; padding-right: 20px; border: 1px solid #000; border-right: 0;"><b>Total (USD) :</b></td>
                                            <td style="display: inline-block; padding: 3px 0; width: 130px; padding-right: 13px; border: 1px solid #000;"><b>{{$subscriberdetail->price ?? 0}}</b></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <p style="color: rgba(192, 0, 0, 1); font-size: 12px; line-height: 16px; margin: 0 0 8px 0;">
                            Full payment for the above fee must be received within fourteen (14) days from the invoice date OR before date of existing subscription expiry, whichever is soonest.
                        </p>
                        <p style="color: rgba(192, 0, 0, 1); font-size: 12px; line-height: 16px; margin: 0;">
                            If payment has not been received after your expiry date, your subscription will be suspended automatically. Access will only resume when full payment has been received.
                        </p>
                        <p style="color: #000; font-size: 12px; line-height: 16px; margin: 0;">For Telegraphic Transfer, our bank account details are as follows:</p>
                        <ul style="list-style: none; padding: 0; margin: 8px 0 0 0; font-size: 12px; font-weight: 700;" >
                            <li style="padding: 2px 0;"><b style="min-width: 160px; display: inline-block;">Beneficiary Account name </b>:RED MONEY SDN BHD Beneficiary</li>
                            <li style="padding: 2px 0;"><b style="min-width: 160px; display: inline-block;">Bank Name </b>:RED MONEY SDN BHD Beneficiary</li>
                            <li style="padding: 2px 0;"><b style="min-width: 160px; display: inline-block;">Beneficiary Account name </b>:RED MONEY SDN BHD Beneficiary</li>
                            <li style="padding: 2px 0;"><b style="min-width: 160px; display: inline-block;">Beneficiary Account name </b>:MBBEMYKL Account Number : 7649 2200 0021 (For US Dollar Payments)</li>
                        </ul>
                        <p style="color: rgba(192, 0, 0, 1); font-size: 12px; line-height: 16px; margin: 4px 0 8px 0;">
                            *PLEASE NOTE:<br>
                            ALL FUND TRANSFER CHARGES ARE TO BE BORNE BY THE REMITTER UNDER "OUR" AND PAYMENT MADE MUST BE EXCLUSIVE OF ALL TAXES DUE TO REDMONEY
                        </p>
                        <p style="color: #000; font-size: 12px; line-height: 16px; margin: 0 0 14px 0;">Please quote your <b>company name</b> and our <b>invoice number</b> in all your payment for our reference once expedited. For ease of payment tracking, we require the <b>bank remittance advice or MT103 slip</b> to be forwarded to us for audit purpose.</p>
                        <p style="color: #000; font-size: 12px; line-height: 16px; margin: 0 0 14px 0;">If you have any questions concerning this invoice, do contact Finance Team at +603 2162 7800 ext no(s): 21 / 26 / 27 or email us at invoice@redmoneygroup.com</p>
                        <p style="color: #000; font-size: 12px; line-height: 16px; margin: 0 0 14px 0;"><b>THANK YOU. </b></p>
                        <p style="color: #000; font-size: 12px; line-height: 16px; margin: 0 0 24px 0;">This is a computer generated document. No signature required.</p>
                        <p style="color: #000; font-size: 12px; line-height: 20px; margin: 0 0 24px 0; text-align: center;"><b>Red Money Sdn Bhd 200401029487</b> (667995-W)<br>E-12B-2.1, Level 12B, The Icon (East Wing), No.1, Jalan 1/68F off Jalan Tun Razak, 50400 Kuala Lumpur Malaysia</p>
                        <p style="color: #000; font-size: 12px; line-height: 16px; margin: 0 0 20px 0; text-align: center;">Tel: +603 2162 7800 Fax: +603 2162 7810 <b><a href="https://www.REDmoneyGroup.com">www.REDmoneyGroup.com</a></b></p>
                    </div>
                    <div class="plan-page-btns m-t-60">
                        {{-- <a href="" class="btn btn-secondary">
                            <svg class="m-r-10" width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.58879 10.9109L4.01129 7.33339H11.9996V5.66672H4.01129L7.58879 2.08922L6.41046 0.910889L0.821289 6.50006L6.41046 12.0892L7.58879 10.9109Z" fill="#800000"/>
                            </svg>
                            Previous
                        </a> --}}
                        <a href="{{url('registrationCompleted')}}" class="btn btn-primary">
                            Next
                            <svg class="m-l-10" width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.41083 10.9109L5.58917 12.0892L11.1783 6.50006L5.58917 0.910889L4.41083 2.08922L7.98833 5.66672H0V7.33339H7.98833L4.41083 10.9109Z" fill="white"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="inner-content" id="tab2">
                    <h6 class="m-b-30" >Payment Information</h6>
                    <form class="funds-form">
                        <div class="form-group tooltip m-b-20">
                            <input type="text" class="form-control">
                            <label>Card Number</label>
                            <span class="icon">
                                <img src="assets/images/tooltip-icon.svg" alt="icon">
                            </span>
                        </div>
                        <div class="flex-row">
                            <div class="col-6">
                                <div class="form-group m-b-20">
                                    <input type="text" class="form-control">
                                    <label>Name on Card</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="flex-row">
                                    <div class="col-6">
                                        <div class="form-group m-b-20">
                                            <input type="text" class="form-control">
                                            <label>Expiry</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group m-b-20">
                                            <input type="text" class="form-control">
                                            <label>Expiry</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group m-b-20">
                            <div class="g-recaptcha" data-sitekey="YOUR_SITE_KEY"></div>
                        </div>
                        <div class="plan-page-btns m-t-40">
                            <a href="#" class="btn btn-secondary">
                                <svg class="m-r-10" width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.58879 10.9109L4.01129 7.33339H11.9996V5.66672H4.01129L7.58879 2.08922L6.41046 0.910889L0.821289 6.50006L6.41046 12.0892L7.58879 10.9109Z" fill="#800000"/>
                                </svg>
                                Previous
                            </a>
                            <a href="#" class="btn btn-primary">
                                Submit
                                <svg class="m-l-10" width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.41083 10.9109L5.58917 12.0892L11.1783 6.50006L5.58917 0.910889L4.41083 2.08922L7.98833 5.66672H0V7.33339H7.98833L4.41083 10.9109Z" fill="white"/>
                                </svg>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>
