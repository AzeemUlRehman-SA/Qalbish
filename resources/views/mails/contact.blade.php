<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <style type="text/css" rel="stylesheet" media="all">

        /* Base ------------------------------ */
        *:not(br):not(tr):not(html) {
            font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        body {
            width: 100% !important;
            height: 100%;
            margin: 0;
            line-height: 1.4;
            background-color: #F5F7F9;
            color: #839197;
            -webkit-text-size-adjust: none;
        }

        a {
            color: #414EF9;
        }

        /* Layout ------------------------------ */
        .email-wrapper {
            width: 100%;
            margin: 0;
            padding: 0;
            background-color: #F5F7F9;
        }

        .email-content {
            width: 100%;
            margin: 0;
            padding: 0;
        }

        /* Masthead ----------------------- */
        .email-masthead {
            padding: 25px 0;
            text-align: center;
        }

        .email-masthead_logo {
            max-width: 400px;
            border: 0;
        }

        .email-masthead_name {
            font-size: 16px;
            font-weight: bold;
            color: #839197;
            text-decoration: none;
            text-shadow: 0 1px 0 white;
        }

        /* Body ------------------------------ */
        .email-body {
            width: 100%;
            margin: 0;
            padding: 0;
            border-top: 1px solid #E7EAEC;
            border-bottom: 1px solid #E7EAEC;
            background-color: #FFFFFF;
        }

        .email-body_inner {
            width: 570px;
            margin: 0 auto;
            padding: 0;
        }

        .email-footer {
            width: 570px;
            margin: 0 auto;
            padding: 0;
            text-align: center;
        }

        .email-footer p {
            color: #839197;
        }

        .body-action {
            width: 100%;
            margin: 30px auto;
            padding: 0;
            text-align: center;
        }

        .body-sub {
            margin-top: 25px;
            padding-top: 25px;
            border-top: 1px solid #E7EAEC;
        }

        .content-cell {
            padding: 35px;
        }

        .align-right {
            text-align: right;
        }

        /* Type ------------------------------ */
        h1 {
            margin-top: 0;
            color: #292E31;
            font-size: 19px;
            font-weight: bold;
            text-align: left;
        }

        h2 {
            margin-top: 0;
            color: #292E31;
            font-size: 16px;
            font-weight: bold;
            text-align: left;
        }

        h3 {
            margin-top: 0;
            color: #292E31;
            font-size: 14px;
            font-weight: bold;
            text-align: left;
        }

        p {
            margin-top: 0;
            color: #839197;
            font-size: 16px;
            line-height: 1.5em;
            text-align: left;
        }

        p.sub {
            font-size: 12px;
        }

        p.center {
            text-align: center;
        }

        /* Buttons ------------------------------ */
        .button {
            display: inline-block;
            width: 200px;
            background-color: #414EF9;
            border-radius: 3px;
            color: #ffffff;
            font-size: 15px;
            line-height: 45px;
            text-align: center;
            text-decoration: none;
            -webkit-text-size-adjust: none;
            mso-hide: all;
        }

        .button--green {
            background-color: #28DB67;
        }

        .button--red {
            background-color: #FF3665;
        }

        .button--blue {
            background-color: #414EF9;
        }

        /*Media Queries ------------------------------ */
        @media only screen and (max-width: 600px) {
            .email-body_inner,
            .email-footer {
                width: 100% !important;
            }
        }

        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }

        h2 {
            margin-top: 12px;
        }

        a.button {
            cursor: pointer;
            cursor: hand;
        }
    </style>
</head>
<body>
<table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center">
            <table class="email-content" width="100%" cellpadding="0" cellspacing="0">
                <!-- Logo -->
                <tr>
                    <td class="email-masthead content-cell" style="background: #fbecdb;color:white;">
                        <img src="{{ asset('frontend/images/logo.png') }}" style="width: 16% !important; height: auto; !important;">
                        <span class="logodesc">
                  <span class="logo-title"
                        style="
                        color:#000;
                        font-size: 26px;
                        display: block;
                        font-weight: bold;
                        margin-top: 5px;
                    "></span>

              </span>
                    </td>
                </tr>
                <!-- Email Body -->
                <tr>
                    <td class="email-body" width="100%">
                        <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0">
                            <!-- Body content -->
                            <tr>
                                <td class="content-cell">
                                    <!-- Action -->
                                    <table class="body-action" align="center" width="100%" cellpadding="0"
                                           cellspacing="0">
                                        <tr>
                                            <td valign="top" align="left">
                                                <table class="p100"
                                                       style="margin: 0; mso-table-lspace: 0; mso-table-rspace: 0; padding: 0;"
                                                       cellspacing="0" cellpadding="0" border="0" align="left">
                                                    <tbody>
                                                    <tr>
                                                        <td style="width: 30px;" width="30" valign="top" align="left">
                                                            &nbsp;
                                                        </td>
                                                        <td valign="top" align="left">
                                                            <table class="p100"
                                                                   style="margin: 0; mso-table-lspace: 0; mso-table-rspace: 0; padding: 0; width: 600px;"
                                                                   width="600" cellspacing="0" cellpadding="0"
                                                                   border="0" align="left">
                                                                <tbody>

                                                                <tr>
                                                                    <td style="color: rgb(51, 51, 51); font-size: 37px; font-weight: 700; line-height: 44px; text-align: center;"
                                                                        align="left" valign="top">
                                                                        <font face="'Georgia', serif">


                                                                            <h1 style="margin:0;">
                                                                                Hi Support Team </h1>

                                                                        </font>
                                                                    </td>
                                                                </tr>
{{--                                                                <tr>--}}
{{--                                                                    <td style="color: rgb(141, 141, 141); font-size: 14px; font-weight: 400; letter-spacing: 0.02em; line-height: 23px; text-align: center; cursor: pointer; box-sizing: content-box; outline: none 0;"--}}
{{--                                                                        valign="top" align="left"--}}
{{--                                                                        class="editable_text text">--}}
{{--                                                                        <font face="'Open Sans', sans-serif">--}}

{{--                                                                            <p> </p>--}}

{{--                                                                        </font>--}}
{{--                                                                    </td>--}}
{{--                                                                </tr>--}}

                                                                <tr>
                                                                    <td style="height: 20px; mso-line-height-rule: exactly;"
                                                                        valign="top" align="left">&nbsp;
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="color: rgb(141, 141, 141); font-size: 20px; font-weight: 400; letter-spacing: 0.02em; line-height: 23px; text-align: center; cursor: pointer; box-sizing: content-box; outline: none 0;"
                                                                        valign="top" align="left">
                                                                        <font face="'Open Sans', sans-serif">
                                                                            My Name is {{ $contact->full_name }}. {{ $contact->message }}
                                                                        </font>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="height: 20px; mso-line-height-rule: exactly;"
                                                                        valign="top" align="left">&nbsp;
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="color: #000; font-size: 16px; font-weight: 600; letter-spacing: 0.02em; line-height: 23px; text-align: left; box-sizing: content-box; outline: none 0;"
                                                                        valign="top" align="left">
                                                                        <font face="'Open Sans', sans-serif">
                                                                            Regards <br>
                                                                            Qalbish Team
                                                                        </font>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="height: 20px; mso-line-height-rule: exactly;"
                                                                        valign="top" align="left">&nbsp;
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                        <td style="width: 30px;" width="30" valign="top" align="left">
                                                            &nbsp;
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="background: #fbecdb;color:white;">
                        <table class="email-footer" align="center" width="570" cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="content-cell">
                                    <p class="sub center" style="color:#000">
                                        Support Team
                                        <br>
                                        <b>Qalbish</b>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

</body>
</html>
