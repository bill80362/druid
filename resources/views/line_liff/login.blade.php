<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config("app.name")}}-會員資訊</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f3f3f3;
        }
        .loader {
            border: 16px solid #f3f3f3;
            border-top: 16px solid #3498db;
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
<div class="loader"></div>
{{--<h1>{{config("app.name")}}-會員資訊</h1>--}}
{{--<p>User ID: <span id="userId"></span></p>--}}
{{--<p>Display Name: <span id="displayName"></span></p>--}}

<script src="https://static.line-scdn.net/liff/edge/2.1/sdk.js"></script>
<script>
    function initializeLiff(myLiffId) {
        liff.init({ liffId: myLiffId })
            .then(() => {
                if (liff.isLoggedIn()) {
                    getUserProfile();
                } else {
                    liff.login();
                }
            })
            .catch(err => {
                console.error('LIFF Initialization failed', err);
            });
    }

    function getUserProfile() {
        liff.getProfile()
            .then(profile => {
                // document.getElementById('userId').textContent = profile.userId;
                // document.getElementById('displayName').textContent = profile.displayName;
                //
                window.location = '/line_liff/profile/{{$line->user_id}}?userId='+profile.userId+'&name='+profile.displayName;
            })
            .catch(err => {
                console.error('Error getting profile', err);
            });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const myLiffId = '{{$line->liff_id}}'; // Replace with your LIFF ID
        initializeLiff(myLiffId);
    });
</script>

</body>
</html>
