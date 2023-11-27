<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <style type="text/css">
        @media screen {
            @font-face {
                font-family: 'Lato';
                font-style: normal;
                font-weight: 400;
                src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: normal;
                font-weight: 700;
                src: local('Lato Bold'), local('Lato-Bold'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: italic;
                font-weight: 400;
                src: local('Lato Italic'), local('Lato-Italic'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: italic;
                font-weight: 700;
                src: local('Lato Bold Italic'), local('Lato-BoldItalic'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format('woff');
            }
        }

        /* CLIENT-SPECIFIC STYLES */
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        /* RESET STYLES */
        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        table {
            border-collapse: collapse !important;
        }

        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
            font-family: 'Lato', Helvetica, Arial, sans-serif !important;
        }

        /* iOS BLUE LINKS */
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* MOBILE STYLES */
        @media screen and (max-width:600px) {
            h1 {
                font-size: 32px !important;
                line-height: 32px !important;
            }
        }

        /* ANDROID CENTER FIX */
        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }
    </style>
</head>

<body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td bgcolor="#f4f4f4" align="center" style="padding: 20px 10px 30px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#ffffff" align="center">
                            <p
                                style="font-family:'Roboto Slab',Arial,Helvetica,sans-serif;font-size:16px;line-height:19px;font-weight:700;font-style:normal;color:rgb(43, 74, 169);text-decoration:none;letter-spacing:0px;padding: 15px 50px 15px 50px;display: inline-block;">
                                Approval of Your Business Application</p>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" align="left"
                            style="padding: 10px 30px 10px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 500; line-height: 20px;">
                            <p style="margin: 0; font-weight:bold; color: rgb(43, 74, 169);">Hello {{ $email_data['fullname'] }},</p>
                        </td>
                    </tr>
                   <tr>
                        <td bgcolor="#ffffff" align="left" style="padding: 10px 10px 0px 30px; color: #000000; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 300; line-height: 25px;">
                            <p style="margin: 0;">This is in reference to your business for <strong>{{ $email_data['business_name']}}</strong> with BIN <strong>{{ $email_data['bin']}}</strong>.</p>
                        </td>
                    </tr>
                    @if ($email_data['status'] != 6)
                    <tr>
                        <td bgcolor="#ffffff" align="left" style="padding: 10px 20px 0px 30px; color: #000000; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 300; line-height: 25px;">
                            <p style="margin: 0px;color: #000000;">It is our pleasure to inform you that we have found them to be compliant and herewith granting you the approval of your business to {{ $email_data['type'] }}. </p>
                        </td>
                    </tr>
                    @else
                    <tr>
                        <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 20px 30px; color: #000000; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 300; line-height: 25px;">
                            <p style="margin: 0;">Unfortunately, your {{ $email_data['type'] }} application has been declined due to some issues in your application.</p>
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <td bgcolor="#ffffff" align="left" style="padding: 10px 30px 10px 30px; color: #000000; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 300; line-height: 25px;">
                            <p style="margin: 0;color: #000000;">Thank you and have a great day.</p>
                        </td> 
                    </tr> 

                    <tr>
                        <td bgcolor="#ffffff" align="left"  style="padding: 10px 30px 10px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 10px;">
                            <p style="margin: 20px 0 20px 0;">*This is a system generated email. Please do not reply to this email.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
