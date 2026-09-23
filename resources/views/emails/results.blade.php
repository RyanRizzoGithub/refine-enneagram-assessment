<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="x-apple-disable-message-reformatting">
<title>Here are your results</title>
</head>
<body style="margin:0;padding:0;background-color:#F4F4F4;">
<div style="display:none;font-size:1px;color:#F4F4F4;line-height:1px;max-height:0;max-width:0;opacity:0;overflow:hidden;">Let's get to know YOUR Enneagram type.</div>

<table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color:#F4F4F4;">
  <tr>
    <td align="center" style="padding:0 10px;">
      <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">

        <!-- Logo -->
        <tr>
          <td align="center" valign="top" style="padding:40px 10px;">
            <img src="{{ url('/images/the-refine-network/refine-logo.png') }}" width="300" alt="theREFINEnetwork" style="display:block;width:300px;max-width:300px;height:auto;border:0;">
          </td>
        </tr>

        <!-- Headline -->
        <tr>
          <td bgcolor="#FFFFFF" align="center" valign="top" style="padding:40px 20px 20px 20px;border-radius:4px 4px 0 0;color:#111111;font-family:Montserrat,Helvetica,Arial,sans-serif;font-size:44px;font-weight:700;line-height:48px;">
            So, maybe you're a {{ $enneagramNumber }}!
          </td>
        </tr>

        <!-- Intro copy -->
        <tr>
          <td bgcolor="#FFFFFF" align="left" style="padding:5px 30px 10px 30px;color:#666666;font-family:'Open Sans',Helvetica,Arial,sans-serif;font-size:18px;line-height:28px;">
            <p style="margin:0;">Hi {{ $firstName }},</p>
            <p style="margin:16px 0 0 0;">Thanks for taking the theREFINEnetwork Enneagram assessment. This assessment has been extremely helpful in our businesses and relationships to bring awareness and connection. We hope the same will be true for you! View your full results below.</p>
          </td>
        </tr>

        <!-- Results button -->
        <tr>
          <td bgcolor="#FFFFFF" align="center" style="padding:20px 30px 40px 30px;">
            <table role="presentation" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center" bgcolor="#AEABAE" style="border-radius:8px;">
                  <a href="{{ $resultsUrl }}" target="_blank" style="font-size:20px;font-family:Montserrat,Helvetica,Arial,sans-serif;color:#ffffff;text-decoration:none;padding:15px 25px;border-radius:8px;border:1px solid #aeabae;display:inline-block;font-weight:700;">GET YOUR RESULTS</a>
                </td>
              </tr>
            </table>
          </td>
        </tr>

        <!-- Guidance copy + coaching upsell -->
        <tr>
          <td bgcolor="#FFFFFF" align="left" style="padding:0 30px 30px 30px;color:#666666;font-family:'Open Sans',Helvetica,Arial,sans-serif;font-size:18px;line-height:28px;border-radius:0 0 4px 4px;">
            <p style="margin:0 0 20px 0;">If these results are a little overwhelming, we understand. We believe in the power of "why" and recommend starting with the internal drivers. Evaluate how they resonate with you and see if they illuminate unrealized motivations in your life. <em>Once you've grasped the "why", everything else explains "how" and "what".</em> Working through this lens gives you the thorough understanding of your Enneagram type.</p>

            <h1 style="color:#000000;font-family:Montserrat,Helvetica,Arial,sans-serif;font-size:28px;margin:0 0 12px 0;">Take the next step.</h1>
            <p style="margin:0;">While the assessment results give a broad overview of your Enneagram type, the magic lies in the coaching. Sign up for an introductory session below to dig further into your type and what it means to you.</p>

            <table role="presentation" width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center" style="padding:20px 0 10px 0;">
                  {{-- TODO: replace with the real coaching booking URL once confirmed with Evan --}}
                  <table role="presentation" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td align="center" bgcolor="#AEABAE" style="border-radius:8px;">
                        <a href="https://therefinenetwork.com" target="_blank" style="font-size:20px;font-family:Montserrat,Helvetica,Arial,sans-serif;color:#ffffff;text-decoration:none;padding:15px 25px;border-radius:8px;border:1px solid #aeabae;display:inline-block;font-weight:700;">SCHEDULE YOUR SESSION</a>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>

        <!-- "Unsure?" callout -->
        <tr>
          <td align="center" style="padding:20px 10px 0 10px;">
            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tr>
                <td bgcolor="#AEABAE" align="left" style="padding:30px;border-radius:4px;color:#ffffff;font-family:'Open Sans',Helvetica,Arial,sans-serif;font-size:18px;line-height:25px;">
                  <p style="margin:0;">After digging in, are you unsure of your results? Do you feel like you mistyped or the motivations may not have resonated with you? Sometimes that happens. Email us at <a href="mailto:info@truestrategy.info?subject=Assessment%20results%20correction" style="color:#ffffff;text-decoration:underline;">info@truestrategy.info</a> and we'll send you the correct results.</p>
                </td>
              </tr>
            </table>
          </td>
        </tr>

        <!-- Footer -->
        <tr>
          <td align="center" style="padding:30px;color:#808080;font-family:'Open Sans',Helvetica,Arial,sans-serif;font-size:12px;line-height:18px;text-align:center;">
            <p style="margin:0;">You're receiving this because you completed the theREFINEnetwork Enneagram assessment.</p>
            <p style="margin:10px 0 0 0;">True Strategy, PO Box 1143, Belmont, NC 28012, United States</p>
          </td>
        </tr>

      </table>
    </td>
  </tr>
</table>
</body>
</html>
