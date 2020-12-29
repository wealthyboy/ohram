<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8" />
   <title>Template builder</title>
   <meta charset="UTF-8" />
   <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" />
   <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
   <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"
  />
  <link href="{{ asset('store/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet" />

   <link href="https://fonts.googleapis.com/css?family=Crimson+Text:400,600,700" rel="stylesheet" type="text/css">
   <style type="text/css">
      @import url('https://fonts.googleapis.com/css?family=Montserrat:400,700|Open+Sans:300,400,600,700,800');
      body {margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; outline: none !important;}
      table {border-spacing:0;}
      .pointer{cursor:pointer; position:relative;}
      .border-custom{ 2px solid #222 !important;}

      .hide{ display: none;}
      .cancel-button{ position: absolute; top: 10px;  right: 0px; height: 30px; color: #ffffff;  width: 30px; border-radius: 100%; padding-right: 10px; background-color: #007bff;}
      .cancel-button a{display: inline-block;left: 10px;position: relative;top: 3px;}

      table td {border-collapse: collapse;}
      img {-ms-interpolation-mode: bicubic; display: block; outline: none !important;}
      .ExternalClass {width: 100%;}
      .ExternalClass,.ExternalClass p,.ExternalClass span,.ExternalClass font,.ExternalClass td,.ExternalClass div {line-height: inherit;}
      .ReadMsgBody {width: 100%;background-color: #ffffff;}
      a[x-apple-data-detectors] { color: inherit !important; text-decoration: none !important; font-size: inherit !important; font-family: inherit !important; font-weight: inherit !important; line-height: inherit !important; }
      td a {color: inherit; text-decoration: none; outline: none !important; }
      a {color: inherit; text-decoration: none; border-style: none; outline: none !important; }
      .undoreset a, .undoreset a:hover {text-decoration: none !important;}
      .yshortcuts a {border-bottom: none !important;}
      .ios-footer a {color: #aaaaaa !important;text-decoration: none;}
      table p, table h1, table h2, table h3, table h4{ margin-top:0!important;margin-right:0!important;margin-bottom:0!important;margin-left:0!important;padding-top:0!important;padding-right:0!important;padding-bottom:0!important;padding-left:0!important;display: inline-block!important;font-family: inherit!important;}
      #canspamBar a img{display: inline-block !important;}
      .badge a img{display: inline-block !important;}
      @media screen and (max-width: 599px)
      {
         body{width:100% !important;}
         .container-main {width:100% !important; min-width:100% !important;}
         .container {width:100% !important; min-width:100% !important;}
         .container-wrap {display:inline-block !important; width:100% !important; height:auto !important; border-radius:0 !important;}
         .container-wrap>table{width:100% !important; min-width:100% !important;}
         .main-row>td{padding-left:15px !important; padding-right:15px !important;}
         .row {padding-left:15px !important; padding-right:15px !important;}
         .container-image img {width: 100% !important; height: auto !important; max-width:100% !important;}
         .fl-center {display: block !important; text-align: center !important;}
         .fl-center table {display: inline-block !important; float: none !important;}
         .fl-left {display:inline-block !important;}
         .icon-center {display:block !important; text-align:center !important;}
         .icon-center img {display:inline-block !important; float:none !important;}
         .icon-left {display:block !important; text-align:left !important;}
         .disable {display: none !important;}
         .pn {padding: 0 !important;}
         .pt-10 {padding-top: 10px !important;}
         .pt-20 {padding-top: 20px !important;}
         .pt-40 {padding-top: 40px !important;}
         .mob-40 {height:40px !important;}
         .txt-center {text-align: center !important;}
         .txt-left {text-align: left !important;}
         .bg-cov-perc {background-size: 100% 79% !important;}
         .border-none {border:0 !important;}
      }
   </style>

</head>
<body class="body">
   <div class="container-fluid">
      <div class="row">
         <div style="background-color: #333;" class="col-md-6">
            <div class="navigation mb-1 pointer">
              <div style="display:none;" class="cancel-button"><a id="#" href="#">X</a></div>
               <table data-group="navigation" width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 0px; border-collapse: collapse; margin: 0 auto;" data-module="navigation-11" data-thumb="http://www.stampready.net/dashboard/editor/user_uploads/zip_uploads/2019/04/01/quA5rxOyIJGf1ltjV7sLaSM8/Full/thumbnails/nav-11.jpg">
                  <tbody>
                     <tr>
                        <td align="center" style="background-color: #ededed" bgcolor="#ededed" data-bgcolor="body-bg">
                           <table class="container-main" align="center" border="0" cellpadding="0" cellspacing="0" style="min-width: 100%;">
                              <tbody>
                                 <tr class="main-row">
                                    <td align="center" style="width:100%; background-color:#ffffff;" bgcolor="#ffffff" data-bgcolor="white-bg">
                                       <table width="600" align="center" class="container" border="0" cellpadding="0" cellspacing="0" style="width:600px;">
                                          <tbody>
                                             <tr>
                                                <td height="20"></td>
                                             </tr>
                                             <tr>
                                                <td align="center">
                                                   <a href="https://ohram.org"><img src="https://ohram.org/images/logo/1589383129OHRAM%203-2.png" data-crop="false" width="auto" height="auto" alt="" style="display:block; width:100px;"></a>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td height="13"></td>
                                             </tr>
                                             <tr>
                                                <td align="center" style="padding-top:1px;">
                                                   <span class="text"  style="text-align:center; font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-size:12px; line-height: 20px; text-decoration: none; color: #000000 !important; font-weight:600; text-transform: uppercase; letter-spacing: 0.05em; display: inline-block;"  data-color="#000000" data-fontweight="600"  data-fontsize="12"  data-letterspacing="0.05" data-lineheight="20"  data-align="center"   data-size="nav-11-link-size" data-color="nav-11-link-color" data-link-style="color: #000000;" data-link-color="nav-11-link-color"><a  class="anchor-link  anchor" href="">MEAL REPLACEMENT SHAKES |</a></span>
                                                   <span class="text"  style="text-align:center; font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-size:12px; line-height: 20px; text-decoration: none; color: #000000  !important; font-weight:600; text-transform: uppercase; letter-spacing: 0.05em; display: inline-block;"  data-color="#000000" data-letterspacing="0.05"  data-fontsize="12"  data-lineheight="20"  data-align="center" data-size="nav-11-link-size" data-color="nav-11-link-color" data-link-style="color: #000000;" data-link-color="nav-11-link-color"><a  class="anchor-link  anchor"  href="">Gym accessories |</a></span>
                                                   <span class="text"  style="text-align:center; font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-size:12px; line-height: 20px; text-decoration: none; color: #000000  !important; font-weight:600; text-transform: uppercase; letter-spacing: 0.05em; display: inline-block;" data-color="#000000"  data-fontweight="600"  data-fontsize="12"   data-letterspacing="0.05" data-lineheight="20"  data-align="center"  data-size="nav-11-link-size" data-color="nav-11-link-color" data-link-style="color: #000000;" data-link-color="nav-11-link-color"><a  class="anchor-link  anchor"  href="">WEIGHT-LOSS |</a></span>
                                                   <span class="text"  style="text-align:center; font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-size:12px; line-height: 20px; text-decoration: none; color: #000000 !important; font-weight:600; text-transform: uppercase; letter-spacing: 0.05em; display: inline-block;"  data-color="#000000" data-fontweight="600"  data-fontsize="12"  data-letterspacing="0.05" data-lineheight="20"  data-align="center"  data-size="nav-11-link-size" data-color="nav-11-link-color" data-link-style="color: #000000;" data-link-color="nav-11-link-color"><a  class="anchor-link  anchor"   href="">BUNDLES </a></span>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td height="15"></td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
            <div class="titles mb-1 pointer">
               <div style="display:none;" class="cancel-button"><a id="#" href="#">X</a></div>
               <table data-group="titles" width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 0px; border-collapse: collapse; margin: 0 auto;" data-module="title-variant-2" data-thumb="http://www.stampready.net/dashboard/editor/user_uploads/zip_uploads/2019/04/01/quA5rxOyIJGf1ltjV7sLaSM8/Full/thumbnails/var-2.jpg">
                  <tbody>
                     <tr>
                        <td align="center" style="background-color: #ededed" bgcolor="#ededed" data-bgcolor="body-bg">
                           <table class="container-main" align="center" border="0" cellpadding="0" cellspacing="0" style="min-width: 100%;">
                              <tbody>
                                 <tr class="main-row">
                                    <td align="center" style="width:100%; background-color:#ffffff;" bgcolor="#ffffff" data-bgcolor="white-bg">
                                       <table width="460" align="center" class="container" border="0" cellpadding="0" cellspacing="0" style="width:460px;">
                                          <tbody>
                                             <tr>
                                                <td height="18"></td>
                                             </tr>
                                             <tr>
                                                <td class="text" data-color="#000000" data-fontweight="600"  data-letterspacing="0.05" data-lineheight="25"  data-align="center"  style="text-align:center; font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-size:20px; line-height: 25px; text-decoration: none; color: #000000; font-weight:600; text-transform: uppercase; letter-spacing: 0.05em" data-size="var-2-title-size" data-color="var-2-title-color" data-link-color="var-2-link-color" data-link-style="color: blue;">
                                                   Some words about
                                                </td>
                                             </tr>
                                             <tr>
                                                <td height="17"></td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
            <div class="titles mb-1 pointer">
              <div style="display:none;" class="cancel-button "><a id="#" href="#">X</a></div>
              <table data-group="titles" width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 0px; border-collapse: collapse; margin: 0 auto;" data-module="title-variant-6" data-thumb="http://www.stampready.net/dashboard/editor/user_uploads/zip_uploads/2019/04/01/quA5rxOyIJGf1ltjV7sLaSM8/Full/thumbnails/var-6.jpg">
                  <tbody>
                     <tr>
                        <td align="center" style="background-color: #ededed" bgcolor="#ededed" data-bgcolor="body-bg">
                           <table class="container-main" align="center" border="0" cellpadding="0" cellspacing="0" style="min-width: 100%;">
                              <tbody>
                                 <tr class="main-row">
                                    <td align="center" style="width:100%; background-color:#ffffff;" bgcolor="#ffffff" data-bgcolor="white-bg">
                                       <table width="410" align="center" class="container" border="0" cellpadding="0" cellspacing="0" style="width:410px;">
                                          <tbody>
                                             <tr>
                                                <td height="17"></td>
                                             </tr>
                                             <tr>
                                                <td data-color="#000000"  data-fontweight="600" data-fontsize="20"  data-letterspacing="0.05" data-lineheight="20"  data-align="center"  class="text" style="text-align:center; font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-size:20px; line-height: 25px; text-decoration: none; color: #000000; font-weight:600; text-transform: uppercase; letter-spacing: 0.05em" data-size="var-6-title-size" data-color="var-6-title-color" data-link-color="var-6-link-color" data-link-style="color: blue;">
                                                   Some words about
                                                </td>
                                             </tr>
                                             <tr>
                                                <td height="16"></td>
                                             </tr>
                                             <tr>
                                                <td data-fontweight="400"  data-color="#000000" data-fontsize="12" data-letterspacing="0.05" data-lineheight="20"  data-align="center"  class="text" style="text-align:center; font-family: 'Open Sans', Arial, Helvetica, sans-serif; font-size:12px; line-height: 19px; text-decoration: none; color: #444444; font-weight:400;" data-size="var-6-text-size" data-color="var-6-text-color" data-link-color="var-6-link-color" data-link-style="color: blue;">
                                                   The dismal man readily complied a circle waste again formed round the table, and harmonyss once is more prevailed
                                                </td>
                                             </tr>
                                             <tr>
                                                <td height="25"></td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
            <div class="titles mb-1 pointer">
              <div style="display:none;" class="cancel-button "><a id="#" href="#">X</a></div>
              <table data-group="titles" width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 0px; border-collapse: collapse; margin: 0 auto;" data-module="title-variant-8" data-thumb="http://www.stampready.net/dashboard/editor/user_uploads/zip_uploads/2019/04/01/quA5rxOyIJGf1ltjV7sLaSM8/Full/thumbnails/var-8.jpg">
                  <tbody>
                     <tr>
                        <td align="center" style="background-color: #ededed" bgcolor="#ededed" data-bgcolor="body-bg">
                           <table class="container-main" align="center" border="0" cellpadding="0" cellspacing="0" style="min-width: 100%;">
                              <tbody>
                                 <tr class="main-row">
                                    <td align="center" style="width:100%; background-color:#ffffff;" bgcolor="#ffffff" data-bgcolor="white-bg">
                                       <table width="600" align="center" class="container" border="0" cellpadding="0" cellspacing="0" style="width:600px;">
                                          <tbody>
                                             <tr>
                                                <td height="19"></td>
                                             </tr>
                                             <tr>
                                                <td  data-color="#000000" data-fontweight="600" data-fontsize="20"  data-letterspacing="0.05" data-lineheight="25"  data-align="left" class="text" style="text-align:left; font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-size:20px; line-height: 25px; text-decoration: none; color: #000000; font-weight:600; text-transform: uppercase; letter-spacing: 0.05em" data-size="var-8-title-size" data-color="var-8-title-color" data-link-color="var-8-link-color" data-link-style="color: blue;">
                                                   Some words about
                                                </td>
                                             </tr>
                                             <tr>
                                                <td height="15"></td>
                                             </tr>
                                             <tr>
                                                <td data-color="#000000" class="text" data-fontsize="12"  data-fontweight="600"  data-letterspacing="0.05" data-lineheight="20"  data-align="left" style="text-align:left; font-family: 'Open Sans', Arial, Helvetica, sans-serif; font-size:12px; line-height: 19px; text-decoration: none; color: #444444; font-weight:400;" data-size="var-6-text-size" data-color="var-6-text-color" data-link-color="var-6-link-color" data-link-style="color: blue;">
                                                   The dismal man readily complied a circle waste again formed round the table, and harmonyss once is more prevailed
                                                </td>
                                             </tr>
                                             <tr>
                                                <td height="25"></td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
            
            
            
            <div class="header mb-1 pointer">
              <div style="display:none;" class="cancel-button "><a id="#" href="#">X</a></div>
               <table data-group="header" class="bg-img-section" width="100%"  align="center" border="0" cellpadding="0" cellspacing="0" style="border: 0px; border-collapse: collapse; margin: 0 auto; cursor: pointer;" data-module="header-1" data-thumb="">
                  <tbody>
                     <tr>
                        <td align="center" style="background-color: #ededed" bgcolor="#ededed" data-bgcolor="body-bg">
                           <table class="container-main" align="center" border="0" cellpadding="0" cellspacing="0" style="min-width: 100%;">
                              <tbody>
                                 <tr class="main-row">
                                       <td align="center"  class="bg-img" style="cursor: pointer; background-color: rgb(204, 204, 204);min-height: 100%; background-image: url(&quot;https://www.ohram.org/images/category/A3uZabPZFqQEzeT4BQqCLO6vTiEKbcjjhoekP1vG.jpeg&quot;);   background-size: contain; background-repeat: no-repeat;"  bgcolor="#cccccc" height="500"  data-bgcolor="head-1-bg" data-bg="head-1-img">
                                          <!--[if gte mso 9]>
                                          <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="width:800px;height:360px; background-repeat:no-repeat; background-position:center;">
                                             <v:fill type="frame" src="https://www.ohram.org/images/category/A3uZabPZFqQEzeT4BQqCLO6vTiEKbcjjhoekP1vG.jpeg" color="#cccccc" ></v:fill>
                                             <v:textbox inset="0,0,0,0">
                                                <![endif]-->
                                                <table width="460" align="center" class="container" border="0" cellpadding="0" cellspacing="0" style="width:460px;">
                                                   <tbody>
                                                      <tr>
                                                         <td height="73"></td>
                                                      </tr>
                                                      <tr>
                                                         <td class="text" data-color="#ffffff" data-fontsize="25"  data-fontweight="600"  data-letterspacing="0.05" data-lineheight="33"  data-align="center" style="text-align:center; font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-size:25px; line-height: 33px; text-decoration: none; color: #ffffff; font-weight:600; text-transform: uppercase; letter-spacing: 0.05em" data-size="banner-2-title-size" data-color="banner-2-title-color" data-link-color="banner-2-link-color" data-link-style="color: blue;">
                                                            WE ARE GOOD AT WHAT WE DO
                                                         </td>
                                                      </tr>
                                                      <tr>
                                                         <td height="20"></td>
                                                      </tr>
                                                      <tr>
                                                         <td align="center">
                                                            <table width="380" align="center" class="container" border="0" cellpadding="0" cellspacing="0" style="width:380px;">
                                                               <tbody>
                                                                  <tr>
                                                                     <td data-color="#ffffff"  data-fontweight="600" data-fontsize="13"  data-letterspacing="0.05" data-lineheight="20"  data-align="center" class="text" style="text-align:center; font-family: 'Open Sans', Arial, Helvetica, sans-serif; font-size:13px; line-height: 20px; text-decoration: none; color: #ffffff; font-weight:400;" data-size="banner-2-text-size" data-color="banner-2-text-color" data-link-color="banner-2-link-color" data-link-style="color: blue;">
                                                                        The dismal man readily complied a circle was again formed round the table, and harmony once more prevailed. Some lingering irritability appeared.
                                                                     </td>
                                                                  </tr>
                                                               </tbody>
                                                            </table>
                                                         </td>
                                                      </tr>
                                                      <tr>
                                                         <td height="25"></td>
                                                      </tr>
                                                      <tr>
                                                         <td align="center">
                                                            <table align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#3498db" style="border-radius: 15px; background-color: #3498db; min-width: 110px;" data-bgcolor="blue-btn-bg">
                                                               <tbody>
                                                                  <tr>
                                                                     <td width="18"></td>
                                                                     <td class="text"  data-fontweight="600" data-color="#ffffff" height="30" align="center" style="height: 30px; text-align: center; font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-size: 11px; line-height:11px; color: #ffffff; font-weight: 700; text-decoration: none !important; text-transform: uppercase; letter-spacing: 0.05em;vertical-align: middle;" data-size="blue-btn-txt-size" data-color="blue-btn-txt-color"><a class="anchor anchor-link" href="http://ohram.com" data-size="blue-btn-txt-size" data-color="blue-btn-txt-color" style="color:#ffffff;">Read more</a></td>
                                                                     <td width="18"></td>
                                                                  </tr>
                                                               </tbody>
                                                            </table>
                                                         </td>
                                                      </tr>
                                                      <tr>
                                                         <td height="79"></td>
                                                      </tr>
                                                   </tbody>
                                                </table>
                                                <!--[if gte mso 9]>
                                             </v:textbox>
                                          </v:rect>
                                          <![endif]-->
                                       </td>
                                    
                                    
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                  </tbody>
               </table>
              
            </div>
            <div class="sale1 mb-1 pointer">
               <div  style="display:none;" class="cancel-button"><a id="#" href="#">X</a></div>
               <table data-group="sale" class="main-table" id="sale1" width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 0px; border-collapse: collapse; margin: 0 auto;" data-module="sale-2" data-thumb="">
                  <tbody>
                     <tr>
                        <td align="center" style="background-color: #ededed" bgcolor="#ededed" data-bgcolor="body-bg">
                           <table class="container-main" align="center" border="0" cellpadding="0" cellspacing="0" style="min-width: 100%;">
                              <tbody>
                                 <tr class="main-row">
                                    <td  class="bg-color-section" align="center" style="width:100%; background-color:#ffffff;" bgcolor="#ffffff" data-bgcolor="white-bg">
                                       <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                                          <tbody>
                                             <tr>
                                                <td height="40"></td>
                                             </tr>
                                          </tbody>
                                       </table>
                                       <table data-repeatable="" width="600" align="center" class="container" border="0" cellpadding="0" cellspacing="0" style="width:600px;">
                                          <tbody>
                                             <tr>
                                                <th width="280" align="left" class="container-wrap" valign="top" style="vertical-align: top; width:280px;">
                                                   <table width="280" align="left" class="container" border="0" cellpadding="0" cellspacing="0" style="width:280px;">
                                                      <tbody>
                                                         <tr>
                                                            <td align="center" class="container-image container-image1"><img class="p-img" src="https://www.ohram.org/images/products/w2FaZphzr9ZKfwYEkOnmOfd6gel2Y8gebdZYVjjj.jpeg" width="100%" height="auto" alt="" style="width: 100%; max-width: 280px; display: block; border: 0px;"></td>
                                                         </tr>
                                                         <tr>
                                                            <td height="17"></td>
                                                         </tr>
                                                         <tr>
                                                            <td class="text" data-fontweight="700"  data-letterspacing="0.05" data-lineheight="20"  data-fontsize="20" data-align="center" style="text-align:center; font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-size:20px; line-height: 20px; text-decoration: none; color: #000000; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em" data-size="sale-2-title-size" data-color="sale-2-title-color" data-link-color="sale-2-link-color" data-link-style="color: blue;">
                                                            Product Name
                                                            </td>
                                                         </tr>
                                                         <tr>
                                                            <td height="11"></td>
                                                         </tr>
                                                      
                                                         <tr>
                                                            <td class="text" data-fontweight="700" data-fontsize="25" data-letterspacing="0.05" data-lineheight="25"  data-align="center"  style="text-align:center; font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-size:25px; line-height: 25px; text-decoration: none; color: #000000; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em" data-size="sale-2-price-size" data-color="sale-2-price-color" data-link-color="sale-2-link-color" data-link-style="color: blue;">
                                                               $49
                                                               <strike  class="text">$99</strike>
                                                            </td>
                                                         </tr>
                                                         <tr>
                                                            <td height="27"></td>
                                                         </tr>
                                                         <tr>
                                                            <td align="center">
                                                               <table align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#27af9a" style="border-radius: 15px; background-color: #27af9a; min-width: 110px;" data-bgcolor="blue-btn-bg">
                                                                  <tbody>
                                                                     <tr>
                                                                        <td width="18"></td>
                                                                        <td class="text"  height="30" data-height="30" data-color="#000000" align="center" style="height: 30px; text-align: center; font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-size: 11px; line-height:11px; color: #ffffff; font-weight: 700; text-decoration: none !important; text-transform: uppercase; letter-spacing: 0.05em;vertical-align: middle;" data-size="blue-btn-txt-size" data-color="blue-btn-txt-color"><a href="#" class="anchor-link  anchor"  data-size="blue-btn-txt-size" data-color="blue-btn-txt-color" style="color:#ffffff;">Buy now</a></td>
                                                                        <td width="18"></td>
                                                                     </tr>
                                                                  </tbody>
                                                               </table>
                                                            </td>
                                                         </tr>
                                                         <tr>
                                                            <td height="38"></td>
                                                         </tr>
                                                      </tbody>
                                                   </table>
                                                </th>
                                                <th width="280" align="left" class="container-wrap" valign="top" style="vertical-align: top; width:280px;">
                                                   <table width="280" align="left" class="container" border="0" cellpadding="0" cellspacing="0" style="width:280px;">
                                                      <tbody>
                                                         <tr>
                                                            <td align="center" class="container-image container-image1"><img class="p-img" src="https://www.ohram.org/images/products/w2FaZphzr9ZKfwYEkOnmOfd6gel2Y8gebdZYVjjj.jpeg" width="100%" height="auto" alt="" style="width: 100%; max-width: 280px; display: block; border: 0px;"></td>
                                                         </tr>
                                                         <tr>
                                                            <td height="17"></td>
                                                         </tr>
                                                         <tr>
                                                            <td class="text" data-fontsize="20"   data-fontweight="700"  data-letterspacing="0.05" data-lineheight="25"  data-align="center"   style="text-align:center; font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-size:20px; line-height: 20px; text-decoration: none; color: #000000; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em" data-size="sale-2-title-size" data-color="sale-2-title-color" data-link-color="sale-2-link-color" data-link-style="color: blue;">
                                                            Product Name
                                                            </td>
                                                         </tr>
                                                         <tr>
                                                            <td height="11"></td>
                                                         </tr>
                                                        
                                                         <tr>
                                                            <td class="text" data-fontsize="25"   data-fontweight="700"  data-letterspacing="0.05" data-lineheight="25"  data-align="center"  style="text-align:center; font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-size:25px; line-height: 25px; text-decoration: none; color: #000000; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em" data-size="sale-2-price-size" data-color="sale-2-price-color" data-link-color="sale-2-link-color" data-link-style="color: blue;">
                                                               $49
                                                               <strike class="text">$99</strike>
                                                            </td>
                                                         </tr>
                                                         <tr>
                                                            <td height="27"></td>
                                                         </tr>
                                                         <tr>
                                                            <td align="center">
                                                               <table align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#27af9a" style="border-radius: 15px; background-color: #27af9a; min-width: 110px;" data-bgcolor="blue-btn-bg">
                                                                  <tbody>
                                                                     <tr>
                                                                        <td width="18"></td>
                                                                        <td class="text"  height="30" data-height="30" data-color="#000000" align="center" style="height: 30px; text-align: center; font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-size: 11px; line-height:11px; color: #ffffff; font-weight: 700; text-decoration: none !important; text-transform: uppercase; letter-spacing: 0.05em;vertical-align: middle;" data-size="blue-btn-txt-size" data-color="blue-btn-txt-color"><a href="#" class="anchor-link  anchor"  data-size="blue-btn-txt-size" data-color="blue-btn-txt-color" style="color:#ffffff;">Buy now</a></td>
                                                                        <td width="18"></td>
                                                                     </tr>
                                                                  </tbody>
                                                               </table>
                                                            </td>
                                                         </tr>
                                                         <tr>
                                                            <td height="38"></td>
                                                         </tr>
                                                      </tbody>
                                                   </table>
                                                </th>
                                              
                                             </tr>
                                          </tbody>
                                       </table>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
            <div class="sale2 pointer mb-1">
               <div style="display:none;" class="cancel-button"><a id="#" href="#">X</a></div>
               <table data-group="sale" class="main-table" width="100%"  align="center" border="0" cellpadding="0" cellspacing="0" style="border: 0px; border-collapse: collapse; margin: 0 auto;" data-module="sale-3" data-thumb="">
                  <tbody>
                     <tr>
                        <td align="center" style="background-color: #ededed;" bgcolor="#ededed" data-bgcolor="body-bg">
                           <table class="container-main" align="center" border="0" cellpadding="0" cellspacing="0" style="min-width: 100%;">
                              <tbody>
                                 <tr class="main-row">
                                    <td align="center"   class="bg-color-section" style="width:100%; background-color:#f8f8f8;" bgcolor="#f8f8f8" data-bgcolor="gray-bg">
                                       <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                                          <tbody>
                                             <tr>
                                                <td height="40"></td>
                                             </tr>
                                          </tbody>
                                       </table>
                                       <table data-repeatable="" width="600" align="center" class="container" border="0" cellpadding="0" cellspacing="0" style="width:600px;">
                                          <tbody>
                                             <tr>
                                                <th width="280" align="left" class="container-wrap" valign="top" style="vertical-align: top; width:280px;">
                                                   <table width="280" align="left" class="container" border="0" cellpadding="0" cellspacing="0" style="width:280px;">
                                                      <tbody>
                                                         <tr>
                                                            <td align="center" class="container-image"><a href="#"><img  class="p-img" src="https://www.ohram.org/images/products/i0t4pa1gO7qu9I4pEDjLs8t0yGxjZSXJHotSzjL1.jpeg" width="100%" height="auto" alt="" style="width: 100%; max-width: 280px; display: block; border: 0px;"></a></td>
                                                         </tr>
                                                         <tr>
                                                            <td height="30"></td>
                                                         </tr>
                                                         <tr>
                                                            <td class="text" data-color="#000000"   data-fontsize="20"   data-fontweight="700"  data-letterspacing="0.05" data-lineheight="20"  data-align="center" style="text-align:center; font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-size:20px; line-height: 20px; text-decoration: none; color: #000000; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em" data-size="sale-3-title-size" data-color="sale-3-title-color" data-link-color="sale-3-link-color" data-link-style="color: blue;">
                                                               Product 4
                                                            </td>
                                                         </tr>
                                                         <tr>
                                                            <td height="16"></td>
                                                         </tr>
                                                         <tr>
                                                            <td  class="text" data-color="#000000"  data-fontsize="25"  data-fontweight="700"  data-letterspacing="0.05" data-lineheight="25"  data-align="center" style="text-align:center; font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-size:25px; line-height: 25px; text-decoration: none; color: #000000; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em" data-size="sale-3-price-size" data-color="sale-3-price-color" data-link-color="sale-3-link-color" data-link-style="color: blue;">
                                                               $149
                                                            </td>
                                                         </tr>
                                                         <tr>
                                                            <td height="29"></td>
                                                         </tr>
                                                         <tr>
                                                            <td align="center">
                                                               <table align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#27af9a" style="border-radius: 15px; background-color: #27af9a; min-width: 110px;" data-bgcolor="blue-btn-bg">
                                                                  <tbody>
                                                                     <tr>
                                                                        <td width="18"></td>
                                                                        <td class="text"  height="30" data-height="30" data-color="#000000" align="center" style="height: 30px; text-align: center; font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-size: 11px; line-height:11px; color: #ffffff; font-weight: 700; text-decoration: none !important; text-transform: uppercase; letter-spacing: 0.05em;vertical-align: middle;" data-size="blue-btn-txt-size" data-color="blue-btn-txt-color"><a href="#" class="anchor-link  anchor"  data-size="blue-btn-txt-size" data-color="blue-btn-txt-color" style="color:#ffffff;">Buy now</a></td>
                                                                        <td width="18"></td>
                                                                     </tr>
                                                                  </tbody>
                                                               </table>
                                                            </td>
                                                         </tr>
                                                         <tr>
                                                            <td height="40"></td>
                                                         </tr>
                                                      </tbody>
                                                   </table>
                                                </th>
                                                <th width="280" align="right" class="container-wrap" valign="top" style="vertical-align: top;">
                                                   <table width="280" align="right" class="container" border="0" cellpadding="0" cellspacing="0" style="width:280px;">
                                                      <tbody>
                                                         <tr>
                                                            <td align="center" class="container-image"><img  class="p-img" src="https://www.ohram.org/images/products/N1b5BhgY5Wh8YyQzJhT9OgznIoJjV4DukDVm0NmB.jpeg" width="100%" height="auto" alt="" style="width: 100%; max-width: 280px; display: block; border: 0px;"></td>
                                                         </tr>
                                                         <tr>
                                                            <td height="30"></td>
                                                         </tr>
                                                         <tr>
                                                            <td class="text" data-color="#000000"  data-fontsize="20"    data-fontweight="700"  data-letterspacing="0.05" data-lineheight="20"  data-align="center" style="text-align:center; font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-size:20px; line-height: 20px; text-decoration: none; color: #000000; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em" data-size="sale-3-title-size" data-color="sale-3-title-color" data-link-color="sale-3-link-color" data-link-style="color: blue;">
                                                               best support
                                                            </td>
                                                         </tr>
                                                         <tr>
                                                            <td height="16"></td>
                                                         </tr>
                                                         <tr>
                                                            <td class="text"  data-color="#000000"  data-fontsize="25"  style="text-align:center; font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-size:25px; line-height: 25px; text-decoration: none; color: #000000; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em" data-size="sale-3-price-size" data-color="sale-3-price-color" data-link-color="sale-3-link-color" data-link-style="color: blue;">
                                                               $329
                                                            </td>
                                                         </tr>
                                                         <tr>
                                                            <td height="29"></td>
                                                         </tr>
                                                         <tr>
                                                            <td align="center">
                                                               <table align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#27af9a" style="border-radius: 15px; background-color: #27af9a; min-width: 110px;" data-bgcolor="blue-btn-bg">
                                                                  <tbody>
                                                                     <tr>
                                                                        <td width="18"></td>
                                                                        <td height="30"  class="text" data-color="#000000" align="center" style="height: 30px; text-align: center; font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-size: 11px; line-height:11px; color: #ffffff; font-weight: 700; text-decoration: none !important; text-transform: uppercase; letter-spacing: 0.05em;vertical-align: middle;" data-size="blue-btn-txt-size" data-color="blue-btn-txt-color"><a class="anchor-link  anchor" href="http://example.com" data-size="blue-btn-txt-size" data-color="blue-btn-txt-color" style="color:#ffffff;">Buy now</a></td>
                                                                        <td width="18"></td>
                                                                     </tr>
                                                                  </tbody>
                                                               </table>
                                                            </td>
                                                         </tr>
                                                         <tr>
                                                            <td height="40"></td>
                                                         </tr>
                                                      </tbody>
                                                   </table>
                                                </th>
                                             </tr>
                                             <tr class="disable">
                                                <td height="10"></td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
            <div class="banner3 pointer mb-1">
               <div style="display:none;" class="cancel-button"><a id="#" href="#">X</a></div>
               <table data-group="sale" class="main-table" width="100%"  align="center" border="0" cellpadding="0" cellspacing="0" style="border: 0px; border-collapse: collapse; margin: 0 auto;" data-module="sale-3" data-thumb="">
                  <tbody>
                     <tr>
                        <td align="center" style="background-color: #ededed;" bgcolor="#ededed" data-bgcolor="body-bg">
                           <table class="container-main" align="center" border="0" cellpadding="0" cellspacing="0" style="min-width: 100%;">
                              <tbody>
                                 <tr class="main-row">
                                    <td align="center"   class="bg-color-section" style="width:100%; background-color:#f8f8f8;" bgcolor="#f8f8f8" data-bgcolor="gray-bg">
                                       <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                                          <tbody>
                                             <tr>
                                                <td height="40"></td>
                                             </tr>
                                          </tbody>
                                       </table>
                                       <table data-repeatable="" width="600" align="center" class="container" border="0" cellpadding="0" cellspacing="0" style="width:600px;">
                                          <tbody>
                                             <tr>
                                                <th width="" align="left" class="container-wrap" valign="top" style="vertical-align: top; width:100%">
                                                   <table width="600" align="center" class="container" border="0" cellpadding="0" cellspacing="0" style="width:280px;">
                                                      <tbody>
                                                         <tr>
                                                            <td align="center" class="container-image"><a href="#"><img  class="p-img" src="https://www.ohram.org/images/products/i0t4pa1gO7qu9I4pEDjLs8t0yGxjZSXJHotSzjL1.jpeg" width="100%" height="auto" alt="" style="width: 100%; max-width: 600px; display: block; border: 0px;"></a></td>
                                                         </tr>
                                                         <tr>
                                                            <td height="30"></td>
                                                         </tr>
                                                         <tr>
                                                            <td class="text" data-color="#000000"   data-fontsize="20"   data-fontweight="700"  data-letterspacing="0.05" data-lineheight="20"  data-align="center" style="text-align:center; font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-size:20px; line-height: 20px; text-decoration: none; color: #000000; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em" data-size="sale-3-title-size" data-color="sale-3-title-color" data-link-color="sale-3-link-color" data-link-style="color: blue;">
                                                               Product 4
                                                            </td>
                                                         </tr>
                                                         <tr>
                                                            <td height="16"></td>
                                                         </tr>
                                                         <tr>
                                                            <td  class="text" data-color="#000000"  data-fontsize="25"  data-fontweight="700"  data-letterspacing="0.05" data-lineheight="25"  data-align="center" style="text-align:center; font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-size:25px; line-height: 25px; text-decoration: none; color: #000000; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em" data-size="sale-3-price-size" data-color="sale-3-price-color" data-link-color="sale-3-link-color" data-link-style="color: blue;">
                                                               $149
                                                            </td>
                                                         </tr>
                                                         <tr>
                                                            <td height="29"></td>
                                                         </tr>
                                                         <tr>
                                                            <td align="center">
                                                               <table align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#27af9a" style="border-radius: 15px; background-color: #27af9a; min-width: 110px;" data-bgcolor="blue-btn-bg">
                                                                  <tbody>
                                                                     <tr>
                                                                        <td width="18"></td>
                                                                        <td class="text"  height="30" data-height="30" data-color="#000000" align="center" style="height: 30px; text-align: center; font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-size: 11px; line-height:11px; color: #ffffff; font-weight: 700; text-decoration: none !important; text-transform: uppercase; letter-spacing: 0.05em;vertical-align: middle;" data-size="blue-btn-txt-size" data-color="blue-btn-txt-color"><a href="#" class="anchor-link  anchor"  data-size="blue-btn-txt-size" data-color="blue-btn-txt-color" style="color:#ffffff;">Buy now</a></td>
                                                                        <td width="18"></td>
                                                                     </tr>
                                                                  </tbody>
                                                               </table>
                                                            </td>
                                                         </tr>
                                                         <tr>
                                                            <td height="40"></td>
                                                         </tr>
                                                      </tbody>
                                                   </table>
                                                </th>
                                              
                                             </tr>
                                             <tr class="disable">
                                                <td height="10"></td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
            <div class="image50 mb-1 pointer">
               <div style="display:none;" class="cancel-button"><a id="#" href="#">X</a></div>
               <table data-group="image-50%" width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 0px; border-collapse: collapse; margin: 0 auto;" data-module="image-left" data-thumb="http://www.stampready.net/dashboard/editor/user_uploads/zip_uploads/2019/04/01/quA5rxOyIJGf1ltjV7sLaSM8/Full/thumbnails/image-left.jpg">
                  <tbody>
                     <tr>
                        <td align="center" style="background-color: #ededed" bgcolor="#ededed" data-bgcolor="body-bg">
                           <table class="container-main" align="center" border="0" cellpadding="0" cellspacing="0" style="min-width: 100%;">
                              <tbody>
                                 <tr class="main-row">
                                    <td align="center" style="width:100%; background-color:#ffffff;" bgcolor="#ffffff" data-bgcolor="white-bg">
                                       <table data-repeatable="" width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="width:100%; max-width:800px;">
                                          <tbody>
                                             <tr>
                                                <th width="50%" align="left" class="container-wrap" valign="top" style="vertical-align: top; width:50%;">
                                                   <table width="100%" align="left" class="container" border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                                                      <tbody>
                                                         <tr>
                                                            <td align="center"  class="container-image"><img  class="p-img" src="https://www.ohram.org/images/category/A3uZabPZFqQEzeT4BQqCLO6vTiEKbcjjhoekP1vG.jpeg" width="100%" height="auto" alt="" style="width: 100%; max-width: 500px; display: block; border: 0px;"></td>
                                                         </tr>
                                                      </tbody>
                                                   </table>
                                                </th>
                                                <th width="50%" align="right" class="container-wrap" valign="top" style="vertical-align: top; width:50%;">
                                                   <table width="100%" align="right" class="container" border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                                                      <tbody>
                                                         <tr>
                                                            <td align="left" class="pn" style="padding-left:40px;">
                                                               <table width="260" align="left" class="container" border="0" cellpadding="0" cellspacing="0" style="width:260px;">
                                                                  <tbody>
                                                                     <tr>
                                                                        <td height="10"></td>
                                                                     </tr>
                                                                     <tr class="disable">
                                                                        <td height="20"></td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td class="text" data-color="#000000"  data-fontsize="14"   data-fontweight="400"  data-letterspacing="0.05" data-lineheight="14"  data-align="left" style="text-align:left; font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-size:14px; line-height: 14px; text-decoration: none; color: #000000; font-weight:600; text-transform: uppercase; letter-spacing: 0.05em" data-size="img-left-sup-title-size" data-color="img-left-sup-title-color" data-link-color="img-left-link-color" data-link-style="color: blue;">
                                                                           latest project
                                                                        </td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td height="13"></td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td  class="text"  data-color="#000000" data-fontsize="13"  data-fontweight="400"  data-letterspacing="0.05" data-lineheight="20"  data-color="" data-align="left" style="text-align:left; font-family: 'Open Sans', Arial, Helvetica, sans-serif; font-size:13px; line-height: 20px; text-decoration: none; color: #444444; font-weight:400;" data-size="img-left-text-size" data-color="img-left-text-color" data-link-color="img-left-link-color" data-link-style="color: blue;">
                                                                           The sight of the tumblers restored Bob Sawy- er to a degree of equanimity which.
                                                                        </td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td height="35"></td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td align="left">
                                                                           <table align="left" border="0" cellpadding="0" cellspacing="0" bgcolor="#3498db" style="border-radius: 15px; background-color: #3498db; min-width: 110px;" data-bgcolor="blue-btn-bg">
                                                                              <tbody>
                                                                                 <tr>
                                                                                    <td width="18"></td>
                                                                                    <td height="30" class="text" data-color="#000000" align="center" style="height: 30px; text-align: center; font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-size: 11px; line-height:11px; color: #ffffff; font-weight: 700; text-decoration: none !important; text-transform: uppercase; letter-spacing: 0.05em;vertical-align: middle;" data-size="blue-btn-txt-size" data-color="blue-btn-txt-color"><a class="anchor-link  anchor"  href="http://example.com" data-size="blue-btn-txt-size" data-color="blue-btn-txt-color" style="color:#ffffff;">Read more</a></td>
                                                                                    <td width="18"></td>
                                                                                 </tr>
                                                                              </tbody>
                                                                           </table>
                                                                        </td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td height="40"></td>
                                                                     </tr>
                                                                  </tbody>
                                                               </table>
                                                            </td>
                                                         </tr>
                                                      </tbody>
                                                   </table>
                                                </th>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
            <div class="image50 mb-1 pointer">
               <div style="display:none;" class="cancel-button"><a id="#" href="#">X</a></div>
               <table data-group="image-50%" width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 0px; border-collapse: collapse; margin: 0 auto;" data-module="image-right" data-thumb="http://www.stampready.net/dashboard/editor/user_uploads/zip_uploads/2019/04/01/quA5rxOyIJGf1ltjV7sLaSM8/Full/thumbnails/image-right.jpg">
                  <tbody>
                     <tr>
                        <td align="center" style="background-color: #ededed" bgcolor="#ededed" data-bgcolor="body-bg">
                           <table class="container-main" align="center" border="0" cellpadding="0" cellspacing="0" style="min-width: 100%;">
                              <tbody>
                                 <tr class="main-row">
                                    <td align="center"  class="bg-color-section" style="width:100%; background-color:#ffffff;" bgcolor="#ffffff" data-bgcolor="white-bg">
                                       <table data-repeatable="" dir="rtl" width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="width:100%; max-width:800px;">
                                          <tbody>
                                             <tr>
                                                <th width="50%" align="left" class="container-wrap" valign="top" style="vertical-align: top; width:50%;">
                                                   <table width="100%" align="left" class="container" border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                                                      <tbody>
                                                         <tr>
                                                            <td align="center" class="container-image"><img  class="p-img" src="https://www.ohram.org/images/category/A3uZabPZFqQEzeT4BQqCLO6vTiEKbcjjhoekP1vG.jpeg" width="100%" height="auto" alt="" style="width: 100%; max-width: 400px; display: block; border: 0px;"></td>
                                                         </tr>
                                                      </tbody>
                                                   </table>
                                                </th>
                                                <th dir="ltr" width="50%" align="right" class="container-wrap" valign="top" style="vertical-align: top; width:50%;">
                                                   <table width="100%" align="right" class="container" border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                                                      <tbody>
                                                         <tr>
                                                            <td align="right" class="pn" style="padding-right:40px;">
                                                               <table width="260" align="right" class="container" border="0" cellpadding="0" cellspacing="0" style="width:260px;">
                                                                  <tbody>
                                                                     <tr>
                                                                        <td height="10"></td>
                                                                     </tr>
                                                                     <tr class="disable">
                                                                        <td height="20"></td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td   class="text" data-color="#000000"  data-fontsize="14 "  data-fontweight="600"  data-letterspacing="0.05" data-lineheight="14"  data-align="left" style="text-align:left; font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-size:14px; line-height: 14px; text-decoration: none; color: #000000; font-weight:600; text-transform: uppercase; letter-spacing: 0.05em" data-size="img-right-sup-title-size" data-color="img-right-sup-title-color" data-link-color="img-right-link-color" data-link-style="color: blue;">
                                                                           latest project
                                                                        </td>
                                                                     </tr>
                                                                   
                                                                    
                                                                     <tr>
                                                                        <td height="13"></td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td class="text"  data-color="#000000" data-fontsize="13"  data-fontweight="400"  data-letterspacing="0.05" data-lineheight="20"  data-align="left"  style="text-align:left; font-family: 'Open Sans', Arial, Helvetica, sans-serif; font-size:13px; line-height: 20px; text-decoration: none; color: #444444; font-weight:400;" data-size="img-right-text-size" data-color="img-right-text-color" data-link-color="img-right-link-color" data-link-style="color: blue;">
                                                                           The sight of the tumblers restored Bob Sawy- er to a degree of equanimity which.
                                                                        </td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td height="35"></td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td align="left">
                                                                           <table align="left" border="0" cellpadding="0" cellspacing="0" bgcolor="#3498db" style="border-radius: 15px; background-color: #3498db; min-width: 110px;" data-bgcolor="blue-btn-bg">
                                                                              <tbody>
                                                                                 <tr>
                                                                                    <td width="18"></td>
                                                                                    <td height="30"  data-color="#000000" align="center" class="text" style="height: 30px; text-align: center; font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-size: 11px; line-height:11px; color: #ffffff; font-weight: 700; text-decoration: none !important; text-transform: uppercase; letter-spacing: 0.05em;vertical-align: middle;" data-size="blue-btn-txt-size" data-color="blue-btn-txt-color"><a class="anchor-link  anchor"  href="http://example.com" data-size="blue-btn-txt-size" data-color="blue-btn-txt-color" style="color:#ffffff;">Read more</a></td>
                                                                                    <td width="18"></td>
                                                                                 </tr>
                                                                              </tbody>
                                                                           </table>
                                                                        </td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td height="40"></td>
                                                                     </tr>
                                                                  </tbody>
                                                               </table>
                                                            </td>
                                                         </tr>
                                                      </tbody>
                                                   </table>
                                                </th>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
            
            <div class="team mb-1 pointer">
               <div style="display:none;" class="cancel-button"><a id="#" href="#">X</a></div>
               <table data-group="team"  class="main-table" width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 0px; border-collapse: collapse; margin: 0 auto;" data-module="team-5" data-thumb="http://www.stampready.net/dashboard/editor/user_uploads/zip_uploads/2019/04/01/quA5rxOyIJGf1ltjV7sLaSM8/Full/thumbnails/team-5.jpg">
                  <tbody>
                     <tr>
                        <td align="center" style="background-color: #ededed" bgcolor="#ededed" data-bgcolor="body-bg">
                           <table class="container-main" align="center" border="0" cellpadding="0" cellspacing="0" style="min-width: 100%;">
                              <tbody>
                                 <tr class="main-row">
                                    <td align="center" class="bg-color-section" style="width:100%; background-color:#f8f8f8;" bgcolor="#f8f8f8" data-bgcolor="gray-bg">
                                       <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                                          <tbody>
                                             <tr>
                                                <td height="40"></td>
                                             </tr>
                                          </tbody>
                                       </table>
                                       <table data-repeatable="" dir="rtl" width="600" align="center" class="container" border="0" cellpadding="0" cellspacing="0" style="width:600px;">
                                          <tbody>
                                             <tr>
                                                <th width="180" align="right" class="container-wrap" valign="top" style="vertical-align: top;">
                                                   <table width="180" align="right" class="container" border="0" cellpadding="0" cellspacing="0" style="width:180px;">
                                                      <tbody>
                                                         <tr>
                                                            <td align="center" class="container-image"><img class="p-img" src="https://www.ohram.org/images/reviews/QxrlDUDCUog0CdzwoeVORRTFatu1FIGm9ledm8lG.jpeg" width="100%" height="auto" alt="" style="width: 100%; max-width: 180px; display: block; border: 0px;"></td>
                                                         </tr>
                                                      </tbody>
                                                   </table>
                                                </th>
                                                <th dir="ltr" width="395" align="right" class="container-wrap border-none" valign="top" style="vertical-align: top;">
                                                   <table width="100%" align="right" border="0" cellpadding="0" cellspacing="0" style="width:100%; border-left: 4px solid #3498db;" data-border-left-color="blue-line-left">
                                                      <tbody>
                                                         <tr>
                                                            <td align="left" style="padding-left: 15px;">
                                                               <table width="365" align="left" class="container" border="0" cellpadding="0" cellspacing="0" style="width: 365px;">
                                                                  <tbody>
                                                                     <tr>
                                                                        <td height="18"></td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td data-fontweight="600"  data-color="#000000" data-fontsize="14"  data-letterspacing="0.05" data-lineheight="14"  data-align="left"  class="text" style="text-align:left; font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-size:14px; line-height: 14px; text-decoration: none; color: #000000; font-weight:600; text-transform: uppercase; letter-spacing: 0.05em" data-size="team-5-title-size" data-color="team-5-title-color" data-link-color="team-5-link-color" data-link-style="color: blue;">
                                                                           Fiona 
                                                                        </td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td height="5"></td>
                                                                     </tr>
                                                                    
                                                                     <tr>
                                                                        <td class="text" data-color="#444444"  data-fontsize="13"  data-fontweight="400"  data-letterspacing="0.05" data-lineheight="14"  data-align="left"  style="text-align:left; font-family: 'Open Sans', Arial, Helvetica, sans-serif; font-size:13px; line-height: 20px; text-decoration: none; color: #444444; font-weight:400;" data-size="team-5-text-size" data-color="team-5-text-color" data-link-color="team-5-link-color" data-link-style="color: blue;">
                                                                        I’m still on my journey with the tea and coffee I got from u. I was about 92kg when I started, I checked my weight last week I was weighing 86.4kg. I couldn't stop screaming out of excitement 🤣🤣 Thank you so much your products are really effective 😁 💃🏽
                                                                        </td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td height="23"></td>
                                                                     </tr>
                                                                   
                                                                     <tr class="disable">
                                                                        <td height="20"></td>
                                                                     </tr>
                                                                  </tbody>
                                                               </table>
                                                            </td>
                                                         </tr>
                                                      </tbody>
                                                   </table>
                                                </th>
                                             </tr>
                                             <tr>
                                                <td height="40"></td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
           
            <div class="blog mb-1 pointer">
               <div style="display:none;" class="cancel-button"><a id="#" href="#">X</a></div>
               <table data-group="blog" class="main-table" width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 0px; border-collapse: collapse; margin: 0 auto;" data-module="blog-4" data-thumb="http://www.stampready.net/dashboard/editor/user_uploads/zip_uploads/2019/04/01/quA5rxOyIJGf1ltjV7sLaSM8/Full/thumbnails/blg-4.jpg">
                  <tbody>
                     <tr>
                        <td align="center" class="bg-color-section" style="background-color: #ededed" bgcolor="#ededed" data-bgcolor="body-bg">
                           <table class="container-main" align="center" border="0" cellpadding="0" cellspacing="0" style="min-width: 100%;">
                              <tbody>
                                 <tr class="main-row">
                                    <td align="center"  class="bg-color-section" style="width:100%; background-color:#f8f8f8;" bgcolor="#f8f8f8" data-bgcolor="gray-bg">
                                       <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                                          <tbody>
                                             <tr>
                                                <td height="40"></td>
                                             </tr>
                                          </tbody>
                                       </table>
                                       <table data-repeatable="" width="600" align="center" class="container" border="0" cellpadding="0" cellspacing="0" style="width:600px;">
                                          <tbody>
                                             <tr>
                                                <th width="280" align="left" class="container-wrap" valign="top" style="vertical-align: top; width:280px;">
                                                   <table width="280" align="left" class="container" border="0" cellpadding="0" cellspacing="0" style="width:280px;">
                                                      <tbody>
                                                         <tr>
                                                            <td align="center" class="container-image"><img class="p-img" src="https://www.ohram.org/images/blog/HKtMy0JphR2qCKrox2hqPDRaLuKcPvjl8GnIk2lR.jpeg" width="100%" height="auto" alt="" style="width: 100%; max-width: 280px; display: block; border: 0px;"></td>
                                                         </tr>
                                                         <tr>
                                                            <td height="20"></td>
                                                         </tr>
                                                         <tr>
                                                            <td class="text" data-color="#000000"  data-fontsize="14 "   data-fontweight="800"  data-letterspacing="0.05" data-lineheight="14"  data-align="center"  style="text-align:center; font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-size:14px; line-height: 14px; text-decoration: none; color: #000000; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em" color="#FF0000" data-size="blg-4-title-size" data-link-color="blg-4-link-color" data-link-style="color: blue;" data-color="blg-4-title-color">
                                                               best support
                                                            </td>
                                                         </tr>
                                                         <tr>
                                                            <td height="11"></td>
                                                         </tr>
                                                         <tr>
                                                            <td class="text"  data-fontsize="13"  data-fontweight="400"  data-letterspacing="0.05" data-lineheight="20"  data-align="center"  style="text-align:center; font-family: 'Open Sans', Arial, Helvetica, sans-serif; font-size:13px; line-height: 20px; text-decoration: none; color: #444444; font-weight:400;" data-size="blg-4-text-size" data-color="blg-4-text-color" data-link-color="blg-4-link-color" data-link-style="color: blue;">
                                                               The sight of the tumblers restored Bob Sawy- er to a degree of equanimity which he had notest possessed since his interview with his landlady. His face brightened up.
                                                            </td>
                                                         </tr>
                                                         <tr>
                                                            <td height="25"></td>
                                                         </tr>
                                                         <tr>
                                                            <td align="center">
                                                               <table align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#27af9a" style="border-radius: 15px; background-color: #27af9a; min-width: 110px;" data-bgcolor="blue-btn-bg">
                                                                  <tbody>
                                                                     <tr>
                                                                        <td width="18"></td>
                                                                        <td class="text" data-color="#ffffff"  data-fontweight="700" height="30" align="center" style="height: 30px; text-align: center; font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-size: 11px; line-height:11px; color: #ffffff; font-weight: 700; text-decoration: none !important; text-transform: uppercase; letter-spacing: 0.05em;vertical-align: middle;" data-size="blue-btn-txt-size" data-color="blue-btn-txt-color"><a href="#" class="anchor anchor-link" data-size="blue-btn-txt-size" data-color="blue-btn-txt-color" style="color:#ffffff;">Buy now</a></td>
                                                                        <td width="18"></td>
                                                                     </tr>
                                                                  </tbody>
                                                               </table>
                                                            </td>
                                                         </tr>
                                                         <tr>
                                                            <td height="40"></td>
                                                         </tr>
                                                      </tbody>
                                                   </table>
                                                </th>
                                                <th width="280" align="right" class="container-wrap" valign="top" style="vertical-align: top;">
                                                   <table width="280" align="right" class="container" border="0" cellpadding="0" cellspacing="0" style="width:280px;">
                                                      <tbody>
                                                         <tr>
                                                            <td align="center" class="container-image"><img class="p-img" src="https://www.ohram.org/images/blog/OfLiFPog7B9BtWOtnEdwAulQPgkLuzjinWHYtxKu.jpeg" width="100%" height="auto" alt="" style="width: 100%; max-width: 280px; display: block; border: 0px;"></td>
                                                         </tr>
                                                         <tr>
                                                            <td height="20"></td>
                                                         </tr>
                                                         <tr>
                                                            <td  class="text"  data-color="#000000"  data-fontsize="14"  data-fontweight="800"  data-letterspacing="0.05" data-lineheight="14"  data-align="center"  style="text-align:center; font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-size:14px; line-height: 14px; text-decoration: none; color: #000000; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em" data-size="blg-4-title-size" data-link-color="blg-4-link-color" data-link-style="color: blue;" data-color="blg-4-title-color">
                                                               layared psd
                                                            </td>
                                                         </tr>
                                                         <tr>
                                                            <td height="11"></td>
                                                         </tr>
                                                         <tr>
                                                            <td class="text" data-color="#000000"  data-fontsize="13"  data-fontweight="400"  data-letterspacing="0.05" data-lineheight="20"  data-align="center"  style="text-align:center; font-family: 'Open Sans', Arial, Helvetica, sans-serif; font-size:13px; line-height: 20px; text-decoration: none; color: #444444; font-weight:400;"  style="color: #cccccc;" data-size="blg-4-text-size" data-color="blg-4-text-color" data-link-color="blg-4-link-color" data-link-style="color: blue;">
                                                               The dismal man readily complied a circle was- te again formed round the table, and harmonyss once is more prevailed. Some lingering irritability appeared to find a.
                                                            </td>
                                                         </tr>
                                                         <tr>
                                                            <td height="25"></td>
                                                         </tr>
                                                         <tr>
                                                            <td align="center">
                                                               <table align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#27af9a" style="border-radius: 15px; background-color: #27af9a; min-width: 110px;" data-bgcolor="blue-btn-bg">
                                                                  <tbody>
                                                                     <tr>
                                                                        <td width="18"></td>
                                                                        <td class="text"  data-fontweight="700" height="30" align="center" style="height: 30px; text-align: center; font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-size: 11px; line-height:11px; color: #ffffff; font-weight: 700; text-decoration: none !important; text-transform: uppercase; letter-spacing: 0.05em;vertical-align: middle;" data-size="blue-btn-txt-size" data-color="blue-btn-txt-color"><a href="#" class="anchor anchor-link" data-size="blue-btn-txt-size" data-color="blue-btn-txt-color" style="color:#ffffff;">Buy now</a></td>
                                                                        <td width="18"></td>
                                                                     </tr>
                                                                  </tbody>
                                                               </table>
                                                            </td>
                                                         </tr>
                                                         <tr>
                                                            <td height="40"></td>
                                                         </tr>
                                                      </tbody>
                                                   </table>
                                                </th>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
            
            <div class="text-blocks mb-1 pointer">
               <div style="display:none;" class="cancel-button"><a id="#" href="#">X</a></div>
               <table data-group="text-blocks" class="main-table" width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 0px; border-collapse: collapse; margin: 0 auto;" data-module="text-block-1" data-thumb="">
                  <tbody>
                     <tr>
                        <td align="center" style="background-color: #ededed" bgcolor="" data-bgcolor="body-bg">
                           <table class="container-main" align="center" border="0" cellpadding="0" cellspacing="0" style="min-width: 100%;">
                              <tbody>
                                 <tr class="main-row">
                                    <td align="center"  class="bg-color-section" style="width:100%; background-color:#f8f8f8;" bgcolor="#f8f8f8" data-bgcolor="gray-bg">
                                       <table width="600" align="center" class="container" border="0" cellpadding="0" cellspacing="0" style="width:600px;">
                                          <tbody>
                                             <tr>
                                                <td height="35"></td>
                                             </tr>
                                             <tr>
                                                <td class="text"  data-color="#000000"  data-fontsize="13"   data-fontweight="400"  data-letterspacing="0.05" data-lineheight="20"  data-align="left"  data-fontweight="400"  data-letterspacing="0.05" data-lineheight="20"  data-align="left"  style="text-align:left; font-family: 'Open Sans', Arial, Helvetica, sans-serif; font-size:13px; line-height: 20px; text-decoration: none; color: #444444; font-weight:400;" data-size="txt-blck-1-text-size" data-color="txt-blck-1-text-color" data-link-color="txt-blck-1-link-color" data-link-style="color: blue;">
                                                   The dismal man readily complied a circle was again formed round the table, and harmony once more prevailed. Some lingering irritability appeared to find a resting-place in Mr. Winkle's bosom, occasioned possibly by the temporary abstraction of his coatsahough it is scarcely reasonable to suppose that so slight a circumstance can have excited even.
                                                </td>
                                             </tr>
                                             <tr>
                                                <td height="46"></td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
            
            <div class="footer mb-1 pointer">
               <div style="display:none;" class="cancel-button"><a id="#" href="#">X</a></div>
               <table data-group="footer" class="main-table" width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 0px; border-collapse: collapse; margin: 0 auto;" data-module="footer-4" data-thumb="http://www.stampready.net/dashboard/editor/user_uploads/zip_uploads/2019/04/01/quA5rxOyIJGf1ltjV7sLaSM8/Full/thumbnails/footer-4.jpg">
                  <tbody>
                     <tr>
                        <td align="center" style="background-color: #ffffff" bgcolor="#ffffff" data-bgcolor="body-bg">
                           <table class="container-main" align="center" border="0" cellpadding="0" cellspacing="0" style="min-width: 100%;">
                              <tbody>
                                 <tr class="main-row">
                                    <td align="center" class="bg-color-section" style="width:100%; background-color:#ffffff;" bgcolor="#ffffff" data-bgcolor="gray-bg">
                                       <table width="280" align="center" class="container" border="0" cellpadding="0" cellspacing="0" style="width:280px;">
                                          <tbody>
                                             <tr>
                                                <td height="35"></td>
                                             </tr>
                                             <tr>
                                                <td class="text"  data-color="#000000"  style="vertical-align:top; text-align:center; font-family: 'Open Sans', Arial, Helvetica, sans-serif; font-size:13px; line-height: 20px; text-decoration: none; color: #444444; font-weight: 400;" data-size="footer-4-rights-size" data-color="footer-4-rights-color" data-link-color="footer-4-link-color" data-link-style="color: blue;">
                                                   Copyright © Ohram 2020
                                                </td>
                                             </tr>
                                             <tr>
                                                <td height="20"></td>
                                             </tr>
                                             <tr>
                                                <td valign="top" align="center">
                                                   <table border="0" cellpadding="0" cellspacing="0" align="center">
                                                      <tbody>
                                                         <tr>
                                                            <td align="center">
                                                               <!--[if (gte mso 9)|(IE)]>
                                                            </td>
                                                            <td valign="middle">
                                                               <![endif]-->
                                                               <table data-repeatable="" border="0" cellpadding="0" cellspacing="0" style="display:table-cell;vertical-align:middle;">
                                                                  <tbody>
                                                                     <tr>
                                                                        <td align="center" style="padding-right:6px;" valign="middle"><img src="/images/icons/t-icon-blue.png" border="0" data-crop="false" width="auto" height="auto" alt="" style="display:block; border: 0px; width: auto;"></td>
                                                                     </tr>
                                                                  </tbody>
                                                               </table>
                                                               <!--[if (gte mso 9)|(IE)]>
                                                            </td>
                                                            <td valign="middle">
                                                               <![endif]-->
                                                               
                                                               <!--[if (gte mso 9)|(IE)]>
                                                            </td>
                                                            <td valign="middle">
                                                               <![endif]-->
                                                               <table data-repeatable="" border="0" cellpadding="0" cellspacing="0" style="display:table-cell;vertical-align:middle;">
                                                                  <tbody>
                                                                     <tr>
                                                                        <td align="center" style="padding:0 6px;" valign="middle"><img src="/images/icons/f-icon-blue.png" border="0" data-crop="false" width="auto" height="auto" alt="" style="display:block; border: 0px; width: auto;"></td>
                                                                     </tr>
                                                                  </tbody>
                                                               </table>
                                                               <!--[if (gte mso 9)|(IE)]>
                                                            </td>
                                                            <td valign="middle">
                                                               <![endif]-->
                                                             
                                                               <!--[if (gte mso 9)|(IE)]>
                                                            </td>
                                                            <td valign="middle">
                                                               <![endif]-->
                                                              
                                                               <!--[if (gte mso 9)|(IE)]>
                                                            </td>
                                                            <td valign="middle">
                                                               <![endif]-->
                                                               <table data-repeatable="" border="0" cellpadding="0" cellspacing="0" style="display:table-cell;vertical-align:middle;">
                                                                  <tbody>
                                                                     <tr>
                                                                        <td align="center" style="padding:0 6px;" valign="middle"><img src="/images/icons/ins-icon-blue.png" border="0" data-crop="false" width="auto" height="auto" alt="" style="display:block; border: 0px; width: auto;"></td>
                                                                     </tr>
                                                                  </tbody>
                                                               </table>
                                                               <!--[if (gte mso 9)|(IE)]>
                                                            </td>
                                                            <td valign="middle">
                                                               <![endif]-->
                                                              
                                                            </td>
                                                         </tr>
                                                      </tbody>
                                                   </table>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td height="15"></td>
                                             </tr>
                                             <tr>
                                                <td class="text" data-color="#444444" style="vertical-align:top; text-align:center; font-family: 'Open Sans', Arial, Helvetica, sans-serif; font-size:13px; line-height: 13px; text-decoration: none; color: #444444; font-weight: 400;" data-size="footer-4-unsub-size" data-color="footer-4-unsub-color" data-link-color="footer-4-link-color" data-link-style="color: blue;"><a href="sr_unsubscribe" style="vertical-align:top; text-align:center; font-family: 'Open Sans', Arial, Helvetica, sans-serif; font-size:13px; line-height: 13px; text-decoration: none; color: #444444; font-weight: 400;" data-size="footer-4-unsub-size" data-color="footer-4-unsub-color" data-link-color="footer-4-link-color" data-link-style="color: blue;"><a href="https://ohram.org/newsletter/unsubscribe">Unsubscribe</a></td>
                                             </tr>
                                             <tr>
                                                <td height="44"></td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
            
         </div>
         <div class="col-md-6 mt-5 ">
         <a href="{{ route('templates.index') }}"><< Back</a>
            <form class="" action="{{ route('templates.store') }}"  method="post" enctype="multipart/form-data" id="form--template">
               @csrf

               <button id="apply" type="button" class="btn btn-primary">Apply</button>

               <button type="submit" id="save-template" disabled="true" class="btn btn-primary">Save Template</button>
               <div class="form-group">
                  <label for="template-name">Name</label>
                  <input type="text" name="name" class="form-control" id="template-name" value="Template Name" aria-describedby="emailHelp" placeholder="Enter Name">
               </div>
               <p class="hide clear-all"><a id="clear" href="">Clear </a></p>
               <div id="template">
                   
               </div>
               <input type="hidden"  id="html" name="html" />
            </form>
         </div>
         <div data-notify="container" class="col-xs-12 col-sm-12 alert alert-danger alert-with-icon" role="alert" data-notify-position="bottom-center" style="display: inline-block; margin: 15px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1031; bottom: -15px; left: 0px; right: 0px;">
         <p  class="pull-right"><a  id="panel-toggle" href="#">+ Expand</a><p>
            <form class="hide">
               <div class="form-row">
                  <div class="form-group col-md-4">
                     <label for="font-slider">Increase Font</label>
                     <input type="text"  id="font-slider"  min="11"  step="1" max="50"  class="form-control">
                  </div>
                  <div class="form-group col-md-4">
                     <label for="font-slider">Line Height Font</label>
                     <input type="text"  id="font-line-height"  min="11"  step="1" max="50"  class="form-control">
                  </div>
                  <div class="form-group col-md-4">
                     <label for="bg-color">Background Color</label>
                     <input type="text" id="bg-color" class="form-control colorpicker" >
                  </div>
                  <div class="form-group col-md-4">
                     <label for="font-color">Font Color</label>
                     <input type="text" id="font-color" class="form-control colorpicker" >
                  </div>
                  <div class="form-group col-md-4">
                     <label for="btn-color">Button Color</label>
                     <input type="text"  id="btn-color" class="colorpicker form-control" >
                  </div>
                  <!-- <div class="form-group col-md-4">
                     <label for="btn-slider">Button Height</label>
                     <input type="text"  id="btn-height"  min="1" max="1000"  class="form-control"  placeholder="">
                  </div> -->
                 
                  <div class="form-group col-md-4">
                     <label for="inputPassword4">Img Link</label>
                     <input type="text" class="form-control" id="img-src" placeholder="link">
                  </div>
                  <div class="form-group col-md-4">
                     <label for="inputPassword4">Anchor Link</label>
                     <input type="text" class="form-control" id="anchor-link" placeholder="link">
                  </div>
                  <div class="form-group col-md-2">
                     <label for="bg-img-height">Bg Image Height</label>
                     <input type="text" class="form-control" id="bg-img-height" placeholder="Height">
                  </div>
                  <!-- <div class="form-group col-md-2">
                     <label for="inputPassword4">Image Width</label>
                     <input type="text" class="form-control" id="anchor-link" placeholder="Width">
                  </div> -->
               </div>
               <!-- <div class="border text-right">
                  <button type="submit" class="btn btn-primary">Apply</button>
               </div> -->
            </form>
         </div>
      </div>
   </div>

   <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
   <script src="{{ asset('store/js/bootstrap-colorpicker.min.js') }}"></script>

   <script type="text/javascript">
      $(document).ready(function(){
             //

            var self,text_align,line_height,letter_spacing,font_weight,font_size,color;
           
            $('.pointer').on('click',function(e){
               $(".clear-all").removeClass('hide')
               $("#template").append(  $(this).clone() );

               //MAke all text editable
               $('#template .text').each(function(e,i){
                  $(this).attr('contenteditable',true)
               })
               
               //MAke all buttons editable
               $('#template .anchor-link').each(function(e,i){
                  $(this).attr('contenteditable',true)
               })

               //
               localStorage.removeItem("font_size"); 

               $('#save-template').attr('disabled',true)

            })

            //section activated for editing
            $(document).on('click', '#template .pointer', function () {
               $(this).addClass('editing')
            })
           
            //Editing fonts && Editing btn
            $(document).on('click', '#template .text', function () {
               removeTextToEditClass()
               removeBtnToEditClass()
               $(this).find('.anchor').addClass('btn-to-edit')
               $(this).addClass('text-to-edit')

               self = $(this);
               text_align = self.data('align')
               line_height = self.data('lineheight')
               letter_spacing  =  self.data('letterspacing')
               font_weight  =  self.data('fontweight')
               font_size  =   self.data('fontsize')
               color = self.data('color')
            })

            $(document).on('click', '#template .main-table', function () {
               removeBorderFromTable()
               var self = $(this)
               self.addClass('background-to-edit').addClass('border')
              //$(this).find('.bg--section').addClass("animate__animated animate__fadeIn").css("display","block");
            })


            //Increase Fonts
            $('#font-slider').on('input',function(){
               var  obj = $(this);
               var  v = obj.val();
               if (v == ''){
                 return 
               }
               font_size = v
               // Store
               localStorage.setItem("font_size", v);
               $('#template .text-to-edit').removeAttr('style').attr('style',"text-align:" + text_align + "; font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-size:"+ v + "px;line-height:" + line_height + "px; text-decoration: none; color: "+ color +"; font-weight:" + font_weight + "; text-transform: uppercase; letter-spacing:"+ letter_spacing + "em");
            });

             //Increase Fonts Line Height
             $('#font-line-height').on('input',function(){
               var  obj = $(this);
               var  v = obj.val();
               if (v == ''){
                 return 
               }
               line_height = v
               font_size = localStorage.getItem("font_size"); 
               $('#template .text-to-edit').removeAttr('style').attr('style',"text-align:" + text_align + "; font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-size:"+ v + "px;line-height:" + line_height + "px; text-decoration: none; color: "+ color +"; font-weight:" + font_weight + "; text-transform: uppercase; letter-spacing:"+ letter_spacing + "em");
            });

            //update bacground color
            $('#bg-color').on('change',function(){
               var v = $(this).val();
               $('#template .background-to-edit').find('.bg-color-section').css('background-color', v ).attr("bgcolor",v);
            }); 

         
            //Edit font color
            $('#font-color').on('change',function(){
               var v = $(this).val();
               color = v
               font_size = localStorage.getItem("font_size"); 
               $('#template .text-to-edit').removeAttr('style').attr('style',"text-align:" + text_align + "; font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-size:"+ font_size + "px;line-height:" + line_height + "px; text-decoration: none; color:" + v +"; font-weight:" + font_weight + "; text-transform: uppercase; letter-spacing:"+ letter_spacing + "em");
            });

            //Change btn colors 
            $('#btn-color').on('change',function(){
               var v = $(this).val();
               $('.btn-to-edit').parent().parent().parent().parent().css({'background-color': v,"border-radius": '55px'})
            });


             //Change banner image 
            $(document).on('click', '#template .pointer .bg-img-section', function () {
               var obj =  $(this);
               $('#bg-img-height').on('input',function(){
                  var h = $(this).val();
                  obj.find('.bg-img').attr("height",h)
               });

               $('#img-src').on('input',function(){
                  var v = $(this).val();
                  obj.find('.bg-img').css('background-image', 'url(' +  v  +')').attr("background",v)
               });
            });

            //Update achor links 
            $('#anchor-link').on('input',function(){
               var v = $(this).val();
               if (v == ''){
                 return 
               }
               $('.btn-to-edit').attr('href', v )
            });

            //Show remove btn
            $(document).on('mouseenter', '#template .pointer', function () {
               $(this).find('.cancel-button').addClass("animate__animated animate__fadeIn").css("display","block");
            }).on('mouseleave', '#template .pointer', function () {
               $(this).find('.cancel-button').removeClass("animate__animated animate__fadeIn").css("display","none");
            });

            $('#clear').on('click',function(e){
               e.preventDefault()
               $("#template").html( '' );
            })

            $(document).on('click',' #template .cancel-button',function(e){
               e.preventDefault()
               $(this).parent().remove();
            })
            
            //Activate image editor
            $(document).on('click',' #template  .container-image',function(e){
               removeImageToEditClass()
               var self = $(this).addClass('image-to-edit').css('border','3px solid #333');
            })

            $('#img-src').on('input',function(){
               var self = $('#template  .image-to-edit')
               var v = $(this).val();
               if (v == ''){
                 return 
               }
               self.find('.p-img').attr("src",v)
            });


            $(document).on('click',' #apply',function(e){
               removeBorderFromTable()
               removeImageToEditClass()
               localStorage.removeItem("font_size"); 
               $('#save-template').attr('disabled',false)
            })

            
            $('#form--template').on('submit',function(e){
               var html  = $("#template").html()
               var all = document.querySelectorAll('#template .cancel-button');
               all.forEach(e => e.remove());
               $("#html").val(html)
            })


            $(document).on('click','#panel-toggle',function(e){
               e.preventDefault()
               $(this).parent().parent().addClass('animate__animated animate__fadeIn')
               $(this).parent().parent().find('form').toggleClass('hide')
               if ( $(this).html()  == '+ Expand'){
                     $(this).html('- Hide')
                     $(this).parent().parent().removeClass('animate__animated animate__fadeIn')
                     return
               }
               if ( $(this).html()  == '- Hide'){
                     $(this).html('+ Expand')
                     return
               }
            })

         function removeTextToEditClass(){
            $('#template .text').each(function(e,i){
               $(this).removeClass('text-to-edit')
            })
         }

         function removeBorderFromTable(){
            $('#template .main-table').each(function(e,i){
               $(this).removeClass('background-to-edit').removeClass('border').css('border','0px')
            })

            $('#template .main-table').each(function(e,i){
            })
         }

         function removeImageToEditClass(){
            $('#template .container-image').each(function(e,i){
               $(this).removeClass('image-to-edit').css('border','none');
            })
         }


         function changeImage(){
            var self = $('#template  .image-to-edit')
            $('#img-src').on('input',function(){
               var v = $(this).val();
               if (v == ''){
                 return 
               }
               self.find('.p-img').attr("src",v)
            });
         }

         function removeBtnToEditClass(){
            $('#template .anchor-link').each(function(e,i){
               $(this).removeClass('btn-to-edit')
            })
         }
      })

      $('.colorpicker').colorpicker({
         format: 'hex', 
      })
   
   </script>
   </body>
</html>

