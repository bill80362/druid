<!DOCTYPE html>
<html lang="en">
<head></head>
<body>

<h2>Add Facebook Login to your webpage</h2>


<p id="profile"></p>

<script>
(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {
        return;
    }
    js = d.createElement(s);
    js.id = id;
    js.src = "https://connect.facebook.net/zh_TW/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk')
);

window.fbAsyncInit = function () {
    <!-- Initialize the SDK with your app and the Graph API version for your app -->
    FB.init({
        appId: '966078551515097',
        xfbml: true,
        version: 'v21.0'
    });
    <!-- If you are logged in, automatically get your name and email adress, your public profile information -->
    FB.login(function (response) {
        console.log(response)
        if (response.authResponse) {
            console.log('Welcome!  Fetching your information.... ');
            FB.api('/me', {fields: 'name, email'}, function (response) {
                console.log(response)
                document.getElementById("profile").innerHTML = "Good to see you, " + response.name + ". i see your email address is " + response.email
            });
        } else {
            <!-- If you are not logged in, the login dialog will open for you to login asking for permission to get your public profile and email -->
            console.log('User cancelled login or did not fully authorize.');
        }
    });

    FB.getLoginStatus(function(response) {
        console.log(response);
        if (response.authResponse) {
            console.log('Welcome!  Fetching your information.... ');
            FB.api('/me', {fields: 'name, email'}, function (response) {
                console.log(response)
                document.getElementById("profile").innerHTML = "Good to see you, " + response.name + ". i see your email address is " + response.email
            });
        } else {
            <!-- If you are not logged in, the login dialog will open for you to login asking for permission to get your public profile and email -->
            console.log('User cancelled login or did not fully authorize.');
        }
    });

    // FB.logout(function(response) {
    //     console.log(response);
    //     // Person is now logged out
    // });


};

</script>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/zh_TW/sdk.js#xfbml=1&version=v21.0&appId=966078551515097"></script>

{{--<div class="fb-login-button" data-width="200" data-size="" data-button-type="" data-layout="" data-auto-logout-link="false" data-use-continue-as="false"></div>--}}

<button type="button" onclick="FB.login()">
    登入
</button>

<button type="button" onclick="FB.logout()">
    登出
</button>

</body>
</html>
