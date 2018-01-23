@extends('layouts.main_mail_layout')

@section('mainContent')
    <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
        <tr>
            <td bgcolor="#70bbd9" align="center" bgcolor="#70bbd9" style="padding: 40px 0 30px 0;">
                <h1 class="mailHeadContent">Tasker</h1>
            </td>
        </tr>
        <tr>
            <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td class="mainCells">
                            <p align="center">Hello!</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 0 30px 0;">
                            <p>{{$textmail}}</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#ee4c50" td bgcolor="#ee4c50" style="padding: 30px 30px 30px 30px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td class="mainCells">
                            Welcome to "Tasker!"
                        </td>
                        <td class="mainCells">
                            <a href="{{env('APP_URL')}}">Go to "Tasker!"</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
@endsection