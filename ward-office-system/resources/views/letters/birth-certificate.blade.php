<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #1E2530;
            margin: 0;
            padding: 40px 50px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #14273F;
            padding-bottom: 14px;
            margin-bottom: 24px;
        }

        .header .office {
            font-size: 16px;
            font-weight: bold;
            color: #14273F;
        }

        .header .address {
            font-size: 11px;
            color: #4B5563;
            margin-top: 2px;
        }

        .meta {
            display: table;
            width: 100%;
            margin-bottom: 20px;
            font-size: 11px;
        }

        .meta .ref {
            display: table-cell;
            text-align: left;
        }

        .meta .date {
            display: table-cell;
            text-align: right;
        }

        .title {
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            font-size: 13px;
            margin: 24px 0;
            text-transform: uppercase;
        }

        .body-text {
            line-height: 1.8;
            text-align: justify;
            margin-bottom: 40px;
        }

        .body-text strong {
            color: #14273F;
        }

        .signature-block {
            margin-top: 60px;
        }

        .signature-line {
            border-top: 1px solid #1E2530;
            width: 220px;
            margin-top: 50px;
            padding-top: 4px;
        }

        .footer-note {
            margin-top: 60px;
            font-size: 9px;
            color: #4B5563;
            border-top: 1px solid #D8DBE0;
            padding-top: 8px;
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="office">Ward Office</div>
        <div class="address">{{ $request->wardOffice->ward_number }}, {{ $request->wardOffice->municipality }},
            {{ $request->wardOffice->district }}</div>
    </div>

    <div class="meta">
        <div class="ref"><strong>Ref. No.:</strong> {{ $request->reference_number }}</div>
        <div class="date"><strong>Date:</strong> {{ now()->format('F d, Y') }}</div>
    </div>

    <div class="title">Recommendation for Birth Registration</div>

    <div class="body-text">
        This is to certify that <strong>{{ $request->form_data['child_name'] ?? 'N/A' }}</strong> was born on
        <strong>{{ $request->form_data['date_of_birth'] ?? 'N/A' }}</strong>, to father
        <strong>{{ $request->form_data['father_name'] ?? 'N/A' }}</strong> and mother
        <strong>{{ $request->form_data['mother_name'] ?? 'N/A' }}</strong>, within the jurisdiction of this Ward Office.
        <br><br>
        Based on the records and verification available with this office, this Ward Office recommends the
        above particulars for registration and issuance of a birth certificate by the concerned vital
        registration authority.
        <br><br>
        This recommendation is issued upon the request of the applicant, <strong>{{ $request->citizen->name }}</strong>,
        for the purpose stated: <strong>{{ $request->purpose ?? 'Birth certificate registration' }}</strong>.
    </div>

    <div class="signature-block">
        <div class="signature-line">
            {{ $request->officer->name ?? 'Authorized Officer' }}<br>
            Ward Officer
        </div>
    </div>

    <div class="footer-note">
        This is a system-generated recommendation letter issued by the Ward Office Document Request &amp; Management
        System.
        Reference number {{ $request->reference_number }} may be used to verify the authenticity of this document.
    </div>

</body>

</html>