<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Template</title>
</head>
<body>
    <div class="fund-desc-box m-b-25">
        <div class="title-header m-b-25">
            <h2>
                {{$fund_name ?? ''}}
            </h2>
        </div>
        <table>
            <tbody>
                <tr>
                    <td>
                        <p class="label">Fund Coutry</p>
                        <p class="text-color-primary">{{$fund_country ?? ''}}</p>
                    </td>
                    <td>
                        <p class="label">Fund City </p>
                        <p class="text-color-primary">{{$fund_city ?? ''}}</p>
                    </td>
                    <td>
                        <p class="label">Fund Investor Risk</p>
                        <p class="text-color-primary">{{$investor_risk ?? ''}}</p>
                    </td>
                    <td>
                        <p class="label">Contact Person Name</p>
                        <p class="text-color-primary">{{$contact_person_name ?? ''}}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="label">Contact Person Phone</p>
                        <p class="text-color-primary">{{$contact_person_phone ?? ''}}</p>
                    </td>
                    <td>
                        <p class="label">Contact Person Email</p>
                        <p class="text-color-primary">{{$contact_person_email ?? ''}}</p>
                    </td>
                    <td>
                        <p class="label">Type Of Fund</p>
                        <p class="text-color-primary">{{$type_of_fund ?? ''}}</p>
                    </td>
                    <td>
                        <p class="label">Total Expense Ratio (TER)</p>
                        <p class="text-color-primary">{{$fund_expense_ratio ?? ''}}</p>
                    </td>
                    <td>
                        <p class="label">Launch Date</p>
                        <p class="text-color-primary">{{$created_at ?? ''}}</p>
                    </td>
                </tr>
                <tr>

                    <td>
                        <p class="label">Fund Last Update</p>
                        <p class="text-color-primary">{{$fund_last_update_date ?? ''}}</p>
                    </td>

                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
