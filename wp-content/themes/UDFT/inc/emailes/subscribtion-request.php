<?php

DEFINE( 'SITE_URL', site_url() );

function subscription_request_email( $subscriber_id )
{

    $out =
        '<!DOCTYPE html   PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  style="width:100%;font-family:arial, helvetica neue, helvetica, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0;">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="telephone=no" name="format-detection">
    <!--[if (mso 16)]>
    <style type="text/css">
        a {text-decoration: none;}
    </style>
    <![endif]-->
    <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]-->
    <style type="text/css">
        @media only screen and (max-width:600px) {

            p,
            ul li,
            ol li,
            a {
                font-size: 16px !important;
                line-height: 120% !important
            }

            h1 {
                font-size: 30px !important;
                text-align: center;
                line-height: 120% !important
            }

            h2 {
                font-size: 26px !important;
                text-align: center;
                line-height: 120% !important
            }

            h3 {
                font-size: 20px !important;
                text-align: center;
                line-height: 120% !important
            }

            h1 a {
                font-size: 30px !important
            }

            h2 a {
                font-size: 26px !important
            }

            h3 a {
                font-size: 20px !important
            }

            .es-menu td a {
                font-size: 16px !important
            }

            .es-header-body p,
            .es-header-body ul li,
            .es-header-body ol li,
            .es-header-body a {
                font-size: 16px !important
            }

            .es-footer-body p,
            .es-footer-body ul li,
            .es-footer-body ol li,
            .es-footer-body a {
                font-size: 16px !important
            }

            .es-infoblock p,
            .es-infoblock ul li,
            .es-infoblock ol li,
            .es-infoblock a {
                font-size: 12px !important
            }

            *[class="gmail-fix"] {
                display: none !important
            }

            .es-m-txt-c,
            .es-m-txt-c h1,
            .es-m-txt-c h2,
            .es-m-txt-c h3 {
                text-align: center !important
            }

            .es-m-txt-r,
            .es-m-txt-r h1,
            .es-m-txt-r h2,
            .es-m-txt-r h3 {
                text-align: right !important
            }

            .es-m-txt-l,
            .es-m-txt-l h1,
            .es-m-txt-l h2,
            .es-m-txt-l h3 {
                text-align: left !important
            }

            .es-m-txt-r img,
            .es-m-txt-c img,
            .es-m-txt-l img {
                display: inline !important
            }

            .es-button-border {
                display: block !important
            }

            a.es-button {
                font-size: 20px !important;
                display: block !important;
                border-width: 10px 0px 10px 0px !important
            }

            .es-btn-fw {
                border-width: 10px 0px !important;
                text-align: center !important
            }

            .es-adaptive table,
            .es-btn-fw,
            .es-btn-fw-brdr,
            .es-left,
            .es-right {
                width: 100% !important
            }

            .es-content table,
            .es-header table,
            .es-footer table,
            .es-content,
            .es-footer,
            .es-header {
                width: 100% !important;
                max-width: 600px !important
            }

            .es-adapt-td {
                display: block !important;
                width: 100% !important
            }

            .adapt-img {
                width: 100% !important;
                height: auto !important
            }

            .es-m-p0 {
                padding: 0px !important
            }

            .es-m-p0r {
                padding-right: 0px !important
            }

            .es-m-p0l {
                padding-left: 0px !important
            }

            .es-m-p0t {
                padding-top: 0px !important
            }

            .es-m-p0b {
                padding-bottom: 0 !important
            }

            .es-m-p20b {
                padding-bottom: 20px !important
            }

            .es-mobile-hidden,
            .es-hidden {
                display: none !important
            }

            .es-desk-hidden {
                display: table-row !important;
                width: auto !important;
                overflow: visible !important;
                float: none !important;
                max-height: inherit !important;
                line-height: inherit !important
            }

            .es-desk-menu-hidden {
                display: table-cell !important
            }

            table.es-table-not-adapt,
            .esd-block-html table {
                width: auto !important
            }

            table.es-social {
                display: inline-block !important
            }

            table.es-social td {
                display: inline-block !important
            }
        }

        #outlook a {
            padding: 0;
        }

        .ExternalClass {
            width: 100%;
        }

        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
            line-height: 100%;
        }

        .es-button {
            mso-style-priority: 100 !important;
            text-decoration: none !important;
        }

        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }
        a:hover{
            opacity:0.5;
        }
        ul li a:hover{
            opacity:1;
            color:#c08937 !important;
        }
        .m_-1994012998109970122adapt-img:hover {
            opacity:0.5;
        }

        .es-desk-hidden {
            display: none;
            float: left;
            overflow: hidden;
            width: 0;
            max-height: 0;
            line-height: 0;
            mso-hide: all;
        }
    </style>
</head>

<body
    style="width:100%;font-family:arial, helvetica neue, helvetica, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0;">
<div class="es-wrapper-color" style="background-color:#F6F6F6;">
    <!--[if gte mso 9]>
    <v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
        <v:fill type="tile" color="#f6f6f6"></v:fill>
    </v:background>
    <![endif]-->
    <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0"
           style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;">
        <tr style="border-collapse:collapse;">
            <td valign="top" style="padding:0;Margin:0;">
                <table cellpadding="0" cellspacing="0" class="es-content" align="center"
                       style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;">
                    <tr style="border-collapse:collapse;">
                        <td align="center" bgcolor="#ffffff" style="padding:0;Margin:0;background-color:#FFFFFF;">
                            <table bgcolor="#ffffff" class="es-header-body" align="center" cellpadding="0" cellspacing="0"
                                   width="750"
                                   style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;">
                                <tr style="border-collapse:collapse;">
                                    <td
                                        style="Margin:0;padding-top:15px;padding-bottom:15px;padding-left:20px;padding-right:20px;background-position:left bottom;"
                                        align="left">
                                        <table width="100%" cellspacing="0" cellpadding="0"
                                               style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tr style="border-collapse:collapse;">
                                                <td width="560" valign="top" align="center" style="padding:0;Margin:0;">
                                                    <table width="100%" cellspacing="0" cellpadding="0"
                                                           style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;"><a target="_blank" href="' . SITE_URL . '"
                                                                                                              style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;font-size:14px;text-decoration:none;color:#1376C8;"><img
                                                                        src="' . get_stylesheet_directory_uri() . '/img/top-logo.png"
                                                                        alt
                                                                        style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;"
                                                                        height="65"></a></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr style="border-collapse:collapse;">
                                    <td
                                        style="Margin:0;padding-top:15px;padding-bottom:15px;padding-left:20px;padding-right:20px;background-position:left bottom;background-color:#FFFFFF;"
                                        align="left" bgcolor="#ffffff">
                                        <table width="100%" cellspacing="0" cellpadding="0"
                                               style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tr style="border-collapse:collapse;">
                                                <td width="560" valign="top" align="center" style="padding:0;Margin:0;">
                                                    <table width="100%" cellspacing="0" cellpadding="0"
                                                           style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                        <tr style="border-collapse:collapse;">
                                                            <td style="padding:0;Margin:0;">
                                                                <table class="es-menu" width="100%" cellspacing="0" cellpadding="0"
                                                                       style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                                    <tr class="links" style="border-collapse:collapse;">
                                                                        <td
                                                                            style="Margin:0;padding-left:5px;padding-right:5px;padding-top:10px;padding-bottom:10px;border:0;"
                                                                            width="25%" valign="top" bgcolor="transparent" align="center"><a
                                                                                target="_blank" href="' . SITE_URL . '/uber_uns/"
                                                                                style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;font-size:16px;text-decoration:none;display:block;color:#000000;font-weight:normal;">üBER UNS</a>
                                                                        </td>
                                                                        <td
                                                                            style="Margin:0;padding-left:5px;padding-right:5px;padding-top:10px;padding-bottom:10px;border:0;"
                                                                            width="25%" valign="top" bgcolor="transparent" align="center"><a
                                                                                target="_blank" href="' . SITE_URL . '/news/"
                                                                                style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;font-size:16px;text-decoration:none;display:block;color:#000000;font-weight:normal;">NEWS</a>
                                                                        </td>
                                                                        <td
                                                                            style="Margin:0;padding-left:5px;padding-right:5px;padding-top:10px;padding-bottom:10px;border:0;"
                                                                            width="25%" valign="top" bgcolor="transparent" align="center"><a
                                                                                target="_blank" href="' . SITE_URL . '/partner/"
                                                                                style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;font-size:16px;text-decoration:none;display:block;color:#000000;font-weight:normal;">PARTNER</a>
                                                                        </td>
                                                                        <td
                                                                            style="Margin:0;padding-left:5px;padding-right:5px;padding-top:10px;padding-bottom:10px;border:0;"
                                                                            width="25%" valign="top" bgcolor="transparent" align="center"><a
                                                                                target="_blank" href="' . SITE_URL . '/kontakt/"
                                                                                style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;font-size:16px;text-decoration:none;display:block;color:#000000;font-weight:normal;">KONTAKT</a>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <table cellpadding="0" cellspacing="0" class="es-content" align="center"
                       style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;">
                    <tr style="border-collapse:collapse;">
                        <td align="center" bgcolor="#ffffff" style="padding:0;Margin:0;background-color:#FFFFFF;">
                            <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0" cellspacing="0"
                                   width="913"
                                   style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;">
                                <tr style="border-collapse:collapse;">
                                    <td align="left" style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;">
                                        <table width="100%" cellspacing="0" cellpadding="0"
                                               style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tr style="border-collapse:collapse;">
                                                <td class="es-m-p0r es-m-p20b" width="860" valign="top" align="center"
                                                    style="padding:0;Margin:0;">
                                                    <div style="width:420px;text-align:center;margin:35px auto">
                                                        <h1 style="font-size:32px; font-weight:600;margin-bottom:25px;color:#000000">DANKE FÜR DEINEN<br />
                                                            EINKAUF<br />
                                                            BEI DOLCEFUMO</h1>
                                                        <p style="margin:0 0 25px 0; color:#b78c3a;font-size:15px;color:#000000;">Bestellnummer:  <?php echo $order_id;?></p>



                                                        <table cellpadding="0" cellspacing="0" border="0" width="420" align="center">
                                                            <tr>
                                                                <td style="text-align: center;color:#000000"><p style="margin:0 0 25px 0; color:#000000;font-size:12px;font-weight:400;text-align: center;font-family:Arial, Helwetica">Hallo <?php echo $customer_name;?> ,<br />
                                                                        Deine Bestellung ist bei uns eingegangen. Sobald die Zahlung bei uns<br/>
                                                                        eingegangen ist wird die Ware versandt. Anschließend erhälst du von uns eine<br />
                                                                        Versandbestätigung mit deinen Lieferinformationen.<br /><br />

                                                                        Bitte überweise den fälligen Betrag unter Angabe deiner Bestellnummer auf folgendes Konto:<br />
                                                                        <b>Name des Zahlungsempfängers:</b> Dolcefumo GmbH<br />
                                                                        <b>Bank des Zahlungsempfängers:</b> BW-Bank<br />
                                                                        <b>IBAN:</b> DE27 6005 0101 0008 0551 29<br />
                                                                        <b>BIC:</b> SOLADEST600<br /><br />
                                                                        Mehr Informationen zum Thema Bezahlen per Vorkasse findest du unter unseren<br />
                                                                        <a href="<?php echo $store_url;?>/zahlungsarten">Zahlungsmöglichkeiten</a>.<br /><br />

                                                                    </p></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding:30px 0; color:#000000;font-size:12px;font-weight:600;text-align: center;font-family:Arial, Helwetica">Telefon: 0711/52852522<br />
                                                                    e-Mail Support: <a href="mailto:support@dolcefumo.de">support@dolcefumo.de</a></td>
                                                            </tr>
                                                        </table>


                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr style="border-collapse:collapse;">
                                    <td align="left" style="padding:0;Margin:0;">
                                        <table cellpadding="0" cellspacing="0" width="100%"
                                               style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tr style="border-collapse:collapse;">
                                                <td width="913" align="center" valign="top" style="padding:0;Margin:0;">
                                                    <table cellpadding="0" cellspacing="0" width="100%"
                                                           style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;display:none;"></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr style="border-collapse:collapse;">
                                    <td align="center" style="padding:0;Margin:0;">
                                        <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0" cellspacing="0"
                                               width="913"
                                               style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;">
                                            <tr style="border-collapse:collapse;">
                                                <td align="left" bgcolor="#555"
                                                    style="padding:0;Margin:0;padding-bottom:30px;padding-top:40px;background-color:#555555;background-position:left top;">
                                                    <!--[if mso]><table width="913" cellpadding="0" cellspacing="0"><tr><td width="182" valign="top"><![endif]-->
                                                    <table cellpadding="0" cellspacing="0" class="es-left" align="left"
                                                           style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left;">
                                                        <tr style="border-collapse:collapse;">
                                                            <td width="182" class="es-m-p0r es-m-p20b" align="center" style="padding:0;Margin:0;">
                                                                <table cellpadding="0" cellspacing="0" width="100%"
                                                                       style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-position:left top;">
                                                                    <tr style="border-collapse:collapse;">
                                                                        <td align="center" style="padding:0;Margin:0;"><img class="adapt-img"
                                                                                                                            src="https://qwljc.stripocdn.email/content/guids/CABINET_7d15da6e98d476872f92f122ed52e54c/images/37131566992513394.png"
                                                                                                                            alt
                                                                                                                            style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;"
                                                                                                                            width="86"></td>
                                                                    </tr>
                                                                    <tr style="border-collapse:collapse;">
                                                                        <td align="center" style="padding:0;Margin:0;padding-top:20px;">
                                                                            <h3
                                                                                style="Margin:0;line-height:24px;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;font-size:16px;font-style:normal;font-weight:normal;color:#FFFFFF;">
                                                                                <a target="_blank"
                                                                                   style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;font-size:16px;text-decoration:none;color:#c9c9c9;line-height:24px;"
                                                                                   href="' . SITE_URL . '/login">KUNDENKONTO</a></h3>
                                                                        </td>
                                                                    </tr>
                                                                    <tr style="border-collapse:collapse;">
                                                                        <td align="center"
                                                                            style="Margin:0;padding-bottom:20px;padding-left:20px;padding-right:20px;padding-top:30px;">
                                                                            <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0"
                                                                                   style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                                                <tr style="border-collapse:collapse;">
                                                                                    <td
                                                                                        style="padding:0;Margin:0px;border-bottom:1px solid #777777;background:none;height:1px;width:100%;margin:0px;">
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                    <tr style="border-collapse:collapse;">
                                                                        <td align="left" style="padding:0;Margin:0;">
                                                                            <ul style="padding-left: 35px;">
                                                                                <li
                                                                                    style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:14px;Margin-bottom:15px;color:#FFFFFF;">
                                                                                    <a target="_blank"
                                                                                       style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;font-size:14px;text-decoration:none;color:#FFFFFF;line-height:14px;"
                                                                                       href="' . SITE_URL . '/bonusprogramm">Bonusprogramm</a></li>
                                                                                <li
                                                                                    style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:14px;Margin-bottom:15px;color:#FFFFFF;">
                                                                                    <a target="_blank"
                                                                                       style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;font-size:14px;text-decoration:none;color:#FFFFFF;line-height:14px;"
                                                                                       href="' . SITE_URL . '/index.php?route=account/return/add">Warenrücksendungen</a>
                                                                                </li>
                                                                                <li
                                                                                    style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:14px;Margin-bottom:15px;color:#FFFFFF;">
                                                                                    <a target="_blank"
                                                                                       style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;font-size:14px;text-decoration:none;color:#FFFFFF;line-height:14px;"
                                                                                       href="' . SITE_URL . '/versandkosten">Versandkosten</a></li>
                                                                                <li
                                                                                    style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:14px;Margin-bottom:15px;color:#FFFFFF;">
                                                                                    <a target="_blank"
                                                                                       style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;font-size:14px;text-decoration:none;color:#FFFFFF;line-height:14px;"
                                                                                       href="' . SITE_URL . '/zahlungsarten">Zahlungsarten</a></li>
                                                                                <li
                                                                                    style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:14px;Margin-bottom:15px;color:#FFFFFF;">
                                                                                    <a target="_blank"
                                                                                       style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;font-size:14px;text-decoration:none;color:#FFFFFF;line-height:14px;"
                                                                                       href="' . SITE_URL . '/konto/">Anmelden</a></li>
                                                                                <li
                                                                                    style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:14px;Margin-bottom:15px;color:#FFFFFF;">
                                                                                    <a target="_blank"
                                                                                       style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;font-size:14px;text-decoration:none;color:#FFFFFF;line-height:14px;"
                                                                                       href="' . SITE_URL . '/haendler_anmelden/">Händlerkonto Registrieren</a></li>
                                                                            </ul>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <!--[if mso]></td><td width="176" valign="top"><![endif]-->
                                                    <table cellpadding="0" cellspacing="0" class="es-left" align="left"
                                                           style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left;">
                                                        <tr style="border-collapse:collapse;">
                                                            <td width="176" class="es-m-p20b" align="center" style="padding:0;Margin:0;">
                                                                <table cellpadding="0" cellspacing="0" width="100%"
                                                                       style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-position:left top;">
                                                                    <tr style="border-collapse:collapse;">
                                                                        <td align="center" style="padding:0;Margin:0;"><img class="adapt-img"
                                                                                                                            src="https://qwljc.stripocdn.email/content/guids/CABINET_7d15da6e98d476872f92f122ed52e54c/images/6711566992519832.png"
                                                                                                                            alt
                                                                                                                            style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;"
                                                                                                                            width="86"></td>
                                                                    </tr>
                                                                    <tr style="border-collapse:collapse;">
                                                                        <td align="center" style="padding:0;Margin:0;padding-top:20px;">
                                                                            <p
                                                                                style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:16px;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:24px;color:#FFFFFF;">
                                                                                <a target="_blank"
                                                                                   style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;font-size:16px;text-decoration:none;color:#c9c9c9;line-height:24px;"
                                                                                   href="">VERSCHIEDENE INFORMATIONEN</a></p>
                                                                        </td>
                                                                    </tr>
                                                                    <tr style="border-collapse:collapse;">
                                                                        <td align="center"
                                                                            style="Margin:0;padding-top:5px;padding-bottom:20px;padding-left:20px;padding-right:20px;">
                                                                            <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0"
                                                                                   style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                                                <tr style="border-collapse:collapse;">
                                                                                    <td
                                                                                        style="padding:0;Margin:0px;border-bottom:1px solid #777777;background:none;height:1px;width:100%;margin:0px;">
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                    <tr style="border-collapse:collapse;">
                                                                        <td align="left" style="padding:0;Margin:0;">
                                                                            <ul style="padding-left: 35px;">
                                                                                <li
                                                                                    style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:14px;Margin-bottom:15px;color:#FFFFFF;">
                                                                                    <a target="_blank"
                                                                                       style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;font-size:14px;text-decoration:none;color:#FFFFFF;line-height:14px;"
                                                                                       href="' . SITE_URL . '/wissenswertes-zur-e-zigarette/">Wissenswertes zur
                                                                                        E-Zigarette</a></li>
                                                                                <li
                                                                                    style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:14px;Margin-bottom:15px;color:#FFFFFF;">
                                                                                    <a target="_blank"
                                                                                       style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;font-size:14px;text-decoration:none;color:#FFFFFF;line-height:14px;"
                                                                                       href="' . SITE_URL . '/warnhinweis/">Warnhinweis!</a></li>
                                                                                <li
                                                                                    style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:14px;Margin-bottom:15px;color:#FFFFFF;">
                                                                                    <a target="_blank"
                                                                                       style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;font-size:14px;text-decoration:none;color:#FFFFFF;line-height:14px;"
                                                                                       href="' . SITE_URL . '/rund-um-den-verdampfer/">Rund um den Verdampfer</a>
                                                                                </li>
                                                                                <li
                                                                                    style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:14px;Margin-bottom:15px;color:#FFFFFF;">
                                                                                    <a target="_blank"
                                                                                       style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;font-size:14px;text-decoration:none;color:#FFFFFF;line-height:14px;"
                                                                                       href="' . SITE_URL . '/hinweise-zur-reinigung/">Hinweise zur Reinigung</a>
                                                                                </li>
                                                                                <li
                                                                                    style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:14px;Margin-bottom:15px;color:#FFFFFF;">
                                                                                    <a target="_blank"
                                                                                       style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;font-size:14px;text-decoration:none;color:#FFFFFF;line-height:14px;"
                                                                                       href="' . SITE_URL . '/liquids-inhaltsstoffe/">Liquids Inhaltsstoffe</a></li>
                                                                                <li
                                                                                    style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:14px;Margin-bottom:15px;color:#FFFFFF;">
                                                                                    <a target="_blank"
                                                                                       style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;font-size:14px;text-decoration:none;color:#FFFFFF;line-height:14px;"
                                                                                       href="' . SITE_URL . '/gesundheitshinweise/">Gesundheitshinweise</a></li>
                                                                            </ul>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <!--[if mso]></td><td width="182" valign="top"><![endif]-->
                                                    <table cellpadding="0" cellspacing="0" class="es-left" align="left"
                                                           style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left;">
                                                        <tr style="border-collapse:collapse;">
                                                            <td width="182" class="es-m-p20b" align="center" style="padding:0;Margin:0;">
                                                                <table cellpadding="0" cellspacing="0" width="100%"
                                                                       style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                                    <tr style="border-collapse:collapse;">
                                                                        <td align="center" style="padding:0;Margin:0;"><img class="adapt-img"
                                                                                                                            src="https://qwljc.stripocdn.email/content/guids/CABINET_7d15da6e98d476872f92f122ed52e54c/images/33291566992527749.png"
                                                                                                                            alt
                                                                                                                            style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;"
                                                                                                                            width="86"></td>
                                                                    </tr>
                                                                    <tr style="border-collapse:collapse;">
                                                                        <td align="center" style="padding:0;Margin:0;padding-top:20px;">
                                                                            <h3
                                                                                style="Margin:0;line-height:24px;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;font-size:16px;font-style:normal;font-weight:normal;color:#FFFFFF;">
                                                                                <a target="_blank"
                                                                                   style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;font-size:16px;text-decoration:none;color:#c9c9c9;line-height:24px;"
                                                                                   href="">RECHTLICHE DETAILS</a></h3>
                                                                        </td>
                                                                    </tr>
                                                                    <tr style="border-collapse:collapse;">
                                                                        <td align="center"
                                                                            style="Margin:0;padding-bottom:20px;padding-left:20px;padding-right:20px;padding-top:30px;">
                                                                            <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0"
                                                                                   style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                                                <tr style="border-collapse:collapse;">
                                                                                    <td
                                                                                        style="padding:0;Margin:0px;border-bottom:1px solid #777777;background:none;height:1px;width:100%;margin:0px;">
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                    <tr style="border-collapse:collapse;">
                                                                        <td align="left" style="padding:0;Margin:0;">
                                                                            <ul style="padding-left: 35px;">
                                                                                <li
                                                                                    style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:14px;Margin-bottom:15px;color:#FFFFFF;">
                                                                                    <a target="_blank"
                                                                                       style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;font-size:14px;text-decoration:none;color:#FFFFFF;line-height:14px;"
                                                                                       href="' . SITE_URL . '/batterieverordnung">Batterieverordnung</a></li>
                                                                                <li
                                                                                    style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:14px;Margin-bottom:15px;color:#FFFFFF;">
                                                                                    <a target="_blank"
                                                                                       style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;font-size:14px;text-decoration:none;color:#FFFFFF;line-height:14px;"
                                                                                       href="' . SITE_URL . '/altgeraeteentsorgung">Altgeräteentsorgung</a></li>
                                                                                <li
                                                                                    style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:14px;Margin-bottom:15px;color:#FFFFFF;">
                                                                                    <a target="_blank"
                                                                                       style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;font-size:14px;text-decoration:none;color:#FFFFFF;line-height:14px;"
                                                                                       href="' . SITE_URL . '/impressum">Impressum</a></li>
                                                                                <li
                                                                                    style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:14px;Margin-bottom:15px;color:#FFFFFF;">
                                                                                    <a target="_blank"
                                                                                       style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;font-size:14px;text-decoration:none;color:#FFFFFF;line-height:14px;"
                                                                                       href="' . SITE_URL . '/widerrufsformular">Widerrufsformular</a></li>
                                                                                <li
                                                                                    style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:14px;Margin-bottom:15px;color:#FFFFFF;">
                                                                                    <a target="_blank"
                                                                                       style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;font-size:14px;text-decoration:none;color:#FFFFFF;line-height:14px;"
                                                                                       href="' . SITE_URL . '/widerrufsbelehrung">Widerrufsbelehrung</a></li>
                                                                                <li
                                                                                    style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:14px;Margin-bottom:15px;color:#FFFFFF;">
                                                                                    <a target="_blank"
                                                                                       style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;font-size:14px;text-decoration:none;color:#FFFFFF;line-height:14px;"
                                                                                       href="' . SITE_URL . '/allgemeine-geschaeftsbedingungen">AGB</a></li>
                                                                                <li
                                                                                    style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:14px;Margin-bottom:15px;color:#FFFFFF;">
                                                                                    <a target="_blank"
                                                                                       style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;font-size:14px;text-decoration:none;color:#FFFFFF;line-height:14px;word-break:break-all;display:inline-block;"
                                                                                       href="' . SITE_URL . '/datenschutzbestimmungen">Datenschutzbestimmungen</a>
                                                                                </li>
                                                                                <li
                                                                                    style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:14px;Margin-bottom:15px;color:#FFFFFF;">
                                                                                    <a target="_blank"
                                                                                       style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;font-size:14px;text-decoration:none;color:#FFFFFF;line-height:14px;"
                                                                                       href="' . SITE_URL . '/haftungsausschluss">Haftungsausschluß</a></li>
                                                                            </ul>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <!--[if mso]></td><td width="180" valign="top"><![endif]-->
                                                    <table cellpadding="0" cellspacing="0" class="es-left" align="left"
                                                           style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left;">
                                                        <tr style="border-collapse:collapse;">
                                                            <td width="180" align="center" class="es-m-p20b" style="padding:0;Margin:0;">
                                                                <table cellpadding="0" cellspacing="0" width="100%"
                                                                       style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                                    <tr style="border-collapse:collapse;">
                                                                        <td align="center" style="padding:0;Margin:0;"><img class="adapt-img"
                                                                                                                            src="https://qwljc.stripocdn.email/content/guids/CABINET_7d15da6e98d476872f92f122ed52e54c/images/65941566992534833.png"
                                                                                                                            alt
                                                                                                                            style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;"
                                                                                                                            width="86"></td>
                                                                    </tr>
                                                                    <tr style="border-collapse:collapse;">
                                                                        <td align="center" style="padding:0;Margin:0;padding-top:20px;">
                                                                            <h3
                                                                                style="Margin:0;line-height:24px;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;font-size:16px;font-style:normal;font-weight:normal;color:#FFFFFF;">
                                                                                <a target="_blank"
                                                                                   style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;font-size:16px;text-decoration:none;color:#c9c9c9;line-height:24px;"
                                                                                   href="">FOLGE UNS</a></h3>
                                                                        </td>
                                                                    </tr>
                                                                    <tr style="border-collapse:collapse;">
                                                                        <td align="center"
                                                                            style="Margin:0;padding-bottom:20px;padding-left:20px;padding-right:20px;padding-top:30px;">
                                                                            <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0"
                                                                                   style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                                                <tr style="border-collapse:collapse;">
                                                                                    <td
                                                                                        style="padding:0;Margin:0px;border-bottom:1px solid #777777;background:none;height:1px;width:100%;margin:0px;">
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                    <tr style="border-collapse:collapse;">
                                                                        <td align="left" style="padding:0;Margin:0;">
                                                                            <ul style="list-style:none;padding-left: 20px;margin-top: 5px;">
                                                                                <li style="margin-bottom:0px;">
                                                                                    <table cellpadding="0" cellspacing="0">
                                                                                        <tr>
                                                                                            <td><img
                                                                                                    src="https://qwljc.stripocdn.email/content/guids/CABINET_7d15da6e98d476872f92f122ed52e54c/images/19761567003083579.png" />
                                                                                            </td>
                                                                                            <td> <a class="_blank"
                                                                                                    href="https://www.facebook.com/dolcefumo-296746137024156"
                                                                                                    target="_blank"
                                                                                                    style="font-size: 12px;    padding-left: 8px;  color: #fff;  font-weight: 400;;text-decoration:none;font-family:Arial, Helwetica">Facebook</a>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </li>
                                                                                <li style="margin-bottom:0px;">
                                                                                    <table cellpadding="0" cellspacing="0">
                                                                                        <tr>
                                                                                            <td><img
                                                                                                    src="https://qwljc.stripocdn.email/content/guids/CABINET_7d15da6e98d476872f92f122ed52e54c/images/27371567003107487.png" />
                                                                                            </td>
                                                                                            <td> <a class="_blank" href="https://www.youtube.com/user/dolcefumo"
                                                                                                    target="_blank"
                                                                                                    style="font-size: 12px;    padding-left: 8px;  color: #fff;  font-weight: 400;;text-decoration:none;font-family:Arial, Helwetica">YouTube</a>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </li>
                                                                            </ul>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <!--[if mso]></td><td width="0"></td><td width="180" valign="top"><![endif]-->
                                                    <table cellpadding="0" cellspacing="0" class="es-left" align="left"
                                                           style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left;">
                                                        <tr style="border-collapse:collapse;">
                                                            <td width="180" align="center" style="padding:0;Margin:0;">
                                                                <table cellpadding="0" cellspacing="0" width="100%"
                                                                       style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                                    <tr style="border-collapse:collapse;">
                                                                        <td align="center" style="padding:0;Margin:0;"><img class="adapt-img"
                                                                                                                            src="https://qwljc.stripocdn.email/content/guids/CABINET_7d15da6e98d476872f92f122ed52e54c/images/22711566992540876.png"
                                                                                                                            alt
                                                                                                                            style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;"
                                                                                                                            width="86"></td>
                                                                    </tr>
                                                                    <tr style="border-collapse:collapse;">
                                                                        <td align="center" style="padding:0;Margin:0;padding-top:20px;">
                                                                            <h3
                                                                                style="Margin:0;line-height:24px;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;font-size:16px;font-style:normal;font-weight:normal;color:#FFFFFF;">
                                                                                <a target="_blank"
                                                                                   style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;font-size:16px;text-decoration:none;color:#c9c9c9;line-height:24px;"
                                                                                   href="' . SITE_URL . '/kontakt">KONTAKT</a></h3>
                                                                        </td>
                                                                    </tr>
                                                                    <tr style="border-collapse:collapse;">
                                                                        <td align="center"
                                                                            style="Margin:0;padding-bottom:20px;padding-left:20px;padding-right:20px;padding-top:30px;">
                                                                            <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0"
                                                                                   style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                                                <tr style="border-collapse:collapse;">
                                                                                    <td
                                                                                        style="padding:0;Margin:0px;border-bottom:1px solid #777777;background:none;height:1px;width:100%;margin:0px;">
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                    <tr style="border-collapse:collapse;">
                                                                        <td align="left"
                                                                            style="padding:0;Margin:0;padding-top:20px;padding-bottom:20px;padding-left:20px;">
                                                                            <p
                                                                                style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:14px;color:#FFFFFF;">
                                                                                Adresse:&nbsp;<br>
                                                                                Unter dem Birkenkopf<br>
                                                                                18,<br>
                                                                                70197 Stuttgart</p>
                                                                        </td>
                                                                    </tr>
                                                                    <tr style="border-collapse:collapse;">
                                                                        <td align="left"
                                                                            style="padding:0;Margin:0;padding-top:20px;padding-bottom:20px;padding-left:20px;">
                                                                            <p
                                                                                style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:14px;color:#FFFFFF;">
                                                                                Supportanfragen: <a href="mailto:support@dolcefumo.de"
                                                                                                    style="text-decoration:none;color:#ffffff;">support@dolcefumo.de</a></p>
                                                                        </td>
                                                                    </tr>
                                                                    <tr style="border-collapse:collapse;">
                                                                        <td align="left"
                                                                            style="padding:0;Margin:0;padding-top:20px;padding-bottom:20px;padding-left:20px;">
                                                                            <p
                                                                                style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:14px;color:#FFFFFF;">
                                                                                Telefon Zentrale: <br></p>
                                                                            <p
                                                                                style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:14px;color:#FFFFFF;">
                                                                                +49 (0) 711 528525-0</p>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <!--[if mso]></td></tr></table><![endif]-->
                                                </td>
                                            </tr>
                                            <tr style="border-collapse:collapse;">
                                                <td align="left"
                                                    style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;background-position:left top;">
                                                    <table cellpadding="0" cellspacing="0" width="100%"
                                                           style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                        <tr style="border-collapse:collapse;">
                                                            <td width="860" align="center" valign="top" style="padding:0;Margin:0;">
                                                                <table cellpadding="0" cellspacing="0" width="100%"
                                                                       style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-position:left top;">
                                                                    <tr style="border-collapse:collapse;">
                                                                        <td align="center" style="padding:0;Margin:0;padding-bottom:15px;">
                                                                            <p
                                                                                style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:12px;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:14px;color:#000000;">
                                                                                <strong>Firmensitz</strong>: Dolcefumo GmbH / Unter dem Birkenkopf 18 / 70197
                                                                                Stuttgart / Deutschland</p>
                                                                            <p
                                                                                style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:12px;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:14px;color:#000000;">
                                                                                <strong>Bankverbindung</strong>: BW Bank, DE27600501010008055129</p>
                                                                            <p
                                                                                style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:12px;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:14px;color:#000000;">
                                                                                Registergericht Stuttgart, HRB 751738, Ust.-ID-Nr.: DE 298811131,
                                                                                WEEE-Reg.-Nr.: DE 41595840</p>
                                                                            <p
                                                                                style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:12px;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:14px;color:#000000;">
                                                                                Geschäftsführer: Christian Granza &amp; Ajdn Sulkovski</p>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
</body>

</html>';

    return $out;

}