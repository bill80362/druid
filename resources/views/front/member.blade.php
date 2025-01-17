<html>
<head>
    <title></title>
</head>
<body>

<div id="fb-root"></div>
<script async defer
        src="https://connect.facebook.net/zh_TW/sdk.js#xfbml=1&version=v21.0&appId=576248175200444"></script>

<div>
    會員名稱：{{$member->name}}
</div>

<div
    class="fb-login-button"
    data-max-rows="1"
    data-size="large"
    data-button-type="continue_with"
    data-use-continue-as="true"
    data-scope="public_profile"
></div>
</body>
</html>

