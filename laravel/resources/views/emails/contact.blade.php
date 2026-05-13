<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Contact Message</title>
</head>
<body style="margin: 0; padding: 0; font-family: 'Arial', sans-serif; background-color: #000000; color: #ffffff;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #000000; padding: 40px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #111111; border-top: 5px solid #ffd000; border-radius: 8px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.5);">
                    <tr>
                        <td style="padding: 40px; text-align: center; background-color: #0a0a0a; border-bottom: 1px solid #333333;">
                            <h1 style="color: #ffd000; margin: 0; font-size: 28px; text-transform: uppercase; font-family: 'Arial Black', sans-serif; letter-spacing: 2px;">SCREENBITES</h1>
                            <p style="color: #888888; font-size: 12px; text-transform: uppercase; letter-spacing: 4px; margin-top: 5px;">Cinema Support</p>
                        </td>
                    </tr>
                    
                    <tr>
                        <td style="padding: 40px;">
                            <h2 style="color: #ffffff; margin-top: 0; font-size: 20px; border-bottom: 1px solid #333333; padding-bottom: 15px;">New Message Details</h2>
                            
                            <p style="color: #cccccc; font-size: 15px; margin-bottom: 10px;"><strong>Topic:</strong> <span style="color: #ffd000;">{{ $data['topic'] }}</span></p>
                            <p style="color: #cccccc; font-size: 15px; margin-bottom: 10px;"><strong>Name:</strong> {{ $data['name'] }}</p>
                            <p style="color: #cccccc; font-size: 15px; margin-bottom: 30px;"><strong>Email:</strong> <a href="mailto:{{ $data['email'] }}" style="color: #ffd000; text-decoration: none;">{{ $data['email'] }}</a></p>
                            
                            <h3 style="color: #ffffff; font-size: 16px; margin-bottom: 15px; text-transform: uppercase;">Message:</h3>
                            <div style="background-color: #000000; border-left: 4px solid #ffd000; padding: 20px; color: #aaaaaa; font-size: 15px; line-height: 1.6; border-radius: 0 4px 4px 0;">
                                {{ nl2br(e($data['message'])) }}
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 20px; text-align: center; background-color: #0a0a0a; font-size: 12px; color: #555555;">
                            This email was generated automatically by the Screenbites Cinema system.<br>
                            Do not reply directly to this automated address.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    @include('cookie-banner')
</body>
</html>