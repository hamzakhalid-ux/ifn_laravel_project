<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Invoice</title>
</head>
<body>
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
                        <p style="margin: 0; font-size: 12px; font-weight: 700; color: #000;">Bill to : {{($first_name ?? ''). ' ' .($last_name ?? '' )}}</p>
                        <p style="margin: 0; font-size: 12px; font-weight: 700; color: #000; border-top: 1px solid #000;">{{ $company ?? ''}}</p>
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
                    Subscription-E-{{$package_id ?? 0}}
                </td>
                <td style="vertical-align: top; padding: 4px 0; border-bottom: 1px solid #000;">
                    <p style="font-size: 12px; color: #000; margin: 0;">
                        {{$package_description ?? ''}}<br>{{($number_of_subscriber+1) ?? 0}} Subscription - 3 Years
                    </p>
                    <p style="font-size: 12px; color: #000; margin: 0;">
                        Duration:<br>19 September 2023 - 19 September 2026
                    </p>
                </td>
                <td style="text-align: right; vertical-align: top; padding: 4px 0; border-bottom: 1px solid #000;">
                    {{$price ?? 0}}
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
                            <td style="display: inline-block; width: 130px;  padding: 3px 0; padding-right: 13px; border: 1px solid #000; border-bottom: 0;"><b>{{$price ?? 0}}</b></td>
                        </tr>
                        <tr>
                            <td style="width: 110px; padding: 3px 0;  padding-right: 20px;">- Discount :</td>
                            <td style="display: inline-block; width: 130px;  padding: 3px 0; padding-right: 13px; border: 1px solid #000; border-bottom: 0; border-top: 0;">0.00</td>
                        </tr>
                        <tr>
                            <td style="width: 110px;  padding: 3px 0; padding-right: 20px; padding-bottom: 18px;">Subtotal :</td>
                            <td style="display: inline-block; width: 130px;  padding: 3px 0; padding-right: 13px; border: 1px solid #000; border-bottom: 0; border-top: 0; padding-bottom: 18px;">{{$price ?? 0}}</td>
                        </tr>
                        <tr>
                            <td style="width: 110px; padding: 3px 0; padding-right: 20px; border: 1px solid #000; border-right: 0;"><b>Total (USD) :</b></td>
                            <td style="display: inline-block; padding: 3px 0; width: 130px; padding-right: 13px; border: 1px solid #000;"><b>{{$price ?? 0}}</b></td>
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
</body>
</html>
