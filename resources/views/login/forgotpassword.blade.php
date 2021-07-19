<html>
    <head>
        <title>Forgot Password Email</title>
    </head>
    <body>
        <table>
            <tr><td>Dear {{ $Fullname }}</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Your account has been succsfully updated.<br>
            Your account information is as below with new password:
            </td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Email: {{ $Email }}</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>New Password: {{ $Password }}</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Thank & Regards, </td></tr>
            <tr><td>X-Star Cineplex Website</td></tr>
        </table>
    </body>
</html>
